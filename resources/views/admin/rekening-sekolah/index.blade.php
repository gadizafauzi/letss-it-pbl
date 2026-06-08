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
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Rekening Sekolah</h1>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.rekening-sekolah.create') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-bold
                          bg-white text-emerald-500 hover:bg-emerald-50 shadow-md hover:shadow-lg transition-all no-underline">
                        <i data-lucide="plus" class="w-[14px] h-[14px]"></i>Tambah Rekening
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

        {{-- TABLE --}}
        <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-[1.5px] border-slate-100">
                            @foreach (['No', 'Bank', 'No Rekening', 'Atas Nama', 'Status'] as $h)
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
                        @forelse ($accounts as $account)
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $account->bank_name }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 font-mono">
                                    {{ $account->account_number }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500">
                                    {{ $account->account_name }}
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($account->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-red-100 text-red-700">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.rekening-sekolah.edit', $account->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-sky-100 text-sky-500
                                              hover:bg-sky-500 hover:text-white transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Edit">
                                            <i data-lucide="square-pen" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        <form action="{{ route('admin.rekening-sekolah.destroy', $account->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus data?')"
                                                class="w-[30px] h-[30px] rounded-lg bg-red-100 text-red-400
                                                       hover:bg-red-500 hover:text-white transition-all
                                                       inline-flex items-center justify-center cursor-pointer border-none" title="Hapus">
                                                <i data-lucide="trash-2" class="w-[13px] h-[13px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl inline-flex items-center justify-center mb-4 text-slate-300">
                                            <i data-lucide="credit-card" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada data rekening</p>
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
