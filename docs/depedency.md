raw
Dependency · MD

# Dokumentasi Dependency/Package Laravel

## Proyek Sistem Akademik & Website Sekolah

Dokumentasi ini berisi dependency/package Laravel yang kemungkinan akan digunakan pada proyek PBL Sistem Akademik & Website Sekolah. Penjelasan dependency dilakukan menggunakan pendekatan 5W+1H untuk menjelaskan fungsi, tujuan, pengguna, waktu penggunaan, lokasi implementasi, serta cara penggunaan package pada sistem.

---

# 1. Spatie Laravel Permission
 
| Komponen | Penjelasan |
|---|---|
| **What** | Package Laravel untuk manajemen role dan permission |
| **Why** | Digunakan untuk mengatur hak akses admin, guru, wali kelas, dan siswa |
| **Who** | Admin, Guru, Siswa, Developer |
| **When** | Saat proses login dan akses fitur sistem |
| **Where** | Dashboard, middleware, dan manajemen akun |
| **How** | Diinstall menggunakan Composer dan dikonfigurasi pada role pengguna |
| **Referensi** | https://spatie.be/docs/laravel-permission |
 
### Cara Instalasi
 
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```
 
---
 
# 2. Laravel Excel
 
| Komponen | Penjelasan |
|---|---|
| **What** | Package Laravel untuk import dan export file Excel |
| **Why** | Mempermudah pengelolaan data akademik dalam jumlah besar |
| **Who** | Admin dan Guru |
| **When** | Saat import/export data siswa, nilai, dan absensi |
| **Where** | Modul siswa, nilai, absensi, dan laporan |
| **How** | Menggunakan package Laravel Excel pada controller |
| **Referensi** | https://laravel-excel.com |
 
### Cara Instalasi
 
```bash
composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config
```
 
---
 
# 3. Laravel DomPDF
 
| Komponen | Penjelasan |
|---|---|
| **What** | Package Laravel untuk generate file PDF |
| **Why** | Digunakan untuk mencetak rapor dan laporan |
| **Who** | Admin dan Guru |
| **When** | Saat mencetak laporan akademik |
| **Where** | Modul rapor dan laporan |
| **How** | View Laravel dikonversi menjadi file PDF |
| **Referensi** | https://github.com/barryvdh/laravel-dompdf |
 
### Cara Instalasi
 
```bash
composer require barryvdh/laravel-dompdf
php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
```
 
---
 
<!-- # 4. Intervention Image
 
| Komponen | Penjelasan |
|---|---|
| **What** | Package Laravel untuk manipulasi gambar |
| **Why** | Digunakan untuk resize dan upload gambar |
| **Who** | Admin dan Siswa |
| **When** | Saat upload foto atau gambar |
| **Where** | Profil pengguna, banner, dan berita sekolah |
| **How** | Menggunakan library upload image Laravel |
| **Referensi** | https://image.intervention.io |
 
### Cara Instalasi
 
```bash
composer require intervention/image
php artisan vendor:publish --provider="Intervention\Image\Laravel\ServiceProvider"
```
 
---
 
# 5. Laravel Debugbar
 
| Komponen | Penjelasan |
|---|---|
| **What** | Package debugging Laravel |
| **Why** | Membantu developer melihat query dan performa aplikasi |
| **Who** | Developer |
| **When** | Saat proses development dan testing |
| **Where** | Seluruh sistem Laravel |
| **How** | Menampilkan query database dan performa aplikasi |
| **Referensi** | https://github.com/barryvdh/laravel-debugbar |
 
### Cara Instalasi
 
```bash
composer require barryvdh/laravel-debugbar --dev
php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
```
 
> **Catatan:** Gunakan flag `--dev` agar hanya aktif di environment development, tidak ikut terbawa ke production.
 
---
 
# 6. SweetAlert2
 
| Komponen | Penjelasan |
|---|---|
| **What** | Library alert modern berbasis JavaScript |
| **Why** | Membuat tampilan notifikasi lebih interaktif |
| **Who** | Semua pengguna |
| **When** | Saat proses CRUD data |
| **Where** | Form dan dashboard sistem |
| **How** | Diintegrasikan menggunakan CDN JavaScript |
| **Referensi** | https://sweetalert2.github.io |
 
### Cara Instalasi
 
```bash
npm install sweetalert2
```
 
> Atau gunakan CDN langsung di layout Blade:
> ```html
> <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
> ```
 
---
 
# 7. CKEditor
 
| Komponen | Penjelasan |
|---|---|
| **What** | Text editor berbasis web (WYSIWYG) |
| **Why** | Digunakan untuk membuat berita dan artikel sekolah |
| **Who** | Admin |
| **When** | Saat membuat atau mengedit konten |
| **Where** | Modul berita dan pengumuman |
| **How** | Diintegrasikan pada textarea menggunakan JavaScript |
| **Referensi** | https://ckeditor.com |
 
### Cara Instalasi
 
```bash
npm install @ckeditor/ckeditor5-build-classic
```
 
> Atau gunakan CDN langsung di layout Blade:
> ```html
> <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
> ```
 
---
 
# 8. DataTables
 
| Komponen | Penjelasan |
|---|---|
| **What** | Library tabel interaktif |
| **Why** | Mempermudah pencarian, sorting, dan filter data |
| **Who** | Admin dan Guru |
| **When** | Saat menampilkan data dalam jumlah besar |
| **Where** | Data siswa, guru, kelas, dan nilai |
| **How** | Menggunakan package Yajra Laravel DataTables |
| **Referensi** | https://datatables.net |
 
### Cara Instalasi
 
```bash
composer require yajra/laravel-datatables-oracle
php artisan vendor:publish --tag=datatables
```
 
---
 
# 9. FilePond
 
| Komponen | Penjelasan |
|---|---|
| **What** | Library upload file modern |
| **Why** | Mempermudah proses upload file dan gambar |
| **Who** | Admin, Guru, dan Siswa |
| **When** | Saat upload file |
| **Where** | Upload bukti pembayaran dan gambar |
| **How** | Diintegrasikan menggunakan JavaScript dan Laravel backend |
| **Referensi** | https://pqina.nl/filepond |
 
### Cara Instalasi
 
```bash
npm install filepond filepond-plugin-image-preview filepond-plugin-file-validate-type
```
 
> Atau gunakan CDN langsung di layout Blade:
> ```html
> <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
> <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
> ```
 
--- -->

# Kesimpulan

Dengan implementasi dependency yang sesuai, sistem dapat dikembangkan dengan lebih optimal serta mendukung kebutuhan akademik dan website sekolah secara efektif.
