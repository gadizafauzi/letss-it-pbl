@extends('layouts.admin')

@section('content')
    <div class="space-y-5 max-w-5xl">

        {{-- PAGE HEADER --}}
        <div>
            <a href="{{ route('admin.tagihan.index') }}" class="text-sm text-slate-500 hover:text-emerald-600 mb-2 inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Rekap Tagihan
            </a>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight mb-1">Riwayat Tagihan Siswa</h1>
            <p class="text-sm text-slate-500">Detail seluruh tagihan milik <strong class="text-slate-700">{{ $student->full_name }}</strong> ({{ $student->nis }})</p>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium bg-emerald-100 border border-emerald-200 text-emerald-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-[1.5px] border-slate-100">
                            @foreach (['No', 'Jenis Tagihan', 'Periode', 'Jatuh Tempo', 'Nominal', 'Status', 'Aksi'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $loop->iteration + $invoices->firstItem() - 1 }}
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
                                    <div class="flex gap-1.5">
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
                                <td colspan="7">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl inline-flex items-center justify-center mb-4 text-slate-300">
                                            <i data-lucide="receipt" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada tagihan untuk siswa ini</p>
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
