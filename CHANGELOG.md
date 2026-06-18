## [v0.8.0] -2026-06-18-
### Added

* Integrasi WhatsApp Gateway menggunakan Fonnte API.
* Penambahan konfigurasi `FONNTE_TOKEN` pada file `.env`.
* Fitur pengiriman tagihan pendidikan ke nomor WhatsApp wali murid.
* Method `sendWhatsAppBill()` pada `TagihanController`.
* Tombol aksi **Kirim WhatsApp** pada halaman daftar tagihan.
* Notifikasi status pengiriman pesan (berhasil/gagal) pada dashboard admin.

### Changed

* Penyesuaian alur pengelolaan tagihan untuk mendukung pengiriman notifikasi WhatsApp.
* Penyesuaian format data invoice yang digunakan dalam pesan WhatsApp.

### Fixed

* Perbaikan logika validasi pembayaran saat proses pelunasan tagihan.
* Perbaikan struktur data invoice yang menyebabkan kegagalan pembuatan informasi tagihan.

### Impacted Modules

* Modul Tagihan
* Modul Pembayaran
* Modul Invoice
* Modul Siswa
* Modul Wali Murid

### Planned Tasks

- [ ] Setup FONNTE_TOKEN pada file `.env`
- [ ] Implementasi method `sendWhatsAppBill()`
- [ ] Menambahkan route pengiriman WhatsApp
- [ ] Menambahkan tombol **Kirim WA** pada halaman tagihan
- [ ] Pengujian pengiriman WhatsApp menggunakan Fonnte API
- [ ] Dokumentasi penggunaan fitur
- [ ] Merge branch `feature/whatsapp-billing-notification`
## [v0.7.0] - 2026-06-08

### Added

* Menambahkan fitur tagihan dan pembayaran.
* Menambahkan fitur export dan import data.

### Changed

* Memperbarui tampilan website publik.
* Menambahkan animasi pada halaman website publik.

### Refactor

* Memisahkan dashboard siswa berdasarkan unit SD dan SMP.
* Memisahkan dashboard Guru dan Wali Kelas.
* Memisahkan layout dan sidebar berdasarkan role dan unit.
* Mengubah `Student\DashboardController` menjadi dispatcher untuk redirect otomatis sesuai unit siswa.
* Memecah `KelasController` menjadi beberapa controller yang lebih spesifik.
* Menambahkan controller khusus untuk fitur Wali Kelas.
* Menyesuaikan struktur route untuk mendukung arsitektur baru.
* Menjaga kompatibilitas route lama melalui sistem redirect dan alias route.
* Menghapus modul dan tampilan unit TK yang tidak lagi digunakan.
* Memodularisasi halaman publik (Home, Profil, Unit, Berita, dan PPDB).

### Fixed

* Memastikan fitur lama tetap berjalan setelah proses refactoring.
* Berhasil melakukan merge dengan branch `develop` tanpa konflik.

---

## [v0.6.4] - 2026-06-07

### Added

* Menambahkan fitur pembayaran.
* Menambahkan fitur edit profil pengguna.
* Menambahkan fitur upload foto profil.
* Menambahkan perhitungan nilai otomatis (*live grades calculation*).
* Menambahkan fitur cetak KTM siswa.

### Refactor

* Refactoring controller Guru dan Siswa.

### Fixed

* Memperbaiki route yang duplikat.

---

## [v0.6.3] - 2026-06-06

### Fixed

* Memperbaiki tata letak halaman profil.
* Memperbaiki tata letak halaman unit pendidikan.

---

## [v0.6.2] - 2026-06-04

### Changed

* Memperbarui tampilan website publik.

---

## [v0.6.1] - 2026-05-31

### Added

* Menambahkan fitur import data.
* Menambahkan fitur export data.
* Menambahkan fitur pencarian data.
* Menambahkan fitur filter data.
* Menambahkan fitur upload foto siswa pada dashboard admin.

### Documentation

* Menambahkan dokumentasi fitur yang belum selesai dikembangkan.

## [v0.6.0] - 2026-05-29
---

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
