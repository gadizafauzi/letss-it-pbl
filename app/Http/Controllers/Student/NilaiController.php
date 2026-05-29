<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Grade;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();
        
        $activeYear = AcademicYear::where('status', 'active')->first();
        $semester = $request->input('semester', $activeYear?->active_semester ?? 'even');

        $grades = Grade::where('student_id', $student->id)
            ->where('academic_year_id', $activeYear?->id)
            ->where('semester', $semester)
            ->with(['teachingAssignment.subject', 'teachingAssignment.teacher'])
            ->get();

        return view('student.nilai', compact('student', 'grades', 'activeYear', 'semester'));
    }
}
