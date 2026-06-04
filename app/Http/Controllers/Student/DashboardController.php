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
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass', 'currentClass.academicYear'])
            ->firstOrFail();

        $activeYear = AcademicYear::where('status', 'active')->first();

        // Hitung Invoice/Tagihan
        $tagihanSaatIni = Invoice::where('student_id', $student->id)
            ->where('status', 'unpaid')
            ->sum('amount');

        $totalTerbayar = Invoice::where('student_id', $student->id)
            ->where('status', 'paid')
            ->sum('amount');

        // Hitung jumlah mata pelajaran dari nilai semester aktif
        $jumlahMapel = Grade::where('student_id', $student->id)
            ->where('academic_year_id', $activeYear?->id)
            ->where('semester', $activeYear?->active_semester ?? 'odd')
            ->count();

        // Hitung rata-rata nilai akhir dari semester aktif
        $rataRataNilai = Grade::where('student_id', $student->id)
            ->where('academic_year_id', $activeYear?->id)
            ->where('semester', $activeYear?->active_semester ?? 'odd')
            ->whereNotNull('final_score')
            ->avg('final_score');
        $rataRataNilai = $rataRataNilai !== null ? round($rataRataNilai, 1) : '-';

        return view('student.dashboard', compact(
            'student', 'activeYear',
            'tagihanSaatIni', 'totalTerbayar',
            'jumlahMapel', 'rataRataNilai'
        ));
    }

    public function cetakKtm()
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass'])
            ->firstOrFail();

        return view('student.cetak-ktm', compact('student'));
    }
}
