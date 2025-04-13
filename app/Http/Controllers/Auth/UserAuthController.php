<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Login berhasil!',
                    'timer' => 2000,
                ]
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->with([
            'toast' => [
                'type' => 'error',
                'message' => 'Email atau password salah.',
                'timer' => 2000,
            ]
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->intended('/dashboard')->with([
            'toast' => [
                'type' => 'success',
                'message' => 'Pendaftaran berhasil, selamat datang!',
                'timer' => 2000,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with([
            'toast' => [
                'type' => 'info',
                'message' => 'Anda telah keluar.',
                'timer' => 2000,
            ]
        ]);
    }

    public function showProfile()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('toast', [
                'type' => 'error',
                'message' => 'Pengguna tidak ditemukan. Silakan login terlebih dahulu.',
                'timer' => 2000,
            ]);
        }
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);
    
        // Update hanya field yang diubah
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        // Jika password diubah
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
    
        // Menggunakan query builder untuk update data
        DB::table('users')
            ->where('id', $user->id)
            ->update($updateData);
    
        return redirect()->route('profile.index')->with('toast', [
            'type' => 'success',
            'message' => 'Profil berhasil diperbarui!',
            'timer' => 2000,
        ]);
    }
    
    
    
}
