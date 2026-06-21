<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Cek apakah role user sesuai dengan yang diizinkan di route
     * Contoh pakai: middleware('role:dokter,perawat')
     */
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        $user = $request->user();
//dd($user, $roles, $request->session()->getId()); //debug
        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}