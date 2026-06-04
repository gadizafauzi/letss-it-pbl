<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Student Controllers
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\TagihanController;
use App\Http\Controllers\Student\NilaiController;
use App\Http\Controllers\Student\ProfileController as StudentProfile;

// Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\KelasController as TeacherKelas;

// Admin Controllers
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\MengajarController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitController;

// Models
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('public.home.index'))->name('public.home');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        $totalSiswa = Student::count();
        $totalGuru  = Teacher::count();
        $totalKelas = SchoolClass::count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalKelas'));
    })->name('admin.dashboard');

    //tambahan 30 mei
    Route::get('/admin/siswa/export', [SiswaController::class, 'export'])
        ->name('admin.siswa.export');

    Route::get('/admin/siswa/import', [SiswaController::class, 'importPage'])
        ->name('admin.siswa.import');

    Route::post('/admin/siswa/import', [SiswaController::class, 'import'])
        ->name('admin.siswa.import.post');

    Route::get('/admin/siswa/import/template', [SiswaController::class, 'importTemplate'])
        ->name('admin.siswa.import.template');

    Route::get('/admin/siswa/classes-by-unit/{unit}', [SiswaController::class, 'classesByUnit'])
        ->name('admin.siswa.classes-by-unit');

    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');

    //======
    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');

    Route::get('/admin/guru/export', [GuruController::class, 'export'])
        ->name('admin.guru.export');

    Route::get('/admin/guru/import', [GuruController::class, 'importPage'])
        ->name('admin.guru.import');

    Route::post('/admin/guru/import', [GuruController::class, 'import'])
        ->name('admin.guru.import.post');

    Route::get('/admin/guru/import/template', [GuruController::class, 'importTemplate'])
        ->name('admin.guru.import.template');

    Route::resource('/admin/guru', GuruController::class)->names('admin.guru');
    Route::resource('/admin/kelas', KelasController::class)->names('admin.kelas');
    Route::resource('/admin/mapel', MapelController::class)->names('admin.mapel');
    Route::resource('/admin/mengajar', MengajarController::class)->names('admin.mengajar');
    Route::resource('/admin/tahun-ajaran', TahunAjaranController::class)->names('admin.tahun-ajaran');

    Route::patch(
        '/admin/tahun-ajaran/{id}/set-active',
        [TahunAjaranController::class, 'setActive']
    )->name('admin.tahun-ajaran.set-active');

    Route::resource('/admin/jabatan', JabatanController::class)->names('admin.jabatan');
    Route::resource('/admin/unit', UnitController::class)->names('admin.unit');

    Route::get('/admin/pembayaran', fn() => view('admin.pembayaran.index'))
        ->name('admin.pembayaran.index');


    // CMS
    Route::get('/admin/beranda', fn() => view('admin.beranda.index'))->name('admin.beranda.index');
    Route::get('/admin/profil', fn() => view('admin.profil.index'))->name('admin.profil.index');
    Route::get('/admin/unit-cms', fn() => view('admin.unit-cms.index'))->name('admin.unit-cms.index');
    Route::get('/admin/berita', fn() => view('admin.berita.index'))->name('admin.berita.index');
    Route::get('/admin/ppdb', fn() => view('admin.ppdb.index'))->name('admin.ppdb.index');
    Route::get('/admin/kontak', fn() => view('admin.kontak.index'))->name('admin.kontak.index');
    Route::get('/admin/user', fn() => view('admin.user.index'))->name('admin.user.index');
    Route::get('/admin/profile', fn() => view('admin.profile.index'))->name('admin.profile.index');
});

/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/teacher/dashboard', [TeacherDashboard::class, 'index'])
        ->name('teacher.dashboard');

    Route::get('/teacher/wali-data-siswa', [TeacherKelas::class, 'waliDataSiswa'])
        ->name('teacher.wali-data-siswa');

    Route::get('/teacher/wali-rekap-nilai', [TeacherKelas::class, 'waliRekapNilai'])
        ->name('teacher.wali-rekap-nilai');

    Route::get('/teacher/data-siswa/{classId}', [TeacherKelas::class, 'dataSiswa'])
        ->name('teacher.data-siswa');

    Route::get('/teacher/kelas-saya', [TeacherKelas::class, 'kelasSaya'])
        ->name('teacher.kelas-saya');

    Route::get('/teacher/input-nilai/{teachingId?}', [TeacherKelas::class, 'inputNilai'])
        ->name('teacher.input-nilai');

    Route::post('/teacher/input-nilai', [TeacherKelas::class, 'storeNilai'])
        ->name('teacher.input-nilai.store');

    Route::get('/teacher/profil', [TeacherKelas::class, 'profil'])
        ->name('teacher.profil');
});

/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/dashboard', [StudentDashboard::class, 'index'])
        ->name('student.dashboard');

    Route::get('/student/tagihan', [TagihanController::class, 'index'])
        ->name('student.tagihan');

    Route::get('/student/nilai', [NilaiController::class, 'index'])
        ->name('student.nilai');

    Route::get('/student/profil', [StudentProfile::class, 'index'])
        ->name('student.profil');

    Route::match(['put', 'post'], '/student/profil', [StudentProfile::class, 'update'])
        ->name('student.profil.update');

    Route::get('/student/cetak-ktm', [StudentProfile::class, 'cetakKtm'])
        ->name('student.cetak-ktm');
});

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

Route::get('/profil/visi-misi', fn() => view('public.profil.visi-misi'))
    ->name('public.profil.visi-misi');

Route::get('/profil/sejarah', fn() => view('public.profil.sejarah'))
    ->name('public.profil.sejarah');

Route::get('/profil/struktur-organisasi', fn() => view('public.profil.struktur-organisasi'))
    ->name('public.profil.struktur-organisasi');


/*
|--------------------------------------------------------------------------
| UNIT
|--------------------------------------------------------------------------
*/

Route::get('/unit', fn() => view('public.unit.index'))
    ->name('public.unit.index');


/*
|--------------------------------------------------------------------------
| UNIT TK
|--------------------------------------------------------------------------
*/

Route::get('/unit/tk/profil', fn() => view('public.unit.tk.profil'))
    ->name('public.unit.tk.profil');

Route::get('/unit/tk/guru', fn() => view('public.unit.tk.guru'))
    ->name('public.unit.tk.guru');

Route::get('/unit/tk/ekskul', fn() => view('public.unit.tk.ekskul'))
    ->name('public.unit.tk.ekskul');

Route::get('/unit/tk/fasilitas', fn() => view('public.unit.tk.fasilitas'))
    ->name('public.unit.tk.fasilitas');

Route::get('/unit/tk/prestasi', fn() => view('public.unit.tk.prestasi'))
    ->name('public.unit.tk.prestasi');


/*
|--------------------------------------------------------------------------
| UNIT SD
|--------------------------------------------------------------------------
*/

Route::get('/unit/sd/profil', fn() => view('public.unit.sd.profil'))
    ->name('public.unit.sd.profil');

Route::get('/unit/sd/guru', fn() => view('public.unit.sd.guru'))
    ->name('public.unit.sd.guru');

Route::get('/unit/sd/ekskul', fn() => view('public.unit.sd.ekskul'))
    ->name('public.unit.sd.ekskul');

Route::get('/unit/sd/fasilitas', fn() => view('public.unit.sd.fasilitas'))
    ->name('public.unit.sd.fasilitas');

Route::get('/unit/sd/prestasi', fn() => view('public.unit.sd.prestasi'))
    ->name('public.unit.sd.prestasi');


/*
|--------------------------------------------------------------------------
| UNIT SMP
|--------------------------------------------------------------------------
*/

Route::get('/unit/smp/profil', fn() => view('public.unit.smp.profil'))
    ->name('public.unit.smp.profil');

Route::get('/unit/smp/guru', fn() => view('public.unit.smp.guru'))
    ->name('public.unit.smp.guru');

Route::get('/unit/smp/ekskul', fn() => view('public.unit.smp.ekskul'))
    ->name('public.unit.smp.ekskul');

Route::get('/unit/smp/fasilitas', fn() => view('public.unit.smp.fasilitas'))
    ->name('public.unit.smp.fasilitas');

Route::get('/unit/smp/prestasi', fn() => view('public.unit.smp.prestasi'))
    ->name('public.unit.smp.prestasi');


/*
|--------------------------------------------------------------------------
| BERITA
|--------------------------------------------------------------------------
*/

Route::get('/berita', fn() => view('public.berita.index'))
    ->name('public.berita.index');

Route::get('/berita/detail', fn() => view('public.berita.detail'))
    ->name('public.berita.detail');

Route::get('/berita/kategori', fn() => view('public.berita.kategori'))
    ->name('public.berita.kategori');

Route::get('/berita/search', fn() => view('public.berita.search'))
    ->name('public.berita.search');


/*
|--------------------------------------------------------------------------
| PPDB
|--------------------------------------------------------------------------
*/

Route::get('/ppdb', fn() => view('public.ppdb.index'))
    ->name('public.ppdb.index');

Route::get('/ppdb/alur', fn() => redirect('/ppdb#alur'))
    ->name('public.ppdb.alur');

Route::get('/ppdb/syarat', fn() => redirect('/ppdb#syarat'))
    ->name('public.ppdb.syarat');

Route::get('/ppdb/jadwal', fn() => view('public.ppdb.jadwal'))
    ->name('public.ppdb.jadwal');

Route::get('/ppdb/faq', fn() => redirect('/ppdb#faq'))
    ->name('public.ppdb.faq');

Route::get('/ppdb/kontak', fn() => redirect('/ppdb#kontak'))
    ->name('public.ppdb.form-kontak');
