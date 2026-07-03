# Dokumentasi Refactoring Project LETSS IT PBL

Dokumen ini mencatat seluruh aktivitas refactoring yang telah dilakukan pada source code project, baik refactoring berskala besar maupun kecil, guna meningkatkan kualitas, skalabilitas, dan keamanan kode.

---

## 1. Pemecahan Controller Utama (Berdasarkan Modul)

**Sebelum:**
Controller pada panel Admin menumpuk di dalam direktori `app/Http/Controllers/Admin` tanpa pengelompokan. Satu controller sering kali menangani banyak urusan yang tidak terkait langsung.

**Masalah:**
Direktori Controller menjadi sangat penuh (*bloated*) dan sulit untuk dinavigasi. Sulit mencari file spesifik saat terjadi *bug* pada modul tertentu, melanggar *Single Responsibility Principle* (SRP).

**Perubahan:**
Struktur folder Controller dipecah berdasarkan domain modul, seperti:
- `app/Http/Controllers/Admin/Akademik` (Siswa, Guru, Mapel, dll.)
- `app/Http/Controllers/Admin/Keuangan` (Tagihan, Pembayaran, dll.)
- `app/Http/Controllers/Admin/Cms` (Beranda, Profil, Unit, dll.)
- `app/Http/Controllers/Admin/System` (Dashboard, User, Profil Admin)

**Alasan:**
Memudahkan pengelompokan logika bisnis berdasarkan *domain-driven design* yang lebih terstruktur.

**Dampak:**
Navigasi source code jauh lebih mudah. Pengembang baru dapat langsung menemukan *controller* berdasarkan fungsi bisnisnya.

---

## 2. Ekstraksi Validasi ke Form Request

**Sebelum:**
Logika validasi input diletakkan langsung di dalam method Controller (seperti `store` dan `update`) menggunakan `$request->validate()`.

**Masalah:**
Method Controller menjadi sangat panjang dan sulit dibaca. Terjadi duplikasi kode validasi antara proses penambahan (create) dan pembaruan (update) data.

**Perubahan:**
Semua aturan validasi dipindahkan ke class khusus di dalam `app/Http/Requests`, dengan pengelompokan yang sama dengan struktur Controller (misalnya: `Requests/Admin/Akademik/StoreSiswaRequest`).

**Alasan:**
Pemisahan tanggung jawab (*Separation of Concerns*). Controller seharusnya hanya bertugas mengontrol alur, bukan mengurus detail aturan input.

**Dampak:**
Kode Controller menjadi sangat tipis dan bersih (*thin controller*). Validasi menjadi lebih *reusable* dan mudah dilakukan *unit testing*.

---

## 3. Service Extraction (Ekstraksi Business Logic)

**Sebelum:**
Proses bisnis yang kompleks (seperti logika *import/export* Excel, proses penambahan data beserta upload file, dan logika transaksi keuangan) bercampur di dalam Controller.

**Masalah:**
Terjadi duplikasi logika jika proses yang sama harus dipanggil dari tempat lain (misalnya API atau CLI). Sulit melakukan pemeliharaan jika struktur file excel atau cara *upload* berubah.

**Perubahan:**
Dibuat class layanan mandiri (Service Pattern) di dalam `app/Services`, seperti:
- `GuruService.php` dan `SiswaService.php` untuk memproses logika data kompleks.
- `Shared/ExcelExportService.php`, `ExcelImportService.php`, dan `FileUploadService.php` untuk logika yang dipakai berulang di berbagai modul.

**Alasan:**
Menghindari perulangan kode (Prinsip DRY - *Don't Repeat Yourself*) dan mengisolasi logika pemrosesan yang kompleks.

**Dampak:**
Perubahan cara kerja (seperti integrasi dengan *cloud storage* untuk upload file) cukup dilakukan di satu tempat (Service).

---

## 4. Pemisahan Routing (Route Cleanup)

**Sebelum:**
Semua *route* dideklarasikan dalam satu file `routes/web.php` yang memanjang hingga ribuan baris.

**Masalah:**
Terjadi konflik *route*, sangat lambat saat melakukan pencarian *endpoint*, dan mempersulit kolaborasi antar pengembang pada sistem kontrol versi (Git *merge conflicts*).

**Perubahan:**
File `routes/web.php` diubah menjadi sekadar *dispatcher* yang memanggil file rute terpisah menggunakan `require`:
- `routes/admin.php`
- `routes/teacher.php`
- `routes/student.php`

**Alasan:**
Membagi fokus file routing berdasarkan peran akses (*Role/Actor*).

**Dampak:**
Sistem routing menjadi sangat modular, rapi, dan mudah dibaca. Risiko konflik saat *pull/merge* jauh berkurang.

---

## 5. Pencegahan Cascading Delete (Refactoring Bulk Delete & Validasi Relasi)

**Sebelum:**
Penghapusan data master (seperti Tahun Ajaran, Unit, Jabatan) dan operasional (Siswa, Guru) mengandalkan *Cascade On Delete* dari *database schema*.

**Masalah:**
Penghapusan data level atas (seperti Unit) akan menghapus data turunannya (Siswa, Tagihan, Pembayaran) secara otomatis tanpa peringatan, menyebabkan hilangnya riwayat keuangan (*orphan records*) dan cacatnya laporan audit tutup tahun.

**Perubahan:**
Menambahkan pagaran logika `exists()` (seperti pengecekan *TeachingAssignment*, pengecekan status lunas *Invoice*, atau pengecekan *SchoolClass*) pada metode `destroy` dan `bulkDestroy` di Controller (misalnya: `SiswaController`, `GuruController`, `TahunAjaranController`).

**Alasan:**
Melindungi integritas relasi data dan mencegah kelalaian operasional (faktor *human error*).

**Dampak:**
Data transaksional tidak bisa terhapus sembarangan. Sistem menolak perintah *delete* dan memberikan peringatan eksplisit (misal: "Siswa dengan tagihan lunas tidak bisa dihapus").

---

## 6. Pemisahan Blade Layout & Component

**Sebelum:**
Banyak pengulangan kode HTML/UI pada halaman *frontend* (Public) dan *backend* (Admin/Teacher/Student), seperti *navbar*, *sidebar*, dan *footer*.

**Masalah:**
Perubahan desain pada satu bagian (contoh: mengubah *link* di navbar) mengharuskan pengembang untuk mengedit puluhan file berbeda. 

**Perubahan:**
Menerapkan pendekatan *Blade Component* dan *Layouting*. 
- Pembuatan layout spesifik seperti `layouts/admin.blade.php`, `layouts/student.blade.php`, dan `layouts/unit.blade.php`.
- Pembuatan komponen yang dapat dipanggil berulang, seperti `<x-public.unit-navbar>`.

**Alasan:**
Modularitas antarmuka (*UI Modularity*) dan pemeliharaan kode berbasis komponen.

**Dampak:**
Desain *frontend* menjadi seragam (*consistent*), perbaikan *bug visual* sangat cepat karena hanya perlu menyunting satu file komponen.

---

## 7. Refactoring Modul CMS (Content Management System)

**Sebelum:**
Seluruh manajemen konten situs (seperti Beranda, Profil, Sejarah, Visi Misi) dikelola secara sporadis dalam satu alur yang campur aduk.

**Masalah:**
Menyulitkan Admin saat mengunggah teks dan aset gambar karena *logic update* tidak tersentralisasi berdasarkan halaman (*landing page*).

**Perubahan:**
Ekstraksi fungsionalitas CMS menjadi beberapa *controller* mandiri di bawah `app/Http/Controllers/Admin/Cms/`, yaitu:
- `CmsBerandaController`
- `CmsProfilController`
- `CmsUnitController`
- `CmsPpdbController`
- `CmsPostController` (untuk Berita)

**Alasan:**
Setiap segmen halaman *public* memerlukan penanganan data yang spesifik (seperti konfigurasi bagian *Hero*, *Timeline*, dll.).

**Dampak:**
Backend CMS lebih teratur dan fleksibel jika sekolah ingin menambah struktur atau bagian (*section*) baru pada halaman publik mereka di masa mendatang.

---

## 8. Refactoring Middleware / Policy (Role-Based Access)

**Sebelum:**
Pengecekan hak akses (apakah _user_ adalah admin, guru, atau siswa) mungkin tersebar di dalam _controller_ menggunakan `if (auth()->user()->role !== 'admin')`.

**Masalah:**
Logika keamanan (*security logic*) bercampur aduk dengan proses bisnis. Rentan terjadi kelupaan pengecekan di beberapa URL.

**Perubahan:**
Memusatkan pengecekan pada file `app/Http/Middleware/RoleMiddleware.php`. Seluruh _route_ spesifik kemudian dibungkus dengan metode grup _middleware_ (misalnya `->middleware(['auth', 'role:admin'])`).

**Alasan:**
Keamanan rute wajib bersifat preventif sebelum menyentuh Controller.

**Dampak:**
Sistem hak akses menjadi sangat ketat dan tidak ada URL yang "bocor" ke publik atau diakses oleh pengguna dengan level wewenang berbeda.

---

## 9. Refactoring Pemisahan Aset CSS/JS

**Sebelum:**
Gaya tampilan antarmuka disematkan (*inline*) langsung pada file Blade atau diletakkan dalam satu file besar yang membengkak.

**Masalah:**
Halaman memuat gaya (*styles*) yang tidak diperlukan, memperlambat _render_ (*render-blocking*), dan menyulitkan kustomisasi per *role*.

**Perubahan:**
File aset dipecah berdasarkan target pengguna di direktori `public/css/`:
- `admin.css`
- `teacher.css`
- `student.css`
- `public.css`

**Alasan:**
Optimalisasi kecepatan dan menjaga kemurnian cakupan gaya (*scope isolation*).

**Dampak:**
Dashboard Siswa dan Dashboard Guru tidak saling bertabrakan (_conflict_) secara visual karena tidak berbagi CSS yang sama.

---

## 10. Refactoring Import/Export Excel

**Sebelum:**
Logika pembacaan baris Excel dan penyusunan kolom CSV diletakkan langsung di fungsi `import` dan `export` dalam Controller.

**Masalah:**
Tingkat kerumitan metode menjadi di luar kendali. Susah menambah kolom jika format berubah.

**Perubahan:**
Fungsionalitas ditarik ke dalam `app/Services/Shared/ExcelImportService.php` dan `ExcelExportService.php` sebagai komponen mandiri (*Shared Service*).

**Alasan:**
File/library eksternal (*third-party*) lebih baik dibungkus dalam abstraksi (*Wrapper*).

**Dampak:**
Saat ada format data baru yang perlu diimpor, pengembang hanya perlu meneruskan array ke `ExcelImportService` tanpa menulis ulang logika ekstraksi file `.xlsx`.

---

## 11. Refactoring Dashboard (Role-Based Views)

**Sebelum:**
Dashboard diakses melalui satu _controller_ dan merender tampilan yang dicampur dengan klausa-klausa `if/else` besar bergantung pada peran *user* saat ini.

**Masalah:**
Tampilan bercampur dalam satu file. Logika dashboard siswa harus mengecek kondisi tingkat satuan pendidikannya, sementara guru harus dipilah tugas mengajarnya.

**Perubahan:**
Memisahkan dashboard siswa dan guru secara drastis berdasarkan *namespace* dan foldernya:
- `app/Http/Controllers/Student/...`
- `app/Http/Controllers/Teacher/...`

**Alasan:**
Pengembangan fitur antar aktor (guru/siswa) tidak saling memblokir (*non-blocking development*).

**Dampak:**
Dashboard sekarang sepenuhnya independen, bersih dari `if/else` logika silang, serta UI dapat dikustomisasi secara maksimal per jenjang.
