# Feature Documentation

## Login SISMIK

### Tujuan Fitur
Memungkinkan Admin, Guru, dan Siswa masuk ke dalam sistem sesuai hak akses masing-masing.

### Aktor
- Admin
- Guru
- Siswa

### Alur Fitur
User membuka halaman login → memasukkan email dan password → sistem melakukan validasi → sistem membuat sesi login → user diarahkan ke dashboard sesuai role.

### Route / Controller
Route:
POST /login

Controller:
AuthController


## Dashboard Admin

### Tujuan Fitur
Menampilkan ringkasan kondisi sistem dan memberikan akses ke seluruh modul pengelolaan sekolah.

### Aktor
- Admin

### Alur Fitur
Admin login → dashboard ditampilkan → statistik siswa, guru, kelas dan aktivitas sistem ditampilkan.

### Route / Controller
Route:
GET /admin/dashboard

Controller:
DashboardController


## Manajemen Data Siswa

### Tujuan Fitur
Mengelola data siswa pada seluruh jenjang pendidikan.

### Aktor
- Admin

### Alur Fitur
Admin membuka menu siswa → tambah/edit/hapus data → sistem menyimpan perubahan ke database.

### Route / Controller
Route:
GET /students
POST /students
PUT /students/{id}
DELETE /students/{id}

Controller:
StudentController


## Berita dan Kegiatan

### Tujuan Fitur
Menyampaikan informasi sekolah kepada masyarakat.

### Aktor
- Pengunjung
- Admin

### Alur Fitur
Admin membuat berita → berita dipublikasikan → pengunjung membaca berita melalui website.

### Route / Controller
Route:
GET /news
GET /news/{slug}

Controller:
NewsController
