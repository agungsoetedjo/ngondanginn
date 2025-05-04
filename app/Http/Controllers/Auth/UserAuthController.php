<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if (!$user instanceof \App\Models\User) {
                $user = \App\Models\User::find($user->id);
            }
            // Jika belum verifikasi
            if (!$user->is_verified) {
                // Buat ulang kode OTP
                $otp = rand(100000, 999999);
                $userName = $user->name;
                $user->otp_code = $otp;
                $otpDuration = 25;
                $user->otp_expires_at = now()->addMinutes($otpDuration);
                $user->is_verified = false;
                $user->save();

                // Kirim ulang OTP ke email
                // Misalnya untuk development: tulis ke log
                Mail::to($user->email)->send(new SendOtpMail($userName, $otp, $otpDuration));
                session()->forget('url.intended'); // Hapus redirect intended sebelumnya
                $request->session()->regenerate(); // tetap regenerate

                return redirect('/otp-verifikasi')->with([
                    'toast' => [
                        'type' => 'info',
                        'message' => 'Akun belum diverifikasi. Kode OTP baru telah dikirim ulang.',
                        'timer' => 3000,
                    ],'otp_duration' => $otpDuration
                ]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Login berhasil!',
                    'timer' => 2000,
                ]
            ]);
        }

        return back()->withInput()->with([
            'toast' => [
                'type' => 'error',
                'message' => 'Email atau password salah.',
                'timer' => 2000,
            ],
            'errors' => [
                'email' => 'Email atau password salah.',
            ],
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
        $userName = $request->name;
        $otp = random_int(100000, 999999); // OTP 6 digit
        $otpDuration = 25;
        $user = User::create([
            'name' => $userName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes($otpDuration),
            'is_verified' => false,
        ]);

        // Kirim email OTP
        Mail::to($user->email)->send(new SendOtpMail($userName, $otp, $otpDuration));

        // Login user, redirect ke halaman verifikasi
        Auth::login($user);
        session()->forget('url.intended'); // Hapus redirect intended sebelumnya
        return redirect()->route('otp.verify.form')->with([
            'toast' => [
                'type' => 'success',
                'message' => 'Kode OTP telah dikirim ke email Anda',
                'timer' => 2000,
            ],'otp_duration' => $otpDuration
        ]);
    }

    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();

        if (!$user instanceof \App\Models\User) {
            $user = \App\Models\User::find($user->id);
        }
        
        if (
            $user->otp_code === $request->otp &&
            now()->lessThan($user->otp_expires_at)
        ) {
            $user->is_verified = true;
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->intended('/dashboard')->with([
                'toast' => [
                    'type' => 'success',
                    'message' => 'Akun berhasil diverifikasi!',
                    'timer' => 2000,
                ]
            ]);
        }

        return back()->with([
            'toast' => [
                'type' => 'error',
                'message' => 'Kode OTP salah atau sudah kadaluarsa.',
                'timer' => 2000,
            ]
        ]);

    }

    public function resendOtp()
    {
        $user = Auth::user();

        if (!$user || !$user instanceof \App\Models\User) {
            return redirect()->route('login')->with([
                'toast' => [
                    'type' => 'error',
                    'message' => 'Anda harus login terlebih dahulu.',
                    'timer' => 2000,
                ]
            ]);
        }

        if ($user->is_verified) {
            return redirect()->route('dashboard')->with([
                'toast' => [
                    'type' => 'info',
                    'message' => 'Akun Anda sudah terverifikasi.',
                    'timer' => 2000,
                ]
            ]);
        }

        // Generate ulang kode OTP
        $userName = $user->name;
        $otp = random_int(100000, 999999);
        $user->otp_code = $otp;
        $otpDuration = 25;
        $user->otp_expires_at = now()->addMinutes($otpDuration);
        $user->save();

        // Kirim ulang kode OTP
        Mail::to($user->email)->send(new SendOtpMail($userName, $otp, $otpDuration));

        return redirect()->back()->with([
            'toast' => [
                'type' => 'success',
                'message' => 'Kode OTP baru telah dikirim ulang ke email Anda.',
                'timer' => 2000,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $cookie = Cookie::forget('remember_token');

        return redirect()->route('login')->withCookie($cookie)->with('toast', [
            'type' => 'success',
            'message' => 'Anda berhasil logout!',
            'timer' => 2000,
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
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

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            
            // Mendapatkan lebar dan tinggi gambar
            $img = getimagesize($image);
            $width = $img[0];
            $height = $img[1];
    
            // Cek jika gambar persegi (width == height)
            if ($width !== $height) {
                return back()->with('toast', ['type' => 'error', 'message' => 'Foto harus berbentuk persegi.']);
            }
        }

        // Proses Upload Foto
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $photo->getClientOriginalExtension();
            $relativePath = 'assets_be/img/avatars/' . $filename; // path relatif dari public/
        
            // Hapus foto lama jika bukan default
            if ($user->photo && $user->photo !== 'default.jpg') {
                $oldPath = public_path($user->photo);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
        
            $photo->move(public_path('assets_be/img/avatars'), $filename);
        
            // Simpan path lengkap ke database
            $updateData['photo'] = $relativePath;
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

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return view('auth.check-email'); // Tampilkan halaman "Silahkan cek email Anda"
        }

        // Jika gagal mengirimkan email reset
        return back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(string $token, Request $request)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Menyimpan password baru
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save(); // Pastikan save() dipanggil di sini
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('toast', [
                'type' => 'success',
                'message' => 'Password berhasil diperbarui!',
                'timer' => 2000,
            ]);
        }
    
        return back()->with('toast', [
            'type' => 'error',
            'message' => [__($status)],
            'timer' => 2000,
        ]);
    }
}