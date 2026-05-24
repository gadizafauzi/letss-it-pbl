<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ==============================
    // LOGIN SISWA & GURU
    // ==============================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();

        // Hanya siswa & guru boleh login di sini
        if ($user->role === 'admin') {
            Auth::logout();
            return back()->withErrors(['login' => 'Gunakan halaman Admin Login.']);
        }

        return match ($user->role) {
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default   => redirect('/'),
        };
    }

    // ==============================
    // LOGIN ADMIN (route terpisah)
    // ==============================
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();

        // Hanya admin boleh login di sini
        if ($user->role !== 'admin') {
            Auth::logout();
            return back()->withErrors(['login' => 'Akses ditolak. Halaman ini khusus admin.']);
        }

        return redirect()->route('admin.dashboard');
    }

    // ==============================
    // LOGOUT
    // ==============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
