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

        // belum login
        if (!$user) {
            return redirect('/login');
        }

        // tidak sesuai role
        if ($user->role !== $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
