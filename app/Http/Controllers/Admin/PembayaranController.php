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

        $payments = $query->latest()->paginate(20);

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
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);

        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah lunas.');
        }

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'verified_by' => auth()->id(),
            'payment_method' => $request->payment_method,
            'school_account_id' => $request->school_account_id,
            'payment_date' => $request->payment_date,
            // Jika admin yang input cash, berarti langsung verified tanpa bukti transfer (bisa opsional)
        ]);

        $invoice->update(['status' => 'paid']);

        return redirect()->route('admin.tagihan.show', $invoice->id)
            ->with('success', 'Pembayaran berhasil diproses dan diverifikasi.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['invoice', 'invoice.student', 'verifier', 'schoolAccount']);
        return view('admin.pembayaran.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        // Admin memverifikasi pembayaran transfer yang di-submit siswa (jika ada portal siswa)
        // Saat ini, kita asumsikan siswa kirim bukti, lalu admin ubah statusnya
        
        $payment->update([
            'verified_by' => auth()->id()
        ]);

        $payment->invoice->update(['status' => 'paid']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function destroy(Payment $payment)
    {
        $invoice = $payment->invoice;
        $payment->delete();
        $invoice->update(['status' => 'unpaid']);

        return back()->with('success', 'Data pembayaran dihapus. Status tagihan dikembalikan menjadi belum lunas.');
    }
}
