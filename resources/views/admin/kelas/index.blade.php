@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>

                <h1 class="text-[28px] font-semibold text-slate-800">
                    Data Kelas
                </h1>

            </div>

            {{-- ACTION --}}
            <div>

                <a href="{{ route('admin.kelas.create') }}"
                    class="h-11 px-5 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                    text-white transition-all inline-flex items-center justify-center gap-2
                    text-sm font-semibold shadow-lg shadow-emerald-100">

                    <i data-lucide="plus" class="w-4 h-4"></i>

                    Tambah Data

                </a>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <form method="GET" class="p-5 border-b border-slate-100">

                <div class="flex flex-col xl:flex-row xl:items-center gap-4">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">

                        <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kelas atau wali kelas..."
                            class="w-full h-12 pl-12 pr-4 rounded-2xl border border-slate-200 bg-slate-50">

                    </div>

                    {{-- FILTER UNIT --}}
                    <select name="unit_id" class="h-12 px-4 rounded-2xl border border-slate-200 bg-white text-sm">

                        <option value="">
                            Semua Unit
                        </option>

                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </form>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500">
                                No
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500">
                                Nama Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500">
                                Unit
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500">
                                Wali Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500">
                                Jumlah Siswa
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($classes as $class)
                            <tr class="hover:bg-slate-50">

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-5 text-sm font-semibold text-slate-800">
                                    {{ $class->class_name }}
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $class->unit->unit_name }}
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $class->homeroomTeacher->full_name ?? '-' }}
                                </td>

                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $class->students_count }} siswa
                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.kelas.edit', $class->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            text-emerald-600 inline-flex items-center justify-center">

                                            <i data-lucide="square-pen" class="w-4 h-4"></i>

                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.kelas.destroy', $class->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Hapus data?')"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                                                text-red-600 inline-flex items-center justify-center">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-10 text-slate-400">
                                    Belum ada data kelas
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
