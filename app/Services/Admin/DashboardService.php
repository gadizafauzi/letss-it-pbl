<?php

namespace App\Services\Admin;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Get general statistics for the admin dashboard.
     *
     * @return array
     */
    public function getGeneralStats(): array
    {
        // 1. Total Pembayaran (verified payments)
        $totalPembayaran = Payment::where('verification_status', 'verified')
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->sum('invoices.amount');

        // 2. Aktivitas Terbaru (5 verified payments)
        $recentActivities = Payment::with(['invoice.student', 'verifier'])
            ->where('verification_status', 'verified')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        // 3. Data Grafik Keuangan (Bulanan tahun ini)
        $currentYear = date('Y');
        $monthlyRevenue = Payment::where('verification_status', 'verified')
            ->whereYear('payments.payment_date', $currentYear)
            ->join('invoices', 'payments.invoice_id', '=', 'invoices.id')
            ->selectRaw('MONTH(payments.payment_date) as month, SUM(invoices.amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $monthlyRevenue[$i] ?? 0;
        }

        return [
            'totalSiswa'       => Student::count(),
            'totalGuru'        => Teacher::count(),
            'totalKelas'       => SchoolClass::count(),
            'totalPembayaran'  => $totalPembayaran,
            'recentActivities' => $recentActivities,
            'chartData'        => $chartData,
            'currentYear'      => $currentYear,
        ];
    }
}
