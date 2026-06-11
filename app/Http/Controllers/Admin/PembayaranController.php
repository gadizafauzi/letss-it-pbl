<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\SchoolAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['invoice', 'invoice.student', 'verifier', 'schoolAccount']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('invoice.student', function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && in_array($request->status, ['pending', 'verified', 'rejected'])) {
            $query->where('verification_status', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $payments = $query->latest()->paginate($perPage)->appends(request()->query());

        return view('admin.pembayaran.index', compact('payments'));
    }

    public function create()
    {
        // Biasanya pembayaran dibuat lewat halaman Invoice (Bayar Tagihan), 
        // tapi kita bisa buat form manual jika perlu.
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_method' => 'required|in:cash,transfer',
            'school_account_id' => 'required_if:payment_method,transfer|nullable|exists:school_accounts,id',
            'payment_date' => 'required|date',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah lunas.');
        }

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payments', 'public');
        }

        $isCash = $request->payment_method === 'cash';

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'verified_by' => auth()->id(),
            'payment_method' => $request->payment_method,
            'school_account_id' => $request->school_account_id,
            'payment_date' => $request->payment_date,
            'payment_proof' => $proofPath,
            'verification_status' => 'verified',
        ]);

        $invoice->update(['status' => 'paid']);

        if ($isCash) {
            return redirect()->route('admin.tagihan.show', $invoice->id)
                ->with('success', 'Pembayaran tunai berhasil dicatat dan tagihan lunas.');
        }

        return redirect()->route('admin.tagihan.show', $invoice->id)
            ->with('success', 'Pembayaran transfer berhasil dicatat dan tagihan lunas.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['invoice', 'invoice.student', 'verifier', 'schoolAccount']);
        return view('admin.pembayaran.show', compact('payment'));
    }

    public function verify(Payment $payment)
    {
        if ($payment->verification_status === 'verified') {
            return back()->with('error', 'Pembayaran sudah diverifikasi sebelumnya.');
        }

        $payment->update([
            'verification_status' => 'verified',
            'verified_by' => auth()->id()
        ]);

        $payment->invoice->update(['status' => 'paid']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi. Tagihan menjadi lunas.');
    }

    public function reject(Payment $payment)
    {
        if ($payment->verification_status === 'verified') {
            return back()->with('error', 'Pembayaran sudah diverifikasi, tidak dapat ditolak.');
        }

        $payment->update([
            'verification_status' => 'rejected'
        ]);

        $payment->invoice->update(['status' => 'unpaid']);

        return back()->with('success', 'Pembayaran ditolak.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $payment->invoice->update(['status' => 'unpaid']);
        $payment->delete();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus secara permanen.');
    }

    public function print(Payment $payment)
    {
        if ($payment->verification_status !== 'verified') {
            return back()->with('error', 'Hanya pembayaran yang sudah diverifikasi yang dapat dicetak.');
        }

        $payment->load(['invoice.student', 'verifier']);
        
        // Generate a simple transaction code if we don't have one in DB
        $transactionCode = 'TRX-' . \Carbon\Carbon::parse($payment->created_at)->format('Ymd') . '-' . str_pad($payment->id, 4, '0', STR_PAD_LEFT);

        return view('admin.pembayaran.print', compact('payment', 'transactionCode'));
    }
}
