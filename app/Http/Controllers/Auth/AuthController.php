<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==============================
    // LOGIN SISWA & GURU
    // ==============================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ── Validasi CAPTCHA terlebih dahulu ──
        $request->validate(
            ['captcha' => 'required|captcha'],
            ['captcha.required' => 'Captcha wajib diisi.',
             'captcha.captcha'  => 'Captcha yang dimasukkan salah.']
        );

        // ── Validasi & autentikasi via LoginRequest ──
        $loginRequest = LoginRequest::createFrom($request);
        $loginRequest->setContainer(app())->setRedirector(app('redirect'));
        $loginRequest->validateResolved();
        $loginRequest->authenticate();

        $user = Auth::user();

        // Cek status aktif
        if ($user->status !== 'active') {
            Auth::logout();
            return back()->withErrors(['login' => 'Akun Anda sudah tidak aktif. Silakan hubungi Administrator.']);
        }

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
    // REFRESH CAPTCHA (AJAX)
    // ==============================
    public function refreshCaptcha()
    {
        return response()->json([
            'captcha' => preg_replace('/src="https?:\/\/[^\/]+/', 'src="', captcha_img('math')),
        ]);
    }

    // ==============================
    // LOGIN ADMIN (route terpisah)
    // ==============================
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        // ── Validasi CAPTCHA terlebih dahulu ──
        $request->validate(
            ['captcha' => 'required|captcha'],
            ['captcha.required' => 'Captcha wajib diisi.',
             'captcha.captcha'  => 'Captcha yang dimasukkan salah.']
        );

        // ── Validasi & autentikasi via LoginRequest ──
        $loginRequest = LoginRequest::createFrom($request);
        $loginRequest->setContainer(app())->setRedirector(app('redirect'));
        $loginRequest->validateResolved();
        $loginRequest->authenticate();

        $user = Auth::user();

        // Cek status aktif
        if ($user->status !== 'active') {
            Auth::logout();
            return back()->withErrors(['login' => 'Akun admin Anda sudah tidak aktif.']);
        }

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

    // ==============================
    // UPDATE PASSWORD (ALL ROLES)
    // ==============================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|same:konfirmasi_password',
        ], [
            'password_baru.same' => 'Konfirmasi password harus sama dengan password baru.',
            'password_baru.min' => 'Password baru minimal 8 karakter.',
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Password berhasil diperbarui. Silakan login kembali.');
    }
}

