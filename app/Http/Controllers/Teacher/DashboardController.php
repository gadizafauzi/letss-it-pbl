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
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // cek apakah guru jadi wali kelas di tahun ajaran aktif
        $homeroomClass = SchoolClass::where(
            'homeroom_teacher_id',
            $teacher->id
        )->where('academic_year_id', $activeYear?->id)->first();

        // Hitung statistik wali kelas jika ada
        $totalWaliStudents = 0;
        $classAverage = '-';
        if ($homeroomClass) {
            $totalWaliStudents = Student::where('class_id', $homeroomClass->id)->count();

            $classStudentIds = Student::where('class_id', $homeroomClass->id)->pluck('id');
            $averageScore = Grade::whereIn('student_id', $classStudentIds)
                ->where('academic_year_id', $activeYear?->id)
                ->avg('final_score');

            $classAverage = $averageScore !== null ? round($averageScore, 1) : '-';
        }

        // Ambil semua kelas yang diajar oleh guru di tahun ajaran aktif
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with(['class', 'subject'])
            ->get();

        foreach ($assignments as $assignment) {
            if ($assignment->class) {
                $assignment->student_count = Student::where('class_id', $assignment->class_id)->count();
            } else {
                $assignment->student_count = 0;
            }
        }

        $totalKelasDiajar = $assignments->pluck('class_id')->unique()->count();

        // Hitung total siswa yang diajar (lintas kelas)
        $classIds = $assignments->pluck('class_id')->unique();
        $totalSiswaDiajar = Student::whereIn('class_id', $classIds)->count();

        // Hitung total mapel yang diajar
        $totalMapelDiajar = $assignments->pluck('subject_id')->unique()->count();

        // Hitung rata-rata nilai mapel yang diajar
        $assignmentIds = $assignments->pluck('id');
        $subjectAverageScore = Grade::whereIn('teaching_assignment_id', $assignmentIds)
            ->where('academic_year_id', $activeYear?->id)
            ->avg('final_score');
        $subjectAverage = $subjectAverageScore !== null ? round($subjectAverageScore, 1) : '-';

        return view('teacher.dashboard', [
            'teacher' => $teacher,
            'homeroomClass' => $homeroomClass,
            'totalKelasDiajar' => $totalKelasDiajar,
            'totalSiswaDiajar' => $totalSiswaDiajar,
            'totalMapelDiajar' => $totalMapelDiajar,
            'subjectAverage' => $subjectAverage,
            'totalWaliStudents' => $totalWaliStudents,
            'classAverage' => $classAverage,
            'assignments' => $assignments,
        ]);
    }
}
