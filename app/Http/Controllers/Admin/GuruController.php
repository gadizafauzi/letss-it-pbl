<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportCsvRequest;
use App\Http\Requests\Admin\StoreGuruRequest;
use App\Http\Requests\Admin\UpdateGuruRequest;
use App\Models\Position;
use App\Models\Teacher;
use App\Models\Unit;
use App\Services\Admin\GuruService;
use App\Services\Shared\CsvExportService;
use App\Services\Shared\CsvImportService;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function __construct(
        protected GuruService $guruService,
        protected CsvImportService $csvImportService,
        protected CsvExportService $csvExportService
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

        $teachers = $query->latest()->get();
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.guru.index', compact('teachers', 'units', 'positions'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.guru.create', compact('units', 'positions'));
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

        return view('admin.guru.show', ['teacher' => $guru]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Teacher $guru)
    {
        $units = Unit::all();
        $positions = Position::all();

        return view('admin.guru.edit', [
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
        $this->guruService->deleteTeacher($guru);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
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

        $filename = 'Data_Guru_' . str_replace(' ', '_', $unitName) . '.csv';

        $headers = [
            'NIP', 'Nama Lengkap', 'Unit', 'Jabatan', 'Jenis Kelamin',
            'Tempat Lahir', 'Tanggal Lahir', 'Pendidikan Terakhir',
            'No Telepon', 'Alamat', 'Status Kepegawaian', 'Status'
        ];

        return $this->csvExportService->export($teachers, $headers, function ($teacher) {
            return [
                $teacher->nip,
                $teacher->full_name,
                $teacher->unit?->unit_name ?? '-',
                $teacher->position?->name ?? '-',
                $teacher->gender,
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
        return view('admin.guru.import');
    }

    /**
     * PROSES IMPORT CSV
     */
    public function import(ImportCsvRequest $request)
    {
        $result = $this->csvImportService->import($request->file('file'), function ($row) {
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
            'NIP', 'Nama Lengkap', 'Unit', 'Jabatan', 'Jenis Kelamin (male/female)',
            'Tempat Lahir', 'Tanggal Lahir (YYYY-MM-DD)', 'Pendidikan Terakhir',
            'No Telepon', 'Alamat', 'Status Kepegawaian (pegawai_tetap/pegawai_tidak_tetap)',
            'Status (active/inactive)'
        ];

        $sampleData = [
            '198501012010011001', 'Nama Guru Contoh', 'SD', 'Guru Kelas', 'male',
            'Pekanbaru', '1985-01-01', 'S1', '08123456789', 'Jl. Contoh No. 1',
            'pegawai_tetap', 'active'
        ];

        return $this->csvExportService->downloadTemplate($headers, $sampleData, 'Template_Import_Guru.csv');
    }
}
