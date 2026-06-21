<?php

namespace App\Http\Controllers\Admin\Akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TeachingAssignment;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Http\Requests\Admin\Akademik\StoreMengajarRequest;
use App\Http\Requests\Admin\Akademik\UpdateMengajarRequest;
use App\Http\Requests\Admin\Akademik\BulkDestroyMengajarRequest;

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
            ->paginate($request->get('per_page', 10));

        $academicYears = AcademicYear::orderByDesc('id')->get();
        $classes       = SchoolClass::orderBy('class_name')->get();

        return view('admin.akademik.mengajar.index', compact(
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
        return view('admin.akademik.mengajar.create', [
            'teachers' => Teacher::orderBy('full_name')->get(),
            'subjects' => Subject::orderBy('subject_name')->get(),
            'classes'  => SchoolClass::orderBy('class_name')->get(),
            'years'    => AcademicYear::orderByDesc('id')->get(),
        ]);
    }

    /**
     * STORE DATA
     */
    public function store(StoreMengajarRequest $request)
    {
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

        return view('admin.akademik.mengajar.edit', [
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
    public function update(UpdateMengajarRequest $request, $id)
    {
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

    /**
     * DELETE MASSAL DATA
     */
    public function bulkDestroy(BulkDestroyMengajarRequest $request)
    {
        $assignments = TeachingAssignment::whereIn('id', $request->ids)->get();

        foreach ($assignments as $assignment) {
            $assignment->delete();
        }

        return redirect()
            ->route('admin.mengajar.index')
            ->with('success', count($assignments) . ' data mengajar berhasil dihapus');
    }
}
