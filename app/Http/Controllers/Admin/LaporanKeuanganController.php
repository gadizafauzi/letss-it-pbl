<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $payments = Payment::with(['invoice', 'invoice.student'])
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->where('verification_status', 'verified')
            ->get();

        $totalIncome = $payments->sum(function($payment) {
            return $payment->invoice->amount;
        });

        return view('admin.laporan-keuangan.index', compact('payments', 'totalIncome', 'month', 'year'));
    }
}
