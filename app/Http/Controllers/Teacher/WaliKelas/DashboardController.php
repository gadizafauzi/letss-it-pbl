<?php

namespace App\Http\Controllers\Teacher\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\TeachingAssignment;
use App\Models\Student;
use App\Models\Grade;
use App\Services\Teacher\DashboardService;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

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

        $stats = $this->dashboardService->getStats($teacher, $activeYear, $homeroomClass);

        return view('teacher.wali-kelas.dashboard', [
            'teacher' => $teacher,
            'homeroomClass' => $homeroomClass,
            'totalKelasDiajar' => $stats['totalKelasDiajar'],
            'totalSiswaDiajar' => $stats['totalSiswaDiajar'],
            'totalMapelDiajar' => $stats['totalMapelDiajar'],
            'subjectAverage' => $stats['subjectAverage'],
            'totalWaliStudents' => $stats['totalWaliStudents'],
            'classAverage' => $stats['classAverage'],
            'assignments' => $stats['assignments'],
        ]);
    }
}
