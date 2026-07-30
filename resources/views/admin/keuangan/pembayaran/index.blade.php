@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Data Pembayaran</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.rekening-sekolah.index') }}"
                    class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-sm font-semibold transition-all no-underline">
                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                    Pengaturan Rekening
                </a>
            </div>
        </div>

        {{-- TOAST ALERTS --}}

        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                {{-- Status Tabs --}}
                <div class="flex items-center gap-2 overflow-x-auto whitespace-nowrap scrollbar-none pb-1 w-full md:w-auto" style="-webkit-overflow-scrolling: touch;">
                    <a href="{{ route('admin.pembayaran.index') }}"
                        class="shrink-0 h-9 px-4 rounded-full text-[13px] font-bold transition-all no-underline {{ !request('status') ? 'bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] text-white shadow-md shadow-[#4D7EEB]/30' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} inline-flex items-center">
                        Semua
                    </a>
                    <a href="{{ route('admin.pembayaran.index', ['status' => 'pending']) }}"
                        class="shrink-0 h-9 px-4 rounded-full text-[13px] font-bold transition-all no-underline {{ request('status') == 'pending' ? 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} inline-flex items-center">
                        Menunggu Verifikasi
                    </a>
                    <a href="{{ route('admin.pembayaran.index', ['status' => 'verified']) }}"
                        class="shrink-0 h-9 px-4 rounded-full text-[13px] font-bold transition-all no-underline {{ request('status') == 'verified' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600' }} inline-flex items-center">
                        Terverifikasi
                    </a>
                </div>

                {{-- Search --}}
                <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="w-full md:w-auto flex items-center gap-2">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="relative w-full md:w-auto min-w-0 md:min-w-[250px]">
                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama siswa atau NIS..."
                            class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                                  bg-sky-50 text-[13px] text-slate-700 outline-none
                                  focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                    </div>
                </form>

            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1100px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">No</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Siswa</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Tagihan</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Tgl Bayar</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Metode</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Bukti</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Status</th>
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $loop->iteration + $payments->firstItem() - 1 }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $payment->invoice->student->full_name }}</div>
                                    <div class="text-[11px] text-slate-400 dark:text-slate-500 font-mono">{{ $payment->invoice->student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] text-slate-700 dark:text-slate-300 font-medium">{{ $payment->invoice->payment_type }}</div>
                                    <div class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold">Rp {{ number_format($payment->invoice->amount, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600 dark:text-slate-400">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3.5">
                                    @if($payment->payment_method == 'cash')
                                        <span class="inline-flex items-center gap-1.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 px-2.5 py-1 rounded-full text-xs font-bold border border-slate-200 dark:border-slate-600">
                                            <i data-lucide="banknote" class="w-3 h-3"></i> Tunai
                                        </span>
                                    @else
                                        <div>
                                            <span class="inline-flex items-center gap-1.5 text-sky-700 dark:text-sky-400 bg-sky-100 dark:bg-sky-900/30 px-2.5 py-1 rounded-full text-xs font-bold border border-sky-200 dark:border-sky-800">
                                                <i data-lucide="building-2" class="w-3 h-3"></i> Transfer
                                            </span>
                                            <div class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">{{ $payment->schoolAccount->bank_name ?? '' }}</div>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($payment->payment_proof)
                                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 transition-colors text-[11px] font-bold border border-slate-200 dark:border-slate-600 no-underline">
                                            <i data-lucide="image" class="w-3.5 h-3.5"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-[11px] text-slate-400 dark:text-slate-500 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($payment->verification_status == 'verified')
                                        <div>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Terverifikasi
                                            </span>
                                            <div class="text-[10px] text-slate-400 dark:text-slate-500 mt-1">Oleh: {{ $payment->verifier->name ?? 'Sistem' }}</div>
                                        </div>
                                    @elseif ($payment->verification_status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400 border border-amber-200 dark:border-amber-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Menunggu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 border border-red-200 dark:border-red-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex flex-wrap justify-center gap-1.5">
                                        @if ($payment->verification_status == 'pending')
                                            <form action="{{ route('admin.pembayaran.verify', $payment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="confirmAction(event, 'Verifikasi', 'Konfirmasi verifikasi pembayaran ini?', 'Ya, Verifikasi', 'bg-emerald-500 hover:bg-emerald-600')"
                                                    class="w-8 h-8 rounded-full bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all inline-flex items-center justify-center cursor-pointer shadow-sm"
                                                    title="Verifikasi">
                                                    <i data-lucide="check" class="w-[14px] h-[14px]"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.pembayaran.reject', $payment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="confirmAction(event, 'Tolak', 'Tolak pembayaran ini?', 'Ya, Tolak', 'bg-amber-500 hover:bg-amber-600')"
                                                    class="w-8 h-8 rounded-full bg-amber-50 dark:bg-amber-900/30 border border-amber-200 dark:border-amber-800 text-amber-600 dark:text-amber-400 hover:bg-amber-500 hover:text-white hover:border-amber-500 transition-all inline-flex items-center justify-center cursor-pointer shadow-sm"
                                                    title="Tolak">
                                                    <i data-lucide="x" class="w-[14px] h-[14px]"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($payment->verification_status == 'verified')
                                            <a href="{{ route('admin.pembayaran.print', $payment->id) }}" target="_blank"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                                title="Cetak Struk">
                                                <i data-lucide="printer" class="w-[14px] h-[14px]"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.tagihan.student', $payment->invoice->student->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 hover:text-blue-600 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Buku Siswa">
                                            <i data-lucide="book" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <form action="{{ route('admin.pembayaran.destroy', $payment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800 text-red-500 dark:text-red-400 hover:text-red-600 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer border-none"
                                                title="Hapus Permanen">
                                                <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="flex flex-col items-center justify-center py-20 text-center">
                                        <div class="mb-6 relative">
                                            <div class="absolute inset-0 bg-emerald-200 dark:bg-emerald-900 blur-[32px] opacity-30 rounded-full"></div>
                                            <div class="w-28 h-28 bg-emerald-50 dark:bg-slate-800/80 rounded-[2rem] border border-white/60 dark:border-slate-700 shadow-xl flex items-center justify-center relative z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                                                <i data-lucide="wallet" class="w-12 h-12 text-emerald-400 dark:text-emerald-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum Ada Pembayaran</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Data pembayaran belum tersedia atau filter tidak cocok.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- BOTTOM BAR --}}
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">Tampilkan</span>
                    <select onchange="window.location.href='?per_page=' + this.value + '{{ request('status') ? '&status=' . request('status') : '' }}'"
                        class="h-[36px] px-2 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-lg bg-sky-50 dark:bg-slate-900/50 text-[13px] font-bold text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 transition-all cursor-pointer">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">data</span>
                </div>
                @if ($payments->hasPages())
                    <div class="w-full sm:w-auto overflow-x-auto">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


