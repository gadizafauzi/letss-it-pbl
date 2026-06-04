<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TeachingAssignment;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\AcademicYear;

class MengajarController extends Controller
{
    /**
     * LIST DATA
     */
    public function index(Request $request)
    {
        $teachingAssignments = TeachingAssignment::with([
            'teacher',
            'subject',
            'schoolClass.unit',
            'academicYear'
        ])
            ->when($request->search, function ($query) use ($request) {

                $query->where(function ($q) use ($request) {

                    $q->whereHas('teacher', function ($t) use ($request) {
                        $t->where('full_name', 'like', "%{$request->search}%");
                    })

                        ->orWhereHas('subject', function ($s) use ($request) {
                            $s->where('subject_name', 'like', "%{$request->search}%");
                        })

                        ->orWhereHas('schoolClass', function ($c) use ($request) {
                            $c->where('class_name', 'like', "%{$request->search}%");
                        });
                });
            })
            ->when($request->academic_year_id, function ($query) use ($request) {
                $query->where('academic_year_id', $request->academic_year_id);
            })
            ->when($request->class_id, function ($query) use ($request) {
                $query->where('class_id', $request->class_id);
            })
            ->latest()
            ->paginate(15);

        $academicYears = AcademicYear::orderByDesc('id')->get();
        $classes       = SchoolClass::orderBy('class_name')->get();

        return view('admin.mengajar.index', compact(
            'teachingAssignments',
            'academicYears',
            'classes'
        ));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        return view('admin.mengajar.create', [
            'teachers' => Teacher::orderBy('full_name')->get(),
            'subjects' => Subject::orderBy('subject_name')->get(),
            'classes'  => SchoolClass::orderBy('class_name')->get(),
            'years'    => AcademicYear::orderByDesc('id')->get(),
        ]);
    }

    /**
     * STORE DATA
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',

            // ❗ FIX INI
            'class_id' => 'required|exists:classes,id',

            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        TeachingAssignment::create($request->only([
            'teacher_id',
            'subject_id',
            'class_id',
            'academic_year_id'
        ]));

        return redirect()
            ->route('admin.mengajar.index')
            ->with('success', 'Data mengajar berhasil ditambahkan');
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $teachingAssignment = TeachingAssignment::findOrFail($id);

        return view('admin.mengajar.edit', [
            'teachingAssignment' => $teachingAssignment,
            'teachers' => Teacher::orderBy('full_name')->get(),
            'subjects' => Subject::orderBy('subject_name')->get(),
            'classes'  => SchoolClass::orderBy('class_name')->get(),
            'years'    => AcademicYear::orderByDesc('id')->get(),
        ]);
    }

    /**
     * UPDATE DATA
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',

            // ❗ FIX INI
            'class_id' => 'required|exists:classes,id',

            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $ta = TeachingAssignment::findOrFail($id);

        $ta->update($request->only([
            'teacher_id',
            'subject_id',
            'class_id',
            'academic_year_id'
        ]));

        return redirect()
            ->route('admin.mengajar.index')
            ->with('success', 'Data mengajar berhasil diupdate');
    }

    /**
     * DELETE DATA
     */
    public function destroy($id)
    {
        TeachingAssignment::findOrFail($id)->delete();

        return redirect()
            ->route('admin.mengajar.index')
            ->with('success', 'Data mengajar berhasil dihapus');
    }
}
