<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['class.academicYear'])
            ->firstOrFail();

        $activeYear = AcademicYear::where('status', 'active')->first();

        // Hitung Invoice/Tagihan
        $tagihanSaatIni = Invoice::where('student_id', $student->id)
            ->where('status', 'unpaid')
            ->sum('amount');

        $totalTerbayar = Invoice::where('student_id', $student->id)
            ->where('status', 'paid')
            ->sum('amount');

        // KIP Kuliah overrides unpaid bills
        if ($student->is_kip_kuliah) {
            $tagihanSaatIni = 0;
        }

        return view('student.dashboard', compact('student', 'activeYear', 'tagihanSaatIni', 'totalTerbayar'));
    }

    public function cetakKtm()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['class'])
            ->firstOrFail();

        return view('student.cetak-ktm', compact('student'));
    }
}
