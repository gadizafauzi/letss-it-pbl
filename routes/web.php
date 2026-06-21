<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Public Controllers
use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\PublicPpdbController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\PublicUnitController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicHomeController::class, 'index'])->name('public.home');
Route::get('/coming-soon', fn() => view('shared.coming-soon'))->name('coming-soon');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
require __DIR__ . '/admin.php';

/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/
require __DIR__ . '/teacher.php';

/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/
require __DIR__ . '/student.php';

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/profile/change-password', [AuthController::class, 'updatePassword'])
        ->name('profile.password.update');
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/profil', [PublicProfileController::class, 'index'])
    ->name('public.profil.index');

/*
|--------------------------------------------------------------------------
| UNIT TK
|--------------------------------------------------------------------------
*/

Route::get('/unit/tk', [PublicUnitController::class, 'tk'])
    ->name('public.unit.tk.index');

/*
|--------------------------------------------------------------------------
| UNIT SD
|--------------------------------------------------------------------------
*/

Route::get('/unit/sd', [PublicUnitController::class, 'sd'])
    ->name('public.unit.sd.index');

/*
|--------------------------------------------------------------------------
| UNIT SMP
|--------------------------------------------------------------------------
*/

Route::get('/unit/smp', [PublicUnitController::class, 'smp'])
    ->name('public.unit.smp.index');

/*
|--------------------------------------------------------------------------
| BERITA
|--------------------------------------------------------------------------
*/

Route::get('/berita', [PublicNewsController::class, 'index'])
    ->name('public.berita.index');

Route::get('/berita/kategori', [PublicNewsController::class, 'categories'])
    ->name('public.berita.kategori');

Route::get('/berita/kategori/{slug}', [PublicNewsController::class, 'category'])
    ->name('public.berita.category');

Route::get('/berita/search', [PublicNewsController::class, 'search'])
    ->name('public.berita.search');

Route::get('/berita/{slug}', [PublicNewsController::class, 'show'])
    ->name('public.berita.detail');

/*
|--------------------------------------------------------------------------
| PPDB
|--------------------------------------------------------------------------
*/

Route::get('/ppdb', [PublicPpdbController::class, 'index'])
    ->name('public.ppdb.index');

Route::get('/ppdb/alur', fn() => redirect('/ppdb#alur'))
    ->name('public.ppdb.alur');

Route::get('/ppdb/syarat', fn() => redirect('/ppdb#syarat'))
    ->name('public.ppdb.syarat');

Route::get('/ppdb/jadwal', fn() => redirect('/ppdb#timeline'))
    ->name('public.ppdb.jadwal');

Route::get('/ppdb/faq', fn() => redirect('/ppdb#faq'))
    ->name('public.ppdb.faq');

Route::get('/ppdb/kontak', fn() => redirect('/ppdb#kontak'))
    ->name('public.ppdb.form-kontak');