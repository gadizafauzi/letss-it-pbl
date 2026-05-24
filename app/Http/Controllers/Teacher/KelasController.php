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
            ->with(['class.students', 'subject'])
            ->get();

        return view('teacher.kelas-saya', compact('assignments'));
    }

    public function dataSiswa($classId)
    {
        $class = SchoolClass::with('students')->findOrFail($classId);

        return view('teacher.data-siswa', compact('class'));
    }

    public function inputNilai(Request $request, $assignmentId = null)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // Ambil semua jadwal mengajar milik guru tersebut
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with(['class', 'subject', 'academicYear'])
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
            // Ambil daftar siswa kelas tersebut beserta nilainya khusus untuk mapel ini
            $students = Student::where('class_id', $selectedAssignment->class_id)
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

    public function waliDataSiswa(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();
        $class = SchoolClass::where('homeroom_teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with('academicYear')
            ->first();

        $students = collect();
        if ($class) {
            $query = Student::where('class_id', $class->id);

            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function($q) use ($search) {
                    $q->where('full_name', 'like', '%' . $search . '%')
                      ->orWhere('nis', 'like', '%' . $search . '%');
                });
            }

            if ($request->filled('status')) {
                $status = $request->input('status');
                if ($status !== 'all') {
                    $query->where('status', $status);
                }
            }

            $students = $query->get();
        }

        return view('teacher.wali-data-siswa', [
            'class' => $class,
            'students' => $students,
            'homeroomClass' => $class
        ]);
    }

    public function waliRekapNilai(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();
        $class = SchoolClass::where('homeroom_teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with('academicYear')
            ->first();

        $subjects = collect();
        $students = collect();
        $selectedSubject = null;
        $classAverage = '-';
        $semester = $request->input('semester', $class?->academicYear?->active_semester ?? 'even');
        $selectedSubjectId = $request->input('subject_id');

        if ($class) {
            // Ambil semua mata pelajaran yang ada jadwal mengajarnya di kelas ini
            $assignments = TeachingAssignment::where('class_id', $class->id)
                ->with('subject')
                ->get();

            // Saring list subject unik
            $subjects = $assignments->pluck('subject')->unique('id');

            // Set subject default jika belum dipilih
            if (!$selectedSubjectId && $subjects->isNotEmpty()) {
                $selectedSubject = $subjects->first();
                $selectedSubjectId = $selectedSubject->id;
            } elseif ($selectedSubjectId) {
                $selectedSubject = $subjects->where('id', $selectedSubjectId)->first();
            }

            // Cari teaching assignment yang sesuai dengan mapel terpilih di kelas ini
            $targetAssignment = $assignments->where('subject_id', $selectedSubjectId)->first();

            if ($targetAssignment) {
                $query = Student::where('class_id', $class->id)
                    ->with(['grades' => function ($q) use ($targetAssignment, $semester) {
                        $q->where('teaching_assignment_id', $targetAssignment->id)
                          ->where('semester', $semester);
                    }]);

                if ($request->filled('search')) {
                    $search = $request->input('search');
                    $query->where(function($q) use ($search) {
                        $q->where('full_name', 'like', '%' . $search . '%')
                          ->orWhere('nis', 'like', '%' . $search . '%');
                    });
                }

                $rawStudents = $query->get();

                // Hitung Rata-rata Kelas
                $totalScore = 0;
                $gradedCount = 0;
                foreach ($rawStudents as $student) {
                    $grade = $student->grades->first();
                    if ($grade && $grade->final_score !== null) {
                        $totalScore += $grade->final_score;
                        $gradedCount++;
                    }
                }
                $classAverage = $gradedCount > 0 ? round($totalScore / $gradedCount, 1) : '-';

                // Filter by status (Tuntas / Belum Tuntas) di collection PHP
                if ($request->filled('status') && $request->status !== 'all') {
                    $rawStudents = $rawStudents->filter(function ($student) use ($request) {
                        $grade = $student->grades->first();
                        $average = $grade?->final_score ?? 0;
                        $isTuntas = $average >= 75;
                        return $request->status === 'tuntas' ? $isTuntas : !$isTuntas;
                    });
                }

                $students = $rawStudents;
            }
        }

        return view('teacher.wali-rekap-nilai', [
            'class' => $class,
            'subjects' => $subjects,
            'selectedSubject' => $selectedSubject,
            'selectedSubjectId' => $selectedSubjectId,
            'semester' => $semester,
            'students' => $students,
            'classAverage' => $classAverage,
            'homeroomClass' => $class
        ]);
    }

    public function profil()
    {
        $teacher = Teacher::where('user_id', auth()->id())->with('user')->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // Cari tahu apakah guru ini wali kelas
        $homeroomClass = SchoolClass::where('homeroom_teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->first();

        // Cari tahu mata pelajaran apa saja yang diampu guru ini
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with('subject')
            ->get();
        $subjects = $assignments->pluck('subject')->unique('id');

        return view('teacher.profil', compact('teacher', 'homeroomClass', 'subjects'));
    }
}
