<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentType;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with(['student', 'student.unit']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        $invoices = $query->latest()->paginate(20);

        return view('admin.tagihan.index', compact('invoices'));
    }

    public function create()
    {
        $classes = SchoolClass::with('unit')->get();
        $paymentTypes = PaymentType::with('unit')->get();

        return view('admin.tagihan.create', compact('classes', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_type_id' => 'required|exists:payment_types,id',
            'period' => 'required|string|max:255',
            'due_date' => 'required|date',
            'target' => 'required|in:all,class,student',
            'class_id' => 'required_if:target,class|nullable|exists:classes,id',
        ]);

        $paymentType = PaymentType::find($request->payment_type_id);
        
        $students = collect();

        if ($request->target === 'all') {
            // All active students, if payment type has unit_id, filter by unit
            $query = Student::where('status', 'active');
            if ($paymentType->unit_id) {
                $query->where('unit_id', $paymentType->unit_id);
            }
            $students = $query->get();
        } elseif ($request->target === 'class') {
            $students = Student::where('status', 'active')
                ->whereHas('studentClasses', function($q) use ($request) {
                    $q->where('school_class_id', $request->class_id)
                      ->whereHas('academicYear', function($q2) {
                          $q2->where('status', 'active');
                      });
                })->get();
        }

        $count = 0;
        foreach ($students as $student) {
            // Cek duplikasi
            $exists = Invoice::where('student_id', $student->id)
                ->where('payment_type', $paymentType->name) // we store name as per existing migration
                ->where('period', $request->period)
                ->exists();

            if (!$exists) {
                Invoice::create([
                    'student_id' => $student->id,
                    'payment_type' => $paymentType->name,
                    'period' => $request->period,
                    'amount' => $paymentType->amount,
                    'due_date' => $request->due_date,
                    'status' => 'unpaid'
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', "Berhasil men-generate $count tagihan baru.");
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['student', 'student.unit', 'payment', 'payment.verifier']);
        return view('admin.tagihan.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan yang sudah dibayar tidak dapat dihapus.');
        }
        $invoice->delete();
        return back()->with('success', 'Tagihan berhasil dihapus.');
    }
}
