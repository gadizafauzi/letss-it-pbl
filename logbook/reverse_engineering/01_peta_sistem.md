# PETA SISTEM & ANALISIS STRUKTUR
*(Dokumen Reverse Engineering - Tahap 1 & 2)*

Selamat datang di Dokumentasi Peta Sistem. Sebagai arsitek perangkat lunak Anda, saya telah menelusuri seluruh akar dari kode sumber proyek `letss-it-pbl` ini. Dokumen ini dirancang khusus untuk Anda yang baru belajar, menggunakan analogi sederhana namun tetap 100% akurat berdasarkan kode asli Anda.

---

## 1. Tujuan & Ruang Lingkup Proyek
Berdasarkan pembacaan struktur rute (`routes/web.php`, `admin.php`, `teacher.php`, `student.php`) dan tabel database, proyek ini adalah sebuah **Sistem Informasi Manajemen Sekolah Terpadu**.

Ruang lingkup aplikasi mencakup:
*   **Penerimaan Siswa Baru (PPDB)**
*   **Manajemen Master Data Akademik** (Guru, Siswa, Kelas, Mata Pelajaran, Jadwal)
*   **Manajemen Keuangan** (SPP, Uang Gedung, Tagihan, Verifikasi Pembayaran)
*   **Manajemen Konten Publik / CMS** (Beranda, Berita, Profil, Unit TK/SD/SMP)
*   **Portal Akademik Guru & Siswa** (Input Nilai, Rapor, Tagihan Siswa)

---

## 2. Peta Aktor & Hak Akses (Role Base)
Dari file `composer.json`, saya melihat Anda menggunakan package `spatie/laravel-permission`. Artinya, keamanan sistem Anda sangat ketat dan berjenjang.

Terdapat **4 Aktor Utama (Role)** dalam sistem ini:
1.  **Guest (Tamu / Publik):** Tidak perlu login. Hanya bisa melihat halaman depan (`PublicHomeController`, `PublicPpdbController`).
2.  **Admin:** Punya akses ke rute ber-middleware `['auth', 'role:admin']`. Bertugas sebagai penggerak utama (CRUD Master Data, Verifikasi Uang, Edit CMS).
3.  **Teacher (Guru & Wali Kelas):** Mengakses rute `['auth', 'role:teacher']`. Hanya bisa menginput nilai, mengecek jadwal. *Spesial:* Jika ia di-assign sebagai Wali Kelas di tabel `classes`, ia bisa merilis Rapor Siswa.
4.  **Student (Siswa):** Mengakses rute `['auth', 'role:student']`. Hanya bisa melihat nilai rapor dan tagihannya sendiri.

---

## 3. Peta Modul Utama
Aplikasi ini dipecah menjadi 5 modul besar. Bayangkan modul ini sebagai "Gedung-Gedung" di dalam satu area sekolah.

### A. Modul Publik (Gedung Resepsionis)
*   **Fungsi:** Menampilkan informasi ke dunia luar.
*   **Penggerak:** Folder `app/Http/Controllers/` (File seperti `PublicHomeController.php`, `PublicNewsController.php`).
*   **Ketergantungan:** Modul ini sangat bergantung pada Modul CMS Admin. Jika Admin tidak mengisi tabel CMS, halaman ini akan kosong.

### B. Modul Admin Akademik (Gedung Tata Usaha - Akademik)
*   **Fungsi:** Mengatur inti dari sekolah (Orang dan Pelajaran).
*   **Penggerak Utama:** Folder `app/Http/Controllers/Admin/Akademik/`.
*   **Fitur Krusial:** `GuruController`, `SiswaController`, `KenaikanKelasController`.
*   **Analisis Kode Asli:** Menariknya, fitur Import/Export Excel dijalankan menggunakan pustaka `phpoffice/phpspreadsheet` yang dikemas rapi dalam `ExcelImportService` dan `ExcelExportService`.

### C. Modul Admin Keuangan (Gedung Tata Usaha - Bendahara)
*   **Fungsi:** Menerbitkan `Invoice` (Tagihan) dan mengecek `Payment` (Pembayaran).
*   **Penggerak Utama:** Folder `app/Http/Controllers/Admin/Keuangan/`.
*   **Fitur Krusial:** Di `TagihanController`, terdapat fungsi `kirimWa()` yang menghubungkan aplikasi Anda dengan API WhatsApp untuk menagih orang tua.

### D. Modul CMS / Pengelola Konten (Gedung IT)
*   **Fungsi:** Mengubah teks, visi, misi, dan foto yang tampil di Halaman Publik.
*   **Penggerak Utama:** Folder `app/Http/Controllers/Admin/Cms/`.
*   **Kelebihan Kode:** Gambar diunggah menggunakan `Storage` fasad bawaan Laravel dan kemungkinan diproses dengan `intervention/image` (sesuai `composer.json`).

### E. Modul Portal Akademik (Gedung Kelas & Ruang Guru)
*   **Fungsi:** Interaksi Guru dan Murid.
*   **Penggerak Guru:** `app/Http/Controllers/Teacher/` (Input nilai `Grade`).
*   **Penggerak Siswa:** `app/Http/Controllers/Student/` (Lihat Nilai & Upload Struk Bayar).

---

## 4. Pustaka Pihak Ketiga (Vendor Dependency)
Saya melakukan *reverse engineer* terhadap `composer.json` Anda. Ini adalah "bumbu rahasia" (package) buatan orang lain yang menopang aplikasi Anda:
*   **`spatie/laravel-permission`:** Otak di balik sistem batasan akses (Siapa yang boleh buka menu apa).
*   **`phpoffice/phpspreadsheet`:** Kuli panggul yang bertugas membaca `.xlsx` saat Admin import Siswa/Guru, dan mencetak Excel saat Export data.
*   **`barryvdh/laravel-dompdf`:** Pabrik pencetak PDF. Kemungkinan besar dipakai di fitur "Cetak KTM" (Kartu Tanda Murid) atau "Cetak Rapor".
*   **`mews/captcha`:** Satpam gerbang. Dipakai di halaman `login` untuk mencegah bot/hacker mencoba *brute-force* sandi.
*   **`intervention/image`:** Editor foto otomatis. Dipakai saat Admin CMS / Siswa meng-upload gambar agar ukurannya dikompres (tidak memberatkan server).

---
*Lanjut ke Fase Eksekusi berikutnya: Peta Relasi Database (ERD) dan Dependency Graph.*
