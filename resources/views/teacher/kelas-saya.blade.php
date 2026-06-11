@extends('layouts.teacher')

@section('content')

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-6 relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Kelas Saya</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Daftar kelas yang Anda ampu</p>
    </div>
</div>

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)] overflow-hidden p-0 text-[var(--text-main)]">

    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex items-center gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)] text-[var(--text-main)]">
        <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
        <h2 class="font-extrabold text-[var(--theme-primary)] text-base">
            Daftar Kelas
        </h2>
    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-slate-50 dark:bg-slate-800/40 text-[var(--text-secondary)] text-xs uppercase border-b border-[var(--border-color)] font-bold">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Kelas
                    </th>

                    <th class="px-6 py-4 text-left">
                        Mata Pelajaran
                    </th>

                    <th class="px-6 py-4 text-left">
                        Jumlah Siswa
                    </th>

                    <th class="px-6 py-4 text-left">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-[var(--border-color)]">

                @forelse ($assignments as $assignment)
                    <tr class="hover:bg-[var(--theme-bg-light)] transition-all">

                        <td class="px-6 py-4 font-semibold text-[var(--text-main)]">
                            {{ $assignment->schoolClass->class_name }}
                        </td>

                        <td class="px-6 py-4 text-[var(--text-secondary)]">
                            {{ $assignment->subject->subject_name }}
                        </td>

                        <td class="px-6 py-4 text-[var(--text-secondary)]">
                            @php
                                $jumlahSiswa = \App\Models\StudentClass::where('class_id', $assignment->class_id)
                                    ->whereHas('academicYear', fn($q) => $q->where('status', 'active'))
                                    ->count();
                            @endphp
                            {{ $jumlahSiswa }} siswa
                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full text-xs font-bold">
                                Aktif
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-2">

                                {{-- LIHAT SISWA --}}
                                <a href="{{ route('teacher.data-siswa', $assignment->schoolClass->id) }}"
                                    title="Lihat Siswa"
                                    class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-500/30 flex items-center justify-center transition-all duration-200">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </a>

                                {{-- INPUT NILAI --}}
                                <a href="{{ route('teacher.input-nilai', $assignment->id) }}"
                                    title="Input Nilai"
                                    class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 hover:bg-purple-100 dark:hover:bg-purple-500/30 flex items-center justify-center transition-all duration-200">

                                    <i data-lucide="clipboard-pen-line" class="w-4 h-4"></i>

                                </a>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-[var(--text-secondary)]">
                            Belum ada kelas yang diampu.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
