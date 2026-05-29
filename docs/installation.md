# Installation Documentation

## Tujuan

Dokumen ini menjelaskan langkah-langkah instalasi Sistem Informasi Sekolah Islam Terpadu (SIT) pada lingkungan pengembangan lokal.

---

## Persyaratan Sistem

Pastikan perangkat telah terpasang:

* PHP 8.2 atau lebih baru
* Composer
* Node.js dan NPM
* MySQL / MariaDB
* Git
* Laravel CLI (opsional)

---

## Clone Repository

Clone repository dari GitHub:

```bash
git clone https://github.com/gadizafauzi/letss-it-pbl.git
```

Masuk ke folder project:

```bash
cd letss-it-pbl
```

---

## Install Dependency

Install dependency backend Laravel:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

---

## Konfigurasi Environment

Salin file environment:

```bash
cp .env.example .env
```

Kemudian buka file `.env` dan sesuaikan konfigurasi database:

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

Jalankan perintah berikut:

```bash
php artisan key:generate
```

---

## Migrasi dan Seeder Database

Buat struktur database dan data awal:

```bash
php artisan migrate --seed
```

---

## Build Asset Frontend

Untuk mode development:

```bash
npm run dev
```

Untuk production build:

```bash
npm run build
```

---

## Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

---

## Default Account

### Admin

Email: [admin@gmail.com](mailto:admin@gmail.com)

Password: 12345678

### Guru

NIP: 1987654321

Password: 12345678

### Siswa

NISN: 9876543210

Password: 12345678

---

## Troubleshooting

### Composer Error

```bash
composer update
```

### Cache Error

```bash
php artisan optimize:clear
```

### Permission Error (Linux)

```bash
chmod -R 775 storage bootstrap/cache
```

### Node Modules Bermasalah

```bash
rm -rf node_modules
npm install
```

---

## Verifikasi Instalasi

Pastikan:

* Halaman login dapat diakses
* Database berhasil terkoneksi
* Asset CSS dan JavaScript berhasil dimuat
* Dashboard dapat ditampilkan setelah login
