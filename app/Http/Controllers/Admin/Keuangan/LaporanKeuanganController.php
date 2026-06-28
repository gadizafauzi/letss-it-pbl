<?php

namespace App\Http\Controllers\Admin\Keuangan;

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

        return view('admin.keuangan.laporan-keuangan.index', compact('payments', 'totalIncome', 'month', 'year'));
    }

    // New: Export Excel (generic columns)
    public function exportExcel(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        $payments = Payment::with(['invoice', 'invoice.student'])
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->where('verification_status', 'verified')
            ->get();

        // Build Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Header
        $sheet->fromArray(['Tanggal', 'Keterangan', 'Debit', 'Kredit', 'Saldo'], NULL, 'A1');
        $row = 2;
        foreach ($payments as $payment) {
            $sheet->setCellValue('A' . $row, $payment->payment_date);
            $sheet->setCellValue('B' . $row, $payment->invoice->payment_type . ' (' . $payment->invoice->period . ')');
            $sheet->setCellValue('C' . $row, $payment->payment_method == 'cash' ? $payment->invoice->amount : 0);
            $sheet->setCellValue('D' . $row, $payment->payment_method != 'cash' ? $payment->invoice->amount : 0);
            $sheet->setCellValue('E' . $row, $payment->invoice->amount);
            $row++;
        }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'laporan_keuangan_' . $year . '_' . $month . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
        // Export PDF using dompdf
    public function exportPdf(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        $payments = Payment::with(['invoice', 'invoice.student'])
            ->whereMonth('payment_date', $month)
            ->whereYear('payment_date', $year)
            ->where('verification_status', 'verified')
            ->get();

        $data = ['payments' => $payments, 'month' => $month, 'year' => $year];
        $pdf = \PDF::loadView('admin.keuangan.laporan-keuangan.pdf', $data);
        return $pdf->download('laporan_keuangan_' . $year . '_' . $month . '.pdf');
    }
}

}
