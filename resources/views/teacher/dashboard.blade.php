@extends('layouts.teacher')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    {{-- TOTAL KELAS DIAJAR --}}
    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 group flex items-center gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02]
        hover:border-blue-300 hover:shadow-[-8px_12px_25px_rgba(59,130,246,0.18)]">

        <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110">
            <i data-lucide="book-open" class="w-6 h-6 text-blue-500"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">Total kelas diajar</p>
            <h2 class="text-2xl font-extrabold text-slate-900 counter" data-target="{{ $totalKelasDiajar }}">0</h2>
        </div>
    </div>

    {{-- TOTAL SISWA DIAJAR --}}
    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 group flex items-center gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02]
        hover:border-emerald-300 hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.18)]">

        <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110">
            <i data-lucide="users" class="w-6 h-6 text-emerald-500"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">Total siswa diajar</p>
            <h2 class="text-2xl font-extrabold text-slate-900 counter" data-target="{{ $totalSiswaDiajar }}">0</h2>
        </div>
    </div>

    {{-- TOTAL MAPEL DIAJAR --}}
    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 group flex items-center gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02]
        hover:border-purple-300 hover:shadow-[-8px_12px_25px_rgba(168,85,247,0.18)]">

        <div class="w-14 h-14 rounded-2xl bg-purple-50 flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110">
            <i data-lucide="graduation-cap" class="w-6 h-6 text-purple-500"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">Mata pelajaran diajar</p>
            <h2 class="text-2xl font-extrabold text-slate-900 counter" data-target="{{ $totalMapelDiajar }}">0</h2>
        </div>
    </div>

    {{-- RATA-RATA NILAI DIAJAR --}}
    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 group flex items-center gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02]
        hover:border-orange-300 hover:shadow-[-8px_12px_25px_rgba(249,115,22,0.18)]">

        <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110">
            <i data-lucide="trending-up" class="w-6 h-6 text-orange-500"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">Rata-rata nilai diajar</p>
            @if($subjectAverage !== '-')
                <h2 class="text-2xl font-extrabold text-slate-900 counter" data-target="{{ $subjectAverage }}" data-decimal="1">0</h2>
            @else
                <h2 class="text-2xl font-extrabold text-slate-900">-</h2>
            @endif
        </div>
    </div>

</div>

@if($homeroomClass)

    {{-- DATA WALI KELAS --}}
    <div class="modern-box mb-6">
        <h3 class="box-title">
            Data Wali Kelas {{ $homeroomClass->class_name }}
        </h3>

        <div class="border-t border-slate-100 mt-5 pt-5 grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-400 font-semibold">Total siswa</p>
                    <p class="font-extrabold text-slate-800">
                        <span class="counter" data-target="{{ $totalWaliStudents }}">0</span> Siswa
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-400 font-semibold">Rata-rata nilai</p>
                    <p class="font-extrabold text-slate-800">
                        @if($classAverage !== '-')
                            <span class="counter" data-target="{{ $classAverage }}" data-decimal="1">0</span>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                </div>

                <div>
                    <p class="text-xs text-slate-400 font-semibold">Kehadiran</p>
                    <p class="font-extrabold text-slate-800">
                        <span class="counter" data-target="95">0</span>%
                    </p>
                </div>
            </div>

        </div>
    </div>

@endif

{{-- TABEL KELAS DIAJAR --}}
<div class="modern-box overflow-hidden p-0">
    <div class="px-6 py-5 border-b border-slate-100">
        <h2 class="box-title">Kelas yang Diajar</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Kelas</th>
                    <th class="px-6 py-4 text-left">Mata Pelajaran</th>
                    <th class="px-6 py-4 text-left">Jumlah Siswa</th>
                    <th class="px-6 py-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($assignments as $index => $assignment)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-slate-700">
                            {{ $assignment->schoolClass->class_name ?? 'N/A' }}

                            @if($homeroomClass && $homeroomClass->id == $assignment->class_id)
                                <span class="ml-2 text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full font-normal">
                                    Wali Kelas
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $assignment->subject->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-700 counter" data-target="{{ $assignment->student_count ?? 0 }}">0</td>
                        <td class="px-6 py-4">
                            <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold">
                                Aktif
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="book-x" class="w-8 h-8 text-slate-300"></i>
                                <p class="font-semibold">Belum ada jadwal mengajar pada tahun ajaran ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
