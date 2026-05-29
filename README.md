# Sistem Informasi Sekolah Islam Terpadu (SIT)

## Deskripsi Project

Sistem Informasi Sekolah Islam Terpadu (SIT) merupakan aplikasi berbasis web yang dirancang untuk membantu digitalisasi pengelolaan akademik dan penyebaran informasi sekolah secara terintegrasi.

Sistem ini memiliki dua bagian utama:

- Website Publik Sekolah
- Sistem Informasi Akademik

Website publik digunakan untuk menyampaikan informasi sekolah kepada masyarakat seperti profil sekolah, berita, kegiatan, dan informasi PPDB.

Sementara itu, sistem akademik internal digunakan oleh Admin, Guru, dan Siswa untuk mengelola data akademik secara digital seperti pengelolaan nilai, jadwal pelajaran dan tagihan siswa.

Project ini dikembangkan menggunakan framework Laravel dengan desain modern, responsif, dan sistem autentikasi 

---

## Tujuan Sistem

- Mempermudah pengelolaan data akademik sekolah
- Membantu guru dalam penginputan nilai siswa
- Mempermudah siswa mengakses informasi akademik
- Menyediakan sistem tagihan siswa secara digital
- Meningkatkan efisiensi administrasi sekolah
- Menyediakan media informasi sekolah yang terintegrasi

---

## SDGs

Project ini mendukung:

### SDG 4 – Pendidikan Berkualitas

Dengan membantu digitalisasi layanan pendidikan dan penyebaran informasi sekolah secara efektif.

---

# Fitur Utama

## Website Publik

- Halaman Beranda
- Profil Sekolah
- Unit pendidikan (TK / SD / SMP)
- Berita & Kegiatan
- Informasi PPDB
- Kontak & Lokasi Sekolah

---

## Sistem Autentikasi

- Login Multi Role
- Hak Akses Admin, Guru, dan Siswa
- Enkripsi Password
- Forgot Password
- Reset Password

---

## Dashboard Admin

- CRUD User
- CRUD Guru
- CRUD Siswa
- CRUD Kelas
- CRUD Mata Pelajaran
- CRUD Jadwal
- CRUD Tahun Ajaran
- CRUD Tagihan
- CRUD Berita
- CRUD PPDB
- Manajemen Kontak
- Manajemen Nilai
- Manajemen Tagihan Siswa
- Manajemen Role User

---

## Dashboard Guru

- Melihat Jadwal Mengajar
- Melihat Daftar Kelas
- Input Nilai Siswa
- Edit Nilai
- Rekap Nilai

---

## Dashboard Siswa

- Melihat Nilai
- Melihat Data Diri
- Melihat Tagihan Sekolah
- Riwayat Pembayaran

---

## Fitur Tagihan Siswa

Sistem menyediakan fitur tagihan siswa untuk membantu pengelolaan administrasi pembayaran sekolah.

Fitur meliputi:

- Informasi tagihan siswa
- Status pembayaran
- Riwayat pembayaran
- Monitoring pembayaran oleh admin
- Detail nominal tagihan

---

<!-- ## AI Chatbot (Opsional)

- Chatbot Informasi Sekolah
- Integrasi Google Gemini API
- Prompt Engineering AI Assistant -->

---

# Role Pengguna

| Role | Hak Akses |
|------|------------|
| Admin | Mengelola seluruh data sistem |
| Guru | Mengelola nilai siswa |
| Siswa | Melihat nilai dan tagihan |
| Pengunjung | Mengakses website publik |

---

# Teknologi yang Digunakan

- Laravel
- PHP
- MySQL
- Tailwind CSS
- JavaScript
- Blade Template
- Git & GitHub
- Figma

---

<!-- # Tampilan Sistem

## Dashboard Admin

![Dashboard Admin](screenshots/admin-dashboard.png)

## Dashboard Guru

![Dashboard Guru](screenshots/guru-dashboard.png)

## Dashboard Siswa

![Dashboard Siswa](screenshots/siswa-dashboard.png)

---

# Instalasi Project -->

## Clone Repository

```bash
git clone https://https://github.com/gadizafauzi/letss-it-pbl
cd nama-lets-it-pbl
```

---

## Install Dependency

```bash
composer install
npm install
```

---

## Konfigurasi Environment

```bash
cp .env.example .env
```

Lalu sesuaikan konfigurasi database pada file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_app
DB_USERNAME=root
DB_PASSWORD=
```

---

## Generate Application Key

```bash
php artisan key:generate
```

---

## Migrasi Database

```bash
php artisan migrate --seed
```

---

## Jalankan Server

```bash
php artisan serve
```

---

# Default Account

## Admin

Email : admin@gmail.com  
Password : 12345678

## student

Nisn: SESUAI YANG DI DAFTARKAN DI ADMIN
Password : 12345678

## Teacher

Nip :  SESUAI YANG DI DAFTARKAN DI ADMIN
Password : 12345678


# Struktur Project

```bash
├── app
├── bootstrap
├── config
├── database
├── node_modules
├── public
├── resources
├── routes
├── storage
├── tests
├── screenshots
└── README.md
```

---

# Tim Pengembang

| Role | Nama |
|------|------|
| Project Manager | Gadiza Fauzi |
| System Analyst | Rezky Andikhe Wahyudi |
| Lead Programmer | Zulfa Sahida |
| Quality Assurance | M. Ilham Fadli Ikbar |
| UI/UX Designer | Ramadhan Al Fitra |

---

# Status Project

Project masih dalam tahap pengembangan dan akan terus diperbarui dengan fitur-fitur baru.

---

# License

Project ini dibuat untuk kebutuhan pembelajaran dan pengembangan akademik.

---

# ⭐ Dukungan

Jika project ini bermanfaat, jangan lupa untuk memberikan ⭐ pada repository GitHub ini. redme
