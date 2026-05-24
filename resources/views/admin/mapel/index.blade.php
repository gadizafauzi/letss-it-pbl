@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>

                <h1 class="text-[28px] font-semibold text-slate-800">
                    Mata Pelajaran
                </h1>
            </div>

            {{-- BUTTON --}}
            <div class="flex flex-col sm:flex-row gap-3 w-full xl:w-auto">

                <a href="{{ route('admin.mapel.create') }}"
                    class="h-11 px-5 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                    text-white transition-all inline-flex items-center justify-center
                    gap-2 text-sm font-semibold shadow-lg shadow-emerald-100">

                    <i data-lucide="plus" class="w-4 h-4"></i>

                    Tambah Data

                </a>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <div class="p-5 border-b border-slate-100">

                <form method="GET">

                    <div class="flex flex-col xl:flex-row xl:items-center gap-4">

                        {{-- SEARCH --}}
                        <div class="relative flex-1">

                            <i data-lucide="search"
                                class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari mata pelajaran..."
                                class="w-full h-12 pl-12 pr-4 rounded-2xl border border-slate-200 bg-slate-50
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400 transition-all text-sm text-slate-700">

                        </div>

                        {{-- FILTER UNIT --}}
                        <div class="flex flex-col sm:flex-row gap-3">

                            <select name="unit_id" onchange="this.form.submit()"
                                class="h-12 px-4 rounded-2xl border border-slate-200 bg-white
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                text-sm font-medium text-slate-700">

                                <option value="">
                                    Semua Unit
                                </option>

                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ request('unit_id') == $unit->id ? 'selected' : '' }}>

                                        {{ $unit->unit_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1000px]">

                    {{-- HEAD --}}
                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th
                                class="w-[70px] px-6 py-4 text-center text-[11px]
                                font-bold uppercase tracking-wide text-slate-500">
                                No
                            </th>

                            <th
                                class="px-6 py-4 text-left text-[11px]
                                font-bold uppercase tracking-wide text-slate-500">
                                Kode Mapel
                            </th>

                            <th
                                class="px-6 py-4 text-left text-[11px]
                                font-bold uppercase tracking-wide text-slate-500">
                                Mata Pelajaran
                            </th>

                            <th
                                class="px-6 py-4 text-left text-[11px]
                                font-bold uppercase tracking-wide text-slate-500">
                                Unit
                            </th>

                            <th
                                class="w-[140px] px-6 py-4 text-center text-[11px]
                                font-bold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-slate-100">

                        @forelse ($subjects as $subject)
                            <tr class="hover:bg-slate-50 transition-colors duration-200">

                                {{-- NO --}}
                                <td class="px-6 py-5 text-sm text-center font-semibold text-slate-600">
                                    {{ $loop->iteration + ($subjects->firstItem() - 1) }}
                                </td>

                                {{-- KODE --}}
                                <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                    {{ $subject->subject_code }}
                                </td>

                                {{-- MAPEL --}}
                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-sm font-semibold text-slate-800">
                                            {{ $subject->subject_name }}
                                        </span>

                                    </div>

                                </td>

                                {{-- UNIT --}}
                                <td class="px-6 py-5">

                                    <span
                                        class="px-3 py-1 rounded-xl bg-emerald-50
                                        text-emerald-600 text-xs font-semibold">

                                        {{ $subject->unit->unit_name ?? '-' }}

                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.mapel.edit', $subject->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            shadow-sm text-emerald-500 hover:text-emerald-600
                                            inline-flex items-center justify-center transition-all">

                                            <i data-lucide="square-pen" class="w-4 h-4"></i>

                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.mapel.destroy', $subject->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" onclick="return confirm('Hapus data mapel ini?')"
                                                class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100
                                                shadow-sm text-red-500 hover:text-red-600
                                                inline-flex items-center justify-center transition-all">

                                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty
                            <tr>

                                <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">

                                    Data mata pelajaran belum tersedia

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            @if ($subjects->hasPages())
                <div class="p-5 border-t border-slate-100">

                    {{ $subjects->links() }}

                </div>
            @endif

        </div>

    </div>
@endsection
