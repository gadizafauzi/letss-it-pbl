# Bedah Database & Entity Relationship Diagram (ERD)
*(Dokumen Reverse Engineering - Tahap 12)*

Berdasarkan analisis file *migration* di folder `database/migrations/`, berikut adalah bedah lengkap skema database dari proyek ini.

---

## 1. Tabel Master Utama (Sistem & Kredensial)

### `users`
*   **Fungsi:** Menyimpan data kredensial login (Email & Password). Digunakan oleh Spatie untuk *Role* & *Permission*.
*   **Primary Key (PK):** `id`
*   **Digunakan oleh Modul:** Semua Modul (Auth).

### `academic_years`
*   **Fungsi:** Mengatur tahun ajaran aktif (misal 2024/2025).
*   **PK:** `id`
*   **Digunakan oleh:** Penjadwalan, Nilai.

### `units`
*   **Fungsi:** Mengelompokkan sekolah (TK, SD, SMP).
*   **PK:** `id`

### `positions`
*   **Fungsi:** Jabatan Guru (Kepsek, Waka, Guru Biasa).
*   **PK:** `id`

---

## 2. Tabel Entitas Manusia (Aktor)

### `teachers` (Guru)
*   **Fungsi:** Profil data diri guru.
*   **PK:** `id`
*   **Foreign Key (FK):**
    *   `user_id` ➔ terhubung ke `users(id)` (1-to-1).
    *   `unit_id` ➔ terhubung ke `units(id)`.
    *   `position_id` ➔ terhubung ke `positions(id)`.
*   **Digunakan oleh:** `GuruController`, `MengajarController`.

### `students` (Siswa)
*   **Fungsi:** Profil data diri siswa lengkap (termasuk nama ortu).
*   **PK:** `id`
*   **FK:**
    *   `user_id` ➔ terhubung ke `users(id)` (1-to-1).
    *   `unit_id` ➔ terhubung ke `units(id)`.
*   **Digunakan oleh:** `SiswaController`, `TagihanController`, `Student\NilaiController`.

---

## 3. Tabel Akademik & Kegiatan Belajar Mengajar

### `classes` (Kelas Fisik)
*   **Fungsi:** Menyimpan nama kelas (7A, 8B).
*   **FK Spesial:** `homeroom_teacher_id` ➔ terhubung ke `teachers(id)` (Untuk menentukan siapa Wali Kelasnya).

### `subjects` (Mata Pelajaran)
*   **Fungsi:** Menyimpan daftar mapel.
*   **PK:** `id`

### `teaching_assignments` (Jadwal Mengajar)
*   **Fungsi:** **Tabel Pivot (Relasi)* yang sangat krusial. Menggabungkan Guru, Mapel, Kelas, dan Tahun Ajaran.
*   **FK:**
    *   `teacher_id`
    *   `subject_id`
    *   `class_id`
    *   `academic_year_id`
*   **Unique Index:** Kombinasi ke-4 FK di atas bersifat unik agar tidak ada jadwal ganda.

### `grades` (Nilai / Rapor)
*   **Fungsi:** Menyimpan nilai ujian.
*   **FK:**
    *   `student_id`
    *   `teaching_assignment_id` (Mengetahui nilai ini dari guru siapa, mapel apa).
    *   `academic_year_id`
*   **Status:** `draft`, `published`, `final`. Digunakan sebagai Filter di sisi Siswa.

---

## 4. Tabel Keuangan

### `invoices` (Tagihan)
*   **Fungsi:** Mencatat hutang / kewajiban bayar siswa.
*   **FK:** `student_id`
*   **Status:** `unpaid`, `paid`.

### `payments` (Pembayaran)
*   **Fungsi:** Mencatat struk bayar yang diupload ortu.
*   **FK:**
    *   `invoice_id` (1-to-1 dengan Tagihan).
    *   `verified_by` ➔ `users(id)` (Menandai Admin mana yang menekan tombol verifikasi).

---

## 5. Tabel CMS (Konten Website)
Terdapat banyak tabel beraawalan `cms_` yang di-*generate* dalam satu file migrasi besar (`2026_06_11_130000_create_cms_tables.php`).
Contoh tabel: `cms_hero_sections`, `cms_visis`, `cms_posts` (Berita).
Semua tabel ini berdiri sendiri tanpa *Foreign Key* yang rumit, digunakan murni untuk di-*load* oleh Halaman Publik.
