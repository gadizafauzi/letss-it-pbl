@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- PAGE TITLE --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <h1 class="text-[28px] font-bold text-slate-800">
                Data Siswa
            </h1>

            {{-- ACTION BUTTON --}}
            <div class="flex flex-col sm:flex-row gap-3">

                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <i data-lucide="upload" class="w-4 h-4"></i>
                    Import
                </button>

                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export
                </button>

                <a href="{{ route('admin.siswa.create') }}"
                    class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white transition inline-flex items-center gap-2 text-sm font-bold shadow-lg shadow-emerald-100">

                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Siswa
                </a>

            </div>
        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="px-5 py-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE CARD --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <div class="p-5 border-b border-slate-100">

                <form class="flex flex-col xl:flex-row gap-4">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">

                        <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" placeholder="Cari nama siswa, NIS, NISN..."
                            class="w-full h-12 pl-12 pr-4 rounded-2xl border bg-slate-50
                            focus:bg-white focus:ring-4 focus:ring-emerald-100
                            focus:border-emerald-400 text-sm">

                    </div>

                    {{-- UNIT --}}
                    <select
                        class="h-12 px-4 rounded-2xl border bg-slate-50
                        focus:bg-white focus:ring-4 focus:ring-emerald-100 text-sm">

                        <option value="">Semua Unit</option>

                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}">
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach

                    </select>

                    {{-- KELAS --}}
                    <select
                        class="h-12 px-4 rounded-2xl border bg-slate-50
                        focus:bg-white focus:ring-4 focus:ring-emerald-100 text-sm">

                        <option value="">Semua Kelas</option>

                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">
                                {{ $class->class_name }}
                            </option>
                        @endforeach

                    </select>

                    {{-- STATUS --}}
                    <select
                        class="h-12 px-4 rounded-2xl border bg-slate-50
                        focus:bg-white focus:ring-4 focus:ring-emerald-100 text-sm">

                        <option value="">Semua Status</option>

                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                        <option value="graduated">Tamat</option>
                        <option value="transfer">Pindah</option>
                        <option value="dropout">DO</option>

                    </select>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1100px]">

                    <thead class="bg-slate-50 border-b">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                No
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                NIS
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                Nama
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                Unit
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                WA Ortu
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($students as $student)
                            @php

                                $activeClass = $student->studentClasses->first();

                                $status = $student->status;

                                $statusLabel = match ($status) {
                                    'active' => 'Aktif',

                                    'inactive' => 'Tidak Aktif',

                                    'graduated' => 'Tamat',

                                    'transfer' => 'Pindah',

                                    'dropout' => 'DO',

                                    default => '-',
                                };

                                $statusColors = match ($status) {
                                    'active' => 'bg-emerald-50 text-emerald-600',

                                    'inactive' => 'bg-slate-100 text-slate-600',

                                    'graduated' => 'bg-cyan-50 text-cyan-600',

                                    'transfer' => 'bg-amber-50 text-amber-600',

                                    'dropout' => 'bg-red-50 text-red-600',

                                    default => 'bg-slate-100 text-slate-600',
                                };

                            @endphp

                            <tr class="hover:bg-slate-50 transition-all">

                                {{-- NO --}}
                                <td class="px-6 py-5 text-sm text-slate-700">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- NIS --}}
                                <td class="px-6 py-5">

                                    <span class="font-bold text-slate-800">
                                        {{ $student->nis ?? '-' }}
                                    </span>

                                </td>

                                {{-- NAMA --}}
                                <td class="px-6 py-5">

                                    <div class="space-y-1">

                                        <h4 class="font-semibold text-slate-800">
                                            {{ $student->full_name }}
                                        </h4>

                                        <p class="text-xs text-slate-400">
                                            {{ $student->nisn ?? '-' }}
                                        </p>

                                    </div>

                                </td>

                                {{-- UNIT --}}
                                <td class="px-6 py-5 text-sm text-slate-700">
                                    {{ $student->unit->unit_name ?? '-' }}
                                </td>

                                {{-- KELAS --}}
                                <td class="px-6 py-5 text-sm text-slate-700">

                                    {{ $activeClass?->schoolClass?->class_name ?? '-' }}

                                </td>

                                {{-- WA ORTU --}}
                                <td class="px-6 py-5">

                                    <div>

                                        <div class="font-medium text-slate-700">
                                            {{ $student->parent_phone ?? '-' }}
                                        </div>

                                        <div class="text-xs text-slate-400">
                                            {{ $student->father_name ?? '-' }}
                                        </div>

                                    </div>

                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors }}">

                                        {{ $statusLabel }}

                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.siswa.show', $student->id) }}"
                                            class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200
                                            flex items-center justify-center transition-all">

                                            <i data-lucide="eye" class="w-4 h-4 text-slate-600"></i>

                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.siswa.edit', $student->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            flex items-center justify-center transition-all">

                                            <i data-lucide="square-pen" class="w-4 h-4 text-emerald-600"></i>

                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus data siswa ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                                                flex items-center justify-center transition-all">

                                                <i data-lucide="trash-2" class="w-4 h-4 text-red-600"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-14 text-sm text-slate-400">

                                    Belum ada data siswa

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
