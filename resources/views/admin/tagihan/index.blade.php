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
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Data Tagihan</h1>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.tagihan.create') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-bold
                          bg-white text-emerald-500 hover:bg-emerald-50 shadow-md hover:shadow-lg transition-all no-underline">
                        <i data-lucide="plus" class="w-[14px] h-[14px]"></i>Generate Tagihan
                    </a>
                </div>
            </div>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER --}}
        <div class="bg-white border border-slate-100 rounded-2xl px-5 py-4 shadow-sm">
            <form action="{{ route('admin.tagihan.index') }}" method="GET" class="flex flex-wrap items-center gap-2.5">
                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama atau NIS siswa..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-slate-200 rounded-[10px] bg-slate-50 text-[13px] text-slate-700 outline-none focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100 transition-all">
                </div>

                {{-- Status --}}
                <select name="status" onchange="this.form.submit()"
                    class="h-[42px] px-3 border-[1.5px] border-slate-200 rounded-[10px] bg-slate-50 text-[13px] text-slate-700 outline-none min-w-[140px] focus:border-emerald-400 focus:bg-white focus:ring-2 focus:ring-emerald-100 transition-all">
                    <option value="">Semua Status</option>
                    <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                </select>
                <button type="submit" class="hidden"></button>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-[1.5px] border-slate-100">
                            @foreach (['No', 'Siswa', 'Jenis Tagihan', 'Periode', 'Jatuh Tempo', 'Nominal', 'Status'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $loop->iteration + $invoices->firstItem() - 1 }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $invoice->student->full_name }}</div>
                                    <div class="text-[11px] text-slate-500">{{ $invoice->student->nis }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-700 font-medium">
                                    {{ $invoice->payment_type }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    {{ $invoice->period }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-600">
                                    {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] font-bold text-slate-700">
                                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($invoice->status == 'paid')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">Lunas</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-red-100 text-red-700">Belum Lunas</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.tagihan.show', $invoice->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-emerald-100 text-emerald-600
                                              hover:bg-emerald-500 hover:text-white transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Detail / Bayar">
                                            <i data-lucide="eye" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        @if($invoice->status == 'unpaid')
                                        <form action="{{ route('admin.tagihan.destroy', $invoice->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus tagihan ini?')"
                                                class="w-[30px] h-[30px] rounded-lg bg-red-100 text-red-400
                                                       hover:bg-red-500 hover:text-white transition-all
                                                       inline-flex items-center justify-center cursor-pointer border-none" title="Hapus">
                                                <i data-lucide="trash-2" class="w-[13px] h-[13px]"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl inline-flex items-center justify-center mb-4 text-slate-300">
                                            <i data-lucide="receipt" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada tagihan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($invoices->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
