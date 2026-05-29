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
        $activeYear = AcademicYear::where('status', 'active')->first();

        // cek apakah guru memiliki jabatan Wali Kelas dan ditugaskan di suatu kelas
        $homeroomClass = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $homeroomClass = SchoolClass::where(
                'homeroom_teacher_id',
                $teacher->id
            )->first();
        }

        // Hitung statistik wali kelas jika ada
        $totalWaliStudents = 0;
        $classAverage = '-';
        if ($homeroomClass) {
            $classStudentIds = \App\Models\StudentClass::where('class_id', $homeroomClass->id)
                ->where('academic_year_id', $activeYear?->id)
                ->pluck('student_id');
                
            $totalWaliStudents = $classStudentIds->count();
            $averageScore = Grade::whereIn('student_id', $classStudentIds)
                ->where('academic_year_id', $activeYear?->id)
                ->avg('final_score');

            $classAverage = $averageScore !== null ? round($averageScore, 1) : '-';
        }

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
