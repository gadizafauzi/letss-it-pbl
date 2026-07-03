# Bedah Modul Guru (Panel Pendidik)
*(Dokumen Reverse Engineering - Tahap 5)*

Modul Guru membagi fitur menjadi dua bagian utama: fitur untuk **Guru Mata Pelajaran Biasa**, dan fitur eksklusif untuk **Wali Kelas**. Role yang diperlukan untuk masuk ke halaman ini adalah `teacher`.

---

## 1. Dashboard Guru
*   **Tujuan:** Menyambut guru setelah login dan mungkin menampilkan info ringkas jadwal.
*   **Controller:** `Teacher\DashboardController@index`
*   **Alur:** `Route` ➔ `Middleware(auth, role:teacher)` ➔ `Controller` ➔ `View (teacher.dashboard)`.

---

## 2. Fitur Guru Mata Pelajaran

### A. Menu: Kelas Saya
*   **Tujuan:** Melihat daftar kelas di mana guru tersebut mengajar (berdasarkan tabel `teaching_assignments`).
*   **Controller:** `Teacher\KelasController@kelasSaya`
*   **Database:** Melakukan pencarian (Query) di tabel `teaching_assignments` dengan kondisi `WHERE teacher_id = <ID Guru yang Login>`.

### B. Menu: Input Nilai (Tugas Inti)
*   **Tujuan:** Mengisi form nilai siswa per mata pelajaran.
*   **Controller Utama:** `Teacher\KelasController@inputNilai` (Menampilkan form) & `storeNilai` (Menyimpan form).
*   **Alur Bisnis & Lifecycle:**
    1.  Guru memilih mapel & kelas ➔ `inputNilai` meload seluruh `students` yang berelasi dengan `class_id` tersebut.
    2.  Layar browser menampilkan kotak *input text* untuk tiap siswa.
    3.  Guru klik "Simpan" ➔ Form melempar array ID Siswa beserta Nilainya ke fungsi `storeNilai`.
    4.  Sistem melakukan iterasi. Jika siswa belum punya nilai, Model `Grade` akan menjalankan `INSERT`. Jika sudah ada, Model `Grade` akan menimpa (`UPDATE`).
    5.  Nilai masuk ke database dengan status `draft` (belum bisa dilihat siswa).

---

## 3. Fitur Eksklusif Wali Kelas (Homeroom Teacher)

Jika seorang Guru di-assign namanya di dalam tabel `classes` (sebagai `homeroom_teacher_id`), maka menu tambahan ini akan muncul.

### A. Menu: Data Siswa (Anak Wali)
*   **Tujuan:** Melihat daftar seluruh anak yang ada di kelasnya.
*   **Controller:** `Teacher\WaliKelas\SiswaController@index`
*   **Alur:** Query ke tabel `students` dengan kondisi `WHERE school_class_id = <ID Kelas yang dia wali-kan>`.

### B. Menu: Rekap & Publish Nilai Rapor
*   **Tujuan:** Mengecek apakah semua guru mapel sudah menginput nilai untuk kelasnya, mengekspor ke Excel, dan menerbitkan (Publish) rapor ke siswa.
*   **Controller Utama:** `Teacher\WaliKelas\NilaiController`
*   **Alur Publish (Sangat Krusial):**
    1. Wali Kelas klik tombol "Publish Nilai".
    2. `NilaiController@publish` menerima request POST.
    3. Sistem mem-filter tabel `grades` untuk semua anak di kelas tersebut.
    4. Menjalankan *Bulk Update Query*: `UPDATE grades SET status = 'published' WHERE ...`
    5. Data *(Lifecycle)* kini berstatus resmi (Official). Siswa dan Ortu sekarang bisa melihat nilai ini dari rumah.
*   **Fitur Export:** Terdapat rute `export()` yang akan memanggil *Service* `phpspreadsheet` untuk mem-*build* file Excel berisikan kumpulan rekap angka semua mapel kelas tersebut agar bisa dicetak secara fisik.
