<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Invoice;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $invoices = Invoice::where('student_id', $student->id)
            ->with(['payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        // KIP Kuliah overrides unpaid UKT bills
        $isKip = $student->is_kip_kuliah;

        return view('student.tagihan', compact('student', 'invoices', 'isKip'));
    }
}
