@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>
                <h1 class="text-[28px] font-bold text-slate-800">
                    Data Guru
                </h1>
            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 w-full xl:w-auto">

                {{-- IMPORT --}}
                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition-all inline-flex items-center justify-center gap-2 text-sm font-semibold text-slate-700">

                    <i data-lucide="upload" class="w-4 h-4"></i>
                    Import

                </button>

                {{-- EXPORT --}}
                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition-all inline-flex items-center justify-center gap-2 text-sm font-semibold text-slate-700">

                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export

                </button>

                {{-- TAMBAH --}}
                <a href="{{ route('admin.guru.create') }}"
                    class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white transition-all inline-flex items-center justify-center gap-2 text-sm font-bold shadow-lg shadow-emerald-100">

                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Guru

                </a>

            </div>

        </div>

        {{-- CARD --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <div class="p-5 border-b border-slate-100 bg-white">

                <form method="GET">

                    <div class="flex flex-col xl:flex-row xl:items-center gap-4">

                        {{-- SEARCH --}}
                        <div class="relative flex-1">

                            <i data-lucide="search"
                                class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama guru atau NIP..."
                                class="w-full h-12 pl-12 pr-4 rounded-2xl border border-slate-200 bg-slate-50
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400 transition-all text-sm text-slate-700">

                        </div>

                        {{-- FILTER UNIT --}}
                        <div class="w-full xl:w-[220px]">

                            <select name="unit"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400 transition-all text-sm text-slate-700">

                                <option value="">
                                    Semua Unit
                                </option>

                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ request('unit') == $unit->id ? 'selected' : '' }}>

                                        {{ $unit->unit_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- FILTER JABATAN --}}
                        <div class="w-full xl:w-[220px]">

                            <select name="position"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400 transition-all text-sm text-slate-700">

                                <option value="">
                                    Semua Jabatan
                                </option>

                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ request('position') == $position->id ? 'selected' : '' }}>

                                        {{ $position->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px]">

                    {{-- TABLE HEAD --}}
                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                NO
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                NIP
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Nama Guru
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Unit
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Jabatan
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Status Kepegawaian
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                No. Telepon
                            </th>

                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-slate-100">

                        @forelse ($teachers as $teacher)
                            <tr class="hover:bg-slate-50 transition-all">

                                {{-- NO --}}
                                <td class="px-6 py-5 text-sm font-semibold text-slate-700">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- NIP --}}
                                <td class="px-6 py-5 text-sm font-semibold text-slate-700">
                                    {{ $teacher->nip ?? '-' }}
                                </td>

                                {{-- NAMA --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-sm font-bold text-slate-800">
                                            {{ $teacher->full_name }}
                                        </span>

                                        <span class="text-xs text-slate-400">
                                            {{ $teacher->email ?? 'Tidak ada email' }}
                                        </span>

                                    </div>

                                </td>

                                {{-- UNIT --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $teacher->unit->unit_name ?? '-' }}
                                </td>

                                {{-- JABATAN --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $teacher->position->name ?? '-' }}
                                </td>

                                {{-- STATUS KEPEGAWAIAN --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    @if ($teacher->employment_status == 'pegawai_tetap')
                                        Pegawai Tetap
                                    @elseif($teacher->employment_status == 'pegawai_tidak_tetap')
                                        Pegawai Tidak Tetap
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- NO HP --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $teacher->phone ?? '-' }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5 text-sm text-center">

                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $teacher->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">

                                        {{ $teacher->status == 'active' ? 'Aktif' : 'Nonaktif' }}

                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.guru.show', $teacher->id) }}"
                                            class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200
                                            inline-flex items-center justify-center transition-all">

                                            <i data-lucide="eye" class="w-4 h-4"></i>

                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.guru.edit', $teacher->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            text-emerald-600 inline-flex items-center justify-center transition-all">

                                            <i data-lucide="square-pen" class="w-4 h-4"></i>

                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.guru.destroy', $teacher->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data guru ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                                                text-red-600 inline-flex items-center justify-center transition-all">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-10 text-slate-400">
                                    Belum ada data guru
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
