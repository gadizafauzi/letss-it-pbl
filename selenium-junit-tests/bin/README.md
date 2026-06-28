# Selenium JUnit Tests untuk letss-it-pbl

Project ini berisi automated UI test untuk aplikasi Laravel `letss-it-pbl`.
Test dibuat dengan Java, Selenium WebDriver, JUnit 5, dan Maven agar bisa dibuka di Eclipse IDE.

## Persiapan Aplikasi Laravel

Jalankan aplikasi Laravel lebih dulu dari folder utama project:

```bash
php artisan serve
```

Pastikan aplikasi aktif di:

```text
http://127.0.0.1:8000
```

Pastikan database sudah dimigrate dan diseed. Akun admin default dari seeder:

```text
Username: admin
Password: 12345678
```

## Cara Membuka di Eclipse

1. Buka Eclipse IDE.
2. Pilih `File > Import`.
3. Pilih `Maven > Existing Maven Projects`.
4. Pada `Root Directory`, pilih folder:

```text
selenium-junit-tests
```

5. Klik `Finish`.
6. Tunggu Eclipse selesai download dependency Maven.

## Cara Menjalankan Test

Di Eclipse:

1. Buka folder `src/test/java/id/ac/schoolapp/tests`.
2. Klik kanan salah satu file test.
3. Pilih `Run As > JUnit Test`.

Atau jalankan semua test:

1. Klik kanan project `letss-it-pbl-selenium-tests`.
2. Pilih `Run As > Maven test`.

## Daftar Test

- `PublicPagesTest`
  Menguji halaman publik: beranda, profil, unit TK/SD/SMP, PPDB, dan berita.

- `NewsSearchTest`
  Menguji pencarian berita.

- `AdminAuthTest`
  Menguji login admin berhasil, login admin gagal, dan proteksi dashboard admin.

- `AdminContentAccessTest`
  Menguji admin bisa membuka halaman penting seperti siswa, guru, kelas, mapel, CMS, tagihan, dan pembayaran.

## Jika URL atau Akun Berbeda

Test bisa dijalankan dengan parameter Maven:

```bash
mvn test -DbaseUrl=http://127.0.0.1:8000 -DadminUser=admin -DadminPassword=12345678
```

## Catatan

Selenium 4 memakai Selenium Manager, jadi biasanya ChromeDriver akan diatur otomatis.
Pastikan Google Chrome sudah terinstall di laptop.
