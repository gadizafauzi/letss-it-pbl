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

---

## Website Publik - Profil Sekolah

### Tujuan Fitur
Menyediakan informasi lengkap mengenai visi, misi, sejarah, struktur organisasi, dan akreditasi sekolah kepada masyarakat.

### Aktor
- Pengunjung

### Alur Fitur
Pengunjung membuka halaman profil sekolah → sistem menampilkan informasi profil sekolah → pengunjung membaca informasi yang tersedia.

### Route / Controller
Route:
GET /profile

Controller:
ProfileController

---

## Website Publik - Unit Pendidikan

### Tujuan Fitur
Menampilkan informasi setiap unit pendidikan seperti TK, SD, dan SMP beserta profil, guru, fasilitas, ekstrakurikuler, dan prestasi.

### Aktor
- Pengunjung

### Alur Fitur
Pengunjung memilih unit pendidikan → sistem menampilkan informasi unit yang dipilih → pengunjung melihat detail unit pendidikan.

### Route / Controller
Route:
GET /units

Controller:
EducationUnitController

---

## Website Publik - PPDB

### Tujuan Fitur
Menyediakan informasi Penerimaan Peserta Didik Baru (PPDB) meliputi jadwal, syarat, alur pendaftaran, dan FAQ.

### Aktor
- Pengunjung

### Alur Fitur
Pengunjung membuka halaman PPDB → sistem menampilkan informasi pendaftaran → pengunjung mempelajari persyaratan dan prosedur pendaftaran.

### Route / Controller
Route:
GET /ppdb

Controller:
PpdbController

---

## Manajemen Data Guru

### Tujuan Fitur
Mengelola data guru beserta penugasan mata pelajaran dan kelas yang diampu.

### Aktor
- Admin

### Alur Fitur
Admin membuka menu guru → menambah, mengubah, atau menghapus data guru → sistem menyimpan perubahan ke database.

### Route / Controller
Route:
GET /teachers
POST /teachers
PUT /teachers/{id}
DELETE /teachers/{id}

Controller:
TeacherController

---

## Manajemen Kelas

### Tujuan Fitur
Mengelola data kelas, pengelompokan siswa, dan tahun ajaran.

### Aktor
- Admin

### Alur Fitur
Admin membuat kelas → menentukan wali kelas → menempatkan siswa ke dalam kelas → sistem menyimpan data kelas.

### Route / Controller
Route:
GET /classes
POST /classes
PUT /classes/{id}
DELETE /classes/{id}

Controller:
ClassController

---

## Dashboard Guru

### Tujuan Fitur
Membantu guru mengelola kegiatan akademik seperti melihat jadwal mengajar dan menginput nilai siswa.

### Aktor
- Guru

### Alur Fitur
Guru login → membuka dashboard guru → melihat jadwal mengajar → memilih kelas → menginput atau mengubah nilai siswa.

### Route / Controller
Route:
GET /teacher/dashboard

Controller:
TeacherDashboardController

---

## Dashboard Siswa

### Tujuan Fitur
Memberikan akses kepada siswa untuk melihat data pribadi, nilai akademik, dan rapor digital.

### Aktor
- Siswa

### Alur Fitur
Siswa login → membuka dashboard siswa → melihat data diri → melihat nilai → mengunduh rapor PDF jika diperlukan.

### Route / Controller
Route:
GET /student/dashboard

Controller:
StudentDashboardController
