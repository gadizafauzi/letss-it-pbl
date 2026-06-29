# GitHub Actions Workflow

## Pendahuluan

GitHub Actions adalah fitur CI/CD bawaan GitHub yang memungkinkan otomatisasi saat terjadi event tertentu pada repository, seperti push kode, pembuatan pull request, atau pembaruan branch. Pada project ini, GitHub Actions digunakan untuk memastikan setiap perubahan kode pada aplikasi Laravel aman sebelum digabung ke branch utama.

Project ini berbasis Laravel dengan PHP, frontend Vite + Tailwind CSS, serta pengujian menggunakan Pest. Karena itu workflow GitHub Actions yang tepat fokus pada validasi backend, frontend, dan pengujian aplikasi.

## Analisis Project yang Menjadi Dasar Workflow

Beberapa hal yang menjadi dasar penyusunan workflow ini adalah:

- Framework: Laravel 13
- Bahasa pemrograman: PHP dan JavaScript
- Frontend: Vite, Tailwind CSS
- Testing: Pest / Laravel Test
- Database: konfigurasi testing menggunakan SQLite, sedangkan lingkungan lokal bisa memakai MySQL
- Build assets: npm run build
- Dependency management: Composer dan npm

## Tujuan Penggunaan GitHub Actions

GitHub Actions dipakai pada project ini untuk:

- memastikan perubahan kode tidak merusak aplikasi
- menjalankan pengujian otomatis saat push atau pull request
- memeriksa apakah dependency dapat terinstal dengan benar
- memastikan frontend berhasil dibuild
- mengurangi risiko error sebelum merge ke branch utama

## Workflow yang Digunakan

### Nama workflow

- Laravel CI

### Trigger yang digunakan

Workflow berjalan saat:

- ada push ke branch main, master, atau develop
- ada pull request ke branch main, master, atau develop

### Kapan workflow berjalan

Workflow akan berjalan setiap kali developer:

- mengirim perubahan ke repository
- membuat atau memperbarui pull request

## Struktur File Workflow

File workflow diletakkan di folder berikut:

```text
.github/
└── workflows/
    └── laravel-ci.yml
```

Lokasi file yang disarankan:

- .github/workflows/laravel-ci.yml

## Proses dalam Workflow

Workflow ini mencakup langkah-langkah berikut:

1. Checkout repository
   - Mengambil source code dari repository GitHub.

2. Setup environment
   - Menyiapkan PHP versi 8.4.
   - Menyiapkan Node.js untuk build frontend.

3. Install dependency
   - Menjalankan composer install untuk dependency backend.
   - Menjalankan npm ci untuk dependency frontend.

4. Konfigurasi database
   - Menggunakan SQLite untuk testing agar workflow sederhana dan cepat.
   - Jika nantinya memakai MySQL, gunakan GitHub Secrets untuk username dan password.

5. Menjalankan migration
   - Menjalankan php artisan migrate --force agar skema database siap.

6. Menjalankan testing
   - Menjalankan php artisan test untuk memastikan seluruh test lulus.

7. Build project
   - Menjalankan npm run build untuk memastikan asset frontend berhasil dibuat.

## Contoh File YAML GitHub Actions

Berikut contoh workflow yang sesuai dengan project Laravel ini:

```yaml
name: Laravel CI

on:
  push:
    branches:
      - main
      - master
      - develop
  pull_request:
    branches:
      - main
      - master
      - develop

jobs:
  laravel-tests:
    runs-on: ubuntu-latest

    env:
      APP_ENV: testing
      DB_CONNECTION: sqlite
      DB_DATABASE: database/database.sqlite

    steps:
      - name: Checkout repository
        uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: mbstring, dom, fileinfo, gd, sqlite3, pdo_sqlite
          coverage: none

      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'npm'

      - name: Copy environment file
        run: cp .env.example .env

      - name: Install Composer dependencies
        run: composer install --no-interaction --prefer-dist --no-progress

      - name: Install Node dependencies
        run: npm ci

      - name: Generate application key
        run: php artisan key:generate

      - name: Create SQLite database file
        run: touch database/database.sqlite

      - name: Run database migrations
        run: php artisan migrate --force

      - name: Run tests
        run: php artisan test

      - name: Build frontend assets
        run: npm run build
```

## Best Practice yang Digunakan

Workflow ini mengikuti beberapa praktik yang baik, antara lain:

- menggunakan runner ubuntu-latest
- memakai versi PHP yang sesuai dengan project
- menginstal ekstensi PHP yang dibutuhkan aplikasi
- menggunakan cache untuk dependency npm
- tidak menyimpan credential langsung di file workflow
- memanfaatkan environment variable untuk konfigurasi runtime

## Penggunaan GitHub Secrets

Jika workflow membutuhkan credential sensitif, gunakan GitHub Secrets, bukan menuliskan nilai langsung di file YAML. Contoh variabel yang bisa disimpan di GitHub Secrets:

- DB_USERNAME
- DB_PASSWORD
- APP_KEY
- API_KEY

Contoh penggunaannya:

```yaml
env:
  DB_USERNAME: ${{ secrets.DB_USERNAME }}
  DB_PASSWORD: ${{ secrets.DB_PASSWORD }}
  APP_KEY: ${{ secrets.APP_KEY }}
```

Untuk project saat ini, workflow testing bisa tetap memakai SQLite sehingga tidak memerlukan secret untuk menjalankan test dasar.

## Troubleshooting

### Dependency gagal di-install

Solusi:

- pastikan versi PHP sesuai, yaitu PHP 8.3
- jalankan composer install secara lokal untuk melihat error yang muncul
- jalankan npm ci untuk memastikan dependency Node berhasil terpasang
- cek apakah composer.lock dan package-lock.json tersedia dan konsisten

### Test gagal

Solusi:

- buka output test dari GitHub Actions
- jalankan php artisan test secara lokal
- pastikan .env dan konfigurasi database testing sudah benar
- periksa perubahan kode yang memengaruhi logic aplikasi

### Database connection error

Solusi:

- pastikan workflow membuat file SQLite yang dibutuhkan
- cek konfigurasi DB_CONNECTION dan DB_DATABASE
- jalankan php artisan migrate --force setelah environment siap
- jika memakai MySQL, pastikan GitHub Secrets untuk username dan password sudah diatur

### Environment variable tidak ditemukan

Solusi:

- pastikan file .env dibuat sebelum menjalankan aplikasi
- pastikan cp .env.example .env berhasil
- jika ada variabel sensitif, tambahkan ke GitHub Secrets dan panggil melalui ${{ secrets.NAMA_SECRET }}
- cek apakah aplikasi membutuhkan APP_KEY yang dihasilkan lewat php artisan key:generate

## Maintenance

Workflow perlu dirawat seiring perkembangan project. Beberapa hal yang biasanya perlu diperbarui:

### Menambah dependency baru

Jika menambah package Composer atau npm, workflow tetap akan otomatis menginstal dependency karena langkah install dependency sudah ada. Pastikan package baru tidak memerlukan ekstensi PHP tambahan.

### Mengubah versi runtime

Jika project berpindah ke PHP versi lain, ubah bagian berikut pada workflow:

```yaml
with:
  php-version: '8.3'
```

### Menambah testing baru

Jika menambah test baru di folder tests/Feature atau tests/Unit, workflow akan menjalankannya secara otomatis karena perintah php artisan test tetap dipakai.

## Kesimpulan

GitHub Actions sangat berguna untuk project ini karena membantu memastikan setiap perubahan kode diuji secara otomatis sebelum masuk ke branch utama. Workflow yang disarankan untuk project Laravel ini cukup sederhana, mudah dipahami, dan sesuai dengan kebutuhan pengembangan aplikasi sekolah berbasis web ini.
