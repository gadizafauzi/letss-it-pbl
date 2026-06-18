<?php

namespace App\Http\Controllers\Teacher\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\AcademicYear;
use App\Models\TeachingAssignment;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $teacher = Teacher::with('position')->where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();
        
        $class = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $class = SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
        }

        if (!$class) {
            abort(403, 'Akses ditolak. Anda bukan Wali Kelas atau tidak memiliki kelas.');
        }

        $subjects = collect();
        $students = collect();
        $selectedSubject = null;
        $classAverage = '-';
        $semester = $request->input('semester', $activeYear?->active_semester ?? 'odd');
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
                $studentIds = \App\Models\StudentClass::where('class_id', $class->id)
                    ->where('academic_year_id', $activeYear?->id)
                    ->pluck('student_id');
                $query = Student::whereIn('id', $studentIds)
                    ->with(['grades' => function ($q) use ($targetAssignment, $semester) {
                        $q->where('teaching_assignment_id', $targetAssignment->id)
                          ->where('semester', $semester)
                          ->whereIn('status', ['final', 'published']);
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
            'homeroomClass' => $class,
            'activeYear' => $activeYear
        ]);
    }

    public function export(Request $request)
    {
        $teacher = Teacher::with('position')->where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();
        
        $class = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $class = SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
        }

        if (!$class) {
            abort(403, 'Akses ditolak. Anda bukan Wali Kelas atau tidak memiliki kelas.');
        }

        $semester = $request->input('semester', $activeYear?->active_semester ?? 'odd');
        $selectedSubjectId = $request->input('subject_id');
        
        $students = collect();
        $subjectName = '-';

        if ($class) {
            $assignments = TeachingAssignment::where('class_id', $class->id)->with('subject')->get();
            $subjects = $assignments->pluck('subject')->unique('id');

            if (!$selectedSubjectId && $subjects->isNotEmpty()) {
                $selectedSubjectId = $subjects->first()->id;
            }

            $targetAssignment = $assignments->where('subject_id', $selectedSubjectId)->first();
            
            if ($targetAssignment) {
                $subjectName = $targetAssignment->subject->subject_name;
                $studentIds = \App\Models\StudentClass::where('class_id', $class->id)
                    ->where('academic_year_id', $activeYear?->id)
                    ->pluck('student_id');
                    
                $query = Student::whereIn('id', $studentIds)
                    ->with(['grades' => function ($q) use ($targetAssignment, $semester) {
                        $q->where('teaching_assignment_id', $targetAssignment->id)
                          ->where('semester', $semester)
                          ->whereIn('status', ['final', 'published']);
                    }]);

                if ($request->filled('search')) {
                    $search = $request->input('search');
                    $query->where(function($q) use ($search) {
                        $q->where('full_name', 'like', '%' . $search . '%')
                          ->orWhere('nis', 'like', '%' . $search . '%');
                    });
                }

                $rawStudents = $query->get();
                $students = $rawStudents;

                if ($request->filled('status') && $request->input('status') !== 'all') {
                    $status = $request->input('status');
                    $students = $rawStudents->filter(function($s) use ($status) {
                        $grade = $s->grades->first();
                        $isTuntas = $grade?->final_score !== null && $grade->final_score >= 75;
                        if ($status === 'tuntas') return $isTuntas;
                        return !$isTuntas;
                    })->values();
                }
            }
        }

        $filename = 'Rekap_Nilai_Kelas_' . str_replace(' ', '_', $class->class_name) . '_' . str_replace(' ', '_', $subjectName) . '.csv';

        return response()->streamDownload(function () use ($students) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            fputcsv($file, [
                'No',
                'NIS',
                'Nama Siswa',
                'UTS',
                'UAS',
                'Tugas',
                'Rata-rata',
                'Status'
            ], ';');

            foreach ($students as $index => $student) {
                $grade = $student->grades->first();
                $uts = $grade?->mid_exam !== null ? round($grade->mid_exam) : '-'; 
                $uas = $grade?->final_exam !== null ? round($grade->final_exam) : '-';
                $tugas = $grade?->assignment_score !== null ? round($grade->assignment_score) : '-';
                $average = $grade?->final_score !== null ? round($grade->final_score, 1) : '-';
                
                $statusText = 'Belum Dinilai';
                if ($grade?->final_score !== null) {
                    $statusText = $grade->final_score >= 75 ? 'Tuntas' : 'Belum Tuntas';
                }

                fputcsv($file, [
                    $index + 1,
                    $student->nis,
                    $student->full_name,
                    $uts,
                    $uas,
                    $tugas,
                    $average,
                    $statusText
                ], ';');
            }

            fclose($file);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function publish(Request $request)
    {
        $teacher = Teacher::with('position')->where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();
        
        $class = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $class = SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
        }

        if (!$class) {
            return redirect()->back()->with('error', 'Akses ditolak. Anda bukan Wali Kelas.');
        }

        $semester = $request->input('semester', $activeYear?->active_semester ?? 'odd');

        $studentIds = \App\Models\StudentClass::where('class_id', $class->id)
            ->where('academic_year_id', $activeYear?->id)
            ->pluck('student_id');

        \App\Models\Grade::whereIn('student_id', $studentIds)
            ->where('academic_year_id', $activeYear?->id)
            ->where('semester', $semester)
            ->where('status', 'final')
            ->update(['status' => 'published']);

        return redirect()->back()->with('success', 'Nilai kelas pada semester ' . ($semester === 'odd' ? 'Ganjil' : 'Genap') . ' berhasil diterbitkan dan sekarang dapat dilihat oleh siswa!');
    }
}
