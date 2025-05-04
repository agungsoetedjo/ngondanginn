<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        $user->loadMissing('role');

        if ($user && $user->role && in_array($user->role->name, $roles)) {
            return $next($request);
        }

        return redirect()->back()->with('sweetalert', ['type' => 'warning', 'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
    }
}
