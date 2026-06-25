@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-4xl">

        {{-- PAGE HEADER --}}
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ $invoice->student?->id ? route('admin.tagihan.student', $invoice->student->id) : url()->previous() }}"





                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-0.5">Detail Tagihan</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Informasi tagihan siswa dan proses pembayaran.</p>
            </div>
        </div>

        {{-- SUCCESS / ERROR --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- INVOICE DETAILS --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-sky-100 dark:border-slate-700/50 pb-2">Informasi Siswa & Tagihan</h2>
                <div class="space-y-3">
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Nama Siswa</span>
                        <span class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $invoice->student?->full_name ?? '-' }} ({{ $invoice->student?->nis ?? '-' }})</span>

                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Unit</span>
                        <span class="text-[13px] font-medium text-slate-700 dark:text-slate-300">{{ $invoice->student?->unit->unit_name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Jenis Tagihan</span>
                        <span class="text-[13px] font-medium text-slate-700 dark:text-slate-300">{{ $invoice->payment_type }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Periode</span>
                        <span class="text-[13px] font-medium text-slate-700 dark:text-slate-300">{{ $invoice->period }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Jatuh Tempo</span>
                        <span class="text-[13px] font-medium text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Nominal</span>
                        <span class="text-lg font-extrabold text-blue-600 dark:text-blue-400">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Status</span>
                        @if ($invoice->status == 'paid')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">Lunas</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-bold bg-red-50 text-red-600 border border-red-200">Belum Lunas</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- PAYMENT FORM OR DETAILS --}}
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-4 border-b border-sky-100 dark:border-slate-700/50 pb-2">Pembayaran</h2>
                
                @if ($invoice->payment)
                    <div class="space-y-3">
                        @if ($invoice->payment->verification_status == 'verified')
                            <div class="bg-emerald-50 text-emerald-700 p-3 rounded-xl flex items-center gap-2 mb-4">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                                <span class="text-sm font-semibold">Tagihan telah dibayar dan diverifikasi</span>
                            </div>
                        @elseif ($invoice->payment->verification_status == 'pending')
                            <div class="bg-amber-50 text-amber-700 p-3 rounded-xl flex items-center gap-2 mb-4">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                                <span class="text-sm font-semibold">Menunggu Verifikasi Admin</span>
                            </div>
                        @else
                            <div class="bg-red-50 text-red-700 p-3 rounded-xl flex items-center gap-2 mb-4">
                                <i data-lucide="x-circle" class="w-5 h-5"></i>
                                <span class="text-sm font-semibold">Pembayaran Ditolak. Harap hapus dan ulangi.</span>
                            </div>
                        @endif

                        <div>
                            <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Metode Pembayaran</span>
                            <span class="text-[13px] font-medium text-slate-800 dark:text-slate-200">{{ ucfirst($invoice->payment->payment_method) }}</span>
                        </div>
                        @if ($invoice->payment->schoolAccount)
                            <div>
                                <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Rekening Tujuan</span>
                                <span class="text-[13px] font-medium text-slate-800 dark:text-slate-200">{{ $invoice->payment->schoolAccount->bank_name }} - {{ $invoice->payment->schoolAccount->account_number }}</span>
                            </div>
                        @endif
                        <div>
                            <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Tanggal Bayar</span>
                            <span class="text-[13px] font-medium text-slate-800 dark:text-slate-200">{{ \Carbon\Carbon::parse($invoice->payment->payment_date)->format('d F Y') }}</span>
                        </div>
                        @if ($invoice->payment->payment_proof)
                            <div>
                                <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Bukti Transfer</span>
                                <a href="{{ asset('storage/' . $invoice->payment->payment_proof) }}" target="_blank" class="text-[13px] font-bold text-blue-500 hover:text-blue-600 underline">Lihat Bukti Foto</a>
                            </div>
                        @endif
                        @if ($invoice->payment->verification_status == 'verified')
                        <div>
                            <span class="block text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-0.5">Diverifikasi Oleh</span>
                            <span class="text-[13px] font-medium text-slate-800 dark:text-slate-200">{{ $invoice->payment->verifier->name ?? 'Admin / Sistem' }}</span>
                        </div>
                        @endif
                        
                        <div class="pt-4 border-t border-sky-100 dark:border-slate-700/50 flex gap-2">
                            <a href="{{ route('admin.pembayaran.index') }}" class="text-xs font-semibold text-emerald-600 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition-colors">Ke Verifikasi</a>
                            <form action="{{ route('admin.pembayaran.destroy', $invoice->payment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-red-600 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100 transition-colors border-none cursor-pointer">Hapus</button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Form Proses Pembayaran oleh Admin --}}
                    <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tanggal Pembayaran</label>
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required
                                class="w-full h-11 px-4 border border-sky-100 dark:border-slate-600 rounded-xl bg-white/50 dark:bg-slate-900/50 text-[13px] focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none transition-all dark:text-slate-200">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" required onchange="toggleAccount(this.value)"
                                class="w-full h-11 px-4 border border-sky-100 dark:border-slate-600 rounded-xl bg-white/50 dark:bg-slate-900/50 text-[13px] focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none transition-all dark:text-slate-200">
                                <option value="cash">Tunai (Cash)</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <div id="account_wrapper" class="hidden">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Pilih Rekening Tujuan</label>
                            <select name="school_account_id" id="school_account_id"
                                class="w-full h-11 px-4 border border-sky-100 dark:border-slate-600 rounded-xl bg-white/50 dark:bg-slate-900/50 text-[13px] focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none transition-all dark:text-slate-200">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach (\App\Models\SchoolAccount::where('is_active', true)->get() as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->bank_name }} - {{ $acc->account_number }} ({{ $acc->account_name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="proof_wrapper" class="hidden">
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Bukti Transfer (Opsional)</label>
                            <input type="file" name="payment_proof" accept="image/*"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[13px] file:font-bold file:bg-blue-50 dark:file:bg-blue-500/10 file:text-blue-600 dark:file:text-blue-400 hover:file:bg-blue-100 cursor-pointer">
                        </div>

                        <div class="pt-3">
                            <button type="submit"
                                class="w-full h-11 rounded-xl text-[13px] font-bold text-white bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center justify-center gap-2 cursor-pointer border-none">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Catat Pembayaran
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </div>

    </div>

    <script>
        function toggleAccount(method) {
            const wrapper = document.getElementById('account_wrapper');
            const proofWrapper = document.getElementById('proof_wrapper');
            const select = document.getElementById('school_account_id');
            if (method === 'transfer') {
                wrapper.classList.remove('hidden');
                proofWrapper.classList.remove('hidden');
                select.setAttribute('required', 'required');
            } else {
                wrapper.classList.add('hidden');
                proofWrapper.classList.add('hidden');
                select.removeAttribute('required');
                select.value = "";
            }
        }
    </script>
@endsection


