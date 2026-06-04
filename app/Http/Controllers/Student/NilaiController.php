<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\Grade;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())
            ->with(['currentClass.schoolClass'])
            ->firstOrFail();

        $activeYear = AcademicYear::where('status', 'active')->first();

        // Ambil semua tahun ajaran di mana siswa pernah terdaftar di kelas
        // (bukan hanya yang punya nilai, agar siswa bisa lihat nilai kelas lama)
        $enrolledYearIds = \App\Models\StudentClass::where('student_id', $student->id)
            ->pluck('academic_year_id');

        $academicYears = AcademicYear::whereIn('id', $enrolledYearIds)
            ->orderBy('year', 'desc')
            ->get();

        // Jika siswa belum pernah masuk kelas apapun, tampilkan tahun aktif
        if ($academicYears->isEmpty() && $activeYear) {
            $academicYears = collect([$activeYear]);
        }

        // Tahun ajaran yang dipilih (default: aktif, atau pertama dari daftar)
        $selectedYearId = $request->input('year_id', $activeYear?->id ?? $academicYears->first()?->id);
        $selectedYear   = $academicYears->firstWhere('id', $selectedYearId) ?? $academicYears->first();

        // Semester yang dipilih (default: semester aktif dari tahun terpilih)
        $semester = $request->input('semester', $selectedYear?->active_semester ?? 'odd');

        $grades = Grade::where('student_id', $student->id)
            ->where('academic_year_id', $selectedYear?->id)
            ->where('semester', $semester)
            ->with(['teachingAssignment.subject', 'teachingAssignment.teacher'])
            ->get();

        // Buat map: academic_year_id => nama kelas siswa saat itu
        $classPerYear = \App\Models\StudentClass::where('student_id', $student->id)
            ->whereIn('academic_year_id', $enrolledYearIds)
            ->with('schoolClass')
            ->get()
            ->keyBy('academic_year_id')
            ->map(fn($sc) => $sc->schoolClass?->class_name ?? '-');

        return view('student.nilai', compact(
            'student', 'grades',
            'activeYear', 'academicYears',
            'selectedYear', 'semester',
            'classPerYear'
        ));
    }
}
