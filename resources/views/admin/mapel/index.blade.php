@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100">Mata Pelajaran</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.mapel.create') }}"
                    class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white text-sm font-semibold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Mapel
                </a>
            </div>
        </div>

        {{-- TOAST ALERTS --}}
        @if (session('success'))
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400">
                <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0"></i>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.mapel.index') }}" method="GET" class="flex flex-wrap items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari mata pelajaran..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                              bg-sky-50 text-[13px] text-slate-700 outline-none
                              focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                </div>

                {{-- Unit --}}
                <select name="unit_id" onchange="this.form.submit()"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 rounded-[10px]
                           bg-sky-50 text-[13px] text-slate-700 outline-none min-w-[140px]
                           focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all cursor-pointer">
                    <option value="">Semua Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[700px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            <th class="px-4 py-3.5 text-center w-10">
                                <input type="checkbox" class="row-checkbox rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 dark:checked:bg-blue-500 cursor-pointer w-4 h-4 transition-all">
                            </th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">No</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Kode Mapel</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Mata Pelajaran</th>
                            <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Unit</th>
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subjects as $subject)
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-center">
                                    <input type="checkbox" value="{{ $subject->id }}" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 bg-white dark:bg-slate-900/50 dark:border-slate-600 cursor-pointer w-4 h-4">
                                </td>
                                <td class="px-4 py-3.5 text-xs text-slate-400 dark:text-slate-500 font-semibold">
                                    {{ $loop->iteration + ($subjects->currentPage() - 1) * $subjects->perPage() }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-[13px] font-bold text-slate-700 dark:text-slate-300 bg-sky-50 dark:bg-sky-900/30 px-2.5 py-1 rounded-lg inline-block">
                                        {{ $subject->subject_code }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $subject->subject_name }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold border bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-400 border-sky-200 dark:border-sky-500/30">
                                        {{ $subject->unit->unit_name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.mapel.edit', $subject->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800 text-blue-500 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                            title="Edit">
                                            <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        <form action="{{ route('admin.mapel.destroy', $subject->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus data mapel ini?')"
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
                                                <i data-lucide="book-open" class="w-12 h-12 text-sky-400 dark:text-sky-300"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100 mb-2">Belum Ada Mata Pelajaran</h3>
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">
                                            Data mata pelajaran masih kosong atau pencarian tidak cocok.
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
                    <select name="per_page" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                        class="h-[36px] px-2 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-lg bg-sky-50 dark:bg-slate-900/50 text-[13px] font-bold text-slate-700 dark:text-slate-200 outline-none focus:border-sky-400 transition-all cursor-pointer">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">data</span>
                </div>
                @if ($subjects->hasPages())
                    <div class="w-full sm:w-auto overflow-x-auto">
                        {{ $subjects->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');
            let debounce;
            if (searchInput && filterForm) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounce);
                    debounce = setTimeout(() => filterForm.submit(), 500);
                });
            }
        });
    </script>
@endsection
