{{-- resources/views/admin/unit/index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
            <h1 class="text-[28px] font-bold text-slate-800">Unit Pendidikan</h1>

            <a href="{{ route('admin.unit.create') }}"
                class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white transition inline-flex items-center gap-2 text-sm font-bold shadow-lg shadow-emerald-100">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Unit
            </a>
        </div>

        @if (session('success'))
            <div class="px-5 py-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">Nama Unit</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">Jumlah Siswa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-slate-500">Jumlah Guru</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($units as $unit)
                            <tr class="hover:bg-slate-50 transition-all">

                                <td class="px-6 py-5 text-sm text-slate-700">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-5">
                                    <span class="font-semibold text-slate-800">{{ $unit->unit_name }}</span>
                                </td>

                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600">
                                        {{ $unit->students_count }} Siswa
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-600">
                                        {{ $unit->teachers_count }} Guru
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.unit.edit', $unit->id) }}"
                                            class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100
                                            flex items-center justify-center transition-all">
                                            <i data-lucide="square-pen" class="w-4 h-4 text-emerald-600"></i>
                                        </a>

                                        <form action="{{ route('admin.unit.destroy', $unit->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus unit ini? Data siswa dan guru yang terkait akan terpengaruh.')">
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
                                <td colspan="5" class="text-center py-14 text-sm text-slate-400">
                                    Belum ada data unit pendidikan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
