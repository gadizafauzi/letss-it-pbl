# Dependency Graph & Alur Sistem
*(Dokumen Reverse Engineering - Tahap 11)*

Dokumen ini memetakan "Siapa Bergantung Pada Siapa" (*Dependency*) di dalam sistem, serta merangkum alur jalannya eksekusi program dari ujung ke ujung.

---

## 1. Peta Dependency (Siapa Memanggil Siapa)

Berdasarkan *Layered Architecture* yang dipakai proyek ini, arus ketergantungan bersifat **Satu Arah (Top-Down)** agar kode tidak saling tumpang tindih (*Spaghetti Code*):

**`Routes`**
  ↓ (Bergantung pada)
**`Middlewares`** (Contoh: `auth`, `role:admin`)
  ↓ (Bergantung pada)
**`Controllers`** (Contoh: `GuruController`, `TagihanController`)
  ↓ (Bergantung pada)
**`Requests` / `Validators`** (Contoh: `StoreGuruRequest`)
  ↓ (Bergantung pada)
**`Services`** (Contoh: `GuruService`, `ExcelImportService`)
  ↓ (Bergantung pada)
**`Models`** (Contoh: `Teacher`, `Invoice`, `User`)
  ↓ (Bergantung pada)
**`Database`** (MySQL)

*Tidak boleh ada Model yang memanggil Controller, dan tidak boleh ada View yang langsung melakukan Query Database (selalu lewat Controller).*

---

## 2. Alur Spesiﬁk (Berdasarkan Reverse Engineering)

### A. Alur Upload & Import (Siapa Bekerja Sama?)
1.  **Form Input:** User mengunggah `.xlsx`.
2.  **`GuruController@import`:** Menerima file `Request::file('file')`.
3.  **`ExcelImportService` (Dependency 1):** Library phpoffice membuka file Excel secara asinkron (baris per baris).
4.  **`GuruService` (Dependency 2):** Dipanggil oleh *ImportService* di setiap iterasi baris untuk melakukan proses *cleaning* nama, kapitalisasi teks, dan konversi tanggal.
5.  **`Teacher` & `User` Model (Dependency 3):** Disimpan ke tabel.
*Alur ini membuktikan Controller sama sekali tidak menyentuh logika pengolahan Excel.*

### B. Alur Nilai & Rapor (Lifecycle Data)
1.  **Guru Mapel (Creator):** Menginput nilai di `KelasController@storeNilai`. Nilai tersimpan di tabel `grades` dengan status `draft`.
2.  **Siswa (Denial):** Mencoba melihat nilai di `Student\NilaiController`. Sistem menolak/kosong karena query di-filter `WHERE status = 'published'`.
3.  **Wali Kelas (Publisher):** Menekan tombol Publish di `WaliKelas\NilaiController`. Status berubah dari `draft` ke `published`.
4.  **Siswa (Approved):** Kini bisa melihat nilainya.

### C. Alur Tagihan (Pembayaran Terintegrasi)
1.  **Admin (Generator):** Membuat invoice di `TagihanController`.
2.  **API WA (Notifier):** Admin klik "Kirim WA". Controller melempar API request keluar dari aplikasi.
3.  **Siswa (Payer):** Upload struk ➔ `Payment` Model (Status `pending`).
4.  **Admin (Verifier):** Menyetujui struk ➔ Status `Payment` menjadi `verified`, dan status `Invoice` di-*trigger* menjadi `paid`.
