# Changelog

Semua perubahan penting pada proyek Sistem Informasi Sekolah Islam Terpadu dicatat dalam file ini.

---

## [v0.6.0] - 2026-05-29

### Public Website Update

### Added

* Menambahkan halaman website publik
* Menambahkan layout dan komponen website publik
* Menambahkan sistem layout `public.blade.php`

### Changed

* Pembaruan tampilan website publik
* Penyesuaian struktur frontend website publik

### Fixed

* Perbaikan syntax error route `/unit/smp/prestasi`
* Perbaikan dependency project
* Perbaikan package yang bermasalah

### Refactor

* Pemisahan layout public dengan sistem dashboard utama
* Penataan ulang struktur frontend website publik

---

## [v0.5.1] - 2026-05-27

### Documentation Enhancement

### Added

* Dokumentasi dependency project
* Dokumentasi instalasi project
* Dokumentasi fitur aplikasi
* Dokumentasi refactoring project
* Menambahkan dokumen pengembangan pada folder `/docs`

  * `features.md`
  * `installation.md`
  * `github-actions.md`
  * `dependency.md`
  * `refactoring.md`

### Changed

* Perubahan nama file `redme.md` menjadi `README.md`

### Fixed

* Perbaikan struktur file dokumentasi

---

## [v0.4.0] - 2026-05-24

### Teacher & Student Relation Update

### Added

* Relasi antara teacher dan student
* Implementasi sistem manajemen akademik
* Autentikasi berbasis peran (*role authentication*)
* Sistem otomatis pembuatan akun user
* CRUD data siswa
* CRUD data guru
* CRUD data kelas
* CRUD data unit
* CRUD data mata pelajaran
* CRUD data jabatan
* CRUD data tahun ajaran
* Dashboard khusus wali kelas
* Menambahkan profil siswa dan guru
* Menambahkan cetak kartu KTM siswa
* CRUD data mengajar
* Dashboard khusus guru
* Dashboard khusus siswa
* Controller khusus siswa dan guru
* Layout terpisah untuk admin, teacher, dan student

### Changed

* Perubahan sistem login menjadi berbasis role
* Pembaruan alur autentikasi user
* Pembaruan struktur relasi model
* Pembaruan tampilan dashboard admin, guru, dan siswa
* Pembaruan konfigurasi project Laravel

### Fixed

* Merge branch `develop` ke branch `zulfa`
* Perbaikan konflik role user
* Perbaikan bug login setelah implementasi akun otomatis
* Perbaikan dependency package

### Refactor

* Refactoring sistem login dari single page menjadi role-based authentication
* Penataan ulang struktur autentikasi
* Modularisasi struktur kode project
* Pemisahan layout berdasarkan role user

---

## [v0.3.0] - 2026-05-22

### Dashboard Development

### Added

* Fitur dashboard siswa
* Tampilan statistik dashboard
* Sidebar dashboard responsive
* Layout dashboard berbasis role
* Komponen card dashboard interaktif

### Changed

* Pembaruan tampilan dashboard admin
* Penyesuaian struktur frontend dashboard
* Perbaikan struktur sidebar dashboard

### Fixed

* Perbaikan bug tampilan dashboard
* Perbaikan responsive sidebar

---

## [v0.2.0] - 2026-05-20

### Documentation Update

### Added

* Dokumentasi project `README.md`

### Changed

* Pembaruan struktur dokumentasi project

---

## [v0.1.0] - 2026-05-01

### Initial Project Setup

### Added

* Setup awal project Laravel
* Konfigurasi Tailwind CSS dan Vite
* Setup testing project
* Penambahan file konfigurasi dasar
* Setup environment project
* Setup composer dan package project
* Konfigurasi PostCSS dan Vite

### Changed

* Memperbarui konfigurasi project
* Penyesuaian struktur awal project Laravel

### Test

* Menambahkan testing awal
