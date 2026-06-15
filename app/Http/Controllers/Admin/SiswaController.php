<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportExcelRequest;
use App\Http\Requests\Admin\StoreSiswaRequest;
use App\Http\Requests\Admin\UpdateSiswaRequest;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Unit;
use App\Services\Admin\SiswaService;
use App\Services\Shared\ExcelExportService;
use App\Services\Shared\ExcelImportService;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct(
        protected SiswaService $siswaService,
        protected ExcelImportService $excelImportService,
        protected ExcelExportService $excelExportService
    ) {}

    /**
     * LIST DATA SISWA
     */
    public function index(Request $request)
    {
        $query = Student::with([
            'unit',
            'studentClasses.schoolClass',
            'studentClasses.academicYear'
        ]);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%')
                    ->orWhere('nisn', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        if ($request->filled('class_id')) {
            $query->whereHas('studentClasses', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $students = $query->latest()->paginate($perPage)->appends($request->query());
        $units    = Unit::all();
        $classes  = SchoolClass::query();

        if ($request->filled('unit_id')) {
            $classes->where('unit_id', $request->unit_id);
        }

        $classes = $classes->orderBy('class_name')->get();

        return view('admin.siswa.index', compact('students', 'units', 'classes'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units         = Unit::all();
        $classes       = SchoolClass::all();
        $academicYears = AcademicYear::all();

        return view('admin.siswa.create', compact('units', 'classes', 'academicYears'));
    }

    /**
     * STORE DATA
     */
    public function store(StoreSiswaRequest $request)
    {
        $this->siswaService->storeStudent($request->validated(), $request->file('photo'));

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    /**
     * DETAIL SISWA
     */
    public function show(Student $siswa)
    {
        $siswa->load([
            'unit',
            'studentClasses.schoolClass',
            'studentClasses.academicYear',
        ]);

        return view('admin.siswa.show', ['student' => $siswa]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Student $siswa)
    {
        $siswa->load([
            'studentClasses.schoolClass',
            'studentClasses.academicYear'
        ]);

        $units         = Unit::all();
        $classes       = SchoolClass::all();
        $academicYears = AcademicYear::all();

        return view('admin.siswa.edit', [
            'student'       => $siswa,
            'units'         => $units,
            'classes'       => $classes,
            'academicYears' => $academicYears,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(UpdateSiswaRequest $request, Student $siswa)
    {
        $this->siswaService->updateStudent($siswa, $request->validated(), $request->file('photo'));

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * AMBIL KELAS BERDASARKAN UNIT (AJAX)
     */
    public function classesByUnit($unitId)
    {
        return response()->json(
            SchoolClass::where('unit_id', $unitId)
                ->orderBy('class_name')
                ->get(['id', 'class_name'])
        );
    }

    /**
     * DELETE DATA
     */
    public function destroy(Student $siswa)
    {
        $this->siswaService->deleteStudent($siswa);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }

    /**
     * DELETE MASSAL DATA SISWA
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:students,id'
        ]);

        $students = Student::whereIn('id', $request->ids)->get();

        foreach ($students as $student) {
            $this->siswaService->deleteStudent($student);
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', count($students) . ' data siswa berhasil dihapus');
    }

    /**
     * EXPORT DATA SISWA CSV
     */
    public function export(Request $request)
    {
        $query = Student::with(['unit', 'studentClasses.schoolClass']);

        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        if ($request->filled('class_id')) {
            $query->whereHas('studentClasses', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->get();

        $unitName  = 'SemuaUnit';
        $className = 'SemuaKelas';

        if ($request->filled('unit_id')) {
            $unitName = Unit::find($request->unit_id)?->unit_name ?? 'SemuaUnit';
        }

        if ($request->filled('class_id')) {
            $className = SchoolClass::find($request->class_id)?->class_name ?? 'SemuaKelas';
        }

        $filename = 'Data_Siswa_'
            . str_replace(' ', '_', $unitName)
            . '_Kelas_'
            . str_replace(' ', '_', $className)
            . '.xlsx';

        $headers = [
            'NIS SISWA', 'NISN SISWA', 'NIK', 'NAMA SISWA', 'ID KELAS', 'ID UNIT',
            'NO. WA ORTU', 'JENIS KELAMIN', 'TEMPAT LAHIR', 'TANGGAL LAHIR',
            'HOBI', 'NO. HP SISWA', 'ALAMAT', 'NAMA AYAH', 'NAMA IBU'
        ];

        return $this->excelExportService->export($students, $headers, function ($student) {
            $activeClass = $student->studentClasses->first();
            return [
                $student->nis,
                $student->nisn,
                $student->nik,
                $student->full_name,
                $activeClass?->class_id ?? '',
                $student->unit_id,
                $student->parent_phone,
                $student->gender,
                $student->birth_place,
                $student->birth_date ? $student->birth_date->format('Y-m-d') : '',
                $student->hobby,
                $student->phone,
                $student->address,
                $student->father_name,
                $student->mother_name,
            ];
        }, $filename);
    }

    /**
     * HALAMAN IMPORT
     */
    public function importPage()
    {
        return view('admin.siswa.import');
    }

    /**
     * PROSES IMPORT CSV
     */
    public function import(ImportExcelRequest $request)
    {
        $result = $this->excelImportService->import($request->file('file'), function ($row) {
            return $this->siswaService->processImportRow($row);
        });

        $message = "Import selesai: {$result['berhasil']} data berhasil";
        if ($result['gagal'] > 0) {
            $message .= ", {$result['gagal']} data gagal/dilewati";
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $message)
            ->with('import_errors', $result['errors']);
    }

    /**
     * DOWNLOAD TEMPLATE CSV
     */
    public function importTemplate()
    {
        $headers = [
            'NIS SISWA', 'NISN SISWA', 'NIK', 'NAMA SISWA', 'ID KELAS', 'ID UNIT',
            'NO. WA ORTU', 'JENIS KELAMIN', 'TEMPAT LAHIR', 'TANGGAL LAHIR',
            'HOBI', 'NO. HP SISWA', 'ALAMAT', 'NAMA AYAH', 'NAMA IBU'
        ];

        $sampleData = [
            '2018011', '14569041', '1234567890123456', 'ABDULLAH IMPORT', '1', '2',
            '6285812345678', 'L', 'Pekanbaru', '2018-09-10',
            'Sepak Bola', '6285812345613', 'Kota Bunga', 'Father', 'Mother'
        ];

        return $this->excelExportService->downloadTemplate($headers, $sampleData, 'Template_Import_Siswa.xlsx');
    }
}
