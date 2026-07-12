# Panduan Demo untuk Orang Ke-4: Fitur Monitoring & Portal Siswa (Wali Kelas & Siswa)

**Tugas Utama:** Mendemonstrasikan alur di mana Wali Kelas memonitor/merekap nilai, dan Siswa melihat hasilnya.

---

## 1. Login sebagai Wali Kelas
*   **Aksi:** Buka halaman `domain-kalian.com/login`. Masukkan email dan password akun Guru yang menjabat sebagai Wali Kelas.
*   **Penjelasan (Sambil Demo):** *"Selanjutnya, kita akan login sebagai Wali Kelas. Sistem akan langsung mengarahkan kita ke Dashboard Guru / Wali Kelas."*

## 2. Sampaikan Info Penting (Akses Ganda)
*   **Aksi:** Arahkan kursor tetikus (mouse) ke menu sidebar kiri untuk memperlihatkan menu-menu yang tersedia.
*   **Penjelasan (Sambil Demo):** *"Satu hal yang penting di sistem ini: seorang Wali Kelas pada dasarnya adalah Guru. Jadi, seperti yang terlihat di menu ini, dia memiliki akses ganda. Dia punya menu sebagai Guru Mata Pelajaran (untuk input nilai mapel yang dia ajar), dan dia juga punya menu khusus 'Wali Kelas' untuk memantau kelas perwaliannya."*

## 3. Tampilkan Halaman Daftar Siswa
*   **Aksi:** Klik menu navigasi **Wali Kelas -> Data Siswa** (URL-nya di sistem adalah `/teacher/wali-data-siswa`).
*   **Penjelasan (Sambil Demo):** *"Sekarang kita buka menu Data Siswa. Di sini Wali Kelas bisa melihat daftar lengkap seluruh siswa yang ada di kelas perwaliannya."*

## 4. Tampilkan Rekapitulasi Nilai & Proses "Publish"
*   **Aksi:** Klik menu **Wali Kelas -> Rekap Nilai** (URL-nya di sistem adalah `/teacher/wali-rekap-nilai`).
*   **Penjelasan (Sambil Demo):** *"Lalu kita masuk ke menu krusial, yaitu Rekap Nilai. Di halaman ini, Wali Kelas bisa memonitor dan menerima rekapitulasi nilai yang sebelumnya sudah diinput oleh masing-masing Guru Mata Pelajaran (seperti yang didemokan Orang Ke-3 tadi). Nilai-nilai ini **tidak akan langsung bocor ke siswa** sebelum Wali Kelas memverifikasi dan mempublikasikannya di sini."*
*   **Aksi Tambahan:** Tunjukkan proses klik tombol *Publish* atau verifikasi rekap nilai jika ada, yang mengesahkan nilai tersebut (menyentuh fitur `teacher.wali-rekap-nilai.publish` di *backend*).

## 5. Log out & Login sebagai Siswa
*   **Aksi:** Klik profil di pojok kanan atas, pilih **Logout**. Kemudian kembali ke halaman login dan masuk menggunakan akun Siswa (gunakan akun siswa yang tadi nilainya baru saja direkap/dinilai).
*   **Penjelasan (Sambil Demo):** *"Setelah Wali Kelas mempublikasikan nilainya, sekarang mari kita lihat dari sisi Siswa. Kita logout, dan login menggunakan akun Siswa yang bersangkutan."*

## 6. Perlihatkan Profil & Cek Transkrip Nilai
*   **Aksi 1:** Saat masuk, sistem akan mengarah ke Dashboard Siswa (`/student/dashboard`). Klik menu **Profil** (`/student/profil`) untuk membuktikan ini benar akun siswa tersebut.
*   **Aksi 2:** Klik menu **Nilai / Transkrip** (`/student/nilai`).
*   **Penjelasan (Sambil Demo):** *"Ini adalah halaman Profil Siswa. Siswa dapat memperbarui datanya di sini. Dan yang terakhir, untuk melihat hasil belajarnya, siswa cukup membuka menu Transkrip Nilai. Seperti yang bisa dilihat, nilai yang tadi diproses oleh Guru dan disahkan oleh Wali Kelas sekarang sudah bisa dicek secara mandiri oleh siswa yang bersangkutan."*

---

### 💡 Tips Persiapan Sebelum Demo (Wajib Dibaca Orang Ke-4):
*   **Siapkan Data Dummy:** Sebelum demo maju ke depan, **pastikan kalian sudah menyiapkan 1 akun Guru (Wali Kelas) dan 1 akun Siswa** yang datanya saling terhubung (Siswa tersebut terdaftar di kelas yang diampu oleh Guru/Wali Kelas tersebut). 
*   Catat email dan password kedua akun tersebut di Notepad/kertas kecil agar tidak *blank* atau panik saat *live demo*.
*   Mengingat aplikasi kalian memisahkan rute (`/teacher/...` dan `/student/...`), pastikan saat melakukan login tidak salah memasukkan peran atau *role* akunnya.
