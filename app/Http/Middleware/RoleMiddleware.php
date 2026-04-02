<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Periksa apakah role user sesuai dengan yang diizinkan.
     * Contoh pemakaian di route: middleware('role:admin')
     *                            middleware('role:admin,pm')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Kalau belum login, arahkan ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Kalau role user tidak ada di daftar yang diizinkan, tolak akses
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}