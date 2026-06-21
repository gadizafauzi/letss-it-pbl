<?php

use Illuminate\Support\Facades\Route;

// Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\WaliKelas\DashboardController as WaliKelasDashboard;
use App\Http\Controllers\Teacher\WaliKelas\SiswaController as WaliKelasSiswa;
use App\Http\Controllers\Teacher\WaliKelas\NilaiController as WaliKelasNilai;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfile;
use App\Http\Controllers\Teacher\KelasController as TeacherKelas;

Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/teacher/dashboard', [TeacherDashboard::class, 'index'])
        ->name('teacher.dashboard');
        
    Route::get('/teacher/wali-kelas/dashboard', [WaliKelasDashboard::class, 'index'])
        ->name('teacher.wali-kelas.dashboard');

    Route::get('/teacher/wali-data-siswa', [WaliKelasSiswa::class, 'index'])
        ->name('teacher.wali-data-siswa');
    Route::get('/teacher/wali-data-siswa/export', [WaliKelasSiswa::class, 'export'])
        ->name('teacher.wali-data-siswa.export');

    Route::get('/teacher/wali-rekap-nilai', [WaliKelasNilai::class, 'index'])
        ->name('teacher.wali-rekap-nilai');
    Route::get('/teacher/wali-rekap-nilai/export', [WaliKelasNilai::class, 'export'])
        ->name('teacher.wali-rekap-nilai.export');
    Route::post('/teacher/wali-rekap-nilai/publish', [WaliKelasNilai::class, 'publish'])
        ->name('teacher.wali-rekap-nilai.publish');

    Route::get('/teacher/data-siswa/{classId}', [TeacherKelas::class, 'dataSiswa'])
        ->name('teacher.data-siswa');

    Route::get('/teacher/kelas-saya', [TeacherKelas::class, 'kelasSaya'])
        ->name('teacher.kelas-saya');

    Route::get('/teacher/input-nilai/{teachingId?}', [TeacherKelas::class, 'inputNilai'])
        ->name('teacher.input-nilai');

    Route::post('/teacher/input-nilai', [TeacherKelas::class, 'storeNilai'])
        ->name('teacher.input-nilai.store');

    Route::get('/teacher/profil', [TeacherProfile::class, 'profil'])
        ->name('teacher.profil');

    Route::post('/teacher/profil/update', [TeacherProfile::class, 'updateProfile'])
        ->name('teacher.profil.update');
});
