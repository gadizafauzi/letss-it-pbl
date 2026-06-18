<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Student Controllers
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\SD\DashboardController as SDDashboard;
use App\Http\Controllers\Student\SMP\DashboardController as SMPDashboard;
use App\Http\Controllers\Student\TagihanController;
use App\Http\Controllers\Student\NilaiController;
use App\Http\Controllers\Student\ProfileController as StudentProfile;

// Teacher Controllers
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\WaliKelas\DashboardController as WaliKelasDashboard;
use App\Http\Controllers\Teacher\WaliKelas\SiswaController as WaliKelasSiswa;
use App\Http\Controllers\Teacher\WaliKelas\NilaiController as WaliKelasNilai;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfile;
use App\Http\Controllers\Teacher\KelasController as TeacherKelas;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\MengajarController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;

// Public Controllers
use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\PublicPpdbController;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\PublicUnitController;

// Models
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;

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
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

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

    Route::post('/admin/siswa/bulk-destroy', [SiswaController::class, 'bulkDestroy'])
        ->name('admin.siswa.bulk-destroy');

    Route::resource('/admin/siswa', SiswaController::class)->names('admin.siswa');

    // KENAIKAN KELAS / BULK PROMOTION
    Route::get('/admin/kenaikan-kelas', [\App\Http\Controllers\Admin\KenaikanKelasController::class, 'index'])->name('admin.kenaikan-kelas.index');
    Route::get('/admin/kenaikan-kelas/students', [\App\Http\Controllers\Admin\KenaikanKelasController::class, 'getStudents'])->name('admin.kenaikan-kelas.students');
    Route::post('/admin/kenaikan-kelas/process', [\App\Http\Controllers\Admin\KenaikanKelasController::class, 'process'])->name('admin.kenaikan-kelas.process');


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

    // KEUANGAN
    Route::resource('/admin/rekening-sekolah', \App\Http\Controllers\Admin\RekeningSekolahController::class)
        ->parameters(['rekening_sekolah' => 'schoolAccount'])
        ->names('admin.rekening-sekolah');
    
    Route::resource('/admin/jenis-tagihan', \App\Http\Controllers\Admin\JenisTagihanController::class)
        ->parameters(['jenis-tagihan' => 'paymentType'])
        ->names('admin.jenis-tagihan');

    // Tambahan untuk view detail per siswa (dipanggil dari resources/views/admin/tagihan/index.blade.php)
    Route::get('/admin/tagihan/student/{student}', [\App\Http\Controllers\Admin\TagihanController::class, 'student'])
        ->name('admin.tagihan.student');
        


    Route::post('/admin/tagihan/broadcast-wa', [\App\Http\Controllers\Admin\TagihanController::class, 'broadcastWa'])
        ->name('admin.tagihan.broadcast-wa');
        
    Route::post('/admin/tagihan/{invoice}/kirim-wa', [\App\Http\Controllers\Admin\TagihanController::class, 'kirimWa'])
        ->name('admin.tagihan.kirim-wa');

    Route::resource('/admin/tagihan', \App\Http\Controllers\Admin\TagihanController::class)
        ->parameters(['tagihan' => 'invoice'])
        ->names('admin.tagihan');
        
    Route::patch('/admin/pembayaran/{payment}/verify', [\App\Http\Controllers\Admin\PembayaranController::class, 'verify'])
        ->name('admin.pembayaran.verify');
    Route::patch('/admin/pembayaran/{payment}/reject', [\App\Http\Controllers\Admin\PembayaranController::class, 'reject'])
        ->name('admin.pembayaran.reject');
    Route::get('/admin/pembayaran/{payment}/print', [\App\Http\Controllers\Admin\PembayaranController::class, 'print'])
        ->name('admin.pembayaran.print');
        
    Route::resource('/admin/pembayaran', \App\Http\Controllers\Admin\PembayaranController::class)
        ->parameters(['pembayaran' => 'payment'])
        ->names('admin.pembayaran');
    Route::get('/admin/laporan-keuangan', [\App\Http\Controllers\Admin\LaporanKeuanganController::class, 'index'])->name('admin.laporan-keuangan.index');
    

    // CMS Beranda
    Route::prefix('admin/cms/beranda')->name('admin.beranda.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'index'])->name('index');
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateHero'])->name('hero.update');
        Route::put('/welcome/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateWelcome'])->name('welcome.update');
        
        // Statistik
        Route::post('/statistic', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'storeStatistic'])->name('statistic.store');
        Route::put('/statistic/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateStatistic'])->name('statistic.update');
        Route::delete('/statistic/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'destroyStatistic'])->name('statistic.destroy');

        // Program
        Route::post('/program', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'storeProgram'])->name('program.store');
        Route::put('/program/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateProgram'])->name('program.update');
        Route::delete('/program/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'destroyProgram'])->name('program.destroy');

        // Keunggulan
        Route::post('/keunggulan', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'storeKeunggulan'])->name('keunggulan.store');
        Route::put('/keunggulan/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateKeunggulan'])->name('keunggulan.update');
        Route::delete('/keunggulan/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'destroyKeunggulan'])->name('keunggulan.destroy');

        // Testimoni
        Route::post('/testimoni', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'storeTestimoni'])->name('testimoni.store');
        Route::put('/testimoni/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateTestimoni'])->name('testimoni.update');
        Route::delete('/testimoni/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'destroyTestimoni'])->name('testimoni.destroy');

        // FAQ
        Route::post('/faq', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'storeFaq'])->name('faq.store');
        Route::put('/faq/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'updateFaq'])->name('faq.update');
        Route::delete('/faq/{id}', [\App\Http\Controllers\Admin\CmsBerandaController::class, 'destroyFaq'])->name('faq.destroy');
    });

    // Placeholder CMS (Akan diimplementasikan nanti)
    // CMS Profil
    Route::prefix('admin/cms/profil')->name('admin.profil.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CmsProfilController::class, 'index'])->name('index');
        
        // Hero
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\CmsProfilController::class, 'updateHero'])->name('hero.update');
        
        // Visi
        Route::put('/visi', [\App\Http\Controllers\Admin\CmsProfilController::class, 'updateVisi'])->name('visi.update');
        
        // Misi
        Route::post('/misi', [\App\Http\Controllers\Admin\CmsProfilController::class, 'storeMisi'])->name('misi.store');
        Route::put('/misi/{id}', [\App\Http\Controllers\Admin\CmsProfilController::class, 'updateMisi'])->name('misi.update');
        Route::delete('/misi/{id}', [\App\Http\Controllers\Admin\CmsProfilController::class, 'destroyMisi'])->name('misi.destroy');
        
        // Sejarah
        Route::post('/sejarah', [\App\Http\Controllers\Admin\CmsProfilController::class, 'storeSejarah'])->name('sejarah.store');
        Route::put('/sejarah/{id}', [\App\Http\Controllers\Admin\CmsProfilController::class, 'updateSejarah'])->name('sejarah.update');
        Route::delete('/sejarah/{id}', [\App\Http\Controllers\Admin\CmsProfilController::class, 'destroySejarah'])->name('sejarah.destroy');
        
        // Struktur Organisasi
        Route::put('/struktur-organisasi', [\App\Http\Controllers\Admin\CmsProfilController::class, 'updateStrukturOrganisasi'])->name('struktur.update');
    });
    Route::prefix('admin/unit-cms')->name('admin.unit-cms.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CmsUnitController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'show'])->name('show');
        
        Route::put('/{id}/hero', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updateHero'])->name('hero.update');
        Route::put('/{id}/detail', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updateDetail'])->name('detail.update');
        
        Route::post('/{id}/fasilitas', [\App\Http\Controllers\Admin\CmsUnitController::class, 'storeFasilitas'])->name('fasilitas.store');
        Route::put('/{id}/fasilitas/{facilityId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updateFasilitas'])->name('fasilitas.update');
        Route::delete('/{id}/fasilitas/{facilityId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

        Route::post('/{id}/ekskul', [\App\Http\Controllers\Admin\CmsUnitController::class, 'storeEkskul'])->name('ekskul.store');
        Route::put('/{id}/ekskul/{ekskulId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updateEkskul'])->name('ekskul.update');
        Route::delete('/{id}/ekskul/{ekskulId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'destroyEkskul'])->name('ekskul.destroy');

        Route::post('/{id}/guru', [\App\Http\Controllers\Admin\CmsUnitController::class, 'storeGuru'])->name('guru.store');
        Route::put('/{id}/guru/{guruId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updateGuru'])->name('guru.update');
        Route::delete('/{id}/guru/{guruId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'destroyGuru'])->name('guru.destroy');

        Route::post('/{id}/prestasi', [\App\Http\Controllers\Admin\CmsUnitController::class, 'storePrestasi'])->name('prestasi.store');
        Route::put('/{id}/prestasi/{prestasiId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'updatePrestasi'])->name('prestasi.update');
        Route::delete('/{id}/prestasi/{prestasiId}', [\App\Http\Controllers\Admin\CmsUnitController::class, 'destroyPrestasi'])->name('prestasi.destroy');
    });
    // CMS Berita & Kegiatan
    Route::prefix('admin/cms/berita')->name('admin.berita.')->group(function () {
        // Kategori Berita
        Route::get('/kategori', [\App\Http\Controllers\Admin\CmsCategoryController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [\App\Http\Controllers\Admin\CmsCategoryController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{id}', [\App\Http\Controllers\Admin\CmsCategoryController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [\App\Http\Controllers\Admin\CmsCategoryController::class, 'destroy'])->name('kategori.destroy');

        // Berita & Kegiatan
        Route::get('/', [\App\Http\Controllers\Admin\CmsPostController::class, 'index'])->name('posts.index');
        Route::get('/create', [\App\Http\Controllers\Admin\CmsPostController::class, 'create'])->name('posts.create');
        Route::post('/', [\App\Http\Controllers\Admin\CmsPostController::class, 'store'])->name('posts.store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\CmsPostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\CmsPostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\CmsPostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/{id}/preview', [\App\Http\Controllers\Admin\CmsPostController::class, 'preview'])->name('posts.preview');
    });
    // Redirect lama -> baru
    Route::get('/admin/berita', fn() => redirect()->route('admin.berita.posts.index'))->name('admin.berita.index');
    // CMS PPDB
    Route::prefix('admin/cms/ppdb')->name('admin.ppdb.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'index'])->name('index');

        // Hero (Edit Only)
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'updateHero'])->name('hero.update');

        // Timeline (CRUD)
        Route::post('/timeline', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'storeTimeline'])->name('timeline.store');
        Route::put('/timeline/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'updateTimeline'])->name('timeline.update');
        Route::delete('/timeline/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'destroyTimeline'])->name('timeline.destroy');

        // Alur / Step (CRUD)
        Route::post('/step', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'storeStep'])->name('step.store');
        Route::put('/step/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'updateStep'])->name('step.update');
        Route::delete('/step/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'destroyStep'])->name('step.destroy');

        // Brosur (CRUD + file upload)
        Route::post('/brochure', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'storeBrochure'])->name('brochure.store');
        Route::put('/brochure/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'updateBrochure'])->name('brochure.update');
        Route::delete('/brochure/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'destroyBrochure'])->name('brochure.destroy');

        // FAQ PPDB (CRUD)
        Route::post('/faq', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'storeFaq'])->name('faq.store');
        Route::put('/faq/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'updateFaq'])->name('faq.update');
        Route::delete('/faq/{id}', [\App\Http\Controllers\Admin\CmsPpdbController::class, 'destroyFaq'])->name('faq.destroy');
    });

    // CMS Kontak Global
    Route::get('/admin/cms/kontak', [\App\Http\Controllers\Admin\CmsKontakController::class, 'index'])->name('admin.kontak.index');
    Route::put('/admin/cms/kontak', [\App\Http\Controllers\Admin\CmsKontakController::class, 'update'])->name('admin.kontak.update');

    Route::resource('/admin/user', UserController::class)->names('admin.user');
    
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');
});

/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/
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