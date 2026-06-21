<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\System\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Akademik\SiswaController;
use App\Http\Controllers\Admin\Akademik\GuruController;
use App\Http\Controllers\Admin\Akademik\KelasController;
use App\Http\Controllers\Admin\Akademik\MapelController;
use App\Http\Controllers\Admin\Akademik\MengajarController;
use App\Http\Controllers\Admin\Akademik\TahunAjaranController;
use App\Http\Controllers\Admin\Akademik\JabatanController;
use App\Http\Controllers\Admin\Akademik\UnitController;
use App\Http\Controllers\Admin\System\UserController;
use App\Http\Controllers\Admin\System\ProfileController;

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
    Route::get('/admin/kenaikan-kelas', [\App\Http\Controllers\Admin\Akademik\KenaikanKelasController::class, 'index'])->name('admin.kenaikan-kelas.index');
    Route::get('/admin/kenaikan-kelas/students', [\App\Http\Controllers\Admin\Akademik\KenaikanKelasController::class, 'getStudents'])->name('admin.kenaikan-kelas.students');
    Route::post('/admin/kenaikan-kelas/process', [\App\Http\Controllers\Admin\Akademik\KenaikanKelasController::class, 'process'])->name('admin.kenaikan-kelas.process');


    Route::get('/admin/guru/export', [GuruController::class, 'export'])
        ->name('admin.guru.export');

    Route::get('/admin/guru/import', [GuruController::class, 'importPage'])
        ->name('admin.guru.import');

    Route::post('/admin/guru/import', [GuruController::class, 'import'])
        ->name('admin.guru.import.post');

    Route::get('/admin/guru/import/template', [GuruController::class, 'importTemplate'])
        ->name('admin.guru.import.template');

    Route::post('/admin/guru/bulk-destroy', [GuruController::class, 'bulkDestroy'])
        ->name('admin.guru.bulk-destroy');

    Route::post('/admin/kelas/bulk-destroy', [KelasController::class, 'bulkDestroy'])
        ->name('admin.kelas.bulk-destroy');

    Route::post('/admin/mapel/bulk-destroy', [MapelController::class, 'bulkDestroy'])
        ->name('admin.mapel.bulk-destroy');

    Route::post('/admin/mengajar/bulk-destroy', [MengajarController::class, 'bulkDestroy'])
        ->name('admin.mengajar.bulk-destroy');

    Route::post('/admin/tahun-ajaran/bulk-destroy', [TahunAjaranController::class, 'bulkDestroy'])
        ->name('admin.tahun-ajaran.bulk-destroy');

    Route::resource('/admin/guru', GuruController::class)->names('admin.guru');
    Route::resource('/admin/kelas', KelasController::class)->names('admin.kelas');
    Route::resource('/admin/mapel', MapelController::class)->names('admin.mapel');
    Route::resource('/admin/mengajar', MengajarController::class)->names('admin.mengajar');
    Route::resource('/admin/tahun-ajaran', TahunAjaranController::class)->names('admin.tahun-ajaran');

    Route::patch(
        '/admin/tahun-ajaran/{id}/set-active',
        [TahunAjaranController::class, 'setActive']
    )->name('admin.tahun-ajaran.set-active');

    Route::post('/admin/jabatan/bulk-destroy', [JabatanController::class, 'bulkDestroy'])
        ->name('admin.jabatan.bulk-destroy');

    Route::resource('/admin/jabatan', JabatanController::class)->names('admin.jabatan');

    Route::post('/admin/unit/bulk-destroy', [UnitController::class, 'bulkDestroy'])
        ->name('admin.unit.bulk-destroy');

    Route::resource('/admin/unit', UnitController::class)->names('admin.unit');

    Route::resource('/admin/mapel', MapelController::class)->names('admin.mapel');
    Route::resource('/admin/mengajar', MengajarController::class)->names('admin.mengajar');
    Route::resource('/admin/tahun-ajaran', TahunAjaranController::class)->names('admin.tahun-ajaran');

    Route::patch(
        '/admin/tahun-ajaran/{id}/set-active',
        [TahunAjaranController::class, 'setActive']
    )->name('admin.tahun-ajaran.set-active');

    Route::post('/admin/jabatan/bulk-destroy', [JabatanController::class, 'bulkDestroy'])
        ->name('admin.jabatan.bulk-destroy');

    Route::resource('/admin/jabatan', JabatanController::class)->names('admin.jabatan');

    // KEUANGAN
    Route::resource('/admin/rekening-sekolah', \App\Http\Controllers\Admin\Keuangan\RekeningSekolahController::class)
        ->parameters(['rekening_sekolah' => 'schoolAccount'])
        ->names('admin.rekening-sekolah');
    
    Route::post('/admin/jenis-tagihan/bulk-destroy', [\App\Http\Controllers\Admin\Keuangan\JenisTagihanController::class, 'bulkDestroy'])
        ->name('admin.jenis-tagihan.bulk-destroy');
        
    Route::resource('/admin/jenis-tagihan', \App\Http\Controllers\Admin\Keuangan\JenisTagihanController::class)
        ->parameters(['jenis-tagihan' => 'paymentType'])
        ->names('admin.jenis-tagihan');

    // Tambahan untuk view detail per siswa (dipanggil dari resources/views/admin/tagihan/index.blade.php)
    Route::get('/admin/tagihan/student/{student}', [\App\Http\Controllers\Admin\Keuangan\TagihanController::class, 'student'])
        ->name('admin.tagihan.student');
        
    Route::post('/admin/tagihan/broadcast-wa', [\App\Http\Controllers\Admin\Keuangan\TagihanController::class, 'broadcastWa'])
        ->name('admin.tagihan.broadcast-wa');
        
    Route::post('/admin/tagihan/{invoice}/kirim-wa', [\App\Http\Controllers\Admin\Keuangan\TagihanController::class, 'kirimWa'])
        ->name('admin.tagihan.kirim-wa');

    Route::post('/admin/tagihan/bulk-destroy', [\App\Http\Controllers\Admin\Keuangan\TagihanController::class, 'bulkDestroy'])
        ->name('admin.tagihan.bulk-destroy');

    Route::resource('/admin/tagihan', \App\Http\Controllers\Admin\Keuangan\TagihanController::class)
        ->parameters(['tagihan' => 'invoice'])
        ->names('admin.tagihan');
        
    Route::patch('/admin/pembayaran/{payment}/verify', [\App\Http\Controllers\Admin\Keuangan\PembayaranController::class, 'verify'])
        ->name('admin.pembayaran.verify');
    Route::patch('/admin/pembayaran/{payment}/reject', [\App\Http\Controllers\Admin\Keuangan\PembayaranController::class, 'reject'])
        ->name('admin.pembayaran.reject');
    Route::get('/admin/pembayaran/{payment}/print', [\App\Http\Controllers\Admin\Keuangan\PembayaranController::class, 'print'])
        ->name('admin.pembayaran.print');
        
    Route::resource('/admin/pembayaran', \App\Http\Controllers\Admin\Keuangan\PembayaranController::class)
        ->parameters(['pembayaran' => 'payment'])
        ->names('admin.pembayaran');
    Route::get('/admin/laporan-keuangan', [\App\Http\Controllers\Admin\Keuangan\LaporanKeuanganController::class, 'index'])->name('admin.laporan-keuangan.index');
    

    // CMS Beranda
    Route::prefix('admin/cms/beranda')->name('admin.beranda.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'index'])->name('index');
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateHero'])->name('hero.update');
        Route::put('/welcome/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateWelcome'])->name('welcome.update');
        
        // Statistik
        Route::post('/statistic', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'storeStatistic'])->name('statistic.store');
        Route::put('/statistic/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateStatistic'])->name('statistic.update');
        Route::delete('/statistic/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'destroyStatistic'])->name('statistic.destroy');

        // Program
        Route::post('/program', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'storeProgram'])->name('program.store');
        Route::put('/program/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateProgram'])->name('program.update');
        Route::delete('/program/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'destroyProgram'])->name('program.destroy');

        // Keunggulan
        Route::post('/keunggulan', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'storeKeunggulan'])->name('keunggulan.store');
        Route::put('/keunggulan/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateKeunggulan'])->name('keunggulan.update');
        Route::delete('/keunggulan/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'destroyKeunggulan'])->name('keunggulan.destroy');

        // Testimoni
        Route::post('/testimoni', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'storeTestimoni'])->name('testimoni.store');
        Route::put('/testimoni/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateTestimoni'])->name('testimoni.update');
        Route::delete('/testimoni/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'destroyTestimoni'])->name('testimoni.destroy');

        // FAQ
        Route::post('/faq', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'storeFaq'])->name('faq.store');
        Route::put('/faq/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'updateFaq'])->name('faq.update');
        Route::delete('/faq/{id}', [\App\Http\Controllers\Admin\Cms\CmsBerandaController::class, 'destroyFaq'])->name('faq.destroy');
    });

    // CMS Profil
    Route::prefix('admin/cms/profil')->name('admin.profil.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'index'])->name('index');
        
        // Hero
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'updateHero'])->name('hero.update');
        
        // Visi
        Route::put('/visi', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'updateVisi'])->name('visi.update');
        
        // Misi
        Route::post('/misi', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'storeMisi'])->name('misi.store');
        Route::put('/misi/{id}', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'updateMisi'])->name('misi.update');
        Route::delete('/misi/{id}', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'destroyMisi'])->name('misi.destroy');
        
        // Sejarah
        Route::post('/sejarah', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'storeSejarah'])->name('sejarah.store');
        Route::put('/sejarah/{id}', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'updateSejarah'])->name('sejarah.update');
        Route::delete('/sejarah/{id}', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'destroySejarah'])->name('sejarah.destroy');
        
        // Struktur Organisasi
        Route::put('/struktur-organisasi', [\App\Http\Controllers\Admin\Cms\CmsProfilController::class, 'updateStrukturOrganisasi'])->name('struktur.update');
    });
    Route::prefix('admin/unit-cms')->name('admin.unit-cms.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'show'])->name('show');
        
        Route::put('/{id}/hero', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updateHero'])->name('hero.update');
        Route::put('/{id}/detail', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updateDetail'])->name('detail.update');
        
        Route::post('/{id}/fasilitas', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'storeFasilitas'])->name('fasilitas.store');
        Route::put('/{id}/fasilitas/{facilityId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updateFasilitas'])->name('fasilitas.update');
        Route::delete('/{id}/fasilitas/{facilityId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'destroyFasilitas'])->name('fasilitas.destroy');

        Route::post('/{id}/ekskul', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'storeEkskul'])->name('ekskul.store');
        Route::put('/{id}/ekskul/{ekskulId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updateEkskul'])->name('ekskul.update');
        Route::delete('/{id}/ekskul/{ekskulId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'destroyEkskul'])->name('ekskul.destroy');

        Route::post('/{id}/guru', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'storeGuru'])->name('guru.store');
        Route::put('/{id}/guru/{guruId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updateGuru'])->name('guru.update');
        Route::delete('/{id}/guru/{guruId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'destroyGuru'])->name('guru.destroy');

        Route::post('/{id}/prestasi', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'storePrestasi'])->name('prestasi.store');
        Route::put('/{id}/prestasi/{prestasiId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'updatePrestasi'])->name('prestasi.update');
        Route::delete('/{id}/prestasi/{prestasiId}', [\App\Http\Controllers\Admin\Cms\CmsUnitController::class, 'destroyPrestasi'])->name('prestasi.destroy');
    });
    // CMS Berita & Kegiatan
    Route::prefix('admin/cms/berita')->name('admin.berita.')->group(function () {
        // Kategori Berita
        Route::get('/kategori', [\App\Http\Controllers\Admin\Cms\CmsCategoryController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [\App\Http\Controllers\Admin\Cms\CmsCategoryController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{id}', [\App\Http\Controllers\Admin\Cms\CmsCategoryController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [\App\Http\Controllers\Admin\Cms\CmsCategoryController::class, 'destroy'])->name('kategori.destroy');

        // Berita & Kegiatan
        Route::get('/', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'index'])->name('posts.index');
        Route::get('/create', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'create'])->name('posts.create');
        Route::post('/', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'store'])->name('posts.store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'edit'])->name('posts.edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'update'])->name('posts.update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/{id}/preview', [\App\Http\Controllers\Admin\Cms\CmsPostController::class, 'preview'])->name('posts.preview');
    });
    // Redirect lama -> baru
    Route::get('/admin/berita', fn() => redirect()->route('admin.berita.posts.index'))->name('admin.berita.index');
    // CMS PPDB
    Route::prefix('admin/cms/ppdb')->name('admin.ppdb.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'index'])->name('index');

        // Hero (Edit Only)
        Route::put('/hero/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'updateHero'])->name('hero.update');

        // Timeline (CRUD)
        Route::post('/timeline', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'storeTimeline'])->name('timeline.store');
        Route::put('/timeline/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'updateTimeline'])->name('timeline.update');
        Route::delete('/timeline/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'destroyTimeline'])->name('timeline.destroy');

        // Alur / Step (CRUD)
        Route::post('/step', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'storeStep'])->name('step.store');
        Route::put('/step/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'updateStep'])->name('step.update');
        Route::delete('/step/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'destroyStep'])->name('step.destroy');

        // Brosur (CRUD + file upload)
        Route::post('/brochure', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'storeBrochure'])->name('brochure.store');
        Route::put('/brochure/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'updateBrochure'])->name('brochure.update');
        Route::delete('/brochure/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'destroyBrochure'])->name('brochure.destroy');

        // FAQ PPDB (CRUD)
        Route::post('/faq', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'storeFaq'])->name('faq.store');
        Route::put('/faq/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'updateFaq'])->name('faq.update');
        Route::delete('/faq/{id}', [\App\Http\Controllers\Admin\Cms\CmsPpdbController::class, 'destroyFaq'])->name('faq.destroy');
    });

    // CMS Kontak Global
    Route::get('/admin/cms/kontak', [\App\Http\Controllers\Admin\Cms\CmsKontakController::class, 'index'])->name('admin.kontak.index');
    Route::put('/admin/cms/kontak', [\App\Http\Controllers\Admin\Cms\CmsKontakController::class, 'update'])->name('admin.kontak.update');

    Route::resource('/admin/user', UserController::class)->names('admin.user');
    
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');
});

