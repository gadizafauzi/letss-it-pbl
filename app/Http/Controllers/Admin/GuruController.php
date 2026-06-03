<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Unit;
use App\Models\Position;

class GuruController extends Controller
{
    /**
     * LIST DATA GURU
     */
    public function index(Request $request)
    {
        $query = Teacher::with([
            'unit',
            'position',
            'user',
        ]);

        /**
         * SEARCH
         */
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('full_name', 'like', '%' . $request->search . '%')
                    ->orWhere('nip', 'like', '%' . $request->search . '%');
            });
        }

        /**
         * FILTER UNIT
         */
        if ($request->unit) {

            $query->where('unit_id', $request->unit);
        }

        /**
         * FILTER POSITION
         */
        if ($request->position) {

            $query->where('position_id', $request->position);
        }

        $teachers = $query
            ->latest()
            ->get();

        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.index', compact(
            'teachers',
            'units',
            'positions'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.create', compact(
            'units',
            'positions'
        ));
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'position_id' => 'nullable|exists:positions,id',

            'nip' => 'required|string|max:50|unique:teachers,nip|unique:users,username',

            'full_name' => 'required|string|max:255',

            'gender' => 'nullable|in:male,female',

            'birth_place' => 'nullable|string|max:100',

            'birth_date' => 'nullable|date',

            'last_education' => 'nullable|string|max:100',

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'employment_status' => 'nullable|in:pegawai_tetap,pegawai_tidak_tetap',

            'status' => 'required|in:active,inactive',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /**
         * UPLOAD FOTO
         */
        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $image = $manager->decode($request->file('photo'));
            $image->cover(300, 300);

            $filename = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $directory = storage_path('app/public/teachers');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($directory . '/' . $filename);
            $validated['photo'] = 'teachers/' . $filename;
        }

        /**
         * CREATE USER LOGIN
         */
        $user = User::create([

            'name' => $validated['full_name'],

            'username' => $validated['nip'],

            'password' => Hash::make('12345678'),

            'role' => 'teacher',

            'status' => $validated['status'],
        ]);

        /**
         * CREATE TEACHER
         */
        Teacher::create([

            'user_id' => $user->id,

            'unit_id' => $validated['unit_id'],

            'position_id' => $validated['position_id'] ?? null,

            'nip' => $validated['nip'],

            'full_name' => $validated['full_name'],

            'gender' => $validated['gender'] ?? null,

            'birth_place' => $validated['birth_place'] ?? null,

            'birth_date' => $validated['birth_date'] ?? null,

            'last_education' => $validated['last_education'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'address' => $validated['address'] ?? null,

            'employment_status' => $validated['employment_status'] ?? null,

            'status' => $validated['status'],

            'photo' => $validated['photo'] ?? null,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    /**
     * DETAIL GURU
     */
    public function show(Teacher $guru)
    {
        $guru->load([
            'unit',
            'position',
            'teachingAssignments',
            'user',
        ]);

        return view('admin.guru.show', [
            'teacher' => $guru
        ]);
    }

    /**
     * FORM EDIT
     */
    public function edit(Teacher $guru)
    {
        $units = Unit::all();

        $positions = Position::all();

        return view('admin.guru.edit', [
            'teacher' => $guru,
            'units' => $units,
            'positions' => $positions,
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, Teacher $guru)
    {
        $validated = $request->validate([

            'unit_id' => 'required|exists:units,id',

            'position_id' => 'nullable|exists:positions,id',

            'nip' => 'required|string|max:50|unique:teachers,nip,' . $guru->id,

            'full_name' => 'required|string|max:255',

            'gender' => 'nullable|in:male,female',

            'birth_place' => 'nullable|string|max:100',

            'birth_date' => 'nullable|date',

            'last_education' => 'nullable|string|max:100',

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string',

            'employment_status' => 'nullable|in:pegawai_tetap,pegawai_tidak_tetap',

            'status' => 'required|in:active,inactive',

            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ]);

        /**
         * VALIDASI USERNAME USER
         */
        if (
            User::where('username', $validated['nip'])
            ->where('id', '!=', $guru->user_id)
            ->exists()
        ) {

            return back()
                ->withErrors([
                    'nip' => 'NIP sudah digunakan sebagai username login.'
                ])
                ->withInput();
        }

        /**
         * UPLOAD FOTO BARU
         */
        if ($request->hasFile('photo')) {

            /**
             * HAPUS FOTO LAMA
             */
            if ($guru->photo) {
                Storage::disk('public')->delete($guru->photo);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->decode($request->file('photo'));
            $image->cover(300, 300);

            $filename = time() . '_' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $directory = storage_path('app/public/teachers');

            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save($directory . '/' . $filename);
            $validated['photo'] = 'teachers/' . $filename;
        }

        /**
         * UPDATE USER LOGIN
         */
        if ($guru->user) {

            $guru->user->update([

                'name' => $validated['full_name'],

                'username' => $validated['nip'],

                'status' => $validated['status'],
            ]);
        }

        /**
         * UPDATE DATA GURU
         */
        $guru->update([

            'unit_id' => $validated['unit_id'],

            'position_id' => $validated['position_id'] ?? null,

            'nip' => $validated['nip'],

            'full_name' => $validated['full_name'],

            'gender' => $validated['gender'] ?? null,

            'birth_place' => $validated['birth_place'] ?? null,

            'birth_date' => $validated['birth_date'] ?? null,

            'last_education' => $validated['last_education'] ?? null,

            'phone' => $validated['phone'] ?? null,

            'address' => $validated['address'] ?? null,

            'employment_status' => $validated['employment_status'] ?? null,

            'status' => $validated['status'],

            'photo' => $validated['photo'] ?? $guru->photo,
        ]);

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diupdate');
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
            $unit     = Unit::find($request->unit_id);
            $unitName = $unit?->unit_name ?? 'SemuaUnit';
        }

        $filename = 'Data_Guru_' . str_replace(' ', '_', $unitName) . '.csv';

        return response()->streamDownload(function () use ($teachers) {

            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'NIP',
                'Nama Lengkap',
                'Unit',
                'Jabatan',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Pendidikan Terakhir',
                'No Telepon',
                'Alamat',
                'Status Kepegawaian',
                'Status',
            ]);

            foreach ($teachers as $teacher) {
                fputcsv($file, [
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
        return view('admin.guru.import');
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

            $nip  = trim($row[0] ?? '');
            $nama = trim($row[1] ?? '');

            if (!$nip || !$nama) {
                $gagal++;
                $errors[] = "Baris kosong dilewati (NIP: $nip)";
                continue;
            }

            if (Teacher::where('nip', $nip)->exists()) {
                $gagal++;
                $errors[] = "NIP $nip sudah terdaftar, dilewati";
                continue;
            }

            try {
                $user = User::create([
                    'name'     => $nama,
                    'username' => $nip,
                    'password' => Hash::make('12345678'),
                    'role'     => 'teacher',
                    'status'   => 'active',
                ]);

                // Cari unit berdasarkan nama
                $unit = Unit::where('unit_name', trim($row[2] ?? ''))->first();

                // Cari jabatan berdasarkan nama
                $position = Position::where('name', trim($row[3] ?? ''))->first();

                Teacher::create([
                    'user_id'           => $user->id,
                    'unit_id'           => $unit?->id ?? null,
                    'position_id'       => $position?->id ?? null,
                    'nip'               => $nip,
                    'full_name'         => $nama,
                    'gender'            => trim($row[4] ?? null) ?: null,
                    'birth_place'       => trim($row[5] ?? null) ?: null,
                    'birth_date'        => trim($row[6] ?? null) ?: null,
                    'last_education'    => trim($row[7] ?? null) ?: null,
                    'phone'             => trim($row[8] ?? null) ?: null,
                    'address'           => trim($row[9] ?? null) ?: null,
                    'employment_status' => trim($row[10] ?? null) ?: null,
                    'status'            => trim($row[11] ?? 'active') ?: 'active',
                ]);

                $berhasil++;
            } catch (\Exception $e) {
                $gagal++;
                $errors[] = "NIP $nip gagal: " . $e->getMessage();
            }
        }

        fclose($handle);

        $message = "Import selesai: $berhasil data berhasil";
        if ($gagal > 0) $message .= ", $gagal data dilewati";

        return redirect()
            ->route('admin.guru.index')
            ->with('success', $message)
            ->with('import_errors', $errors);
    }

    /**
     * DOWNLOAD TEMPLATE CSV GURU
     */
    public function importTemplate()
    {
        return response()->streamDownload(function () {

            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($file, [
                'NIP',
                'Nama Lengkap',
                'Unit',
                'Jabatan',
                'Jenis Kelamin (male/female)',
                'Tempat Lahir',
                'Tanggal Lahir (YYYY-MM-DD)',
                'Pendidikan Terakhir',
                'No Telepon',
                'Alamat',
                'Status Kepegawaian (pegawai_tetap/pegawai_tidak_tetap)',
                'Status (active/inactive)',
            ]);

            fputcsv($file, [
                '198501012010011001',
                'Nama Guru Contoh',
                'SD',
                'Guru Kelas',
                'male',
                'Pekanbaru',
                '1985-01-01',
                'S1',
                '08123456789',
                'Jl. Contoh No. 1',
                'pegawai_tetap',
                'active',
            ]);

            fclose($file);
        }, 'Template_Import_Guru.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * DELETE DATA
     */
    public function destroy(Teacher $guru)
    {
        /**
         * HAPUS FOTO
         */
        if ($guru->photo) {

            Storage::disk('public')->delete($guru->photo);
        }

        /**
         * HAPUS USER LOGIN
         */
        if ($guru->user) {

            $guru->user->delete();
        }

        /**
         * HAPUS DATA GURU
         */
        $guru->delete();

        return redirect()
            ->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
