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

    public function waliDataSiswa(Request $request)
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

        $students = collect();
        if ($class) {
            $studentIds = \App\Models\StudentClass::where('class_id', $class->id)
                ->where('academic_year_id', $activeYear?->id)
                ->pluck('student_id');
            $query = Student::whereIn('id', $studentIds);

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
            'homeroomClass' => $class,
            'activeYear' => $activeYear
        ]);
    }

    public function waliRekapNilai(Request $request)
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
            'homeroomClass' => $class,
            'activeYear' => $activeYear
        ]);
    }

    public function profil()
    {
        $teacher = Teacher::with(['user', 'position'])->where('user_id', auth()->id())->firstOrFail();
        $activeYear = AcademicYear::where('status', 'active')->first();

        // Cari tahu apakah guru ini wali kelas
        $homeroomClass = null;
        if ($teacher->position && stripos($teacher->position->name, 'Wali') !== false) {
            $homeroomClass = SchoolClass::where('homeroom_teacher_id', $teacher->id)->first();
        }

        // Cari tahu mata pelajaran apa saja yang diampu guru ini
        $assignments = TeachingAssignment::where('teacher_id', $teacher->id)
            ->where('academic_year_id', $activeYear?->id)
            ->with('subject')
            ->get();
        $subjects = $assignments->pluck('subject')->unique('id');

        return view('teacher.profil', compact('teacher', 'homeroomClass', 'subjects'));
    }

    public function exportDataSiswa(Request $request)
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

        $students = collect();
        if ($class) {
            $studentIds = \App\Models\StudentClass::where('class_id', $class->id)
                ->where('academic_year_id', $activeYear?->id)
                ->pluck('student_id');
            $query = Student::whereIn('id', $studentIds);

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

        $filename = 'Data_Siswa_Kelas_' . str_replace(' ', '_', $class->class_name) . '.csv';

        return response()->streamDownload(function () use ($students, $class) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            fputcsv($file, [
                'No',
                'NIS',
                'NISN',
                'Nama Siswa',
                'Status'
            ], ';');

            foreach ($students as $index => $student) {
                fputcsv($file, [
                    $index + 1,
                    $student->nis,
                    $student->nisn,
                    $student->full_name,
                    $student->status === 'active' ? 'Aktif' : 'Tidak Aktif'
                ], ';');
            }

            fclose($file);
        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public function exportRekapNilai(Request $request)
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

    public function updateProfile(Request $request)
    {
        $teacher = Teacher::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'last_education' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo && $teacher->photo !== 'default.png' && $teacher->photo !== 'default.jpg' && $teacher->photo !== 'default_user.png') {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists('photos/' . $teacher->photo)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete('photos/' . $teacher->photo);
                }
            }

            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('photos', $filename, 'public');
            $teacher->photo = $filename;
        }

        $teacher->full_name = $request->full_name;
        $teacher->phone = $request->phone;
        $teacher->last_education = $request->last_education;
        $teacher->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
