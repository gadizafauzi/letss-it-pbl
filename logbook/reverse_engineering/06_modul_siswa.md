# Bedah Modul Siswa (Panel Student)
*(Dokumen Reverse Engineering - Tahap 6)*

Modul Siswa adalah portal swalayan (*self-service*) di mana siswa atau orang tua dapat memantau perkembangan akademik dan kewajiban administrasi. Role aksesnya adalah `student`. Karakteristik utama modul ini adalah **Read-Only (Hanya Membaca)**, kecuali untuk pengunggahan bukti transfer.

---

## 1. Dashboard (Percabangan Berdasarkan Unit)
*   **Tujuan:** Halaman mendarat utama.
*   **Keunikan Kode:** Di dalam folder `app/Http/Controllers/Student/`, terdapat subfolder `SD/` dan `SMP/`.
*   **Alur Logika:**
    1. Siswa berhasil login.
    2. Sistem mengecek ID Unit asal siswa (Apakah dia TK, SD, atau SMP?).
    3. Route `/student/dashboard` (atau Controller Induk) akan mengarahkan (Redirect) layar ke rute spesifik, misalnya `/student/sd/dashboard` atau `/student/smp/dashboard`.
    4. Hal ini dilakukan karena tampilan atau warna dasbor SD dan SMP mungkin dibedakan pada file View-nya.

---

## 2. Menu: Nilai & Rapor
*   **Tujuan:** Melihat daftar nilai ujian akhir (semacam e-Rapor).
*   **Controller:** `Student\NilaiController@index`
*   **Alur Database (Filter Ganda):**
    *   Controller tidak akan menampilkan seluruh tabel nilai. Ia akan memasang *filter* ketat.
    *   `Filter 1:` `WHERE student_id = <Auth ID Saya>` (Siswa A tidak boleh bisa melihat nilai Siswa B).
    *   `Filter 2:` `WHERE status = 'published'` (Aturan keras: Selama Wali Kelas belum klik Publish, nilai ini dianggap tidak ada/disembunyikan).
*   **Hasil:** Jika data ditemukan, dikirim ke `resources/views/student/nilai.blade.php` untuk dirender menjadi tabel HTML Rapor.

---

## 3. Menu: Tagihan & Pembayaran (Hutang Siswa)
*   **Tujuan:** Menginformasikan kewajiban SPP atau biaya lainnya dan menyediakan form bayar.
*   **Controller:** `Student\TagihanController`
*   **Alur Melihat Tagihan (Read):**
    *   Controller mencari baris di tabel `invoices` yang menunjuk ke ID siswa tersebut. Ditampilkan dalam dua tab/tabel: "Belum Lunas (Unpaid)" dan "Lunas (Paid)".
*   **Alur Melakukan Pembayaran (Create):**
    1. Siswa menekan tombol "Bayar" pada tagihan yang masih *Unpaid*.
    2. URL memicu fungsi `storePayment()`.
    3. Muncul form upload untuk mengunggah foto struk (Format JPG/PNG/PDF).
    4. Foto disimpan ke `Storage`.
    5. Sistem melakukan `INSERT` ke tabel `payments` yang berelasi dengan `invoice_id` tersebut.
    6. **Status Lifecycle:** Status di tabel `payments` otomatis terset `pending` atau *null* di kolom `verified_by`. (Menunggu Admin Keuangan mengeklik Setuju di gedungnya).

---

## 4. Menu: Profil & Download KTM
*   **Tujuan:** Melihat data pribadi, update info (jika diizinkan), dan mencetak Kartu Tanda Murid.
*   **Controller Utama:** `Student\ProfileController`
*   **Alur Download KTM (Cetak):**
    *   Siswa klik menu "Cetak KTM".
    *   Route `/student/cetak-ktm` memicu fungsi `cetakKtm()`.
    *   Fungsi ini (berdasarkan *package* di `composer.json`) sangat mungkin memanggil fungsi `PDF::loadView(...)` dari package `barryvdh/laravel-dompdf`.
    *   HTML ID Card diubah menjadi format biner PDF.
    *   Controller memberikan respons unduh (`return $pdf->download('KTM.pdf')`) yang otomatis men-*trigger* proses download di browser Chrome/Edge milik siswa.
