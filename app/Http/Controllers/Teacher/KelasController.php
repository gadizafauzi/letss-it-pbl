<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\TeachingAssignment;
use App\Models\Student;
use App\Models\Grade;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function kelasSaya()
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with(['schoolClass.studentClasses', 'subject'])
            ->get();

        return view('teacher.kelas-saya', compact('assignments'));
    }

    public function dataSiswa($classId)
    {
        $class = SchoolClass::with('studentClasses.student')->findOrFail($classId);

        return view('teacher.data-siswa', compact('class'));
    }

    public function inputNilai(Request $request, $assignmentId = null)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // Ambil semua jadwal mengajar milik guru tersebut
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with(['schoolClass', 'subject', 'academicYear'])
            ->get();

        $selectedAssignment = null;
        $students = collect();

        if ($assignmentId) {
            // Cari jadwal mengajar yang dipilih
            $selectedAssignment = $assignments->where('id', $assignmentId)->first();
        } elseif ($assignments->isNotEmpty()) {
            // Default ke penugasan pertama
            $selectedAssignment = $assignments->first();
            $assignmentId = $selectedAssignment->id;
        }

        if ($selectedAssignment) {
            $studentIds = \App\Models\StudentClass::where('class_id', $selectedAssignment->class_id)
                ->where('academic_year_id', $activeYear?->id)
                ->pluck('student_id');

            // Ambil daftar siswa kelas tersebut beserta nilainya khusus untuk mapel ini
            $students = Student::whereIn('id', $studentIds)
                ->with(['grades' => function ($query) use ($selectedAssignment) {
                    $query->where('teaching_assignment_id', $selectedAssignment->id);
                }])
                ->get();
        }

        return view('teacher.input-nilai', [
            'assignments' => $assignments,
            'selectedAssignment' => $selectedAssignment,
            'students' => $students,
            'assignmentId' => $assignmentId,
        ]);
    }

    public function storeNilai(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:teaching_assignments,id',
            'grades' => 'required|array',
            'grades.*.uts' => 'nullable|numeric|min:0|max:100',
            'grades.*.uas' => 'nullable|numeric|min:0|max:100',
            'grades.*.tugas' => 'nullable|numeric|min:0|max:100',
        ]);

        $assignment = TeachingAssignment::with('academicYear')->findOrFail($request->assignment_id);

        foreach ($request->grades as $studentId => $scores) {
            $uts = $scores['uts'] !== '' ? $scores['uts'] : null;
            $uas = $scores['uas'] !== '' ? $scores['uas'] : null;
            $tugas = $scores['tugas'] !== '' ? $scores['tugas'] : null;

            // Hitung rata-rata
            $finalScore = null;
            if ($uts !== null || $uas !== null || $tugas !== null) {
                $count = 0;
                $sum = 0;
                if ($uts !== null) { $sum += $uts; $count++; }
                if ($uas !== null) { $sum += $uas; $count++; }
                if ($tugas !== null) { $sum += $tugas; $count++; }
                $finalScore = $count > 0 ? round($sum / $count, 2) : null;
            }

            // Tentukan grade letter sederhana
            $gradeLetter = null;
            if ($finalScore !== null) {
                if ($finalScore >= 85) $gradeLetter = 'A';
                elseif ($finalScore >= 75) $gradeLetter = 'B';
                elseif ($finalScore >= 60) $gradeLetter = 'C';
                else $gradeLetter = 'D';
            }

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'teaching_assignment_id' => $assignment->id,
                    'academic_year_id' => $assignment->academic_year_id,
                    'semester' => $assignment->academicYear->active_semester ?? 'even',
                ],
                [
                    'mid_exam' => $uts,
                    'final_exam' => $uas,
                    'assignment_score' => $tugas,
                    'final_score' => $finalScore,
                    'grade_letter' => $gradeLetter,
                    'status' => 'draft',
                ]
            );
        }

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

}
