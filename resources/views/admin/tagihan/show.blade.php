@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-4xl">

        {{-- PAGE HEADER --}}
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Detail Tagihan</h1>
            <p class="text-sm text-slate-500">Informasi tagihan siswa dan proses pembayaran.</p>
        </div>

        {{-- SUCCESS / ERROR --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-red-100 border border-red-200 text-red-700">
                <i data-lucide="alert-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- INVOICE DETAILS --}}
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Informasi Siswa & Tagihan</h2>
                <div class="space-y-3">
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Nama Siswa</span>
                        <span class="text-sm font-medium text-slate-800">{{ $invoice->student->full_name }} ({{ $invoice->student->nis }})</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Unit</span>
                        <span class="text-sm font-medium text-slate-800">{{ $invoice->student->unit->unit_name ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Jenis Tagihan</span>
                        <span class="text-sm font-medium text-slate-800">{{ $invoice->payment_type }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Periode</span>
                        <span class="text-sm font-medium text-slate-800">{{ $invoice->period }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Jatuh Tempo</span>
                        <span class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Nominal</span>
                        <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-400 font-semibold uppercase">Status</span>
                        @if ($invoice->status == 'paid')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">Lunas</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-red-100 text-red-700">Belum Lunas</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- PAYMENT FORM OR DETAILS --}}
            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Pembayaran</h2>
                
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
                                <span class="text-sm font-semibold">Pembayaran Ditolak. Harap hapus dan ulangi proses pembayaran.</span>
                            </div>
                        @endif

                        <div>
                            <span class="block text-xs text-slate-400 font-semibold uppercase">Metode Pembayaran</span>
                            <span class="text-sm font-medium text-slate-800">{{ ucfirst($invoice->payment->payment_method) }}</span>
                        </div>
                        @if ($invoice->payment->schoolAccount)
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold uppercase">Rekening Tujuan</span>
                                <span class="text-sm font-medium text-slate-800">{{ $invoice->payment->schoolAccount->bank_name }} - {{ $invoice->payment->schoolAccount->account_number }}</span>
                            </div>
                        @endif
                        <div>
                            <span class="block text-xs text-slate-400 font-semibold uppercase">Tanggal Bayar</span>
                            <span class="text-sm font-medium text-slate-800">{{ \Carbon\Carbon::parse($invoice->payment->payment_date)->format('d F Y') }}</span>
                        </div>
                        @if ($invoice->payment->payment_proof)
                            <div>
                                <span class="block text-xs text-slate-400 font-semibold uppercase">Bukti Transfer</span>
                                <a href="{{ asset('storage/' . $invoice->payment->payment_proof) }}" target="_blank" class="text-sm font-medium text-sky-600 hover:underline">Lihat Bukti Foto</a>
                            </div>
                        @endif
                        @if ($invoice->payment->verification_status == 'verified')
                        <div>
                            <span class="block text-xs text-slate-400 font-semibold uppercase">Diverifikasi Oleh</span>
                            <span class="text-sm font-medium text-slate-800">{{ $invoice->payment->verifier->name ?? 'Admin / Sistem' }}</span>
                        </div>
                        @endif
                        
                        <div class="pt-4 border-t border-slate-100 flex gap-2">
                            <a href="{{ route('admin.pembayaran.index') }}" class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded hover:bg-emerald-100 transition-colors">Ke Halaman Verifikasi</a>
                            <form action="{{ route('admin.pembayaran.destroy', $invoice->payment->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data pembayaran ini?')" class="text-xs font-semibold text-red-600 bg-red-50 px-3 py-1.5 rounded hover:bg-red-100 transition-colors border-none cursor-pointer">Hapus Pembayaran</button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Form Proses Pembayaran oleh Admin --}}
                    <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Pembayaran</label>
                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required
                                class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Metode Pembayaran</label>
                            <select name="payment_method" id="payment_method" required onchange="toggleAccount(this.value)"
                                class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                                <option value="cash">Tunai (Cash)</option>
                                <option value="transfer">Transfer Bank</option>
                            </select>
                        </div>

                        <div id="account_wrapper" class="hidden">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Pilih Rekening Tujuan</label>
                            <select name="school_account_id" id="school_account_id"
                                class="w-full h-11 px-4 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all">
                                <option value="">-- Pilih Rekening --</option>
                                @foreach (\App\Models\SchoolAccount::where('is_active', true)->get() as $acc)
                                    <option value="{{ $acc->id }}">{{ $acc->bank_name }} - {{ $acc->account_number }} ({{ $acc->account_name }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="proof_wrapper" class="hidden">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Bukti Transfer (Opsional)</label>
                            <input type="file" name="payment_proof" accept="image/*"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full h-11 rounded-xl text-sm font-semibold text-white bg-emerald-500 hover:bg-emerald-600 shadow-sm shadow-emerald-500/20 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Catat Pembayaran
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.tagihan.student', $invoice->student_id) }}" class="text-sm text-slate-500 hover:text-slate-800 flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Riwayat Tagihan Siswa
            </a>
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
