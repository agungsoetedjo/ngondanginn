<?php

namespace App\Http\Middleware;

use App\Mail\SendOtpMail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class CheckVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->is_verified) {
            if (!$user instanceof \App\Models\User) {
                $user = \App\Models\User::find($user->id);
            }

            $userName = $user->name;
            $otp = rand(100000, 999999);
            $user->otp_code = $otp;
            $otpDuration = 25;
            $user->otp_expires_at = now()->addMinutes($otpDuration);
            $user->is_verified = false;
            $user->save();
            Mail::to($user->email)->send(new SendOtpMail($userName, $otp, $otpDuration));
            session()->forget('url.intended'); // Hapus redirect intended sebelumnya
            $request->session()->regenerate(); // tetap regenerate
            
            $request->session()->put('otp_duration', $otpDuration);
            // Jika pengguna belum diverifikasi, arahkan ke halaman verifikasi OTP atau halaman lain
            return redirect('/otp-verifikasi')->with('toast', [
                'type' => 'warning',
                'message' => 'Akun Anda belum diverifikasi. Silakan verifikasi dengan kode OTP.',
                'timer' => 3000,
            ]);
        }

        return $next($request);
    }
}
