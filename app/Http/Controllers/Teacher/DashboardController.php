<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\TeachingAssignment;
use App\Models\Student;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = Teacher::with('position')->where('user_id', auth()->id())->firstOrFail();
        
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $homeroomClass = \App\Models\SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
            if ($homeroomClass) {
                return redirect()->route('teacher.wali-kelas.dashboard');
            }
        }

        $activeYear = AcademicYear::where('status', 'active')->first();



        // Ambil semua kelas yang diajar oleh guru di tahun ajaran aktif
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with(['schoolClass', 'subject'])
            ->get();

        foreach ($assignments as $assignment) {
            if ($assignment->schoolClass) {
                $assignment->student_count = \App\Models\StudentClass::where('class_id', $assignment->class_id)
                    ->where('academic_year_id', $activeYear?->id)
                    ->count();
            } else {
                $assignment->student_count = 0;
            }
        }

        $totalKelasDiajar = $assignments->pluck('class_id')->unique()->count();

        // Hitung total siswa yang diajar (lintas kelas)
        $classIds = $assignments->pluck('class_id')->unique();
        $totalSiswaDiajar = \App\Models\StudentClass::whereIn('class_id', $classIds)
            ->where('academic_year_id', $activeYear?->id)
            ->count();

        // Hitung total mapel yang diajar (sesuai jumlah penugasan)
        $totalMapelDiajar = $assignments->count();

        // Hitung rata-rata nilai mapel yang diajar
        $assignmentIds = $assignments->pluck('id');
        $subjectAverageScore = Grade::whereIn('teaching_assignment_id', $assignmentIds)
            ->where('academic_year_id', $activeYear?->id)
            ->avg('final_score');
        $subjectAverage = $subjectAverageScore !== null ? round($subjectAverageScore, 1) : '-';

        return view('teacher.dashboard.index', [
            'teacher' => $teacher,
            'totalKelasDiajar' => $totalKelasDiajar,
            'totalSiswaDiajar' => $totalSiswaDiajar,
            'totalMapelDiajar' => $totalMapelDiajar,
            'subjectAverage' => $subjectAverage,
            'assignments' => $assignments,
        ]);
    }
}
