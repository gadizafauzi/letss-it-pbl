<?php

namespace App\Services\Teacher;

use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\TeachingAssignment;
use App\Models\StudentClass;
use App\Models\Grade;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    /**
     * Get dashboard statistics for a teacher.
     *
     * @param Teacher $teacher
     * @param AcademicYear|null $activeYear
     * @param SchoolClass|null $homeroomClass
     * @return array
     */
    public function getStats(Teacher $teacher, ?AcademicYear $activeYear, ?SchoolClass $homeroomClass = null): array
    {
        return Cache::remember('teacher.dashboard.stats.' . $teacher->id, now()->addMinutes(10), function () use ($teacher, $activeYear, $homeroomClass) {
            
            // Statistik Wali Kelas
            $totalWaliStudents = 0;
            $classAverage = '-';
            
            if ($homeroomClass) {
                $classStudentIds = StudentClass::where('class_id', $homeroomClass->id)
                    ->where('academic_year_id', $activeYear?->id)
                    ->pluck('student_id');
                    
                $totalWaliStudents = $classStudentIds->count();
                $averageScore = Grade::whereIn('student_id', $classStudentIds)
                    ->where('academic_year_id', $activeYear?->id)
                    ->whereIn('status', ['final', 'published'])
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
                    $assignment->student_count = StudentClass::where('class_id', $assignment->class_id)
                        ->where('academic_year_id', $activeYear?->id)
                        ->count();
                } else {
                    $assignment->student_count = 0;
                }
            }

            $totalKelasDiajar = $assignments->pluck('class_id')->unique()->count();

            // Hitung total siswa yang diajar (lintas kelas)
            $classIds = $assignments->pluck('class_id')->unique();
            $totalSiswaDiajar = StudentClass::whereIn('class_id', $classIds)
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

            return [
                'totalWaliStudents' => $totalWaliStudents,
                'classAverage'      => $classAverage,
                'assignments'       => $assignments,
                'totalKelasDiajar'  => $totalKelasDiajar,
                'totalSiswaDiajar'  => $totalSiswaDiajar,
                'totalMapelDiajar'  => $totalMapelDiajar,
                'subjectAverage'    => $subjectAverage,
            ];
        });
    }
}
