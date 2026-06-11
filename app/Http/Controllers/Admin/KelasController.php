<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\StoreKelasRequest;
use App\Http\Requests\Admin\UpdateKelasRequest;
use App\Models\SchoolClass;
use App\Models\Unit;
use App\Models\Teacher;
use App\Models\StudentClass;
use App\Models\AcademicYear;

class KelasController extends Controller
{
    /**
     * =========================================================
     * LIST DATA KELAS
     * =========================================================
     */
    public function index(Request $request)
    {
        /**
         * QUERY
         */
        $query = SchoolClass::with([
            'unit',
            'homeroomTeacher',
        ]);

        /**
         * SEARCH
         */
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'class_name',
                    'like',
                    '%' . $request->search . '%'
                )

                    ->orWhereHas('homeroomTeacher', function ($teacher) use ($request) {

                        $teacher->where(
                            'full_name',
                            'like',
                            '%' . $request->search . '%'
                        );
                    });
            });
        }

        /**
         * FILTER UNIT
         */
        if ($request->unit_id) {

            $query->where(
                'unit_id',
                $request->unit_id
            );
        }

        /**
         * GET DATA
         */
        $classes = $query
            ->latest()
            ->paginate($request->get('per_page', 10));

        /**
         * TAHUN AJARAN AKTIF
         */
        $activeAcademicYear = AcademicYear::where(
            'status',
            'active'
        )->first();

        /**
         * HITUNG JUMLAH SISWA
         */
        foreach ($classes as $class) {

            $class->students_count = StudentClass::where(
                'class_id',
                $class->id
            )

                ->when($activeAcademicYear, function ($q) use ($activeAcademicYear) {

                    $q->where(
                        'academic_year_id',
                        $activeAcademicYear->id
                    );
                })

                ->count();
        }

        /**
         * DATA UNIT
         */
        $units = Unit::all();

        return view('admin.kelas.index', compact(
            'classes',
            'units'
        ));
    }

    /**
     * =========================================================
     * FORM CREATE
     * =========================================================
     */
    public function create()
    {
        /**
         * UNIT
         */
        $units = Unit::all();

        /**
         * GURU AKTIF
         */
        $teachers = Teacher::where(
            'status',
            'active'
        )
            ->orderBy('full_name')
            ->get();

        return view('admin.kelas.create', compact(
            'units',
            'teachers'
        ));
    }

    /**
     * =========================================================
     * STORE DATA
     * =========================================================
     */
    public function store(StoreKelasRequest $request)
    {
        $validated = $request->validated();

        /**
         * CEK DUPLIKAT
         */
        $exists = SchoolClass::where(
            'unit_id',
            $validated['unit_id']
        )

            ->where(
                'class_name',
                $validated['class_name']
            )

            ->exists();

        if ($exists) {

            return back()

                ->withInput()

                ->withErrors([
                    'class_name' =>
                    'Kelas sudah ada pada unit ini.'
                ]);
        }

        /**
         * SIMPAN DATA
         */
        SchoolClass::create($validated);

        return redirect()

            ->route('admin.kelas.index')

            ->with(
                'success',
                'Data kelas berhasil ditambahkan.'
            );
    }

    /**
     * =========================================================
     * DETAIL DATA
     * =========================================================
     */
    public function show(SchoolClass $kela)
    {
        /**
         * TAHUN AJARAN AKTIF
         */
        $activeAcademicYear = AcademicYear::where(
            'status',
            'active'
        )->first();

        /**
         * LOAD RELATION
         */
        $kela->load([
            'unit',
            'homeroomTeacher',
        ]);

        /**
         * DATA SISWA
         */
        $students = StudentClass::with([
            'student'
        ])

            ->where(
                'class_id',
                $kela->id
            )

            ->when($activeAcademicYear, function ($q) use ($activeAcademicYear) {

                $q->where(
                    'academic_year_id',
                    $activeAcademicYear->id
                );
            })

            ->get();

        return view('admin.kelas.show', [

            'class' => $kela,

            'students' => $students,

            'activeAcademicYear' => $activeAcademicYear,
        ]);
    }

    /**
     * =========================================================
     * FORM EDIT
     * =========================================================
     */
    public function edit(SchoolClass $kela)
    {
        /**
         * UNIT
         */
        $units = Unit::all();

        /**
         * GURU AKTIF
         */
        $teachers = Teacher::where(
            'status',
            'active'
        )
            ->orderBy('full_name')
            ->get();

        return view('admin.kelas.edit', [

            'class' => $kela,

            'units' => $units,

            'teachers' => $teachers,
        ]);
    }

    /**
     * =========================================================
     * UPDATE DATA
     * =========================================================
     */
    public function update(
        UpdateKelasRequest $request,
        SchoolClass $kela
    ) {
        $validated = $request->validated();

        /**
         * CEK DUPLIKAT
         */
        $exists = SchoolClass::where(
            'unit_id',
            $validated['unit_id']
        )

            ->where(
                'class_name',
                $validated['class_name']
            )

            ->where(
                'id',
                '!=',
                $kela->id
            )

            ->exists();

        if ($exists) {

            return back()

                ->withInput()

                ->withErrors([
                    'class_name' =>
                    'Kelas sudah ada pada unit ini.'
                ]);
        }

        /**
         * UPDATE DATA
         */
        $kela->update($validated);

        return redirect()

            ->route('admin.kelas.index')

            ->with(
                'success',
                'Data kelas berhasil diupdate.'
            );
    }

    /**
     * =========================================================
     * DELETE DATA
     * =========================================================
     */
    public function destroy(SchoolClass $kela)
    {
        /**
         * CEK APAKAH MASIH DIGUNAKAN
         */
        $used = StudentClass::where(
            'class_id',
            $kela->id
        )->exists();

        if ($used) {

            return back()

                ->with(
                    'error',
                    'Kelas tidak dapat dihapus karena masih digunakan.'
                );
        }

        /**
         * DELETE
         */
        $kela->delete();

        return redirect()

            ->route('admin.kelas.index')

            ->with(
                'success',
                'Data kelas berhasil dihapus.'
            );
    }
}
