<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Akademik\ImportExcelRequest;
use App\Http\Requests\Admin\Akademik\StoreGuruRequest;
use App\Http\Requests\Admin\Akademik\UpdateGuruRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyGuruRequest;
use App\Models\Position;
use App\Models\Teacher;
use App\Models\Unit;
use App\Services\Admin\GuruService;
use App\Services\Shared\ExcelExportService;
use App\Services\Shared\ExcelImportService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct(
        protected GuruService $guruService,
        protected ExcelImportService $excelImportService,
        protected ExcelExportService $excelExportService
    ) {}

    /**
     * LIST DATA GURU
     */
    public function index(Request $request)
    {
        $query = Teacher::with(['unit', 'position', 'user']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('unit')) {
            $query->where('unit_id', $request->unit);
        }

        if ($request->filled('position')) {
            $query->where('position_id', $request->position);
        }

        $perPage = $request->input('per_page', 10);
        $teachers = $query->latest()->paginate($perPage)->appends($request->query());
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.akademik.guru.index', compact('teachers', 'units', 'positions'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.akademik.guru.create', compact('units', 'positions'));
    }

    /**
     * STORE DATA
     */
    public function store(StoreGuruRequest $request)
    {
        $this->guruService->storeTeacher($request->validated(), $request->file('photo'));

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    /**
     * DETAIL GURU
     */
    public function show(Teacher $guru)
    {
        $guru->load(['unit', 'position', 'teachingAssignments', 'user']);

        return view('admin.akademik.guru.show', ['teacher' => $guru]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Teacher $guru)
    {
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.akademik.guru.edit', [
            'teacher'   => $guru,
            'units'     => $units,
            'positions' => $positions,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(UpdateGuruRequest $request, Teacher $guru)
    {
        $this->guruService->updateTeacher($guru, $request->validated(), $request->file('photo'));

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diupdate');
    }

    /**
     * DELETE DATA
     */
    public function destroy(Teacher $guru)
    {
        if (\App\Models\SchoolClass::where('homeroom_teacher_id', $guru->id)->exists() || 
            \App\Models\TeachingAssignment::where('teacher_id', $guru->id)->exists()) {
            return back()->with('error', 'Guru tidak dapat dihapus karena masih bertugas sebagai Wali Kelas atau memiliki Jadwal Mengajar.');
        }

        $this->guruService->deleteTeacher($guru);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }

    /**
     * DELETE MASSAL DATA GURU
     */
    public function bulkDestroy(BulkDestroyGuruRequest $request)
    {
        $teachers = Teacher::whereIn('id', $request->ids)->get();
        $deleted = 0;
        $failed = 0;

        foreach ($teachers as $teacher) {
            if (\App\Models\SchoolClass::where('homeroom_teacher_id', $teacher->id)->exists() || 
                \App\Models\TeachingAssignment::where('teacher_id', $teacher->id)->exists()) {
                $failed++;
            } else {
                $this->guruService->deleteTeacher($teacher);
                $deleted++;
            }
        }

        $message = "Berhasil menghapus $deleted data guru.";
        if ($failed > 0) {
            $message .= " Gagal menghapus $failed guru karena masih bertugas sebagai Wali Kelas atau memiliki Jadwal Mengajar.";
        }

        return redirect()
            ->route('admin.guru.index')
            ->with($failed > 0 && $deleted == 0 ? 'error' : 'success', $message);
    }

    /**
     * EXPORT DATA GURU CSV
     */
    public function export(Request $request)
    {
        $query = Teacher::with(['unit', 'position']);

        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $teachers = $query->get();
        $unitName = 'SemuaUnit';

        if ($request->filled('unit_id')) {
            $unitName = Unit::find($request->unit_id)?->unit_name ?? 'SemuaUnit';
        }

        $filename = 'Data_Guru_' . str_replace(' ', '_', $unitName) . '.xlsx';

        $headers = [
            'NIP', 'NAMA LENGKAP', 'ID UNIT', 'ID JABATAN', 'JENIS KELAMIN',
            'TEMPAT LAHIR', 'TANGGAL LAHIR', 'PENDIDIKAN TERAKHIR',
            'NO TELEPON', 'ALAMAT', 'STATUS KEPEGAWAIAN', 'STATUS'
        ];

        return $this->excelExportService->export($teachers, $headers, function ($teacher) {
            return [
                $teacher->nip,
                $teacher->full_name,
                $teacher->unit_id,
                $teacher->position_id,
                $teacher->gender === 'male' ? 'L' : ($teacher->gender === 'female' ? 'P' : ''),
                $teacher->birth_place,
                $teacher->birth_date,
                $teacher->last_education,
                $teacher->phone,
                $teacher->address,
                $teacher->employment_status,
                $teacher->status,
            ];
        }, $filename);
    }

    /**
     * HALAMAN IMPORT
     */
    public function importPage()
    {
        return view('admin.akademik.guru.import');
    }

    /**
     * PROSES IMPORT CSV
     */
    public function import(ImportExcelRequest $request)
    {
        $result = $this->excelImportService->import($request->file('file'), function ($row) {
            return $this->guruService->processImportRow($row);
        });

        $message = "Import selesai: {$result['berhasil']} data berhasil";
        if ($result['gagal'] > 0) {
            $message .= ", {$result['gagal']} data gagal/dilewati";
        }

        return redirect()
            ->route('admin.guru.index')
            ->with('success', $message)
            ->with('import_errors', $result['errors']);
    }

    /**
     * DOWNLOAD TEMPLATE CSV GURU
     */
    public function importTemplate()
    {
        $headers = [
            'NIP', 'NAMA LENGKAP', 'ID UNIT', 'ID JABATAN', 'JENIS KELAMIN (L/P)',
            'TEMPAT LAHIR', 'TANGGAL LAHIR (YYYY-MM-DD)', 'PENDIDIKAN TERAKHIR',
            'NO TELEPON', 'ALAMAT', 'STATUS KEPEGAWAIAN',
            'STATUS'
        ];

        $sampleData = [
            '198501012010011001', 'Nama Guru Contoh', '1', '2', 'L',
            'Pekanbaru', '1985-01-01', 'S1', '08123456789', 'Jl. Contoh No. 1',
            'pegawai_tetap', 'active'
        ];

        return $this->excelExportService->downloadTemplate($headers, $sampleData, 'Template_Import_Guru.xlsx');
    }
}
