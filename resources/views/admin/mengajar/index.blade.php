@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>
                <h1 class="text-[28px] font-semibold text-slate-800">
                    Data Mengajar
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola data pengajaran guru berdasarkan kelas dan tahun ajaran
                </p>
            </div>

            {{-- BUTTON --}}
            <a href="{{ route('admin.mengajar.create') }}"
                class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white
                inline-flex items-center gap-2 text-sm font-semibold shadow-lg shadow-emerald-100 transition-all">

                <i data-lucide="plus" class="w-4 h-4"></i>

                Tambah Data

            </a>

        </div>

        {{-- CARD --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    {{-- HEAD --}}
                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Guru
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Mata Pelajaran
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Jenjang
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Tahun Ajaran
                            </th>

                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-slate-100">

                        @forelse ($teachingAssignments as $item)
                            <tr class="hover:bg-slate-50/80 transition-all">

                                {{-- GURU --}}
                                <td class="px-6 py-5">

                                    <div>
                                        <h4 class="text-sm font-semibold text-slate-800">
                                            {{ $item->teacher->full_name ?? '-' }}
                                        </h4>
                                    </div>

                                </td>

                                {{-- MAPEL --}}
                                <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                    {{ $item->subject->subject_name ?? '-' }}
                                </td>

                                {{-- KELAS --}}
                                <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                    {{ $item->schoolClass->class_name ?? '-' }}
                                </td>

                                {{-- JENJANG --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $item->schoolClass->unit->unit_name ?? '-' }}
                                </td>

                                {{-- TAHUN AJARAN --}}
                                <td class="px-6 py-5 text-sm text-slate-600">
                                    {{ $item->academicYear->year ?? '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.mengajar.edit', $item->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            text-emerald-600 inline-flex items-center justify-center transition-all">

                                            <i data-lucide="square-pen" class="w-4 h-4"></i>

                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.mengajar.destroy', $item->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Hapus data ini?')"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                                                text-red-500 hover:text-red-600 inline-flex items-center justify-center transition-all">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>
                        @empty
                            <tr>

                                <td colspan="6" class="py-10 text-center text-sm text-slate-400">
                                    Data mengajar belum tersedia
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
