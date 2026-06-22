<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah user sudah login dan rolenya sesuai dengan yang diminta
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika tidak sesuai, tampilkan error 403 (Dilarang Akses)
        abort(403, 'Maaf, Anda tidak memiliki akses ke halaman ini.');
    }
}