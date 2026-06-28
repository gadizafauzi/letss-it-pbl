<?php

use Illuminate\Support\Facades\Route;

// Student Controllers
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\SD\DashboardController as SDDashboard;
use App\Http\Controllers\Student\SMP\DashboardController as SMPDashboard;
use App\Http\Controllers\Student\TagihanController; use App\Http\Controllers\Student\RaporController;
use App\Http\Controllers\Student\NilaiController;
use App\Http\Controllers\Student\ProfileController as StudentProfile;

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', [StudentDashboard::class, 'index'])
        ->name('student.dashboard');

    Route::get('/student/sd/dashboard', [SDDashboard::class, 'index'])
        ->name('student.sd.dashboard');

    Route::get('/student/smp/dashboard', [SMPDashboard::class, 'index'])
        ->name('student.smp.dashboard');

    Route::get('/student/tagihan', [TagihanController::class, 'index'])
        ->name('student.tagihan');
    Route::post('/student/tagihan/{invoice}/bayar', [TagihanController::class, 'storePayment'])
        ->name('student.tagihan.bayar');

    Route::get('/student/nilai', [NilaiController::class, 'index'])
        ->name('student.nilai');

    Route::get('/student/profil', [StudentProfile::class, 'index'])
        ->name('student.profil');

    Route::match(['put', 'post'], '/student/profil', [StudentProfile::class, 'update'])
        ->name('student.profil.update');

    Route::get('/student/rapor/{id}/pdf', [RaporController::class, 'downloadPdf'])
        ->name('student.rapor.pdf');
});
