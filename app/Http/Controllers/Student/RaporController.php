<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use PDF; // alias for \Barryvdh\DomPDF\Facade\Pdf

class RaporController extends Controller
{
    /**
     * Download rapor (report card) PDF for a given student.
     *
     * @param int $id Student ID
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($id)
    {
        $student = Student::with(['studentClasses.schoolClass', 'studentClasses.academicYear'])->findOrFail($id);

        // Compute grades or fetch from related tables – assuming a relationship `grades`
        $grades = $student->grades ?? [];

        $data = [
            'student' => $student,
            'grades'  => $grades,
        ];

        $pdf = PDF::loadView('student.rapor.pdf', $data);
        $fileName = 'rapor_' . strtolower(str_replace(' ', '_', $student->full_name)) . '.pdf';
        return $pdf->download($fileName);
    }
}
