@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Rekening Sekolah</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Manajemen rekening bank milik sekolah</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.rekening-sekolah.create') }}"
                    class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-sm font-semibold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Rekening
                </a>
            </div>
        </div>

        {{-- SUCCESS / ERROR --}}

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            @foreach (['No', 'Bank', 'No Rekening', 'Atas Nama', 'Status'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($accounts as $account)
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $account->bank_name }}</div>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400 font-mono">
                                    {{ $account->account_number }}
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $account->account_name }}
                                </td>
                                <td class="px-4 py-3.5">
                                    @if ($account->is_active)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400 border-red-200 dark:border-red-500/30">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.rekening-sekolah.edit', $account->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Edit">
                                            <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <form action="{{ route('admin.rekening-sekolah.destroy', $account->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800 text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer border-none"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="flex flex-col items-center justify-center py-20 text-center">
                                        <div class="mb-6 relative">
                                            <div class="absolute inset-0 bg-sky-200 dark:bg-sky-900 blur-[32px] opacity-30 rounded-full"></div>
                                            <div class="w-28 h-28 bg-sky-50 dark:bg-slate-800/80 rounded-[2rem] border border-white/60 dark:border-slate-700 shadow-xl flex items-center justify-center relative z-10 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                                                <i data-lucide="credit-card" class="w-12 h-12 text-sky-400 dark:text-sky-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum ada data rekening</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Silahkan tambahkan data rekening terlebih dahulu.
                                        </p>
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


