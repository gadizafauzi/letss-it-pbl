@extends('admin.layout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Laporan Keuangan - {{ $month }}/{{ $year }}</h1>
    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border">Nama Siswa</th>
                <th class="px-4 py-2 border">Keterangan</th>
                <th class="px-4 py-2 border">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td class="px-4 py-2 border">{{ $payment->payment_date->format('d-m-Y') }}</td>
                    <td class="px-4 py-2 border">{{ $payment->invoice->student->full_name }}</td>
                    <td class="px-4 py-2 border">{{ $payment->invoice->payment_type }} ({{ $payment->invoice->period }})</td>
                    <td class="px-4 py-2 border text-right">{{ number_format($payment->invoice->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
