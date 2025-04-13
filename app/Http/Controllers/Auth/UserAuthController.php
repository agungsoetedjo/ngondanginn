<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
}
