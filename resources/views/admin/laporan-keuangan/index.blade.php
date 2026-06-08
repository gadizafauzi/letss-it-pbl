@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- PAGE HEADER --}}
        <div class="relative overflow-hidden rounded-2xl px-7 py-6"
            style="background: linear-gradient(135deg, #10b981 0%, #34d399 55%, #6ee7b7 100%);">
            <div class="absolute -top-12 -right-12 w-44 h-44 bg-white/[.08] rounded-full"></div>
            <div class="absolute -bottom-16 left-8 w-56 h-56 bg-white/[.05] rounded-full"></div>
            <div class="relative z-10 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-white/60 mb-1">
                        Manajemen Keuangan
                    </p>
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Laporan Keuangan</h1>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-4 shadow-sm">
            <form action="{{ route('admin.laporan-keuangan.index') }}" method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-2">
                    <label class="text-sm font-semibold text-slate-700">Bulan:</label>
                    <select name="month" onchange="this.form.submit()" class="h-[42px] px-3 border-[1.5px] border-slate-200 rounded-[10px] bg-slate-50 text-[13px] text-slate-700 outline-none">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ $month == sprintf('%02d', $i) ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <label class="text-sm font-semibold text-slate-700">Tahun:</label>
                    <select name="year" onchange="this.form.submit()" class="h-[42px] px-3 border-[1.5px] border-slate-200 rounded-[10px] bg-slate-50 text-[13px] text-slate-700 outline-none">
                        @for($y=2024; $y<=date('Y')+1; $y++)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        {{-- SUMMARY CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl p-6 border border-emerald-100 shadow-sm relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none transform translate-x-4 translate-y-4">
                    <i data-lucide="banknote" class="w-32 h-32 text-emerald-500"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2 relative z-10">Total Pemasukan Bulan Ini</h3>
                <div class="text-3xl font-black text-emerald-600 relative z-10">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
                <div class="absolute right-0 bottom-0 opacity-5 pointer-events-none transform translate-x-4 translate-y-4">
                    <i data-lucide="receipt" class="w-32 h-32 text-slate-500"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2 relative z-10">Total Transaksi</h3>
                <div class="text-3xl font-black text-slate-700 relative z-10">{{ $payments->count() }} Transaksi</div>
            </div>
        </div>

        {{-- TABLE DETAILS --}}
        <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm mt-5">
            <div class="p-4 border-b border-slate-100">
                <h2 class="font-bold text-slate-800">Rincian Pembayaran</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-[1.5px] border-slate-100">
                            @foreach (['Tgl Bayar', 'Siswa', 'Jenis Tagihan', 'Metode', 'Nominal'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-[13px] text-slate-600 font-medium">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $payment->invoice->student->full_name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $payment->invoice->student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-700">
                                    {{ $payment->invoice->payment_type }} ({{ $payment->invoice->period }})
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    @if($payment->payment_method == 'cash')
                                        Tunai
                                    @else
                                        Transfer ({{ $payment->schoolAccount->bank_name ?? '' }})
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-[13px] font-bold text-emerald-600">
                                    Rp {{ number_format($payment->invoice->amount,0,',','.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="flex flex-col items-center justify-center py-12 text-center">
                                        <p class="text-[14px] text-slate-500">Tidak ada transaksi pada bulan ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
