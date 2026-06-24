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

        $filename = 'Data_Siswa_Kelas_' . str_replace(' ', '_', $class->class_name) . '.xlsx';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIS');
        $sheet->setCellValue('C1', 'NISN');
        $sheet->setCellValue('D1', 'Nama Siswa');
        $sheet->setCellValue('E1', 'Status');

        $row = 2;
        foreach ($students as $index => $student) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValueExplicit('B' . $row, $student->nis, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C' . $row, $student->nisn, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $student->full_name);
            $sheet->setCellValue('E' . $row, $student->status === 'active' ? 'Aktif' : 'Tidak Aktif');
            $row++;
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
