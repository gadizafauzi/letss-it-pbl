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

class SiswaController extends Controller
{
    /**
     * LIST DATA SISWA
     */
    public function index()
    {
        $students = Student::with([
            'unit',
            'studentClasses.schoolClass',
            'studentClasses.academicYear'
        ])->latest()->get();

        $units = Unit::all();

        $classes = SchoolClass::all();

        return view('admin.siswa.index', compact(
            'students',
            'units',
            'classes'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $units = Unit::all();

        $classes = SchoolClass::all();

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

        /**
         * UPLOAD FOTO
         */
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request
                ->file('photo')
                ->store('students', 'public');
        }

        /**
         * CREATE USER LOGIN
         */
        $user = User::create([
            'name'     => $validated['full_name'],
            'username' => $validated['nis'],
            'password' => Hash::make('12345678'),
            'role'     => 'student',
            'status'   => 'active',
        ]);

        /**
         * CREATE STUDENT
         */
        $student = Student::create([
            'user_id'      => $user->id,
            'unit_id'      => $validated['unit_id'] ?? null,
            'nis'          => $validated['nis'],
            'nisn'         => $validated['nisn'],
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

        /**
         * INSERT KELAS SISWA
         */
        if ($request->class_id && $request->academic_year_id) {
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

        $units        = Unit::all();
        $classes      = SchoolClass::all();
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

        /**
         * UPLOAD FOTO BARU
         */
        if ($request->hasFile('photo')) {
            if ($siswa->photo) {
                Storage::disk('public')->delete($siswa->photo);
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store('students', 'public');
        }

        /**
         * UPDATE USER LOGIN
         */
        if ($siswa->user) {
            $siswa->user->update([
                'name'     => $validated['full_name'],
                'username' => $validated['nis'],
            ]);
        }

        /**
         * UPDATE STUDENT
         */
        $siswa->update([
            'unit_id'      => $validated['unit_id'] ?? null,
            'nis'          => $validated['nis'],
            'nisn'         => $validated['nisn'],
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

        /**
         * UPDATE KELAS AKTIF
         * Hapus kelas lama lalu insert baru (tanpa is_active)
         */
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
