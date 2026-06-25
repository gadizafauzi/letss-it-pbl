<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\CmsSetting;
use App\Models\CmsHeroSection;
use App\Models\CmsWelcomeMessage;
use App\Models\CmsVisi;
use App\Models\CmsMisiItem;
use App\Models\CmsMarqueeItem;
use App\Models\CmsStatistic;
use App\Models\CmsProgram;
use App\Models\CmsTujuanPendidikan;
use App\Models\CmsTestimonial;
use App\Models\CmsFaq;
use App\Models\CmsSejarahItem;
use App\Models\CmsUnitDetail;
use App\Models\CmsUnitTeacher;
use App\Models\CmsUnitEkskul;
use App\Models\CmsUnitFacility;
use App\Models\CmsAchievement;
use App\Models\CmsPostCategory;
use App\Models\CmsPost;
use App\Models\CmsPpdbTimeline;
use App\Models\CmsPpdbRequirement;
use App\Models\CmsPpdbBrochure;
use App\Models\CmsPpdbStep;
use App\Models\Unit;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Get units
        $unitTk = Unit::where('unit_name', 'like', '%TK%')->first() ?? Unit::create(['unit_name' => 'TK Islam Terpadu']);
        $unitSd = Unit::where('unit_name', 'like', '%SD%')->first() ?? Unit::create(['unit_name' => 'SD Islam Terpadu']);
        $unitSmp = Unit::where('unit_name', 'like', '%SMP%')->first() ?? Unit::create(['unit_name' => 'SMP Islam Terpadu']);

        // 1. Seed cms_settings
        $settings = [
            ['key' => 'school_name', 'value' => 'SIT Mutiara Qur\'an', 'type' => 'text'],
            ['key' => 'logo_path', 'value' => 'images/logo_jsit.png', 'type' => 'image'],
            ['key' => 'favicon_path', 'value' => 'favicon.ico', 'type' => 'image'],
            ['key' => 'address', 'value' => 'Karasak, Jorong Pasar Baru, Nagari Cupak, Kec. Gunung Talang, Kabupaten Solok, Sumatera Barat', 'type' => 'textarea'],
            ['key' => 'email', 'value' => 'info@sitmutiaraquran.sch.id', 'type' => 'text'],
            ['key' => 'phone', 'value' => '+62 822-8620-4878', 'type' => 'text'],
            ['key' => 'whatsapp_number', 'value' => '6282286204878', 'type' => 'text'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/sit_mutiara_quran?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==', 'type' => 'text'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com/@sditmutiaraquran8329', 'type' => 'text'],
            ['key' => 'facebook', 'value' => 'https://web.facebook.com/sdit.mutiara.988', 'type' => 'text'],
            ['key' => 'operational_hours', 'value' => "Senin - Jum'at: 07.15 - 15.30 WIB\nSabtu - Minggu: Libur", 'type' => 'textarea'],
            ['key' => 'maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31914.641419208794!2d100.598466!3d-0.8962703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1780587530868!5m2!1sid!2sid', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            CmsSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 2. Seed cms_hero_sections
        $heroes = [
            [
                'page' => 'home',
                'title' => 'Mendidik Generasi Qur\'an yang Berakhlak Mulia & Berprestasi',
                'subtitle' => 'SIT Mutiara Qur\'an hadir di Nagari Cupak untuk membentuk generasi robbani yang mandiri, berkarakter mulia, cerdas akademis, serta mencintai Al-Qur\'an.',
                'image' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&q=80&w=800',
                'button_text' => 'Daftar PPDB Online',
                'button_link' => '/ppdb',
                'button_secondary_text' => 'Profil Sekolah',
                'button_secondary_link' => '/profil',
                'badge_text' => 'Terakreditasi A - BAN-PDM PROVINSI SUMATERA BARAT',
            ],
            [
                'page' => 'profil',
                'title' => 'Profil SIT Mutiara Qur\'an',
                'subtitle' => 'Membangun generasi Qur\'ani yang berkarakter, berprestasi, dan berwawasan global.',
                'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&q=80&w=800',
                'button_text' => 'Jelajahi Profil',
                'button_link' => '#profil-singkat',
            ],
            [
                'page' => 'ppdb',
                'title' => 'Penerimaan Peserta Didik Baru',
                'subtitle' => 'Bergabunglah bersama SIT Mutiara Qur\'an untuk masa depan putra-putri Anda yang lebih baik, berkarakter mulia, dan berprestasi.',
                'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800',
                'button_text' => 'Lihat Informasi PPDB',
                'button_link' => '#informasi',
                'button_secondary_text' => 'Download Brosur',
                'button_secondary_link' => '#brosur',
            ],
            [
                'page' => 'unit_tk',
                'title' => 'TK ISLAM TERPADU',
                'subtitle' => 'Membentuk karakter islami sejak usia dini dengan pendekatan belajar, bermain, dan berkarya yang menyenangkan.',
                'image' => 'images/tk_dummy.png',
                'button_text' => 'Deskripsi Umum',
                'button_link' => '#profil',
                'button_secondary_text' => 'Lihat Prestasi',
                'button_secondary_link' => '#prestasi',
            ],
            [
                'page' => 'unit_sd',
                'title' => 'SD ISLAM TERPADU',
                'subtitle' => 'Membangun generasi cerdas, mandiri, dan berakhlak mulia dengan memadukan kurikulum nasional dan nilai-nilai keislaman secara komprehensif.',
                'image' => 'images/sd_dummy.png',
                'button_text' => 'Deskripsi Umum',
                'button_link' => '#profil',
                'button_secondary_text' => 'Lihat Prestasi',
                'button_secondary_link' => '#prestasi',
            ],
            [
                'page' => 'unit_smp',
                'title' => 'SMP ISLAM TERPADU',
                'subtitle' => 'Membangun generasi remaja yang unggul secara akademik, berkarakter islami kuat, dan siap menghadapi tantangan era global.',
                'image' => 'images/smp_dummy.png',
                'button_text' => 'Deskripsi Umum',
                'button_link' => '#profil',
                'button_secondary_text' => 'Lihat Prestasi',
                'button_secondary_link' => '#prestasi',
            ],
        ];

        foreach ($heroes as $hero) {
            CmsHeroSection::updateOrCreate(['page' => $hero['page']], $hero);
        }

        // 3. Seed cms_welcome_messages
        CmsWelcomeMessage::updateOrCreate(
            ['title' => 'Membentuk Generasi Rabbanî yang Unggul & Berkarakter'],
            [
                'title' => 'Membentuk Generasi Rabbanî yang Unggul & Berkarakter',
                'greeting' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh,',
                'paragraphs' => [
                    'Segala puji bagi Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad SAW. Selamat datang di portal resmi SIT Mutiara Qur\'an Nagari Cupak.',
                    'Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur\'an yang seimbang secara spiritual, intelektual, dan moral. Kami meyakini bahwa setiap anak memiliki potensi terbaiknya, dan tugas kamilah di sekolah untuk menuntun serta mengasah potensi tersebut dengan berlandaskan nilai-nilai Al-Qur\'an dan Sunnah.',
                    'Dengan dukungan asatidzah yang berkompeten, fasilitas yang kondusif, serta lingkungan yang islami, kami siap berkolaborasi erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon pemimpin umat masa depan yang berakhlak mulia.'
                ],
                'kepsek_name' => 'Ustadz Ahmad Fauzi, S.Pd.I, M.Pd',
                'kepsek_title' => 'Pimpinan & Kepala Sekolah SIT Mutiara Qur\'an',
                'kepsek_photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600',
                'is_active' => true
            ]
        );

        // 4. Seed cms_visi
        CmsVisi::updateOrCreate(
            ['id' => 1],
            [
                'text' => 'Menjadi lembaga pendidikan Islam terpadu yang unggul dalam membentuk generasi Qur\'ani, berakhlak mulia, cerdas, dan berdaya saing global.',
                'is_active' => true
            ]
        );

        // 5. Seed cms_misi_items
        $misiItems = [
            'Menyelenggarakan pendidikan yang mengintegrasikan kurikulum nasional dan keislaman.',
            'Menumbuhkan kecintaan terhadap Al-Quran melalui program tahfidz.',
            'Membina akhlak mulia dan karakter islami pada seluruh peserta didik.',
            'Mengembangkan potensi akademik, minat, dan bakat siswa secara optimal.',
            'Menciptakan lingkungan belajar yang aman, nyaman, dan kondusif.',
            'Membangun kerjasama yang baik antara sekolah, orang tua, dan masyarakat.',
        ];

        CmsMisiItem::truncate();
        foreach ($misiItems as $index => $misi) {
            CmsMisiItem::create([
                'text' => $misi,
                'is_active' => true,
                'order' => $index,
            ]);
        }

        // 6. Seed cms_marquee_items
        $marqueeItems = [
            '📢 Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur\'an TA ' . date('Y') . '/' . (date('Y') + 1) . ' Resmi Dibuka! Gelombang 1 Dapatkan Diskon Dana Pembangunan.',
            '🏆 Alhamdulillah, Siswa SMP IT Mutiara Qur\'an Meraih Medali Emas & Perak pada Olimpiade Sains Nasional Tingkat Kabupaten Solok!',
            '🕌 Wisuda Tahfidz Qur\'an Angkatan ke-8 Sukses Diselenggarakan, Melahirkan 45 Hafizh Cilik yang Siap Berbakti.'
        ];

        CmsMarqueeItem::truncate();
        foreach ($marqueeItems as $index => $item) {
            CmsMarqueeItem::create([
                'text' => $item,
                'is_active' => true,
                'order' => $index,
            ]);
        }

        // 7. Seed cms_statistics
        $statistics = [
            ['icon' => 'users', 'number' => '500', 'suffix' => '+', 'label' => 'Siswa Aktif', 'is_dynamic' => false, 'dynamic_source' => 'students_count', 'order' => 0],
            ['icon' => 'graduation-cap', 'number' => '35', 'suffix' => '+', 'label' => 'Tenaga Pendidik', 'is_dynamic' => false, 'dynamic_source' => 'teachers_count', 'order' => 1],
            ['icon' => 'book-open', 'number' => '18', 'suffix' => '', 'label' => 'Rombel Kelas', 'is_dynamic' => false, 'dynamic_source' => 'classes_count', 'order' => 2],
            ['icon' => 'building', 'number' => '15', 'suffix' => ' Tahun', 'label' => 'Tahun Berdiri', 'is_dynamic' => false, 'dynamic_source' => null, 'order' => 3],
        ];

        CmsStatistic::truncate();
        foreach ($statistics as $stat) {
            CmsStatistic::create($stat);
        }

        // 8. Seed cms_programs
        $programs = [
            [
                'icon' => 'book-open',
                'title' => 'Tahfidz Qur\'an Mutqin',
                'description' => 'Program menghafal Al-Qur\'an terstruktur dengan metode talaqqi dan murojaah intensif untuk menjaga kualitas hafalan siswa (target mutqin).',
                'detail' => 'Target: TK Juz 30, SD 5 Juz, SMP 10 Juz',
                'category' => 'keislaman',
                'order' => 0
            ],
            [
                'icon' => 'heart',
                'title' => 'Pembiasaan Akhlakul Karimah',
                'description' => 'Internalisasi adab islami harian melalui Sholat Dhuha, Mabit (Malam Bina Iman dan Taqwa), Dzikir Pagi-Petang, serta pengawasan ibadah mandiri.',
                'detail' => 'Karakter islami terintegrasi dalam keseharian',
                'category' => 'keislaman',
                'order' => 1
            ],
            [
                'icon' => 'languages',
                'title' => 'Bilingual Environment',
                'description' => 'Peningkatan kapasitas bahasa asing (Arab & Inggris) yang digunakan dalam komunikasi harian ringan, doa, dan materi ajar tertentu.',
                'detail' => 'Daily Arabic & English Conversation',
                'category' => 'akademik',
                'order' => 2
            ],
            [
                'icon' => 'code',
                'title' => 'Digital Literacy & Coding',
                'description' => 'Khusus untuk tingkat SMP, dibekali dasar pemrograman komputer, logika digital, dan etika penggunaan teknologi informasi.',
                'detail' => 'Kesiapan menghadapi era revolusi industri 4.0',
                'category' => 'akademik',
                'order' => 3
            ],
            [
                'icon' => 'users',
                'title' => 'Mentoring & Halaqah',
                'description' => 'Kelompok bimbingan rohani khusus (liqo/mentoring) dengan rasio asatidzah kecil untuk memantau perkembangan emosional dan spiritual siswa.',
                'detail' => 'Konseling terpadu yang penuh perhatian',
                'category' => 'karakter',
                'order' => 4
            ],
            [
                'icon' => 'compass',
                'title' => 'Leadership & Outbound',
                'description' => 'Pelatihan kepemimpinan dasar, pramuka IT, kemah ukhuwah, dan kegiatan outbound untuk melatih kemandirian, keberanian, dan kerjasama tim.',
                'detail' => 'Mencetak calon pemimpin umat masa depan',
                'category' => 'karakter',
                'order' => 5
            ]
        ];

        CmsProgram::truncate();
        foreach ($programs as $prog) {
            CmsProgram::create($prog);
        }

        // 9. Seed cms_tujuan_pendidikan
        $tujuanPendidikan = [
            ['icon' => 'book-marked', 'bg_color' => 'amber', 'title' => 'Kurikulum Merdeka + JSIT', 'description' => 'Mengintegrasikan kurikulum nasional Kurikulum Merdeka dengan kurikulum kekhasan JSIT.', 'order' => 0],
            ['icon' => 'monitor', 'bg_color' => 'emerald', 'title' => 'Laboratorium Komputer', 'description' => 'Fasilitas komputer modern penunjang praktikum TIK dan pemrograman dasar sejak dini.', 'order' => 1],
            ['icon' => 'users-2', 'bg_color' => 'blue', 'title' => 'Tenaga Pendidik Berdedikasi', 'description' => 'Asatidzah lulusan perguruan tinggi terkemuka, bersertifikat pendidik, dan hafizh.', 'order' => 2],
            ['icon' => 'home', 'bg_color' => 'violet', 'title' => 'Fasilitas Kelas Kondusif', 'description' => 'Ruang kelas ber-AC, proyektor LCD, serta lingkungan asri yang jauh dari kebisingan.', 'order' => 3],
            ['icon' => 'shield-check', 'bg_color' => 'rose', 'title' => 'Lingkungan Aman & Ramah', 'description' => 'Keamanan terpadu 24 jam dengan sistem sekolah bebas bullying dan hangat.', 'order' => 4],
            ['icon' => 'activity', 'bg_color' => 'cyan', 'title' => 'Ekstrakurikuler Variatif', 'description' => 'Panahan, berkuda, karate, robotik, seni kaligrafi, tilawah, sepak bola, dan pramuka.', 'order' => 5],
        ];

        CmsTujuanPendidikan::truncate();
        foreach ($tujuanPendidikan as $item) {
            CmsTujuanPendidikan::create($item);
        }

        // 10. Seed cms_testimonials
        $testimonials = [
            [
                'quote' => 'Alhamdulillah, semenjak bersekolah di SD IT Mutiara Qur\'an, anak saya menjadi sangat rajin sholat tepat waktu bahkan sering berinisiatif Sholat Dhuha sendiri. Hafalannya juga berkembang pesat. Guru-gurunya sangat sabar dan komunikatif.',
                'name' => 'dr. H. Hendra Syahputra, Sp.A',
                'role' => 'Wali Murid Kelas 4 SD IT / Dokter Anak',
                'avatar' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?auto=format&fit=crop&q=80&w=200',
                'order' => 0
            ],
            [
                'quote' => 'Perpaduan materi akademis umum dan pendidikan akhlak di SMP IT Mutiara Qur\'an sangat berimbang. Anak saya tidak hanya mahir secara akademis, tapi juga memiliki pemahaman agama yang mendalam dan adab yang sopan dalam keluarga.',
                'name' => 'Prof. Dr. Ir. Hj. Mulyani, M.T',
                'role' => 'Wali Murid Kelas 8 SMP IT / Dosen Perguruan Tinggi',
                'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=200',
                'order' => 1
            ],
            [
                'quote' => 'Metode pembelajaran di TK IT Mutiara Qur\'an sangat menyenangkan. Anak kami pulang dengan wajah ceria setiap hari, dan luar biasa di usia 5 tahun sudah lancar melafalkan doa harian serta hafal surah-surah pendek Juz 30. Terima kasih asatidzah!',
                'name' => 'Ronaldi, S.E',
                'role' => 'Wali Murid TK IT / Wiraswasta',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=200',
                'order' => 2
            ]
        ];

        CmsTestimonial::truncate();
        foreach ($testimonials as $testi) {
            CmsTestimonial::create($testi);
        }

        // 11. Seed cms_faqs
        $faqs = [
            // Home Page FAQs
            ['question' => 'Kapan pendaftaran PPDB SIT Mutiara Qur\'an dibuka?', 'answer' => 'Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur\'an dibuka mulai tanggal 15 Oktober hingga kuota terpenuhi untuk setiap gelombang. Kami menyarankan untuk melakukan pendaftaran lebih awal dikarenakan keterbatasan kuota kelas (rombel) demi menjaga kenyamanan belajar mengajar.', 'page' => 'home', 'order' => 0],
            ['question' => 'Bagaimana sistem kurikulum yang diterapkan di sekolah?', 'answer' => 'SIT Mutiara Qur\'an mengintegrasikan Kurikulum Nasional (Kurikulum Merdeka) dengan Kurikulum JSIT (Jaringan Sekolah Islam Terpadu) yang menitikberatkan pada pembiasaan ibadah islami, pembelajaran Al-Qur\'an metode khusus, serta penguatan adab dan karakter mulia sehari-hari.', 'page' => 'home', 'order' => 1],
            ['question' => 'Apakah ada fasilitas antar-jemput dan katering untuk siswa?', 'answer' => 'Ya, kami menyediakan layanan antar-jemput berjadwal dengan armada yang aman bagi siswa di area sekitar Kabupaten Solok, serta katering makan siang sehat bersertifikasi halal khusus untuk siswa jenjang SD dan SMP yang mengikuti program full-day school.', 'page' => 'home', 'order' => 2],
            ['question' => 'Berapa target hafalan Al-Qur\'an untuk masing-masing jenjang?', 'answer' => 'Target hafalan mutqin kami adalah: Jenjang TK (Juz 30), Jenjang SD IT (Minimal 5 Juz), dan Jenjang SMP IT (Minimal 10 Juz) selama masa studi penuh, didukung dengan program karantina tahfidz tahunan khusus.', 'page' => 'home', 'order' => 3],
            // PPDB Page FAQs
            ['question' => 'Kapan pendaftaran PPDB dibuka?', 'answer' => 'Pendaftaran PPDB dibuka mulai bulan Maret hingga Juni setiap tahunnya. Untuk informasi terbaru, silakan cek halaman Jadwal & Timeline.', 'page' => 'ppdb', 'order' => 0],
            ['question' => 'Apakah ada tes masuk untuk calon siswa?', 'answer' => 'Ya, calon siswa akan mengikuti tes seleksi yang meliputi tes baca tulis, wawancara, dan tes kemampuan Al-Quran sesuai jenjang.', 'page' => 'ppdb', 'order' => 1],
            ['question' => 'Berapa biaya pendaftaran?', 'answer' => 'Biaya formulir pendaftaran sebesar Rp 150.000. Informasi biaya pendidikan lengkap akan disampaikan saat daftar ulang.', 'page' => 'ppdb', 'order' => 2],
            ['question' => 'Apakah tersedia program beasiswa?', 'answer' => 'Ya, kami menyediakan program beasiswa untuk siswa berprestasi dan siswa dari keluarga kurang mampu. Hubungi kami untuk informasi lebih lanjut.', 'page' => 'ppdb', 'order' => 3],
            ['question' => 'Bagaimana sistem pembelajaran di SIT Mutiara Quran?', 'answer' => 'Kami menggunakan Kurikulum Merdeka yang diintegrasikan dengan kurikulum keislaman. Pembelajaran berlangsung dari pukul 07.00 hingga 15.30 WIB (fullday school).', 'page' => 'ppdb', 'order' => 4],
            ['question' => 'Apakah ada program tahfidz?', 'answer' => 'Ya, program tahfidz merupakan program unggulan kami. Target hafalan: TK (Juz 30), SD (5 Juz), SMP (10 Juz).', 'page' => 'ppdb', 'order' => 5],
            ['question' => 'Bagaimana cara mendaftar?', 'answer' => 'Anda bisa mendaftar secara online melalui website atau datang langsung ke sekolah. Lihat bagian Alur Pendaftaran di atas untuk detail langkah-langkahnya.', 'page' => 'ppdb', 'order' => 6],
        ];

        CmsFaq::truncate();
        foreach ($faqs as $faq) {
            CmsFaq::create($faq);
        }

        // 12. Seed cms_sejarah_items
        $sejarah = [
            ['year' => '2010', 'title' => 'Pendirian Sekolah', 'description' => 'SIT Mutiara Quran didirikan oleh yayasan dengan 2 kelas pertama dan 30 siswa. Visi awal adalah menciptakan pendidikan Islam yang memadukan ilmu dunia dan akhirat.', 'order' => 0],
            ['year' => '2012', 'title' => 'Pembukaan PAUD/TK', 'description' => 'Membuka jenjang PAUD/TK Islam Terpadu untuk memulai pendidikan Qur\'ani sejak usia dini.', 'order' => 1],
            ['year' => '2014', 'title' => 'Akreditasi A', 'description' => 'Meraih akreditasi A dari BAN-S/M untuk jenjang SD Islam Terpadu, membuktikan kualitas pendidikan yang unggul.', 'order' => 2],
            ['year' => '2016', 'title' => 'Wisuda Tahfidz Pertama', 'description' => 'Angkatan pertama program tahfidz berhasil menyelesaikan target hafalan, menandai keberhasilan program unggulan.', 'order' => 3],
            ['year' => '2018', 'title' => 'Pembukaan SMP IT', 'description' => 'Membuka jenjang SMP Islam Terpadu untuk melanjutkan misi pendidikan ke tingkat yang lebih tinggi.', 'order' => 4],
            ['year' => '2023', 'title' => 'Kampus Baru', 'description' => 'Pindah ke kampus baru dengan fasilitas modern termasuk laboratorium, perpustakaan digital, dan area bermain yang luas.', 'order' => 5],
        ];

        CmsSejarahItem::truncate();
        foreach ($sejarah as $item) {
            CmsSejarahItem::create($item);
        }

        // 13. Seed cms_unit_details
        CmsUnitDetail::updateOrCreate(
            ['unit_id' => $unitTk->id],
            [
                'description_title' => 'Pondasi Kuat untuk Generasi Qur\'ani',
                'description_body' => "TK IT Mutiara Qur'an hadir untuk memfasilitasi masa keemasan anak (golden age) dengan penanaman aqidah, akhlak, dan kecintaan pada Al-Qur'an sejak dini. Kami berkomitmen untuk menciptakan lingkungan pendidikan yang mendukung tumbuh kembang anak secara optimal.\n\nMelalui pendekatan Islami yang menyenangkan, kami menerapkan metode belajar, bermain, dan berkarya. Hal ini bertujuan agar anak-anak tidak hanya cerdas secara kognitif, tetapi juga memiliki karakter islami yang kuat, mandiri, dan berakhlak mulia.\n\nDengan fasilitas yang lengkap, aman, dan nyaman, serta tenaga pendidik yang kompeten dan penuh kasih sayang, TK IT Mutiara Qur'an siap menjadi partner terbaik orang tua dalam mendidik generasi penerus yang cerdas dan berkarakter Qur'ani.",
                'description_logo' => 'images/logomq.jpg',
                'target_age' => 'Usia 4-6 tahun',
                'quota' => '60 siswa'
            ]
        );

        CmsUnitDetail::updateOrCreate(
            ['unit_id' => $unitSd->id],
            [
                'description_title' => 'Pendidikan Dasar Berbasis Karakter Islami',
                'description_body' => "SD Islam Terpadu SIT Mutiara Qur'an memadukan kurikulum nasional dengan nilai-nilai keislaman secara komprehensif, menciptakan lingkungan yang kondusif bagi perkembangan intelektual, spiritual, dan emosional siswa.\n\nKami fokus pada pembentukan karakter mandiri, kejujuran, serta kecintaan terhadap Al-Qur'an dan ilmu pengetahuan, agar siswa siap menghadapi tantangan masa depan dengan akhlak yang tangguh.\n\nProgram unggulan kami meliputi tahfidz Al-Qur'an terstruktur dengan target 5 juz mutqin, pembiasaan ibadah harian seperti shalat dhuha dan shalat berjamaah, serta pembelajaran yang interaktif dan berpusat pada siswa.",
                'description_logo' => 'images/logomq.jpg',
                'target_age' => 'Usia 6-7 tahun',
                'quota' => '90 siswa'
            ]
        );

        CmsUnitDetail::updateOrCreate(
            ['unit_id' => $unitSmp->id],
            [
                'description_title' => 'Pendidikan Menengah Berkualitas & Berkarakter',
                'description_body' => "SMP Islam Terpadu SIT Mutiara Qur'an hadir sebagai solusi pendidikan menengah yang memadukan keunggulan akademik, teknologi, dan pendalaman ilmu agama (Diniyah) untuk mencetak lulusan yang siap bersaing di era global.\n\nDengan program bina pribadi islami (BPI), bahasa asing, dan sains, kami membimbing remaja untuk menemukan potensi terbaik mereka, melatih kepemimpinan, dan memperkuat identitas sebagai muslim sejati.\n\nSiswa juga difasilitasi dengan berbagai kegiatan kokurikuler dan ekstrakurikuler yang sejalan dengan minat dan bakat mereka, mendorong tercapainya prestasi maksimal diimbangi pemahaman akhlak dan akidah.",
                'description_logo' => 'images/logomq.jpg',
                'target_age' => 'Lulusan SD/MI',
                'quota' => '60 siswa'
            ]
        );

        // 14. Seed cms_unit_teachers (Pivot)
        CmsUnitTeacher::truncate();
        $allTeachers = Teacher::all();
        if ($allTeachers->count() > 0) {
            foreach ([$unitTk, $unitSd, $unitSmp] as $u) {
                // Link up to 5 teachers to each unit public page
                $teachersForUnit = $allTeachers->take(5);
                foreach ($teachersForUnit as $index => $t) {
                    CmsUnitTeacher::create([
                        'unit_id' => $u->id,
                        'teacher_id' => $t->id,
                        'is_active' => true,
                        'order' => $index
                    ]);
                }
            }
        }

        // 15. Seed cms_unit_ekskul
        CmsUnitEkskul::truncate();
        $ekskulTk = [
            ['icon' => 'palette', 'title' => 'Mewarnai & Kaligrafi', 'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80', 'description' => 'Mengembangkan kreativitas dan seni anak melalui mewarnai dan kaligrafi dasar.'],
            ['icon' => 'music', 'title' => 'Nasyid & Seni Gerak', 'image' => 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=600&q=80', 'description' => 'Mengenal musik Islami dan gerak kreasi yang menyenangkan.'],
            ['icon' => 'book-open', 'title' => 'Tahfidz Surat Pendek', 'image' => 'https://images.unsplash.com/photo-1585995604802-17c3fe6b53aa?auto=format&fit=crop&w=600&q=80', 'description' => 'Program hafalan surat-surat pendek Juz 30 sejak usia dini.'],
            ['icon' => 'tent', 'title' => 'Outbound Kids', 'image' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80', 'description' => 'Melatih keberanian, ketangkasan, dan kemandirian di alam terbuka.'],
            ['icon' => 'message-circle', 'title' => 'English Fun', 'image' => 'https://images.unsplash.com/photo-1529474944862-1acebdcbab31?auto=format&fit=crop&w=600&q=80', 'description' => 'Pengenalan kosa kata bahasa Inggris dasar sambil bermain dan bernyanyi.'],
            ['icon' => 'scissors', 'title' => 'Prakarya Kreatif', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80', 'description' => 'Membuat karya kreatif dari berbagai bahan sederhana yang melatih motorik halus.'],
        ];
        foreach ($ekskulTk as $index => $e) {
            CmsUnitEkskul::create(array_merge($e, ['unit_id' => $unitTk->id, 'order' => $index, 'is_active' => true]));
        }

        $ekskulSd = [
            ['icon' => 'tent', 'title' => 'Pramuka SIT', 'image' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80', 'description' => 'Melatih kemandirian, kedisiplinan, dan jiwa kepemimpinan dasar.'],
            ['icon' => 'book-open', 'title' => 'Tahfidz Club', 'image' => 'https://images.unsplash.com/photo-1585995604802-17c3fe6b53aa?auto=format&fit=crop&w=600&q=80', 'description' => 'Program pengayaan hafalan Al-Qur\'an secara intensif.'],
            ['icon' => 'dribbble', 'title' => 'Futsal', 'image' => 'https://images.unsplash.com/photo-1529474944862-1acebdcbab31?auto=format&fit=crop&w=600&q=80', 'description' => 'Membangun kebugaran fisik dan sportivitas tim.'],
            ['icon' => 'crosshair', 'title' => 'Panahan', 'image' => 'https://images.unsplash.com/photo-1567699532083-f34b686df3af?auto=format&fit=crop&w=600&q=80', 'description' => 'Melatih fokus, ketenangan, dan menjalankan sunnah Rasul.'],
            ['icon' => 'flask-conical', 'title' => 'Olimpiade Sains', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80', 'description' => 'Bimbingan khusus bagi siswa berprestasi akademik.'],
            ['icon' => 'palette', 'title' => 'Seni & Kaligrafi', 'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80', 'description' => 'Mengembangkan kreativitas melalui seni rupa dan kaligrafi Islam.'],
        ];
        foreach ($ekskulSd as $index => $e) {
            CmsUnitEkskul::create(array_merge($e, ['unit_id' => $unitSd->id, 'order' => $index, 'is_active' => true]));
        }

        $ekskulSmp = [
            ['icon' => 'tent', 'title' => 'Pramuka SIT', 'image' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80', 'description' => 'Melatih kemandirian, kedisiplinan, dan jiwa kepemimpinan dasar.'],
            ['icon' => 'book-open', 'title' => 'Tahfidz Club', 'image' => 'https://images.unsplash.com/photo-1585995604802-17c3fe6b53aa?auto=format&fit=crop&w=600&q=80', 'description' => 'Program pengayaan hafalan Al-Qur\'an secara intensif dan terstruktur.'],
            ['icon' => 'crosshair', 'title' => 'Panahan', 'image' => 'https://images.unsplash.com/photo-1567699532083-f34b686df3af?auto=format&fit=crop&w=600&q=80', 'description' => 'Melatih fokus, ketenangan, dan menjalankan sunnah Rasulullah SAW.'],
            ['icon' => 'flask-conical', 'title' => 'Olimpiade Sains', 'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80', 'description' => 'Bimbingan khusus bagi siswa berprestasi di bidang sains dan matematika.'],
            ['icon' => 'dribbble', 'title' => 'Futsal', 'image' => 'https://images.unsplash.com/photo-1529474944862-1acebdcbab31?auto=format&fit=crop&w=600&q=80', 'description' => 'Membangun kebugaran fisik, sportivitas, dan kerjasama tim.'],
            ['icon' => 'palette', 'title' => 'Seni & Kaligrafi', 'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80', 'description' => 'Mengembangkan kreativitas melalui seni rupa dan kaligrafi Islam.'],
        ];
        foreach ($ekskulSmp as $index => $e) {
            CmsUnitEkskul::create(array_merge($e, ['unit_id' => $unitSmp->id, 'order' => $index, 'is_active' => true]));
        }

        // 16. Seed cms_unit_facilities
        CmsUnitFacility::truncate();
        $facilitiesTk = [
            ['icon' => 'air-vent', 'title' => 'Ruang Kelas Full AC'],
            ['icon' => 'puzzle', 'title' => 'Area Bermain Indoor'],
            ['icon' => 'trees', 'title' => 'Playground Outdoor'],
            ['icon' => 'moon', 'title' => 'Musholla'],
            ['icon' => 'library', 'title' => 'Perpustakaan Mini'],
            ['icon' => 'stethoscope', 'title' => 'UKS'],
            ['icon' => 'cctv', 'title' => 'Keamanan CCTV'],
            ['icon' => 'car', 'title' => 'Area Parkir Luas'],
        ];
        foreach ($facilitiesTk as $index => $f) {
            CmsUnitFacility::create(array_merge($f, ['unit_id' => $unitTk->id, 'order' => $index, 'is_active' => true]));
        }

        $facilitiesSd = [
            ['icon' => 'monitor', 'title' => 'Ruang Kelas Nyaman'],
            ['icon' => 'laptop', 'title' => 'Lab Komputer'],
            ['icon' => 'library', 'title' => 'Perpustakaan'],
            ['icon' => 'moon', 'title' => 'Musholla Luas'],
            ['icon' => 'activity', 'title' => 'Lapangan Olahraga'],
            ['icon' => 'stethoscope', 'title' => 'Klinik / UKS'],
            ['icon' => 'coffee', 'title' => 'Kantin Sehat'],
            ['icon' => 'cctv', 'title' => 'Keamanan CCTV'],
        ];
        foreach ($facilitiesSd as $index => $f) {
            CmsUnitFacility::create(array_merge($f, ['unit_id' => $unitSd->id, 'order' => $index, 'is_active' => true]));
        }

        $facilitiesSmp = [
            ['icon' => 'monitor', 'title' => 'Ruang Kelas Nyaman'],
            ['icon' => 'laptop', 'title' => 'Laboratorium Komputer'],
            ['icon' => 'library', 'title' => 'Perpustakaan'],
            ['icon' => 'moon', 'title' => 'Musholla Luas'],
            ['icon' => 'activity', 'title' => 'Lapangan Olahraga'],
            ['icon' => 'stethoscope', 'title' => 'Klinik / UKS'],
            ['icon' => 'coffee', 'title' => 'Kantin Sehat'],
            ['icon' => 'cctv', 'title' => 'Keamanan CCTV'],
        ];
        foreach ($facilitiesSmp as $index => $f) {
            CmsUnitFacility::create(array_merge($f, ['unit_id' => $unitSmp->id, 'order' => $index, 'is_active' => true]));
        }

        // 17. Seed cms_achievements
        CmsAchievement::truncate();
        $achieveTk = [
            ['year' => '2024', 'title' => 'Juara 1 Lomba Tahfidz Tingkat Kota', 'description' => 'Kategori Hafalan Surat Pendek antar TK.', 'level' => 'Kabupaten', 'side' => 'left'],
            ['year' => '2023', 'title' => 'Juara Harapan Mewarnai Kaligrafi', 'description' => 'Festival Anak Sholeh se-Provinsi.', 'level' => 'Provinsi', 'side' => 'right'],
            ['year' => '2023', 'title' => 'Sekolah Sehat Berkarakter', 'description' => 'Penghargaan dari Dinas Pendidikan setempat.', 'level' => 'Kabupaten', 'side' => 'left'],
            ['year' => '2022', 'title' => 'Juara 2 Tari Islami Kreasi', 'description' => 'Pekan Olahraga dan Seni PAUD.', 'level' => 'Kecamatan', 'side' => 'right'],
        ];
        foreach ($achieveTk as $index => $a) {
            CmsAchievement::create(array_merge($a, ['type' => 'unit', 'unit_id' => $unitTk->id, 'order' => $index, 'is_active' => true]));
        }

        $achieveSd = [
            ['year' => '2024', 'title' => 'Medali Emas Olimpiade Sains Nasional (OSN)', 'description' => 'Tingkat Kabupaten/Kota untuk mata pelajaran Matematika.', 'level' => 'Kabupaten', 'side' => 'left'],
            ['year' => '2023', 'title' => 'Juara Umum Lomba Cerdas Cermat PAI', 'description' => 'Kompetisi antar SD IT se-Provinsi.', 'level' => 'Provinsi', 'side' => 'right'],
            ['year' => '2023', 'title' => 'Juara 1 Lomba Tahfidz Al-Qur\'an', 'description' => 'Kategori 2 Juz pada MTQ Pelajar.', 'level' => 'Kabupaten', 'side' => 'left'],
            ['year' => '2022', 'title' => 'Regu Tergiat Pramuka Penggalang', 'description' => 'Jambore Ranting tingkat Kecamatan.', 'level' => 'Kecamatan', 'side' => 'right'],
        ];
        foreach ($achieveSd as $index => $a) {
            CmsAchievement::create(array_merge($a, ['type' => 'unit', 'unit_id' => $unitSd->id, 'order' => $index, 'is_active' => true]));
        }

        $achieveSmp = [
            ['year' => '2024', 'title' => 'Juara 1 Olimpiade Sains Tingkat Provinsi', 'description' => 'Kategori Matematika pada kompetisi antar SMP IT.', 'level' => 'Provinsi', 'side' => 'left'],
            ['year' => '2023', 'title' => 'Juara Umum MTQ Pelajar Tingkat Kabupaten', 'description' => 'Kategori Tartil dan Tahfidz Al-Qur\'an.', 'level' => 'Kabupaten', 'side' => 'right'],
            ['year' => '2023', 'title' => 'Juara 2 Lomba Debat Bahasa Arab', 'description' => 'Kompetisi antar SMP Islam se-Provinsi.', 'level' => 'Provinsi', 'side' => 'left'],
            ['year' => '2022', 'title' => 'Regu Tergiat Pramuka Penggalang', 'description' => 'Jambore Tingkat Kecamatan dan Kabupaten.', 'level' => 'Kabupaten', 'side' => 'right'],
        ];
        foreach ($achieveSmp as $index => $a) {
            CmsAchievement::create(array_merge($a, ['type' => 'unit', 'unit_id' => $unitSmp->id, 'order' => $index, 'is_active' => true]));
        }

        // 18. Seed cms_post_categories
        $categories = [
            ['name' => 'Tahfidz', 'slug' => 'tahfidz', 'icon' => 'book-marked', 'color' => 'emerald'],
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'icon' => 'trophy', 'color' => 'amber'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'icon' => 'megaphone', 'color' => 'blue'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'icon' => 'calendar', 'color' => 'violet'],
            ['name' => 'Akademik', 'slug' => 'akademik', 'icon' => 'graduation-cap', 'color' => 'cyan'],
            ['name' => 'Sosial', 'slug' => 'sosial', 'icon' => 'heart', 'color' => 'rose'],
        ];

        CmsPostCategory::truncate();
        $seededCategories = [];
        foreach ($categories as $cat) {
            $seededCategories[$cat['name']] = CmsPostCategory::create($cat);
        }

        // 19. Seed cms_posts
        $author = User::where('role', 'admin')->first() ?? User::first();
        $posts = [
            [
                'category_id' => $seededCategories['Tahfidz']->id,
                'title' => 'Wisuda Tahfidz Angkatan ke-8',
                'slug' => 'wisuda-tahfidz-angkatan-ke-8',
                'excerpt' => 'Sebanyak 45 siswa berhasil menyelesaikan target hafalan Al-Quran dan diwisuda dalam acara yang penuh kebanggaan.',
                'body' => '<p>Sebanyak 45 siswa SIT Mutiara Qur\'an berhasil menyelesaikan target hafalan Al-Qur\'an dan diwisuda dalam acara yang penuh kebanggaan dan rasa syukur.</p><p>Acara wisuda tahfidz ini merupakan angkatan ke-8 yang diselenggarakan setiap tahun sebagai bentuk apresiasi terhadap pencapaian siswa-siswi dalam menghafal Al-Qur\'an.</p><p>Para wisudawan terdiri dari siswa SD dan SMP yang telah menyelesaikan hafalan mulai dari 3 juz hingga 10 juz. Mereka telah melalui proses muraja\'ah dan ujian yang ketat.</p><p>Kepala Sekolah, Ustadz Ahmad Fauzi, dalam sambutannya menyampaikan rasa bangga dan berharap pencapaian ini bisa menjadi motivasi bagi siswa lainnya.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(2),
                'meta_title' => 'Wisuda Tahfidz Angkatan ke-8 - SIT Mutiara Qur\'an',
                'meta_description' => 'Sebanyak 45 siswa berhasil menyelesaikan target hafalan Al-Quran dan diwisuda dalam acara wisuda tahfidz angkatan ke-8 SIT Mutiara Qur\'an.',
            ],
            [
                'category_id' => $seededCategories['Prestasi']->id,
                'title' => 'Juara Olimpiade Sains Tingkat Kota',
                'slug' => 'juara-olimpiade-sains-tingkat-kota',
                'excerpt' => 'Tim olimpiade sains SIT Mutiara Quran berhasil meraih juara 1 dan 3 dalam Olimpiade Sains tingkat Kota Kabupaten Solok.',
                'body' => '<p>Alhamdulillah, Tim olimpiade sains SIT Mutiara Quran berhasil meraih prestasi membanggakan dengan menyabet juara 1 dan 3 dalam Olimpiade Sains tingkat Kota Kabupaten Solok.</p><p>Prestasi ini diraih berkat ketekunan siswa dalam bimbingan intensif dan kerja keras tim pengajar sains di unit SD dan SMP.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1518152006812-edab29b069ac?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(10),
                'meta_title' => 'Siswa SIT Mutiara Qur\'an Juara OSN Kabupaten Solok',
                'meta_description' => 'Siswa SMP IT dan SD IT Mutiara Qur\'an berhasil meraih medali emas pada OSN tingkat Kabupaten Solok.',
            ],
            [
                'category_id' => $seededCategories['Pengumuman']->id,
                'title' => 'Pembukaan PPDB ' . date('Y') . '/' . (date('Y') + 1),
                'slug' => 'pembukaan-ppdb-baru',
                'excerpt' => 'Pendaftaran peserta didik baru tahun ajaran resmi dibuka untuk jenjang TK, SD, dan SMP Islam Terpadu.',
                'body' => '<p>Pendaftaran peserta didik baru SIT Mutiara Qur\'an tahun ajaran baru resmi dibuka untuk jenjang TK, SD, dan SMP Islam Terpadu.</p><p>Dapatkan diskon khusus pembangunan untuk pendaftaran gelombang 1. Hubungi panitia untuk informasi lengkap.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(15),
                'meta_title' => 'PPDB SIT Mutiara Qur\'an Resmi Dibuka',
                'meta_description' => 'Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur\'an resmi dibuka untuk jenjang TK, SD, dan SMP.',
            ],
            [
                'category_id' => $seededCategories['Kegiatan']->id,
                'title' => 'Field Trip ke Museum Geologi',
                'slug' => 'field-trip-ke-museum-geologi',
                'excerpt' => 'Siswa kelas 4-6 melaksanakan field trip edukatif ke Museum Geologi sebagai bagian dari pembelajaran IPA yang menyenangkan.',
                'body' => '<p>Siswa kelas 4-6 melaksanakan field trip edukatif ke Museum Geologi sebagai bagian dari pembelajaran IPA yang menyenangkan.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1544531586-fde5298cdd40?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(20),
                'meta_title' => 'Field Trip Edukatif Siswa SIT Mutiara Qur\'an',
                'meta_description' => 'Siswa SD IT Mutiara Qur\'an melakukan perjalanan edukasi seru ke Museum Geologi.',
            ],
            [
                'category_id' => $seededCategories['Akademik']->id,
                'title' => 'Pelatihan Guru Kurikulum Merdeka',
                'slug' => 'pelatihan-guru-kurikulum-merdeka',
                'excerpt' => 'Seluruh guru mengikuti pelatihan implementasi Kurikulum Merdeka yang diintegrasikan dengan nilai-nilai keislaman.',
                'body' => '<p>Seluruh guru mengikuti pelatihan implementasi Kurikulum Merdeka yang diintegrasikan dengan nilai-nilai keislaman.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1571260899304-425eee4c7efc?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(25),
                'meta_title' => 'Pelatihan Guru Profesional Kurikulum Merdeka',
                'meta_description' => 'Tenaga pendidik SIT Mutiara Qur\'an mengikuti pelatihan Kurikulum Merdeka JSIT.',
            ],
            [
                'category_id' => $seededCategories['Kegiatan']->id,
                'title' => 'Lomba Kaligrafi & MTQ Internal',
                'slug' => 'lomba-kaligrafi-mtq-internal',
                'excerpt' => 'Ajang tahunan lomba kaligrafi dan musabaqah tilawatil Quran yang diikuti seluruh siswa dengan penuh semangat.',
                'body' => '<p>Ajang tahunan lomba kaligrafi dan musabaqah tilawatil Quran yang diikuti seluruh siswa dengan penuh semangat.</p>',
                'featured_image' => 'https://images.unsplash.com/photo-1585829365295-ab7cd400c167?auto=format&fit=crop&w=600&q=80',
                'status' => 'published',
                'publish_date' => now()->subDays(30),
                'meta_title' => 'Lomba Keagamaan Internal MTQ Mutiara Qur\'an',
                'meta_description' => 'Ajang tahunan asah bakat seni kaligrafi dan tilawah Quran tingkat internal sekolah.',
            ]
        ];

        CmsPost::truncate();
        foreach ($posts as $index => $p) {
            CmsPost::create(array_merge($p, [
                'author_id' => $author ? $author->id : null,
                'is_active' => true,
                'order' => $index
            ]));
        }

        // 20. Seed cms_ppdb_timeline
        $timeline = [
            ['title' => 'Tahap Pendaftaran', 'description' => 'Pendaftaran Tim dan Submit Proposal', 'date_range' => 'April — 13 Juni ' . date('Y'), 'status' => 'Dibuka', 'order' => 0],
            ['title' => 'Babak Penyisihan I', 'description' => 'Babak Penyisihan Pertama', 'date_range' => '26 — 27 Juni ' . date('Y'), 'status' => 'Segera', 'order' => 1],
            ['title' => 'Babak Penyisihan II', 'description' => 'Seleksi lanjutan untuk mencari finalis.', 'date_range' => '27 Juli — 8 Agustus ' . date('Y'), 'status' => 'Menunggu', 'order' => 2],
            ['title' => 'Pengumuman Finalis', 'description' => 'Tim yang lolos menuju tahap akhir.', 'date_range' => '10 Agustus ' . date('Y'), 'status' => 'Menunggu', 'order' => 3],
            ['title' => 'Daftar Ulang', 'description' => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.', 'date_range' => '16 — 30 Agustus ' . date('Y'), 'status' => 'Menunggu', 'order' => 4],
        ];

        CmsPpdbTimeline::truncate();
        foreach ($timeline as $item) {
            CmsPpdbTimeline::create(array_merge($item, ['is_active' => true]));
        }

        // 21. Seed cms_ppdb_requirements
        $reqsTk = ['Usia minimal 4 tahun', 'Fotokopi akta kelahiran', 'Fotokopi KK', 'Pas foto 3x4 (4 lembar)', 'Surat keterangan sehat'];
        $reqsSd = ['Usia minimal 6 tahun', 'Ijazah / surat keterangan TK', 'Fotokopi akta & KK', 'Pas foto 3x4 (4 lembar)', 'Surat keterangan sehat'];
        $reqsSmp = ['Ijazah / SKL SD', 'Rapor kelas 4, 5, 6', 'Fotokopi akta & KK', 'Pas foto 3x4 (4 lembar)', 'Surat keterangan sehat'];

        CmsPpdbRequirement::truncate();
        foreach ($reqsTk as $index => $text) {
            CmsPpdbRequirement::create(['unit_id' => $unitTk->id, 'text' => $text, 'order' => $index, 'is_active' => true]);
        }
        foreach ($reqsSd as $index => $text) {
            CmsPpdbRequirement::create(['unit_id' => $unitSd->id, 'text' => $text, 'order' => $index, 'is_active' => true]);
        }
        foreach ($reqsSmp as $index => $text) {
            CmsPpdbRequirement::create(['unit_id' => $unitSmp->id, 'text' => $text, 'order' => $index, 'is_active' => true]);
        }

        // 22. Seed cms_ppdb_brochures
        $brochures = [
            ['title' => 'Syarat PPDB TK/SD', 'description' => 'Lihat persyaratan pendaftaran tingkat TK dan SD', 'file_path' => 'syarat-tksd.jpeg', 'order' => 0],
            ['title' => 'Biaya PPDB TK/SD', 'description' => 'Lihat rincian biaya pendaftaran tingkat TK dan SD', 'file_path' => 'biaya-tksd.jpeg', 'order' => 1],
            ['title' => 'Syarat PPDB SMP', 'description' => 'Lihat persyaratan pendaftaran tingkat SMP', 'file_path' => 'syarat-smp.jpeg', 'order' => 2],
            ['title' => 'Biaya PPDB SMP', 'description' => 'Lihat rincian biaya pendaftaran tingkat SMP', 'file_path' => 'biaya-smp.jpeg', 'order' => 3],
        ];

        CmsPpdbBrochure::truncate();
        foreach ($brochures as $b) {
            CmsPpdbBrochure::create(array_merge($b, ['is_active' => true]));
        }

        // 23. Seed cms_ppdb_steps
        $steps = [
            ['step_number' => 1, 'icon' => 'file-edit', 'title' => 'Mengisi Formulir', 'description' => 'Isi formulir pendaftaran online atau datang langsung ke sekolah.'],
            ['step_number' => 2, 'icon' => 'folder-check', 'title' => 'Melengkapi Berkas', 'description' => 'Siapkan dan serahkan berkas persyaratan yang diperlukan.'],
            ['step_number' => 3, 'icon' => 'clipboard-pen', 'title' => 'Tes Seleksi', 'description' => 'Calon siswa mengikuti tes baca tulis, wawancara, dan tes Al-Quran.'],
            ['step_number' => 4, 'icon' => 'megaphone', 'title' => 'Pengumuman', 'description' => 'Hasil seleksi diumumkan melalui website dan WhatsApp.'],
            ['step_number' => 5, 'icon' => 'badge-check', 'title' => 'Daftar Ulang', 'description' => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.'],
        ];

        CmsPpdbStep::truncate();
        foreach ($steps as $index => $step) {
            CmsPpdbStep::create(array_merge($step, ['order' => $index, 'is_active' => true]));
        }

        Schema::enableForeignKeyConstraints();
    }
}
