@extends('layouts.student')

@section('content')
<div class="space-y-6 font-sans">

    <!-- Title & Summary Box -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-extrabold text-slate-800 text-lg leading-tight">Riwayat Tagihan & Pembayaran</h2>
            <p class="text-xs text-slate-400 mt-1 font-medium">Pantau tagihan SPP dan riwayat pembayaran Anda</p>
        </div>

    </div>

    <!-- Invoices Table Box -->
    <div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-emerald-50/50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-emerald-600 h-5 rounded-full"></div>
                <h3 class="font-extrabold text-slate-800 text-base">Daftar Tagihan</h3>
            </div>
            <span class="text-[11px] text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full font-bold">
                {{ $invoices->count() }} Record Tagihan
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-extrabold border-b border-slate-100">
                        <th class="px-6 py-4 text-left w-16">No</th>
                        <th class="px-6 py-4 text-left">Jenis Pembayaran</th>
                        <th class="px-6 py-4 text-left">Periode</th>
                        <th class="px-6 py-4 text-left">Batas Waktu</th>
                        <th class="px-6 py-4 text-right">Jumlah Tagihan</th>
                        <th class="px-6 py-4 text-center w-36">Status</th>
                        <th class="px-6 py-4 text-left">Tanggal Bayar</th>
                        <th class="px-6 py-4 text-center">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($invoices as $index => $invoice)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4 font-mono text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $invoice->payment_type }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-500">
                                {{ $invoice->period }}
                            </td>
                            <td class="px-6 py-4 text-slate-500">
                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-800">
                                Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($invoice->status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Belum Lunas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-sans text-xs">
                                @if($invoice->status === 'paid' && $invoice->payment)
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($invoice->payment->payment_date)->format('d M Y') }}
                                        </span>
                                        <span class="text-[10px] text-slate-400">Verifikator ID: {{ $invoice->payment->verified_by }}</span>
                                    </div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($invoice->status !== 'paid')
                                    <label class="cursor-pointer bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[10px] px-3 py-1.5 rounded-lg transition-all inline-flex items-center gap-1 shadow-sm">
                                        <i data-lucide="upload" class="w-3 h-3"></i>
                                        <span>Upload Bukti (Foto)</span>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                @else
                                    <button class="bg-slate-100 text-slate-400 text-[10px] px-3 py-1.5 rounded-lg font-bold cursor-not-allowed inline-flex items-center gap-1" disabled>
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                        <span>Selesai</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i data-lucide="wallet-cards" class="w-10 h-10 text-slate-300"></i>
                                    <p class="font-bold text-slate-500">Belum ada riwayat tagihan.</p>
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
