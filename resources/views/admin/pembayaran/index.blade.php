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
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Data Pembayaran</h1>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.rekening-sekolah.index') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-bold
                          bg-emerald-700/30 text-white hover:bg-emerald-700/50 transition-all no-underline backdrop-blur-sm">
                        <i data-lucide="credit-card" class="w-[14px] h-[14px]"></i>Pengaturan Rekening
                    </a>
                </div>
            </div>
        </div>

        {{-- SUCCESS / ERROR --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER --}}
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.pembayaran.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all {{ !request('status') ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Semua</a>
                <a href="{{ route('admin.pembayaran.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all {{ request('status') == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Menunggu Verifikasi</a>
                <a href="{{ route('admin.pembayaran.index', ['status' => 'verified']) }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all {{ request('status') == 'verified' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}">Terverifikasi</a>
            </div>
            <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="flex flex-wrap items-center gap-2.5">
                @if(request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama siswa atau NIS..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-slate-200 rounded-[10px] bg-slate-50 text-[13px] text-slate-700 outline-none focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100 transition-all">
                </div>
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-[1.5px] border-slate-100">
                            @foreach (['No', 'Siswa', 'Tagihan', 'Tgl Bayar', 'Metode', 'Bukti', 'Status Verifikasi', 'Aksi'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap {{ $h == 'Aksi' ? 'text-center' : '' }}">
                                    {{ $h }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $loop->iteration + $payments->firstItem() - 1 }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $payment->invoice->student->full_name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $payment->invoice->student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] text-slate-700 font-medium">{{ $payment->invoice->payment_type }}</div>
                                    <div class="text-[11px] text-slate-500">Rp {{ number_format($payment->invoice->amount,0,',','.') }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    @if($payment->payment_method == 'cash')
                                        <span class="inline-flex items-center gap-1 text-slate-700 bg-slate-100 px-2 py-0.5 rounded-full text-xs font-semibold"><i data-lucide="banknote" class="w-3 h-3"></i> Tunai</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-sky-700 bg-sky-100 px-2 py-0.5 rounded-full text-xs font-semibold"><i data-lucide="building-2" class="w-3 h-3"></i> Transfer</span>
                                        <div class="text-[10px] text-slate-400 mt-1">{{ $payment->schoolAccount->bank_name ?? '' }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    @if ($payment->payment_proof)
                                        <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors text-[11px] font-semibold border border-slate-200">
                                            <i data-lucide="image" class="w-3.5 h-3.5"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-[11px] text-slate-400 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    @if ($payment->verification_status == 'verified')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">Terverifikasi</span>
                                        <div class="text-[10px] text-slate-400 mt-1" title="Diverifikasi oleh">Oleh: {{ $payment->verifier->name ?? 'Sistem' }}</div>
                                    @elseif ($payment->verification_status == 'pending')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-700">Menunggu Verifikasi</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-red-100 text-red-700">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex flex-wrap justify-center gap-1.5">
                                        @if ($payment->verification_status == 'pending')
                                            <form action="{{ route('admin.pembayaran.verify', $payment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="return confirm('Konfirmasi verifikasi pembayaran ini?')"
                                                    class="w-[30px] h-[30px] rounded-lg bg-emerald-100 text-emerald-600
                                                           hover:bg-emerald-500 hover:text-white transition-all
                                                           inline-flex items-center justify-center cursor-pointer border-none" title="Terima & Verifikasi">
                                                    <i data-lucide="check" class="w-[13px] h-[13px]"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.pembayaran.reject', $payment->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="return confirm('Tolak pembayaran ini?')"
                                                    class="w-[30px] h-[30px] rounded-lg bg-amber-100 text-amber-600
                                                           hover:bg-amber-500 hover:text-white transition-all
                                                           inline-flex items-center justify-center cursor-pointer border-none" title="Tolak">
                                                    <i data-lucide="x" class="w-[13px] h-[13px]"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($payment->verification_status == 'verified')
                                            <a href="{{ route('admin.pembayaran.print', $payment->id) }}" target="_blank"
                                                class="w-[30px] h-[30px] rounded-lg bg-slate-100 text-slate-600
                                                  hover:bg-slate-500 hover:text-white transition-all
                                                  inline-flex items-center justify-content-center no-underline"
                                                style="justify-content:center" title="Cetak Struk">
                                                <i data-lucide="printer" class="w-[13px] h-[13px]"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('admin.tagihan.student', $payment->invoice->student->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-sky-100 text-sky-600
                                              hover:bg-sky-500 hover:text-white transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Buku Siswa">
                                            <i data-lucide="book" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        <form action="{{ route('admin.pembayaran.destroy', $payment->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus data pembayaran ini secara permanen? Tagihan akan kembali menjadi Belum Lunas.')"
                                                class="w-[30px] h-[30px] rounded-lg bg-red-100 text-red-400
                                                       hover:bg-red-500 hover:text-white transition-all
                                                       inline-flex items-center justify-center cursor-pointer border-none" title="Hapus Permanen">
                                                <i data-lucide="trash-2" class="w-[13px] h-[13px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl inline-flex items-center justify-center mb-4 text-slate-300">
                                            <i data-lucide="wallet" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada pembayaran</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($payments->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
