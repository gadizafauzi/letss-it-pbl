<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SiswaController extends Controller
{
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

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%')
                    ->orWhere('nisn', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        // Filter unit
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        // Filter kelas
        if ($request->filled('class_id')) {
            $query->whereHas('studentClasses', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->paginate(5)->appends($request->query());
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

        return view('admin.siswa.create', compact(
            'units',
            'classes',
            'academicYears'
        ));
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_id'          => 'nullable|exists:units,id',
            'class_id'         => 'nullable|exists:classes,id',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'nis'              => 'required|unique:students,nis',
            'nisn'             => 'required|unique:students,nisn',
            'nik'              => 'nullable|digits:16|unique:students,nik',
            'full_name'        => 'required',
            'gender'           => 'nullable|in:L,P',
            'birth_place'      => 'nullable',
            'birth_date'       => 'nullable|date',
            'hobby'            => 'nullable',
            'phone'            => 'nullable',
            'address'          => 'nullable',
            'father_name'      => 'nullable',
            'mother_name'      => 'nullable',
            'parent_phone'     => 'nullable',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'           => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->decode($request->file('photo'));
            $image->cover(300, 300);

            $filename = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $directory = storage_path('app/public/students');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($directory . '/' . $filename);
            $validated['photo'] = 'students/' . $filename;
        }

        $user = User::create([
            'name'     => $validated['full_name'],
            'username' => $validated['nis'],
            'password' => Hash::make('12345678'),
            'role'     => 'student',
            'status'   => 'active',
        ]);

        $student = Student::create([
            'user_id'      => $user->id,
            'unit_id'      => $validated['unit_id'] ?? null,
            'nis'          => $validated['nis'],
            'nisn'         => $validated['nisn'],
            'nik'          => $validated['nik'] ?? null,
            'full_name'    => $validated['full_name'],
            'gender'       => $validated['gender'] ?? null,
            'birth_place'  => $validated['birth_place'] ?? null,
            'birth_date'   => $validated['birth_date'] ?? null,
            'hobby'        => $validated['hobby'] ?? null,
            'phone'        => $validated['phone'] ?? null,
            'address'      => $validated['address'] ?? null,
            'father_name'  => $validated['father_name'] ?? null,
            'mother_name'  => $validated['mother_name'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            'photo'        => $validated['photo'] ?? null,
            'status'       => $validated['status'],
        ]);

        if (!empty($request->class_id) && !empty($request->academic_year_id)) {
            StudentClass::create([
                'student_id'       => $student->id,
                'class_id'         => $request->class_id,
                'academic_year_id' => $request->academic_year_id,
            ]);
        }

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

        return view('admin.siswa.show', [
            'student' => $siswa
        ]);
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
    public function update(Request $request, Student $siswa)
    {
        $validated = $request->validate([
            'unit_id'          => 'nullable|exists:units,id',
            'class_id'         => 'nullable|exists:classes,id',
            'academic_year_id' => 'nullable|exists:academic_years,id',
            'nis'              => 'required|unique:students,nis,' . $siswa->id,
            'nisn'             => 'required|unique:students,nisn,' . $siswa->id,
            'nik'              => 'nullable|digits:16|unique:students,nik,' . $siswa->id,
            'full_name'        => 'required',
            'gender'           => 'nullable|in:L,P',
            'birth_place'      => 'nullable',
            'birth_date'       => 'nullable|date',
            'hobby'            => 'nullable',
            'phone'            => 'nullable',
            'address'          => 'nullable',
            'father_name'      => 'nullable',
            'mother_name'      => 'nullable',
            'parent_phone'     => 'nullable',
            'photo'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'           => 'required',
        ]);

        if ($request->hasFile('photo')) {
            if ($siswa->photo) {
                Storage::disk('public')->delete($siswa->photo);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->decode($request->file('photo'));
            $image->cover(300, 300);

            $filename = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $directory = storage_path('app/public/students');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($directory . '/' . $filename);
            $validated['photo'] = 'students/' . $filename;
        }

        if ($siswa->user) {
            $siswa->user->update([
                'name'     => $validated['full_name'],
                'username' => $validated['nis'],
            ]);
        }

        $siswa->update([
            'unit_id'      => $validated['unit_id'] ?? null,
            'nis'          => $validated['nis'],
            'nisn'         => $validated['nisn'],
            'nik'          => $validated['nik'] ?? null,
            'full_name'    => $validated['full_name'],
            'gender'       => $validated['gender'] ?? null,
            'birth_place'  => $validated['birth_place'] ?? null,
            'birth_date'   => $validated['birth_date'] ?? null,
            'hobby'        => $validated['hobby'] ?? null,
            'phone'        => $validated['phone'] ?? null,
            'address'      => $validated['address'] ?? null,
            'father_name'  => $validated['father_name'] ?? null,
            'mother_name'  => $validated['mother_name'] ?? null,
            'parent_phone' => $validated['parent_phone'] ?? null,
            'photo'        => $request->hasFile('photo') ? $validated['photo'] : $siswa->photo,
            'status'       => $validated['status'],
        ]);

        if ($request->class_id && $request->academic_year_id) {
            StudentClass::where('student_id', $siswa->id)->delete();

            StudentClass::create([
                'student_id'       => $siswa->id,
                'class_id'         => $request->class_id,
                'academic_year_id' => $request->academic_year_id,
            ]);
        }

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
     * EXPORT DATA SISWA CSV
     */
    public function export(Request $request)
    {
        $query = Student::with([
            'unit',
            'studentClasses.schoolClass'
        ]);

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
            $unit     = Unit::find($request->unit_id);
            $unitName = $unit?->unit_name ?? 'SemuaUnit';
        }

        if ($request->filled('class_id')) {
            $class     = SchoolClass::find($request->class_id);
            $className = $class?->class_name ?? 'SemuaKelas';
        }

        $filename = 'Data_Siswa_'
            . str_replace(' ', '_', $unitName)
            . '_Kelas_'
            . str_replace(' ', '_', $className)
            . '.csv';

        return response()->streamDownload(function () use ($students) {

            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'NIS',
                'NISN',
                'NIK',
                'Nama Lengkap',
                'Unit',
                'Kelas',
                'Jenis Kelamin',
                'Nama Ayah',
                'Nama Ibu',
                'No HP Orang Tua',
                'Alamat',
                'Status',
            ]);

            foreach ($students as $student) {
                $activeClass = $student->studentClasses->first();

                fputcsv($file, [
                    $student->nis,
                    $student->nisn,
                    $student->nik,
                    $student->full_name,
                    $student->unit?->unit_name ?? '-',
                    $activeClass?->schoolClass?->class_name ?? '-',
                    $student->gender,
                    $student->father_name,
                    $student->mother_name,
                    $student->parent_phone,
                    $student->address,
                    $student->status,
                ]);
            }

            fclose($file);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
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
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file   = $request->file('file');
        $handle = fopen($file->getPathname(), 'r');

        fgetcsv($handle); // skip header

        $berhasil = 0;
        $gagal    = 0;
        $errors   = [];

        while (($row = fgetcsv($handle)) !== false) {

            if (empty(array_filter($row))) continue;

            $nis  = trim($row[0] ?? '');
            $nisn = trim($row[1] ?? '');
            $nik  = trim($row[2] ?? '') ?: null;
            $nama = trim($row[3] ?? '');

            if (!$nis || !$nisn || !$nama) {
                $gagal++;
                $errors[] = "Baris kosong dilewati (NIS: $nis)";
                continue;
            }

            if (Student::where('nis', $nis)->exists()) {
                $gagal++;
                $errors[] = "NIS $nis sudah terdaftar, dilewati";
                continue;
            }

            try {
                $user = User::create([
                    'name'     => $nama,
                    'username' => $nis,
                    'password' => Hash::make('12345678'),
                    'role'     => 'student',
                    'status'   => 'active',
                ]);

                Student::create([
                    'user_id'      => $user->id,
                    'nis'          => $nis,
                    'nisn'         => $nisn,
                    'nik'          => $nik,
                    'full_name'    => $nama,
                    'gender'       => trim($row[4] ?? null) ?: null,
                    'birth_place'  => trim($row[5] ?? null) ?: null,
                    'birth_date'   => trim($row[6] ?? null) ?: null,
                    'address'      => trim($row[7] ?? null) ?: null,
                    'father_name'  => trim($row[8] ?? null) ?: null,
                    'mother_name'  => trim($row[9] ?? null) ?: null,
                    'parent_phone' => trim($row[10] ?? null) ?: null,
                    'status'       => trim($row[11] ?? 'active') ?: 'active',
                ]);

                $berhasil++;
            } catch (\Exception $e) {
                $gagal++;
                $errors[] = "NIS $nis gagal: " . $e->getMessage();
            }
        }

        fclose($handle);

        $message = "Import selesai: $berhasil data berhasil";
        if ($gagal > 0) $message .= ", $gagal data dilewati";

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $message)
            ->with('import_errors', $errors);
    }

    /**
     * DOWNLOAD TEMPLATE CSV
     */
    public function importTemplate()
    {
        return response()->streamDownload(function () {

            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'NIS',
                'NISN',
                'NIK',
                'Nama Lengkap',
                'Jenis Kelamin (L/P)',
                'Tempat Lahir',
                'Tanggal Lahir (YYYY-MM-DD)',
                'Alamat',
                'Nama Ayah',
                'Nama Ibu',
                'No HP Orang Tua',
                'Status (active/inactive/graduated/transfer/dropout)',
            ]);

            fputcsv($file, [
                '2024001',
                '1234567890',
                '1234567890123456',
                'Nama Siswa Contoh',
                'L',
                'Pekanbaru',
                '2010-05-15',
                'Jl. Contoh No. 1',
                'Nama Ayah',
                'Nama Ibu',
                '08123456789',
                'active',
            ]);

            fclose($file);
        }, 'Template_Import_Siswa.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * DELETE DATA
     */
    public function destroy(Student $siswa)
    {
        if ($siswa->photo) {
            Storage::disk('public')->delete($siswa->photo);
        }

        if ($siswa->user) {
            $siswa->user->delete();
        }

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
