<?php

namespace App\Http\Controllers\Teacher\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
}
