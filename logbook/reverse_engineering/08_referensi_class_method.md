# Bedah Anatomi Class & Method
*(Dokumen Reverse Engineering - Tahap 8 & Tahap 9)*

Dokumen ini membedah *purpose* (tujuan), fungsi, dan *method* dari klasifikasi utama penyusun proyek Anda. Semua class di proyek ini mematuhi standar *Object-Oriented Programming* (OOP) yang kuat.

---

## 1. Class Kategori Controller (Pengatur Lalu Lintas)
Semua class Controller turunan dari `App\Http\Controllers\Controller` (Parent).

### A. `GuruController`
*   **Fungsi:** Menangani HTTP Request terkait entitas Guru.
*   **Method Krusial:**
    *   `index(Request $request)`: Menerima `$request` dari URL (seperti filter posisi/unit). **Return:** `view('admin.akademik.guru.index')` dengan bawaan `LengthAwarePaginator` (Pagination). Logika query: `Teacher::with(...)` untuk Eager Loading mencegah N+1 problem.
    *   `store(StoreGuruRequest $request)`: Menerima data tervalidasi. Memanggil `$this->guruService->storeTeacher(...)`. **Return:** Redirect redirect dengan Flash Session sukses.
    *   `bulkDestroy(BulkDestroyGuruRequest $request)`: Menerima array `ids`. Menggunakan iterasi *foreach* untuk menghapus guru satu persatu melalui Service. Efek: Menghapus row di database.

### B. `TagihanController`
*   **Fungsi:** Mengatur pembuatan Invoice siswa.
*   **Method Krusial:**
    *   `kirimWa(Invoice $invoice)`: Menggunakan *Route Model Binding* (langsung menerima object Invoice berdasarkan ID di URL). Logika: Membangun *payload* JSON, lalu memakai Fasad `Http::post()` untuk mengirim data ke nomor HP ortu siswa.

---

## 2. Class Kategori Service (Otak Bisnis)
Service Class **tidak diwajibkan** oleh Laravel, tetapi arsitek sistem ini sengaja membuatnya untuk menerapkan pola *Clean Architecture*.

### A. `GuruService`
*   **Alasan Dibuat:** Menangani proses rumit di luar Controller.
*   **Method Krusial:**
    *   `storeTeacher(array $data, UploadedFile $photo = null)`:
        *   **Logika:** 
            1. Menggunakan `DB::transaction()` (Transaksi Database). Artinya jika saat menyimpan foto sukses tetapi menyimpan tabel gagal, seluruh proses dibatalkan (Rollback) agar data tidak korup.
            2. Membuat akun otomatis di tabel `users` (dengan *Hash::make* password dari tanggal lahir).
            3. Jika parameter `$photo` tidak *null*, ia akan memanggil `Storage::putFile()` untuk menyimpan gambar.
        *   **Return:** `Teacher` object.

### B. `ExcelImportService`
*   **Alasan Dibuat:** Memusatkan logika pembacaan `.xlsx` agar bisa dipakai oleh fitur Guru maupun Siswa.
*   **Dependency Tambahan:** Memerlukan package `PhpOffice\PhpSpreadsheet`.
*   **Method Krusial:**
    *   `import(UploadedFile $file, callable $rowProcessor)`:
        *   **Tujuan:** Membaca baris Excel tanpa peduli apakah itu data Guru atau Siswa (Fleksibilitas).
        *   **Parameter `callable`:** Menerima *Anonymous Function* (Closure) dari Controller yang akan dieksekusi untuk tiap baris.
        *   **Return:** Array laporan (Berapa Sukses, Berapa Gagal).

---

## 3. Class Kategori Model (Pustakawan Database)
Semua class Model *extends* ke `Illuminate\Database\Eloquent\Model` (Parent).

### A. `Teacher` Model
*   **Fungsi:** Representasi dari tabel `teachers`.
*   **Trait:** Biasanya memakai `HasFactory` (untuk seeder) dan `SoftDeletes` (opsional jika data tidak benar-benar dihapus).
*   **Method Relasi:**
    *   `user()`: **Return:** `$this->belongsTo(User::class)`. Dipanggil saat Controller butuh email si Guru.
    *   `unit()`: **Return:** `$this->belongsTo(Unit::class)`. Dipanggil untuk menampilkan keterangan TK/SD/SMP.

### B. `Grade` Model (Nilai)
*   **Fungsi:** Representasi dari tabel `grades`.
*   **Logika Bisnis di Model:** Model ini tidak punya *method action* khusus, ia murni digunakan sebagai *Query Builder*.
*   **Efek:** Kapanpun `Grade::create()` dipanggil, Laravel secara otomatis mengisi kolom `created_at` dan `updated_at` di dalam tabel MySQL tanpa perlu di-set manual (Fitur Timestamp bawaan Eloquent).

---

## Kesimpulan Tahap 8 & 9
Setiap *Method* di dalam sistem ini dipecah dengan prinsip **Single Responsibility Principle (SRP)**. Controller *HANYA* mengurus HTTP. Service *HANYA* mengurus logika (Upload, Hash, Transaksi). Model *HANYA* mengurus Query Database. Kombinasi ketiganya membuat proyek Anda ini berskala level Enterprise!
