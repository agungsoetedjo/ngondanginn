<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBendahara
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $user->loadMissing('role');

        if ($user && $user->role && $user->role->name === 'bendahara') {
            return $next($request);
        }

        return redirect()->back()->with('sweetalert', ['type' => 'warning', 'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
    }
}
