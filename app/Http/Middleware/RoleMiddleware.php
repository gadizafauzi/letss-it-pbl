<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        // Belum login – arahkan ke halaman login sesuai role
        if (!$user) {
            if ($role === 'admin') {
                return redirect()->route('admin.login');
            }
            return redirect()->route('login');
        }

        // Sudah login tapi role tidak sesuai
        if ($user->role !== $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
