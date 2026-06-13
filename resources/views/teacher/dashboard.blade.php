@extends('layouts.teacher')

@section('content')

{{-- BANNER SAMBUTAN --}}
<div class="rounded-[20px] p-4 md:p-6 flex items-center justify-between relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    {{-- Dekorasi background --}}
    <div class="absolute top-0 right-0 w-56 h-56 bg-white opacity-5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
    <div class="absolute bottom-0 right-28 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl -mb-8 pointer-events-none"></div>
    {{-- Aksen pink lembut --}}
    <div class="absolute top-4 right-8 w-3 h-3 rounded-full opacity-40 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-4 right-20 w-2 h-2 rounded-full opacity-30 pointer-events-none" style="background:#fb7185;"></div>

    <div class="relative z-10 text-white w-full">
        <h2 class="text-lg md:text-2xl font-extrabold mb-1">
            Hai, {{ explode(' ', $teacher->full_name)[0] }}! <span>👋</span>
        </h2>
        <p class="text-blue-100 text-xs md:text-sm font-medium leading-snug max-w-xl">
            Selamat datang kembali. Kelola kelas dan nilai siswa Anda dengan mudah.
        </p>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-6">

    {{-- TOTAL KELAS DIAJAR --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 border border-blue-400 rounded-3xl px-4 py-4 md:px-6 md:py-5 group flex items-center gap-3 md:gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-[0_4px_15px_-3px_rgba(59,130,246,0.3)] hover:shadow-[0_8px_25px_rgba(59,130,246,0.45)]">

        <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 backdrop-blur-sm">
            <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
        </div>

        <div>
            <p class="text-xs font-bold text-blue-100 mb-0.5">Total kelas diajar</p>
            <h2 class="text-base font-extrabold text-white counter" data-target="{{ $totalKelasDiajar }}">0</h2>
        </div>
    </div>

    {{-- TOTAL SISWA DIAJAR --}}
    <div class="bg-gradient-to-br from-rose-500 to-rose-600 border border-rose-400 rounded-3xl px-4 py-4 md:px-6 md:py-5 group flex items-center gap-3 md:gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-[0_4px_15px_-3px_rgba(244,63,94,0.3)] hover:shadow-[0_8px_25px_rgba(244,63,94,0.45)]">

        <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 backdrop-blur-sm">
            <i data-lucide="users" class="w-6 h-6 text-white"></i>
        </div>

        <div>
            <p class="text-xs font-bold text-rose-100 mb-0.5">Total siswa diajar</p>
            <h2 class="text-base font-extrabold text-white counter" data-target="{{ $totalSiswaDiajar }}">0</h2>
        </div>
    </div>

    {{-- TOTAL MAPEL DIAJAR --}}
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 border border-purple-400 rounded-3xl px-4 py-4 md:px-6 md:py-5 group flex items-center gap-3 md:gap-4
        transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-[0_4px_15px_-3px_rgba(168,85,247,0.3)] hover:shadow-[0_8px_25px_rgba(168,85,247,0.45)]">

        <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center shrink-0
            transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 backdrop-blur-sm">
            <i data-lucide="graduation-cap" class="w-6 h-6 text-white"></i>
        </div>

        <div>
            <p class="text-xs font-bold text-purple-100 mb-0.5">Mata pelajaran diajar</p>
            <h2 class="text-base font-extrabold text-white counter" data-target="{{ $totalMapelDiajar }}">0</h2>
        </div>
    </div>

</div>

@if($homeroomClass)

    <div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)] overflow-hidden mb-6 text-[var(--text-main)]">
        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex items-center gap-3 bg-[var(--theme-bg-light)] text-[var(--text-main)]">
            <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
            <h3 class="font-extrabold text-[var(--theme-primary)] text-base">
                Data Wali Kelas {{ $homeroomClass->class_name }}
            </h3>
        </div>

        <div class="px-6 pb-6">
            <div class="border-t border-[var(--border-color)] mt-5 pt-5 grid grid-cols-1 md:grid-cols-2 gap-5 bg-[var(--bg-card)] text-[var(--text-main)]">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                    <i data-lucide="users" class="w-6 h-6"></i>
                </div>

                <div>
                    <p class="text-xs font-bold text-[var(--theme-primary)] mb-0.5">Total siswa</p>
                    <p class="text-base font-extrabold text-blue-600 dark:text-blue-400">
                        <span class="counter" data-target="{{ $totalWaliStudents }}">0</span> Siswa
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>

                <div>
                    <p class="text-xs font-bold text-[var(--theme-primary)] mb-0.5">Rata-rata nilai</p>
                    <p class="text-base font-extrabold text-rose-600 dark:text-rose-400">
                        @if($classAverage !== '-')
                            <span class="counter" data-target="{{ $classAverage }}" data-decimal="1">0</span>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>

        </div>
        </div>
    </div>

@endif

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden p-0">
    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)]">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base">Kelas yang Diajar</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-800/40 text-[var(--text-secondary)] text-xs uppercase font-bold border-b border-[var(--border-color)]">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Kelas</th>
                    <th class="px-6 py-4 text-left">Mata Pelajaran</th>
                    <th class="px-6 py-4 text-left">Jumlah Siswa</th>
                    <th class="px-6 py-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[var(--border-color)]">
                @forelse($assignments as $index => $assignment)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-bold text-[var(--text-main)]">
                            {{ $assignment->schoolClass->class_name ?? 'N/A' }}

                            @if($homeroomClass && $homeroomClass->id == $assignment->class_id)
                                <span class="ml-2 text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full font-normal">
                                    Wali Kelas
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-[var(--text-secondary)]">{{ $assignment->subject->subject_name ?? '-' }}</td>
                        <td class="px-6 py-4 font-semibold text-[var(--text-main)] counter" data-target="{{ $assignment->student_count ?? 0 }}">0</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-bold">
                                Aktif
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-[var(--text-secondary)]">
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
