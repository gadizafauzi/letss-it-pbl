@extends('layouts.student')

@section('content')
<div class="space-y-6 font-sans">

    {{-- HEADER CARD --}}
    <div class="rounded-[20px] p-4 md:p-6 flex flex-col md:flex-row md:items-center justify-between relative overflow-hidden shadow-[0_8px_24px_rgba(15,23,42,0.06)] mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)] shadow-[0_8px_30px_rgba(79,116,232,0.3)] gap-4">
        <div class="absolute top-0 right-0 w-48 h-48 bg-[var(--bg-card)] opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
        <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
        <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
        
        <div class="relative z-10">
            <h1 class="text-xl md:text-2xl font-extrabold text-white">Riwayat Tagihan & Pembayaran</h1>
            <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Pantau tagihan SPP dan riwayat pembayaran Anda</p>
        </div>
    </div>

    <!-- Invoices Table Box -->
    <div class="bg-[var(--bg-card)] rounded-[24px] shadow-[0_8px_24px_rgba(15,23,42,0.06)] border border-[var(--border-color)] overflow-hidden">
        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--theme-border-light)] flex flex-wrap items-center justify-between gap-3 bg-[var(--theme-bg-light)]">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
                <h3 class="font-extrabold text-[var(--theme-text-primary)] text-base">Daftar Tagihan</h3>
            </div>
            <span class="text-[11px] text-[var(--theme-text-light)] bg-[var(--theme-bg-light)] border border-[var(--theme-border-light)] px-3 py-1 rounded-full font-bold whitespace-nowrap">
                {{ $invoices->count() }} Record Tagihan
            </span>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-sm min-w-[800px]">
                <thead>
                    <tr class="bg-[var(--theme-bg-workspace)] text-[var(--text-secondary)] text-xs uppercase font-extrabold border-b border-[var(--theme-border-light)]">
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
                        <tr class="hover:bg-[var(--theme-bg-workspace)]/70 transition-colors">
                            <td class="px-6 py-4 font-mono text-[var(--text-secondary)]">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-[var(--text-main)]">
                                {{ $invoice->payment_type }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-[var(--text-secondary)]">
                                {{ $invoice->period }}
                            </td>
                            <td class="px-6 py-4 text-[var(--text-secondary)]">
                                {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-[var(--text-main)]">
                                Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($invoice->status === 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[11px] font-extrabold bg-[#d1fae5] text-[#047857] uppercase tracking-wider">
                                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-[11px] font-extrabold bg-[#fef3c7] text-[#b45309] uppercase tracking-wider">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i> Belum Lunas
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-[var(--text-secondary)] font-sans text-xs">
                                @if($invoice->status === 'paid' && $invoice->payment)
                                    <span class="font-bold text-[var(--text-main)]">
                                        {{ \Carbon\Carbon::parse($invoice->payment->payment_date)->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-[var(--text-secondary)]">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($invoice->status !== 'paid')
                                    <label class="cursor-pointer bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold text-[10px] px-3 py-1.5 rounded-lg transition-all inline-flex items-center gap-1 shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
                                        <i data-lucide="upload" class="w-3 h-3"></i>
                                        <span>Upload Bukti (Foto)</span>
                                        <input type="file" class="hidden" accept="image/*">
                                    </label>
                                @else
                                    <button class="bg-[var(--theme-bg-workspace)] text-[var(--text-secondary)] text-[10px] px-3 py-1.5 rounded-lg font-bold cursor-not-allowed inline-flex items-center gap-1" disabled>
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                        <span>Selesai</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-[var(--text-secondary)]">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i data-lucide="wallet-cards" class="w-10 h-10 text-slate-300"></i>
                                    <p class="font-bold text-[var(--text-secondary)]">Belum ada riwayat tagihan.</p>
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
