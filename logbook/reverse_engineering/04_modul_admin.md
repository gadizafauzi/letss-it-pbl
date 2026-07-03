# Bedah Seluruh Modul & Sidebar Admin
*(Dokumen Reverse Engineering - Tahap 3 & Tahap 4)*

Ini adalah analisis "turun mesin" untuk seluruh menu yang ada di sisi Admin. Semua data di sini 100% didasarkan pada *source code* `routes/admin.php` dan deretan Controller di `app/Http/Controllers/Admin/`.

---

## 1. Sidebar: Dashboard
*   **Tujuan:** Halaman pertama saat login, berisi statistik ringkas.
*   **Hak Akses:** User dengan Role `admin`.
*   **Route:** `/admin/dashboard`
*   **Controller:** `Admin\System\DashboardController@index`
*   **Alur:** `Route` ➔ `Middleware(auth, role:admin)` ➔ `Controller` ➔ Query Model (menghitung jumlah guru, siswa, kelas dari tabel) ➔ `View (admin.dashboard)` ➔ Tampil di Browser.

---

## 2. Sidebar Akademik (Core Master Data)

### A. Menu Guru & Siswa
*   **Fungsi Utama:** Manajemen data penduduk sekolah, lengkap dengan fitur *Import* Excel dan Hapus Massal (*Bulk Destroy*).
*   **Route Terlibat:** `/admin/guru` & `/admin/siswa`
*   **Controller:** `GuruController` & `SiswaController`
*   **Service Pekerja:** `GuruService`, `SiswaService`, `ExcelImportService` (untuk parsing `.xlsx`).
*   **Model Terkait:** `Teacher`, `Student`, `User` (Otomatis dibuatkan akun).
*   **Alur Import:** User upload Excel ➔ `Controller` ➔ `ExcelImportService` melakukan iterasi baris ➔ Memanggil `SiswaService` tiap baris ➔ `Model` menyimpan ke Database ➔ `Redirect` kembali.

### B. Menu Kelas, Mapel, Tahun Ajaran, Jabatan, Unit
*   **Fungsi:** Data pendukung operasional (Referensi).
*   **Route:** Resource controller standar (`/admin/kelas`, `/admin/mapel`, dll).
*   **Controller:** `KelasController`, `MapelController`, dll.
*   **Keunikan Kode:** Semua ini memiliki rute khusus `bulk-destroy` untuk menghapus banyak data sekaligus lewat *checkbox* di tabel.

### C. Menu Kenaikan Kelas (Bulk Promotion)
*   **Fungsi:** Memindahkan rombongan belajar (rombel) lama ke rombel baru.
*   **Controller:** `KenaikanKelasController@process`
*   **Query Penting:** Sistem menerima daftar `id` siswa dan `class_id` tujuan, lalu mengeksekusi `UPDATE students SET school_class_id = ? WHERE id IN (...)`.

---

## 3. Sidebar Keuangan (Financial Management)

### A. Menu Jenis Tagihan & Rekening
*   **Fungsi:** Mengatur jenis pembayaran (SPP, DSP) dan rekening bank sekolah.
*   **Model:** `PaymentType`, `SchoolAccount`.

### B. Menu Tagihan (Invoice Generation & WA)
*   **Fungsi:** Membuat *invoice* bulanan/tahunan untuk siswa.
*   **Controller:** `TagihanController`
*   **Fitur Spesial (WA Gateway):** Terdapat rute `POST /admin/tagihan/{invoice}/kirim-wa`. Controller ini mengirim data melalui `cURL` / `Http::post` ke server API WhatsApp eksternal untuk menagih orang tua.

### C. Menu Pembayaran (Verifikasi)
*   **Fungsi:** Admin "kasir" memeriksa bukti struk dan mengubah status tagihan jadi Lunas.
*   **Controller:** `PembayaranController@verify`
*   **Efek Database:** 
    1. `UPDATE payments SET status = 'verified'`.
    2. `UPDATE invoices SET status = 'paid'`.

---

## 4. Sidebar System & Pengguna

### A. Menu User (Role & Permission)
*   **Fungsi:** Mengatur akun pengguna jika ingin dibuat manual.
*   **Package Terkait:** Menggunakan *library* `spatie/laravel-permission`. User bisa di-*assign* role khusus.
*   **Controller:** `UserController`

### B. Menu Profil Admin
*   **Fungsi:** Mengganti password Admin sendiri.
*   **Controller:** `ProfileController`
*   **Validasi:** Menggunakan `UpdatePasswordRequest` untuk memaksa password baru harus sama dengan konfirmasi password.

*(Catatan: Sidebar CMS dipisahkan pada dokumen tersendiri di Tahap 7).*
