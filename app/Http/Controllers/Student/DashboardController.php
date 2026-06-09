<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->with('unit')->firstOrFail();
        $unitName = strtolower($student->unit->unit_name ?? 'smp');

        if ($unitName === 'sd') {
            return redirect()->route('student.sd.dashboard');
        }

        return redirect()->route('student.smp.dashboard');
    }

    public function cetakKtm()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass'])
            ->firstOrFail();

        return view('student.cetak-ktm', compact('student'));
    }
}
