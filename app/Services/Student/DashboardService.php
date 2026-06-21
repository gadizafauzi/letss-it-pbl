<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Grade;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    /**
     * Get dashboard statistics for a student.
     *
     * @param Student $student
     * @param AcademicYear|null $activeYear
     * @return array
     */
    public function getStats(Student $student, ?AcademicYear $activeYear): array
    {
        // Gunakan cache selama 10 menit untuk mengurangi beban query
        return Cache::remember('student.dashboard.stats.' . $student->id, now()->addMinutes(10), function () use ($student, $activeYear) {
            
            // Hitung Invoice/Tagihan
            $tagihanSaatIni = Invoice::where('student_id', $student->id)
                ->where('status', 'unpaid')
                ->sum('amount');

            $totalTerbayar = Invoice::where('student_id', $student->id)
                ->where('status', 'paid')
                ->sum('amount');

            // Hitung jumlah mata pelajaran dari nilai semester aktif yang sudah di-publish
            $jumlahMapel = Grade::where('student_id', $student->id)
                ->where('academic_year_id', $activeYear?->id)
                ->where('semester', $activeYear?->active_semester ?? 'odd')
                ->where('status', 'published')
                ->count();

            // Hitung rata-rata nilai akhir dari semester aktif yang sudah di-publish
            $rataRataNilaiScore = Grade::where('student_id', $student->id)
                ->where('academic_year_id', $activeYear?->id)
                ->where('semester', $activeYear?->active_semester ?? 'odd')
                ->where('status', 'published')
                ->whereNotNull('final_score')
                ->avg('final_score');
            
            $rataRataNilai = $rataRataNilaiScore !== null ? round($rataRataNilaiScore, 1) : '-';

            return [
                'tagihanSaatIni' => $tagihanSaatIni,
                'totalTerbayar'  => $totalTerbayar,
                'jumlahMapel'    => $jumlahMapel,
                'rataRataNilai'  => $rataRataNilai,
            ];
        });
    }
}
