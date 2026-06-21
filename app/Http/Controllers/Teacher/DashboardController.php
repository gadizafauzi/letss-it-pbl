<?php

namespace App\Http\Controllers\Teacher;

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
        
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $homeroomClass = \App\Models\SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
            if ($homeroomClass) {
                return redirect()->route('teacher.wali-kelas.dashboard');
            }
        }

        $activeYear = AcademicYear::where('status', 'active')->first();

        $stats = $this->dashboardService->getStats($teacher, $activeYear);

        return view('teacher.dashboard.index', [
            'teacher' => $teacher,
            'totalKelasDiajar' => $stats['totalKelasDiajar'],
            'totalSiswaDiajar' => $stats['totalSiswaDiajar'],
            'totalMapelDiajar' => $stats['totalMapelDiajar'],
            'subjectAverage' => $stats['subjectAverage'],
            'assignments' => $stats['assignments'],
        ]);
    }
}
