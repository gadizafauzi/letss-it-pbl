<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;
use App\Models\Unit;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class KenaikanKelasController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::orderBy('year', 'desc')->get();
        $units = Unit::all();
        $classes = SchoolClass::orderBy('class_name')->get();

        return view('admin.kenaikan-kelas.index', compact('academicYears', 'units', 'classes'));
    }

    public function getStudents(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'class_id' => 'required',
            'academic_year_id' => 'required',
        ]);

        $students = Student::where('unit_id', $request->unit_id)
            ->whereHas('studentClasses', function ($q) use ($request) {
                $q->where('class_id', $request->class_id)
                  ->where('academic_year_id', $request->academic_year_id);
            })
            ->orderBy('full_name')
            ->get(['id', 'nis', 'full_name', 'status']);

        return response()->json($students);
    }

    public function process(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:students,id',
            'target_academic_year_id' => 'required|exists:academic_years,id',
            'target_class_id' => 'required|exists:classes,id',
            'target_unit_id' => 'required|exists:units,id',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->student_ids as $studentId) {
                // Update the unit on the student model itself just in case they change unit (e.g., TK to SD)
                $student = Student::find($studentId);
                $student->unit_id = $request->target_unit_id;
                $student->save();

                // Add or update the student_classes pivot table
                StudentClass::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'academic_year_id' => $request->target_academic_year_id,
                    ],
                    [
                        'class_id' => $request->target_class_id,
                    ]
                );
            }
            DB::commit();

            return redirect()->back()->with('success', count($request->student_ids) . ' siswa berhasil dipindahkan ke kelas yang baru.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
