# Analisis Kode Per Baris (Line-by-Line Analysis)
*(Dokumen Reverse Engineering - Tahap 10)*

Seperti yang disepakati di *Implementation Plan*, membedah ribuan file per baris akan membanjiri Anda dengan informasi yang repetitif. Oleh karena itu, dokumen ini membedah kode per baris untuk satu buah **File Inti (Core File)**, yaitu `GuruController.php`, karena file ini memuat 90% seluruh bentuk pemanggilan kode standar di aplikasi Anda (Dependency Injection, Eager Loading, FormRequest, Service Call, dan Response).

Jika Anda memahami anatomi per-baris dari file ini, Anda akan otomatis memahami 40 Controller lainnya.

---

## Membedah `app/Http/Controllers/Admin/Akademik/GuruController.php`

```php
1: <?php
// Baris 1: Tag pembuka wajib untuk file PHP. Sistem tidak akan membaca kode jika tag ini hilang.

3: namespace App\Http\Controllers\Admin\Akademik;
// Baris 3: Mendeklarasikan "Alamat Rumah" dari file ini. Membantu sistem membedakan GuruController milik Admin dan GuruController milik User (jika ada).

5: use App\Http\Controllers\Controller;
6: use App\Http\Requests\Admin\Akademik\ImportExcelRequest;
7: use App\Http\Requests\Admin\Akademik\StoreGuruRequest;
...
// Baris 5-16: Fungsi `use`. Ini adalah proses meng-import file (Class) dari folder lain agar bisa digunakan di dalam file ini tanpa harus mengetik alamat panjangnya (Namespace) berulang-ulang. 
// Bayangkan ini seperti "menaruh alat-alat di atas meja operasi sebelum mulai membedah".

18: class GuruController extends Controller
// Baris 18: Mendeklarasikan class bernama GuruController. `extends Controller` berarti class ini mewarisi (inheritance) sifat-sifat dasar Controller bawaan Laravel.

19: {
20:     public function __construct(
21:         protected GuruService $guruService,
22:         protected ExcelImportService $excelImportService,
23:         protected ExcelExportService $excelExportService
24:     ) {}
// Baris 20-24: Ini adalah `Magic Method` Constructor dengan **Constructor Property Promotion** (Fitur PHP 8).
// Mengapa menggunakan Dependency Injection (Injeksi Ketergantungan) di sini?
// Alasan: Agar Controller tidak perlu repot-repot melakukan instansiasi class manual seperti `$guruService = new GuruService()`. Laravel akan secara otomatis "menyuntikkan" class Service tersebut saat controller ini dipanggil. `protected` membuat class service tersebut bisa dipanggil kapan saja di file ini dengan awalan `$this->`.

29:     public function index(Request $request)
// Baris 29: Method untuk menampilkan tabel utama. Mengapa ada parameter `$request`? Karena form pencarian (Search Box) akan mengirimkan nilainya lewat GET Parameter ke fungsi ini.

31:         $query = Teacher::with(['unit', 'position', 'user']);
// Baris 31: MENDALAM! Ini adalah konsep **Eager Loading**.
// Mengapa tidak pakai `Teacher::all()` saja?
// Alasan: Jika pakai `all()`, saat HTML menampilkan nama Unit dari 100 guru, sistem akan menjalankan 100 Query tambahan ke tabel Unit (Dikenal dengan N+1 Problem). Dengan `with(...)`, sistem hanya butuh 2 Query saja. Sangat efisien!

33:         if ($request->filled('search')) {
// Baris 33: Mengecek apakah kotak pencarian diisi atau dibiarkan kosong oleh Admin.

34:             $query->where(function ($q) use ($request) {
35:                 $q->where('full_name', 'like', '%' . $request->search . '%')
36:                     ->orWhere('nip', 'like', '%' . $request->search . '%');
37:             });
// Baris 34-37: Membangun query pencarian. `%` (Wildcard) berarti "cari yang ada potongan kata ini, tidak peduli di awal atau di akhir". Ia mencari berdasarkan nama ATAU NIP.

48:         $perPage = $request->input('per_page', 10);
49:         $teachers = $query->latest()->paginate($perPage)->appends($request->query());
// Baris 48-49: Mengatur jumlah data per halaman (10). `paginate()` digunakan agar halaman tidak *blank* jika ada 10.000 guru (Data dibagi-bagi per halaman). `appends($request->query())` berguna agar saat pindah halaman 2, filter pencariannya tidak mereset/hilang.

53:         return view('admin.akademik.guru.index', compact('teachers', 'units', 'positions'));
// Baris 53: Meneruskan seluruh variabel data ke dalam file Blade (HTML). `compact()` adalah cara singkat PHP mengubah variabel menjadi Array asosiatif.

70:     public function store(StoreGuruRequest $request)
// Baris 70: Method untuk menyimpan data. Perhatikan, ia memakai `StoreGuruRequest` bukan `Request` biasa. 
// Mengapa? Karena sebelum masuk ke fungsi ini, data sudah di "cegat" oleh satpam validasi. Jika lolos, baru dieksekusi.

72:         $this->guruService->storeTeacher($request->validated(), $request->file('photo'));
// Baris 72: Ini adalah alasan kenapa arsitektur ini keren. Controller tidak men-decode password, tidak memindahkan file, tidak menyimpan ke DB. Controller HANYA melempar data bersih (`validated()`) ke `guruService`. Biar Service yang lembur mengurus kerumitannya!

74:         return redirect()
75:             ->route('admin.guru.index')
76:             ->with('success', 'Data guru berhasil ditambahkan');
// Baris 74-76: Mengalihkan browser (Redirect) kembali ke halaman index tabel.
// Mengapa memakai `with('success', ...)`?
// Alasan: Ini disebut "Flash Session". Pesan ini hanya hidup 1 kali muat halaman (untuk memunculkan notifikasi pop-up hijau berhasil), lalu akan terhapus otomatis di muat halaman berikutnya.

121:         if (\App\Models\SchoolClass::where('homeroom_teacher_id', $guru->id)->exists() || 
122:             \App\Models\TeachingAssignment::where('teacher_id', $guru->id)->exists()) {
123:             return back()->with('error', 'Guru tidak dapat dihapus karena masih bertugas sebagai Wali Kelas atau memiliki Jadwal Mengajar.');
124:         }
// Baris 121-124: (Pada method hapus / destroy). Ini adalah **Foreign Key Protection Logic**.
// Mengapa perlu if (exists)?
// Alasan: Jika guru yang dihapus ternyata sedang menjadi Wali Kelas aktif, maka jika dipaksa dihapus, sistem Rapor kelas tersebut akan Error atau Crash (karena kehilangan wali). Maka dari itu, operasi dicegah dan diarahkan kembali (back).

126:         $this->guruService->deleteTeacher($guru);
// Baris 126: Sama seperti store, controller menyuruh service yang melakukan hard-delete.

227:         $result = $this->excelImportService->import($request->file('file'), function ($row) {
228:             return $this->guruService->processImportRow($row);
229:         });
// Baris 227-229: Ini adalah injeksi **Closure / Anonymous Function**.
// Mengapa tidak diurus di dalam ImportService langsung?
// Alasan: Agar `ExcelImportService` bisa di-*recycle* (dipakai ulang). Besok jika Admin ingin import Siswa, controller Siswa bisa mengirim Closure yang berbeda (`siswaService->processImportRow`) ke ImportService yang sama. Fleksibilitas tinggi!

262: }
// Baris 262: Penutup class GuruController.
```
