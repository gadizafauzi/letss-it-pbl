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

    {{-- SUCCESS / ERROR ALERT --}}
    @if (session('success'))
        <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700 mb-6">
            <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-red-100 border border-red-200 text-red-700 mb-6">
            <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
            {{ session('error') }}
        </div>
    @endif

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
                                @if($invoice->status === 'paid')
                                    <button class="bg-[var(--theme-bg-workspace)] text-[var(--text-secondary)] text-[10px] px-3 py-1.5 rounded-lg font-bold cursor-not-allowed inline-flex items-center gap-1" disabled>
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                        <span>Selesai</span>
                                    </button>
                                @elseif($invoice->payment && $invoice->payment->verification_status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-bold bg-[#fef3c7] text-[#b45309] shadow-[0_8px_24px_rgba(15,23,42,0.06)]">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        <span>Menunggu Verifikasi</span>
                                    </span>
                                @else
                                    <div class="flex flex-col items-center gap-1">
                                        <button type="button" onclick="openPaymentModal({{ $invoice->id }}, '{{ $invoice->payment_type }}', '{{ $invoice->period }}')" class="cursor-pointer bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white font-bold text-[10px] px-3 py-1.5 rounded-lg transition-all inline-flex items-center gap-1 shadow-[0_8px_24px_rgba(15,23,42,0.06)] border-none">
                                            <i data-lucide="upload" class="w-3 h-3"></i>
                                            <span>Upload Bukti (Foto)</span>
                                        </button>
                                        @if($invoice->payment && $invoice->payment->verification_status === 'rejected')
                                            <span class="text-[9px] text-red-500 font-bold italic">Ditolak, harap upload ulang</span>
                                        @endif
                                    </div>
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

<!-- Modal Upload Pembayaran -->
<div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/50 backdrop-blur-sm" aria-hidden="true" onclick="closePaymentModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-extrabold text-slate-800 leading-6" id="modal-title">
                    Upload Bukti Pembayaran
                </h3>
                <button type="button" onclick="closePaymentModal()" class="text-slate-400 hover:text-slate-500 focus:outline-none rounded-lg p-1 hover:bg-slate-50 transition-colors">
                    <span class="sr-only">Close</span>
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <form id="paymentForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <p class="text-sm text-slate-600 font-medium mb-1">Tagihan: <span id="modalInvoiceType" class="font-bold text-slate-800"></span></p>
                    <p class="text-sm text-slate-600 font-medium">Periode: <span id="modalInvoicePeriod" class="font-bold text-slate-800"></span></p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="school_account_id" class="block text-sm font-bold text-slate-700 mb-1.5">Rekening Tujuan Transfer</label>
                        <select name="school_account_id" id="school_account_id" required class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-[var(--theme-primary)]/20 focus:border-[var(--theme-primary)] outline-none transition-all">
                            <option value="">-- Pilih Rekening Tujuan --</option>
                            @foreach ($schoolAccounts as $acc)
                                <option value="{{ $acc->id }}">{{ $acc->bank_name }} - {{ $acc->account_number }} ({{ $acc->account_name }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="payment_proof" class="block text-sm font-bold text-slate-700 mb-1.5">Foto Bukti Transfer</label>
                        <input type="file" name="payment_proof" id="payment_proof" accept="image/jpeg,image/png,image/jpg" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[var(--theme-primary)]/10 file:text-[var(--theme-primary)] hover:file:bg-[var(--theme-primary)]/20 cursor-pointer">
                        <p class="mt-1 text-xs text-slate-400">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                    </div>
                </div>

                <div class="mt-6 sm:mt-8 sm:flex sm:flex-row-reverse gap-3">
                    <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent px-4 py-2.5 bg-[var(--theme-primary)] text-base font-bold text-white hover:bg-[var(--theme-primary-hover)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--theme-primary)] sm:w-auto sm:text-sm shadow-sm transition-all">
                        Upload Bukti
                    </button>
                    <button type="button" onclick="closePaymentModal()" class="mt-3 w-full inline-flex justify-center rounded-xl border border-slate-200 px-4 py-2.5 bg-white text-base font-bold text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-200 sm:mt-0 sm:w-auto sm:text-sm transition-all">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPaymentModal(invoiceId, type, period) {
        document.getElementById('modalInvoiceType').innerText = type;
        document.getElementById('modalInvoicePeriod').innerText = period;
        
        let form = document.getElementById('paymentForm');
        form.action = `/student/tagihan/${invoiceId}/bayar`;
        
        document.getElementById('paymentModal').classList.remove('hidden');
        lucide.createIcons();
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
        document.getElementById('paymentForm').reset();
    }
</script>
@endsection
