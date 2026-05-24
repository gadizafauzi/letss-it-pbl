# TODO

## [Siswa] Dropdown Kelas (FK ke tabel classes)
- [x] Cek form `resources/views/admin/siswa/create.blade.php` (field `kelas` masih input text)
- [ ] Update controller `app/Http/Controllers/Admin/SiswaController.php` agar `create()` kirim data `SchoolClass` ke view
- [ ] Update Blade: ganti input `name="kelas"` menjadi `<select name="class_id">` berisi data `SchoolClass`
- [ ] Pastikan edit/show (kalau ada) tidak perlu perubahan untuk task ini
- [ ] Tes manual: buka halaman `admin/siswa/create` dan cek dropdown Kelas tampil

## Catatan Unit Sekolah
- [ ] Setelah tabel unit dibuat + `classes.unit_id`, baru tambahkan dropdown Unit & filter kelas per unit

