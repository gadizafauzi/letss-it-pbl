<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\KelasController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [DashboardController::class, 'index'])
        ->name('teacher.dashboard');

    Route::get('/teacher/kelas-saya', [KelasController::class, 'kelasSaya'])
        ->name('teacher.kelas-saya');

    Route::get('/teacher/input-nilai', [KelasController::class, 'inputNilai'])
        ->name('teacher.input-nilai');

    Route::get('/teacher/input-nilai/{assignment}', [KelasController::class, 'inputNilai'])
        ->name('teacher.input-nilai.assignment');

    Route::post('/teacher/input-nilai/store', [KelasController::class, 'storeNilai'])
        ->name('teacher.input-nilai.store');

    Route::get('/teacher/kelas/{kelas}/siswa', [KelasController::class, 'dataSiswa'])
        ->name('teacher.data-siswa');

    Route::get('/teacher/wali-data-siswa', [KelasController::class, 'waliDataSiswa'])
        ->name('teacher.wali-data-siswa');

    Route::get('/teacher/wali-rekap-nilai', [KelasController::class, 'waliRekapNilai'])
        ->name('teacher.wali-rekap-nilai');

    Route::get('/teacher/profil', [KelasController::class, 'profil'])
        ->name('teacher.profil');
});

use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\ProfileController as StudentProfile;
use App\Http\Controllers\Student\NilaiController as StudentNilai;
use App\Http\Controllers\Student\TagihanController as StudentTagihan;

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboard::class, 'index'])
        ->name('student.dashboard');
    Route::get('/student/cetak-ktm', [StudentDashboard::class, 'cetakKtm'])
        ->name('student.cetak-ktm');
    Route::get('/student/profil', [StudentProfile::class, 'index'])
        ->name('student.profil');
    Route::post('/student/profil/update', [StudentProfile::class, 'update'])
        ->name('student.profil.update');
    Route::get('/student/nilai', [StudentNilai::class, 'index'])
        ->name('student.nilai');
    Route::get('/student/tagihan', [StudentTagihan::class, 'index'])
        ->name('student.tagihan');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');
