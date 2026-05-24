@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>
                <h1 class="text-[28px] font-semibold text-slate-800">
                    Tahun Ajaran
                </h1>
            </div>

            <a href="{{ route('admin.tahun-ajaran.create') }}"
                class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white
           inline-flex items-center gap-2 text-sm font-semibold shadow-lg shadow-emerald-100">

                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Tahun Ajaran
            </a>

        </div>

        {{-- CARD --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <div class="p-5 border-b border-slate-100">

                <div class="flex flex-col xl:flex-row xl:items-center gap-4">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">
                        <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" placeholder="Cari tahun ajaran..."
                            class="w-full h-12 pl-12 pr-4 rounded-2xl border border-slate-200 bg-slate-50
                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                        focus:border-emerald-400 text-sm">
                    </div>

                    {{-- FILTER --}}
                    <div class="flex gap-3">

                        <select class="h-12 px-4 rounded-2xl border border-slate-200 text-sm">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Selesai</option>
                        </select>

                        <select class="h-12 px-4 rounded-2xl border border-slate-200 text-sm">
                            <option value="">Semua Semester</option>
                            <option value="odd">Ganjil</option>
                            <option value="even">Genap</option>
                        </select>

                    </div>

                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Tahun Ajaran
                            </th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase text-slate-500">
                                Semester Aktif
                            </th>
                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($academicYears as $year)
                            <tr class="hover:bg-slate-50 transition-all">

                                {{-- YEAR --}}
                                <td class="px-6 py-5 text-sm font-semibold text-slate-800">
                                    {{ $year->year }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5">
                                    @if ($year->status == 'active')
                                        <span
                                            class="px-3 py-1 rounded-xl bg-emerald-50 text-emerald-600 text-xs font-medium">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-xl bg-slate-100 text-slate-600 text-xs font-medium">
                                            Selesai
                                        </span>
                                    @endif
                                </td>

                                {{-- SEMESTER --}}
                                <td class="px-6 py-5 text-sm text-slate-700">
                                    {{ $year->active_semester == 'odd' ? 'Ganjil' : 'Genap' }}
                                </td>

                                {{-- ACTION --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.tahun-ajaran.edit', $year->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-600
                                       flex items-center justify-center">

                                            <i data-lucide="square-pen" class="w-4 h-4"></i>
                                        </a>

                                        {{-- SET AKTIF --}}
                                        @if ($year->status != 'active')
                                            <form method="POST"
                                                action="{{ route('admin.tahun-ajaran.set-active', $year->id) }}">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                    class="h-9 px-4 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-medium">
                                                    Set Aktif
                                                </button>
                                            </form>
                                        @endif

                                        {{-- DELETE --}}
                                        <form method="POST"
                                            action="{{ route('admin.tahun-ajaran.destroy', $year->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 flex items-center justify-center">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-slate-400">
                                    Data tahun ajaran belum tersedia
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
