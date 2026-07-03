# Bedah Modul CMS (Content Management System) & Layar Publik
*(Dokumen Reverse Engineering - Tahap 7)*

Modul CMS bertugas sebagai mesin pencetak halaman publik (Website yang tidak perlu login). Ada dua pihak yang bekerja di sini: **Admin CMS** (Pembuat Konten) dan **Public Controller** (Pembaca Konten).

---

## 1. Relasi Kunci CMS (The Golden Rule)
Dalam seluruh file `Cms***Controller`, berlaku satu aturan emas yang sama:
*   **Asal Data:** Di-input oleh Admin melalui Form HTML.
*   **Tempat Simpan:** Tersimpan di puluhan tabel yang memiliki *prefix* `cms_` (misal: `cms_heroes`, `cms_visis`, `cms_ppdb_timelines`).
*   **Siapa Pembaca Data (Reader):** Dibaca oleh Controller di luar area Admin, yaitu kelompok Controller Publik (`PublicHomeController`, `PublicNewsController`, dll).
*   **Di Mana Ditampilkan (Viewer):** Di file `resources/views/public/...`.

---

## 2. Bedah Sub-Modul CMS

### A. CMS Beranda & Profil Sekolah
*   **Controller Admin:** `CmsBerandaController`, `CmsProfilController`
*   **Tujuan:** Mengganti foto spanduk raksasa (*Hero Image*), Teks Selamat Datang, Sejarah, dan Visi Misi.
*   **Upload Proses (Intervention Image):** Saat Admin mengunggah gambar latar untuk Beranda, aplikasi mengolah gambar tersebut (memotong/mengompres) agar website depan tidak lambat saat dimuat. Nama file `.jpg` disimpan ke DB, sedangkan file fisiknya dilempar ke folder `public/storage`.
*   **Controller Publik Pembaca:** `PublicHomeController@index` & `PublicProfileController@index`.
*   **Lifecycle Data:** Data di CMS tidak memiliki riwayat versi (bukan artikel blog). Sistemnya me-*replace* atau menimpa isi baris tunggal (ID=1) di database dengan teks baru.

### B. CMS Portal Berita (News & Blog)
*   **Controller Admin:** `CmsCategoryController` & `CmsPostController`.
*   **Tujuan:** Mempublikasikan artikel atau pengumuman sekolah.
*   **Model Relasi (1-to-Many):** Tabel `cms_posts` (Berita) berelasi dengan tabel `cms_post_categories` (Kategori: Olahraga, Akademik, dll).
*   **Controller Publik Pembaca:** `PublicNewsController`
    *   Terdapat rute `/berita/{slug}` yang mencari judul berita berdasarkan URL (slug) dan bukan ID.
    *   Terdapat fitur `search()` untuk mencari *keyword* di dalam judul atau isi artikel.

### C. CMS Unit Pendidikan (TK, SD, SMP)
*   **Controller Admin:** `CmsUnitController`
*   **Tujuan:** Setiap jenjang sekolah punya halaman promosinya sendiri yang memuat Fasilitas, Ekskul, dan Profil Guru.
*   **Logika Dinamis:** Daripada membuat tabel terpisah untuk TK, SD, dan SMP, sistem memakai relasi `unit_id`. Admin memilih "Update Ekskul untuk SD", lalu data masuk ke tabel `cms_unit_ekskuls` dengan tanda `unit_id = (ID SD)`.
*   **Controller Publik Pembaca:** `PublicUnitController` (membaca filter spesifik per jenjang).

### D. CMS PPDB (Pendaftaran Siswa Baru)
*   **Controller Admin:** `CmsPpdbController`
*   **Tujuan:** Menyediakan informasi pendaftaran, kalender pendaftaran, syarat berkas, dan *link download* PDF Brosur bagi calon murid.
*   **Data Models Terlibat:** 
    *   `CmsPpdbTimeline` (Alur waktu dari buka sampai tutup).
    *   `CmsPpdbRequirement` (List syarat seperti FC KK, Akte Kelahiran).
    *   `CmsPpdbBrochure` (Menampung nama file PDF Brosur).
*   **Controller Publik Pembaca:** `PublicPpdbController@index`.
*   **Efek Tampilan:** Jika Admin menekan Hapus/Delete pada suatu syarat pendaftaran di *dashboard*, seketika itu juga syarat tersebut hilang dari halaman publik PPDB (Sinkronisasi *Real-Time* via Database).
