<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Controllers Admin
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\MengajarController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitController;

//Model
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

Route::get('/', function () {
    return view('welcome');
});

// =============================================
// ADMIN
// =============================================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // DASHBOARD
    Route::get('/admin/dashboard', function () {
        $totalSiswa = Student::count();
        $totalGuru  = Teacher::count();
        $totalKelas = SchoolClass::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalKelas'));
    })->name('admin.dashboard');

    // DATA SISWA
    Route::resource('/admin/siswa', SiswaController::class)
        ->names('admin.siswa');

    // DATA GURU
    Route::resource('/admin/guru', GuruController::class)
        ->names('admin.guru');

    // DATA KELAS
    Route::resource('/admin/kelas', KelasController::class)
        ->names('admin.kelas');

    // MATA PELAJARAN
    Route::resource('/admin/mapel', MapelController::class)
        ->names('admin.mapel');

    // DATA MENGAJAR
    Route::resource('/admin/mengajar', MengajarController::class)
        ->names('admin.mengajar');

    // TAHUN AJARAN
    Route::resource('/admin/tahun-ajaran', TahunAjaranController::class)
        ->names('admin.tahun-ajaran');

    Route::patch(
        '/admin/tahun-ajaran/{id}/set-active',
        [TahunAjaranController::class, 'setActive']
    )->name('admin.tahun-ajaran.set-active');

    // JABATAN
    Route::resource('/admin/jabatan', JabatanController::class)
        ->names('admin.jabatan');

    // UNIT PENDIDIKAN (akademik - CRUD)
    Route::resource('/admin/unit', UnitController::class)
        ->names('admin.unit');

    // PEMBAYARAN
    Route::get('/admin/pembayaran', fn() => view('admin.pembayaran.index'))
        ->name('admin.pembayaran.index');

    // =============================================
    // CMS SEKOLAH
    // =============================================

    // BERANDA
    Route::get('/admin/beranda', fn() => view('admin.beranda.index'))
        ->name('admin.beranda.index');

    // PROFIL SEKOLAH
    Route::get('/admin/profil', fn() => view('admin.profil.index'))
        ->name('admin.profil.index');

    // UNIT PENDIDIKAN (CMS - tampilan publik)
    Route::get('/admin/unit-cms', fn() => view('admin.unit-cms.index'))
        ->name('admin.unit-cms.index');

    // BERITA
    Route::get('/admin/berita', fn() => view('admin.berita.index'))
        ->name('admin.berita.index');

    // PPDB
    Route::get('/admin/ppdb', fn() => view('admin.ppdb.index'))
        ->name('admin.ppdb.index');

    // KONTAK
    Route::get('/admin/kontak', fn() => view('admin.kontak.index'))
        ->name('admin.kontak.index');

    // DATA USER
    Route::get('/admin/user', fn() => view('admin.user.index'))
        ->name('admin.user.index');

    // PROFILE ADMIN
    Route::get('/admin/profile', fn() => view('admin.profile.index'))
        ->name('admin.profile.index');
});

// =============================================
// TEACHER
// =============================================
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', fn() => view('teacher.dashboard'))
        ->name('teacher.dashboard');
});

// =============================================
// STUDENT
// =============================================
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', fn() => view('student.dashboard'))
        ->name('student.dashboard');
});

// =============================================
// AUTH
// =============================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
