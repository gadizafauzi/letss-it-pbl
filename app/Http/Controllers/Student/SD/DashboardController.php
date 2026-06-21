<?php

namespace App\Http\Controllers\Student\SD;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Grade;
use App\Services\Student\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass', 'currentClass.academicYear'])
            ->firstOrFail();

        $activeYear = AcademicYear::where('status', 'active')->first();

        $stats = $this->dashboardService->getStats($student, $activeYear);

        return view('student.sd.dashboard', [
            'student'        => $student,
            'activeYear'     => $activeYear,
            'tagihanSaatIni' => $stats['tagihanSaatIni'],
            'totalTerbayar'  => $stats['totalTerbayar'],
            'jumlahMapel'    => $stats['jumlahMapel'],
            'rataRataNilai'  => $stats['rataRataNilai'],
        ]);
    }

    public function cetakKtm()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass'])
            ->firstOrFail();

        return view('student.cetak-ktm', compact('student'));
    }
}
