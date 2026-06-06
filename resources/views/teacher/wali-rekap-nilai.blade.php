@extends('layouts.teacher')

@section('content')

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-6 relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-[var(--bg-card)] opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Rekap Nilai Siswa</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Pantau hasil belajar siswa kelas wali Anda</p>
    </div>
</div>

{{-- CARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <div class="bg-[var(--bg-card)] border-2 border-emerald-100 dark:border-[var(--theme-border-light)] rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-sm hover:border-emerald-300 dark:hover:border-emerald-500">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="school" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-[var(--text-secondary)] mb-1">
                Kelas
            </p>
            <h2 class="text-2xl font-extrabold text-[var(--text-main)]">
                {{ $class->class_name ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="bg-[var(--bg-card)] border-2 border-blue-100 dark:border-[var(--theme-border-light)] rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-sm hover:border-blue-300 dark:hover:border-blue-500">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="users" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-[var(--text-secondary)] mb-1">
                Total Siswa
            </p>
            <h2 class="text-2xl font-extrabold text-[var(--text-main)]">
                {{ $students ? $students->count() : 0 }}
            </h2>
        </div>
    </div>

    <div class="bg-[var(--bg-card)] border-2 border-purple-100 dark:border-[var(--theme-border-light)] rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-sm hover:border-purple-300 dark:hover:border-purple-500">
        <div class="w-14 h-14 rounded-2xl bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="book-open-check" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-[var(--text-secondary)] mb-1">
                Mata Pelajaran
            </p>
            <h2 class="text-xl font-extrabold text-[var(--text-main)] truncate max-w-[150px]" title="{{ $selectedSubject?->subject_name ?? '-' }}">
                {{ $selectedSubject?->subject_name ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="bg-[var(--bg-card)] border-2 border-orange-100 dark:border-[var(--theme-border-light)] rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] shadow-sm hover:border-orange-300 dark:hover:border-orange-500">
        <div class="w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="award" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-[var(--text-secondary)] mb-1">
                Rata-rata Kelas
            </p>
            <h2 class="text-2xl font-extrabold text-[var(--text-main)]">
                {{ $classAverage }}
            </h2>
        </div>
    </div>

</div>

<form method="GET" action="{{ route('teacher.wali-rekap-nilai') }}" class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 mb-6 p-6 text-[var(--text-main)]">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Semester
            </label>

            <select name="semester" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <option value="even" {{ $semester === 'even' ? 'selected' : '' }}>Genap</option>
                <option value="odd" {{ $semester === 'odd' ? 'selected' : '' }}>Ganjil</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Mata Pelajaran
            </label>

            <select name="subject_id" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                @forelse($subjects as $subj)
                    <option value="{{ $subj->id }}" {{ $selectedSubjectId == $subj->id ? 'selected' : '' }}>
                        {{ $subj->subject_name }}
                    </option>
                @empty
                    <option value="">Tidak ada mapel</option>
                @endforelse
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Status
            </label>

            <select name="status" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-[var(--border-color)] px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua</option>
                <option value="tuntas" {{ request('status') === 'tuntas' ? 'selected' : '' }}>Tuntas</option>
                <option value="belum_tuntas" {{ request('status') === 'belum_tuntas' ? 'selected' : '' }}>Belum Tuntas</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Cari Siswa
            </label>

            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 text-[var(--text-secondary)] absolute left-4 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa" class="w-full h-12 rounded-xl border border-[var(--border-color)] pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
            </div>
        </div>

    </div>
</form>

{{-- TABLE --}}
<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden p-0 text-[var(--text-main)]">

    <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex flex-wrap items-center justify-between gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)] text-[var(--text-main)]">
        <div class="flex items-center gap-3">
            <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
            <h2 class="font-extrabold text-[var(--theme-primary)] text-base">
                Rekap Nilai Siswa
            </h2>
        </div>

        <a href="{{ route('teacher.wali-rekap-nilai.export', request()->all()) }}"
            class="h-10 px-4 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white text-sm font-bold inline-flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
            <i data-lucide="download" class="w-4 h-4"></i>
            Ekspor Nilai
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-[var(--theme-bg-light)] text-[var(--text-secondary)] text-xs uppercase">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">NIS</th>
                    <th class="px-6 py-4 text-left">Nama Siswa</th>
                    <th class="px-6 py-4 text-center">UTS</th>
                    <th class="px-6 py-4 text-center">UAS</th>
                    <th class="px-6 py-4 text-center">Tugas</th>
                    <th class="px-6 py-4 text-center">Rata-rata</th>
                    <th class="px-6 py-4 text-center">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[var(--border-color)]">

                @forelse($students as $index => $student)
                    @php
                        $grade = $student->grades->first();
                        $uts = $grade?->mid_exam !== null ? round($grade->mid_exam) : '-';
                        $uas = $grade?->final_exam !== null ? round($grade->final_exam) : '-';
                        $tugas = $grade?->assignment_score !== null ? round($grade->assignment_score) : '-';
                        $average = $grade?->final_score !== null ? round($grade->final_score, 1) : '-';
                        $isTuntas = $grade?->final_score !== null && $grade->final_score >= 75;
                    @endphp

                    <tr class="hover:bg-[var(--theme-bg-light)] transition-all">
                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-[var(--text-secondary)]">
                            {{ $student->nis }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-[var(--text-main)]">
                            {{ $student->full_name }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $uts }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $uas }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $tugas }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="bg-[var(--theme-bg-light)] text-[var(--text-main)] px-3 py-1 rounded-full text-xs font-bold">
                                {{ $average }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($grade?->final_score === null)
                                <span class="bg-[var(--theme-bg-light)] text-[var(--text-secondary)] px-3 py-1 rounded-full text-xs font-bold">
                                    Belum Dinilai
                                </span>
                            @elseif($isTuntas)
                                <span class="bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 px-3 py-1 rounded-full text-xs font-bold">
                                    Tuntas
                                </span>
                            @else
                                <span class="bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 px-3 py-1 rounded-full text-xs font-bold">
                                    Belum Tuntas
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-[var(--text-secondary)]">
                            Tidak ada data nilai siswa.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
