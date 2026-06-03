@extends('layouts.admin')

@section('content')
    <div class="space-y-5">

        {{-- PAGE HEADER --}}
        <div class="relative overflow-hidden rounded-2xl px-7 py-6"
            style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 55%, #60a5fa 100%);">
            <div class="absolute -top-12 -right-12 w-44 h-44 bg-white/[.08] rounded-full"></div>
            <div class="absolute -bottom-16 left-8 w-56 h-56 bg-white/[.05] rounded-full"></div>
            <div class="relative z-10 flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-white/60 mb-1">
                        Manajemen Akademik
                    </p>
                    <h1 class="text-[26px] font-extrabold text-white leading-tight">Data Jabatan</h1>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.jabatan.create') }}"
                        class="inline-flex items-center gap-1.5 h-[38px] px-4 rounded-[10px] text-xs font-bold
                          bg-white text-sky-500 hover:bg-sky-50 shadow-md hover:shadow-lg transition-all no-underline">
                        <i data-lucide="plus" class="w-[14px] h-[14px]"></i>Tambah Jabatan
                    </a>
                </div>
            </div>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="flex items-center gap-2.5 px-4 py-3.5 rounded-xl text-sm font-medium
                    bg-sky-100 border border-sky-200 text-sky-700">
                <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER --}}
        <div class="bg-white border border-sky-100 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.jabatan.index') }}" method="GET"
                class="flex flex-wrap items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama jabatan..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 rounded-[10px]
                              bg-sky-50 text-[13px] text-slate-700 outline-none
                              focus:border-sky-400 focus:bg-white focus:ring-2 focus:ring-sky-100 transition-all">
                </div>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-sky-100 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-sky-50 border-b-[1.5px] border-sky-100">
                            @foreach (['No', 'Nama Jabatan', 'Jumlah Guru'] as $h)
                                <th
                                    class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 whitespace-nowrap">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th
                                class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jabatans as $jabatan)
                            <tr class="border-b border-sky-50 hover:bg-sky-50/50 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800">{{ $jabatan->name }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-sky-100 text-sky-700">
                                        {{ $jabatan->teachers_count }} Guru
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.jabatan.edit', $jabatan->id) }}"
                                            class="w-[30px] h-[30px] rounded-lg bg-sky-100 text-sky-500
                                              hover:bg-sky-500 hover:text-white transition-all
                                              inline-flex items-center justify-content-center no-underline"
                                            style="justify-content:center" title="Edit">
                                            <i data-lucide="square-pen" class="w-[13px] h-[13px]"></i>
                                        </a>
                                        <form action="{{ route('admin.jabatan.destroy', $jabatan->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus jabatan ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-[30px] h-[30px] rounded-lg bg-red-100 text-red-400
                                                       hover:bg-red-500 hover:text-white transition-all
                                                       inline-flex items-center justify-center cursor-pointer border-none"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[13px] h-[13px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div
                                            class="w-14 h-14 bg-sky-50 rounded-2xl inline-flex items-center justify-center mb-4 text-sky-300">
                                            <i data-lucide="briefcase" class="w-7 h-7"></i>
                                        </div>
                                        <p class="text-[15px] font-bold text-slate-800 mb-1.5">Belum ada data jabatan</p>
                                        <p class="text-[13px] text-slate-400">Data jabatan belum tersedia atau pencarian
                                            tidak cocok.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
