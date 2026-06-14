# Dokumentasi Refactoring Sistem SIAKAD

Dokumen ini menjelaskan perubahan struktur proyek yang dilakukan untuk meningkatkan modularitas, keterbacaan kode, kemudahan pemeliharaan, dan mempermudah pengembangan fitur di masa mendatang.

Refactoring ini mengubah aplikasi yang sebelumnya kompleks dan memiliki banyak perulangan kode (_Fat Controller_) menjadi struktur yang jauh lebih rapi, terpusat, dan terukur (_Thin Controller_).

---

## 1. Refactoring Dashboard (Siswa & Guru)

### Masalah
Logika dan tampilan bercampur dalam satu file. Dashboard siswa harus mengecek kondisi SD/SMP, dan dashboard guru mencampur tugas mengajar umum dengan tugas spesifik wali kelas.

### Perubahan
- Memisahkan _view_, _layout_, komponen _sidebar_, CSS, dan _controller_ siswa berdasarkan unit (SD & SMP).
- Memisahkan dashboard guru berdasarkan peran (Guru Reguler & Wali Kelas).
- Mempertahankan _route_ lama (seperti `/student/dashboard`) hanya sebagai _dispatcher_ yang mengarahkan otomatis sesuai unit/peran.

### Dampak
Antarmuka lebih spesifik, kode UI tidak saling tumpang tindih, dan pengembangan fitur baru per jenjang/peran bisa dilakukan secara independen.

## 2. Pemecahan Controller Utama (Prinsip SRP)

### Masalah
Banyak _controller_ (seperti `GuruController` dan `SiswaController` lama) yang menangani berbagai domain tugas secara bersamaan (mulai dari CRUD profil, data perwalian, nilai, hingga manajemen kelas).

### Perubahan
Memecah _controller_ besar menjadi beberapa _controller_ spesifik:
- `Teacher\ProfileController` (khusus update profil & foto guru)
- `Teacher\WaliKelas\SiswaController` & `Teacher\WaliKelas\NilaiController` (khusus manajemen data perwalian)
- `Teacher\KelasController` (khusus jadwal mengajar & input nilai harian)

### Dampak
Penerapan _Single Responsibility Principle (SRP)_ membuat _controller_ fokus hanya pada satu tugas utamanya sehingga lebih ringkas dan terarah.

## 3. Penerapan Service Pattern & Form Request

### Masalah
Terjadi _Fat Controller_ (terutama di modul Admin untuk Guru, Siswa, dan Dashboard) karena alur request HTTP, proses validasi input, hingga logika kalkulasi data semuanya dikerjakan di satu tempat.

### Perubahan
- Service Layer: Memindahkan logika berat (_business logic_) ke `Admin\GuruService`, `Admin\SiswaService`, dan `Admin\DashboardService`.
- Form Request: Memindahkan aturan validasi panjang ke class khusus di dalam `Http\Requests\Admin\` (seperti `StoreGuruRequest`, `UpdateSiswaRequest`, `ImportExcelRequest`).

### Dampak
Menghasilkan _Thin Controller_ (controller yang sangat tipis dan bersih). _Controller_ kini hanya bertugas menerima HTTP request, memanggil service, dan mengembalikan _view/response_.

## 4. Pembuatan Shared Services

### Masalah
Proses _Import_ Excel, _Export_ Excel, dan unggah file gambar/dokumen sering ditulis berulang di berbagai fungsi, rawan menimbulkan inkonsistensi format.

### Perubahan
Dibuatkan kumpulan layanan terpusat di folder `Services/Shared/`:
- `ExcelImportService.php`
- `ExcelExportService.php`
- `FileUploadService.php`

### Dampak
Mengurangi duplikasi kode (_DRY - Don't Repeat Yourself_), membuat format pembacaan/penulisan file menjadi standar di seluruh aplikasi, serta memudahkan jika ingin berpindah sistem _storage_ (misal ke AWS S3) karena hanya perlu diubah di satu file.

## 5. Refactoring Halaman Publik & Integrasi CMS

### Masalah
File _view_ halaman depan sebelumnya kurang terstruktur, dan pengelolaan data unit pendidikan (seperti TK, SD, SMP) masih bercampur secara statis atau sulit dikelola.

### Perubahan
- Memisahkan struktur tampilan ke folder `resources/views/public/`.
- Menggunakan _Controller_ khusus publik (seperti `PublicHomeController`, `PublicUnitController`, `PublicNewsController`) untuk memisahkan urusan pengunjung dengan admin/guru.
- Halaman unit (TK, SD, SMP) kini mengambil data secara dinamis dari tabel-tabel CMS (seperti `CmsHeroSection`, `CmsUnitDetail`, `CmsUnitTeacher`, dll).
- Memecah blok kode HTML panjang menjadi komponen kecil (_partial blade_).

### Dampak
Struktur folder publik sangat rapi. Halaman-halaman publik tidak lagi statis/kaku, melainkan menjadi dinamis dan bisa dikelola langsung oleh admin melalui fitur CMS.

---

## Struktur Baru Hasil Refactoring

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── GuruController.php
│   │   │   └── SiswaController.php
│   │   ├── PublicHomeController.php
│   │   ├── PublicUnitController.php
│   │   ├── Student/
│   │   │   ├── SD/DashboardController.php
│   │   │   └── SMP/DashboardController.php
│   │   └── Teacher/
│   │       ├── KelasController.php
│   │       ├── ProfileController.php
│   │       └── WaliKelas/
│   │           ├── DashboardController.php
│   │           ├── NilaiController.php
│   │           └── SiswaController.php
│   └── Requests/
│       └── Admin/
│           ├── ImportExcelRequest.php
│           ├── StoreGuruRequest.php
│           ├── StoreKelasRequest.php
│           ├── StoreSiswaRequest.php
│           ├── UpdateGuruRequest.php
│           ├── UpdateKelasRequest.php
│           └── UpdateSiswaRequest.php
│
└── Services/
    ├── Admin/
    │   ├── DashboardService.php
    │   ├── GuruService.php
    │   └── SiswaService.php
    └── Shared/
        ├── ExcelExportService.php
        ├── ExcelImportService.php
        └── FileUploadService.php

public/
└── css/
    ├── student/
    │   ├── sd-theme.css
    │   └── smp-theme.css
    └── teacher/
        ├── regular-theme.css
        └── wali-kelas-theme.css

resources/
└── views/
    ├── components/
    │   ├── student/
    │   └── teacher/
    ├── layouts/
    │   ├── public.blade.php
    │   ├── student/
    │   └── teacher/
    ├── public/
    │   ├── berita/
    │   ├── home/
    │   ├── ppdb/
    │   └── unit/
    ├── student/
    │   ├── sd/
    │   └── smp/
    └── teacher/
        ├── dashboard/
        └── wali-kelas/
```

## Kesimpulan

Refactoring tahap ini berhasil menyelesaikan masalah kompleksitas pada area kritis aplikasi. Pemisahan tugas melalui _Service Layer_, _Shared Services_, dan isolasi berdasarkan peran/unit menjadikan _codebase_ SIAKAD jauh lebih bersih (_Clean Code_). Sistem kini sudah dalam kondisi solid dan sangat siap untuk menerima penambahan fitur baru dengan cepat dan aman.
