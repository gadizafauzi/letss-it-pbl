<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $transactionCode }}</title>
    <style>
        @page {
            margin: 0;
            size: auto;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            color: #000;
        }
        .receipt {
            background: #fff;
            width: 100%;
            max-width: 300px; /* ~80mm thermal paper width */
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header p {
            margin: 0;
            font-size: 11px;
            line-height: 1.3;
        }
        .divider-solid {
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            margin: 8px 0;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
        }
        .divider-solid::before {
            content: "==================================================";
        }
        .divider-dashed {
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            margin: 5px 0;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
        }
        .divider-dashed::before {
            content: "--------------------------------------------------";
        }
        table.info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 11px;
        }
        table.info-table td {
            vertical-align: top;
            padding: 2px 0;
        }
        table.info-table td:first-child {
            width: 90px;
        }
        table.info-table td.colon {
            width: 10px;
            text-align: center;
        }
        
        table.items-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 11px;
        }
        table.items-table th {
            text-align: left;
            padding-bottom: 3px;
        }
        table.items-table td {
            padding: 3px 0;
            overflow: hidden;
        }
        table.items-table th.right, table.items-table td.right {
            text-align: right;
        }
        
        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 15px;
        }
        .footer .signature-space {
            margin: 25px 0 10px 0;
        }
        @media print {
            @page {
                margin: 0;
                size: 80mm 150mm; /* Lebar 80mm, tinggi 150mm agar preview kertas terlihat memanjang seperti struk */
            }
            body {
                background-color: #fff;
                padding: 0;
                display: block; /* Remove flex centering for print */
                width: 80mm;
            }
            .receipt {
                width: 80mm;
                max-width: 80mm;
                box-shadow: none;
                padding: 15px 5px; /* Sedikit padding agar tulisan tidak nempel di pinggir kertas */
                margin: 0 auto;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="receipt">
    <div class="header">
        <h2>Sekolah Islam Terpadu Mutiara Qur'an</h2>
        <p>Karasak, Jorong Pasar Baru, Nagari Cupak,<br>Kecamatan Gunung Talang, Kabupaten Solok,<br>Sumatra Barat</p>
    </div>

    <div class="divider-solid"></div>

    @php
        $latestClass = $payment->invoice->student->studentClasses->last();
        $accountKas = $payment->payment_method == 'cash' ? 'Kas Tunai ' . ($payment->invoice->student->unit->unit_name ?? '') : ($payment->schoolAccount->bank_name ?? 'Transfer');
        $hariIni = \Carbon\Carbon::now()->isoFormat('D MMMM Y');
        $tanggalBayar = \Carbon\Carbon::parse($payment->payment_date)->isoFormat('D MMMM Y');
    @endphp

    <table class="info-table">
        <tr>
            <td>No. Referensi</td>
            <td class="colon">:</td>
            <td>{{ $transactionCode }}</td>
        </tr>
        <tr>
            <td>Tahun Ajaran</td>
            <td class="colon">:</td>
            <td>{{ $latestClass?->academicYear?->year ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Bayar</td>
            <td class="colon">:</td>
            <td>{{ $tanggalBayar }}</td>
        </tr>
        <tr>
            <td>Akun Kas</td>
            <td class="colon">:</td>
            <td>{{ $accountKas }}</td>
        </tr>
        <tr>
            <td>NIS</td>
            <td class="colon">:</td>
            <td>{{ $payment->invoice->student->nis }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td class="colon">:</td>
            <td>{{ \Illuminate\Support\Str::limit($payment->invoice->student->full_name, 20) }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td class="colon">:</td>
            <td>{{ $latestClass?->schoolClass?->class_name ?? '-' }}</td>
        </tr>
    </table>

    <div class="divider-solid"></div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width:25px; border-bottom: none;">No.</th>
                <th style="border-bottom: none;">Pembayaran</th>
                <th class="right" style="width: 70px; border-bottom: none;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="padding: 0;"><div class="divider-dashed"></div></td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px; vertical-align: top;">1</td>
                <td style="padding-bottom: 5px;">{{ $payment->invoice->payment_type }}<br><small>{{ $payment->invoice->period }}</small></td>
                <td class="right" style="padding-bottom: 5px; vertical-align: top;">Rp. {{ number_format($payment->invoice->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 0;"><div class="divider-dashed"></div></td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 5px; font-weight: bold;">Total</td>
                <td class="right" style="padding-top: 5px; font-weight: bold;">Rp. {{ number_format($payment->invoice->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 0;"><div class="divider-solid"></div></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Solok, {{ $hariIni }}<br>Kasir</p>
        
        <div class="signature-space">
            {{ strtoupper($payment->verifier->name ?? 'SISTEM') }}
        </div>
        
        <p style="font-size: 10px;">Simpan Kwitansi Ini Sebagai Bukti<br>Pembayaran yang Sah</p>
    </div>
</div>

</body>
</html>
