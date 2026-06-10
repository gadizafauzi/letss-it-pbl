<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\SchoolAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagihanController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $invoices = Invoice::where('student_id', $student->id)
            ->with(['payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        $schoolAccounts = SchoolAccount::where('is_active', true)->get();

        // KIP Kuliah logic removed
        $isKip = false;

        return view('student.tagihan', compact('student', 'invoices', 'schoolAccounts', 'isKip'));
    }

    public function storePayment(Request $request, Invoice $invoice)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        if ($invoice->student_id !== $student->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah lunas.');
        }

        $request->validate([
            'school_account_id' => 'required|exists:school_accounts,id',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $proofPath = $request->file('payment_proof')->store('payments', 'public');

        if ($invoice->payment) {
            if ($invoice->payment->payment_proof) {
                Storage::disk('public')->delete($invoice->payment->payment_proof);
            }
            $invoice->payment->update([
                'payment_method' => 'transfer',
                'school_account_id' => $request->school_account_id,
                'payment_date' => now(),
                'payment_proof' => $proofPath,
                'verification_status' => 'pending',
                'verified_by' => null,
            ]);
        } else {
            Payment::create([
                'invoice_id' => $invoice->id,
                'payment_method' => 'transfer',
                'school_account_id' => $request->school_account_id,
                'payment_date' => now(),
                'payment_proof' => $proofPath,
                'verification_status' => 'pending',
                'verified_by' => null,
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah dan sedang menunggu verifikasi admin.');
    }
}
