<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController ;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', fn() => view('teacher.dashboard'))
        ->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', fn() => view('student.dashboard'))
        ->name('student.dashboard');
});




// login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// ============================
// HALAMAN PUBLIK
// ============================

// Beranda
Route::get('/', fn() => view('public.home.index'))->name('public.home');

// Profil
Route::get('/profil/visi-misi', fn() => view('public.profil.visi-misi'))->name('public.profil.visi-misi');
Route::get('/profil/sejarah', fn() => view('public.profil.sejarah'))->name('public.profil.sejarah');
Route::get('/profil/struktur-organisasi', fn() => view('public.profil.struktur-organisasi'))->name('public.profil.struktur-organisasi');

// Unit Pendidikan
Route::get('/unit', fn() => view('public.unit.index'))->name('public.unit.index');
Route::get('/unit/tk/profil', fn() => view('public.unit.tk.profil'))->name('public.unit.tk.profil');
Route::get('/unit/tk/guru', fn() => view('public.unit.tk.guru'))->name('public.unit.tk.guru');
Route::get('/unit/tk/ekskul', fn() => view('public.unit.tk.ekskul'))->name('public.unit.tk.ekskul');
Route::get('/unit/tk/fasilitas', fn() => view('public.unit.tk.fasilitas'))->name('public.unit.tk.fasilitas');
Route::get('/unit/tk/prestasi', fn() => view('public.unit.tk.prestasi'))->name('public.unit.tk.prestasi');
Route::get('/unit/sd/profil', fn() => view('public.unit.sd.profil'))->name('public.unit.sd.profil');
Route::get('/unit/sd/guru', fn() => view('public.unit.sd.guru'))->name('public.unit.sd.guru');
Route::get('/unit/sd/ekskul', fn() => view('public.unit.sd.ekskul'))->name('public.unit.sd.ekskul');
Route::get('/unit/sd/fasilitas', fn() => view('public.unit.sd.fasilitas'))->name('public.unit.sd.fasilitas');
Route::get('/unit/sd/prestasi', fn() => view('public.unit.sd.prestasi'))->name('public.unit.sd.prestasi');
Route::get('/unit/smp/profil', fn() => view('public.unit.smp.profil'))->name('public.unit.smp.profil');
Route::get('/unit/smp/guru', fn() => view('public.unit.smp.guru'))->name('public.unit.smp.guru');
Route::get('/unit/smp/ekskul', fn() => view('public.unit.smp.ekskul'))->name('public.unit.smp.ekskul');
Route::get('/unit/smp/fasilitas', fn() => view('public.unit.smp.fasilitas'))->name('public.unit.smp.fasilitas');
Route::get('/unit/smp/prestasi', fn() => view('public.unit.smp.prestasi'))->name('public.unit.smp.prestasi');

// Berita
Route::get('/berita', fn() => view('public.berita.index'))->name('public.berita.index');
Route::get('/berita/detail', fn() => view('public.berita.detail'))->name('public.berita.detail');
Route::get('/berita/kategori', fn() => view('public.berita.kategori'))->name('public.berita.kategori');
Route::get('/berita/search', fn() => view('public.berita.search'))->name('public.berita.search');

// PPDB
Route::get('/ppdb', fn() => view('public.ppdb.index'))->name('public.ppdb.index');
Route::get('/ppdb/alur', fn() => view('public.ppdb.alur'))->name('public.ppdb.alur');
Route::get('/ppdb/syarat', fn() => view('public.ppdb.syarat'))->name('public.ppdb.syarat');
Route::get('/ppdb/jadwal', fn() => view('public.ppdb.jadwal'))->name('public.ppdb.jadwal');
Route::get('/ppdb/faq', fn() => view('public.ppdb.faq'))->name('public.ppdb.faq');
Route::get('/ppdb/kontak', fn() => view('public.ppdb.form-kontak'))->name('public.ppdb.form-kontak');

