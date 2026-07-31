@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="mb-2">
            <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Laporan Keuangan</h1>
        </div>

        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form action="{{ route('admin.laporan-keuangan.index') }}" method="GET" class="flex flex-row items-center gap-3">
                
                {{-- Bulan --}}
                <div class="flex items-center gap-2">
                    <label class="text-[13px] font-bold text-slate-700 dark:text-slate-300">Bulan:</label>
                    <select name="month" onchange="this.form.submit()"
                        class="h-[42px] px-2 border-[1.5px] border-sky-100 rounded-[10px]
                               bg-sky-50 text-[11px] sm:text-[13px] text-slate-700 outline-none
                               focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer">
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ $month == sprintf('%02d', $i) ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="flex items-center gap-2">
                    <label class="text-[13px] font-bold text-slate-700 dark:text-slate-300">Tahun:</label>
                    <select name="year" onchange="this.form.submit()"
                        class="h-[42px] px-2 border-[1.5px] border-sky-100 rounded-[10px]
                               bg-sky-50 text-[11px] sm:text-[13px] text-slate-700 outline-none
                               focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer">
                        @for($y = 2024; $y <= date('Y') + 1; $y++)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

            </form>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Total Pemasukan --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6 relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-emerald-100 dark:bg-emerald-500/10 rounded-full"></div>
                <div class="absolute -right-1 -bottom-1 w-16 h-16 bg-emerald-200 dark:bg-emerald-500/20 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-500/20 rounded-xl flex items-center justify-center">
                            <i data-lucide="banknote" class="w-5 h-5 text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pemasukan Bulan Ini</span>
                    </div>
                    <div class="text-3xl font-black text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                </div>
            </div>

            {{-- Total Transaksi --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6 relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-blue-100 dark:bg-blue-500/10 rounded-full"></div>
                <div class="absolute -right-1 -bottom-1 w-16 h-16 bg-blue-200 dark:bg-blue-500/20 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i data-lucide="receipt" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Transaksi</span>
                    </div>
                    <div class="text-3xl font-black text-blue-600 dark:text-blue-400">{{ $payments->count() }} <span class="text-xl font-bold text-slate-500 dark:text-slate-400">Transaksi</span></div>
                </div>
            </div>
        </div>

        {{-- TABLE RINCIAN --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-sky-100 dark:border-slate-700/50 flex items-center gap-3 bg-sky-50/50 dark:bg-slate-800/50">
                <div class="w-9 h-9 bg-emerald-100 dark:bg-emerald-500/20 rounded-xl flex items-center justify-center">
                    <i data-lucide="list" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <h2 class="text-[15px] font-bold text-slate-800 dark:text-slate-100">Rincian Pembayaran</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">No</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Tgl Bayar</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Siswa</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Jenis Tagihan</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Metode</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600 dark:text-slate-400 font-medium">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $payment->invoice->student->full_name }}</div>
                                    <div class="text-[11px] text-slate-400 dark:text-slate-500 font-mono">{{ $payment->invoice->student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-700 dark:text-slate-300">
                                    {{ $payment->invoice->payment_type }}
                                    <span class="text-[11px] text-slate-400 dark:text-slate-500">({{ $payment->invoice->period }})</span>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600 dark:text-slate-400">
                                    @if($payment->payment_method == 'cash')
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 px-2.5 py-1 rounded-full text-xs font-bold border border-slate-200 dark:border-slate-600">
                                            <i data-lucide="banknote" class="w-3 h-3"></i> Tunai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-sky-700 dark:text-sky-400 bg-sky-100 dark:bg-sky-900/30 px-2.5 py-1 rounded-full text-xs font-bold border border-sky-200 dark:border-sky-800">
                                            <i data-lucide="building-2" class="w-3 h-3"></i> Transfer {{ $payment->schoolAccount->bank_name ?? '' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-[13px] font-bold text-emerald-600 dark:text-emerald-400">
                                        Rp {{ number_format($payment->invoice->amount, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="mb-4 w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center">
                                            <i data-lucide="bar-chart-2" class="w-10 h-10 text-slate-300 dark:text-slate-600"></i>
                                        </div>
                                        <p class="text-[14px] font-bold text-slate-800 dark:text-slate-100 mb-1">Tidak ada transaksi</p>
                                        <p class="text-[13px] text-slate-500 dark:text-slate-400">Tidak ada transaksi pada bulan ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($payments->count() > 0)
                        <tfoot>
                            <tr class="border-t-2 border-slate-200 dark:border-slate-700 bg-slate-50/80 dark:bg-slate-800/80">
                                <td colspan="5" class="px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-slate-200 text-right">Total:</td>
                                <td class="px-4 py-3.5 text-sm font-black text-emerald-600 dark:text-emerald-400">
                                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection


