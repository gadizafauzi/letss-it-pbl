@extends('layouts.student')

@section('content')
<div class="space-y-6 font-sans">

    <!-- Title & Filter -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 md:p-6 shadow-sm flex flex-col xl:flex-row xl:items-center justify-between gap-4 md:gap-6">
        <div class="shrink-0">
            <h2 class="font-extrabold text-[var(--theme-primary)] text-lg leading-tight">Daftar Nilai Semester</h2>
            <p class="text-xs text-slate-400 mt-1 font-medium">
                Menampilkan nilai tahun ajaran: <span class="font-bold text-slate-600">{{ $selectedYear?->year ?? '-' }}</span>
                @if($selectedYear && $activeYear && $selectedYear->id === $activeYear->id)
                    <span class="ml-1 text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:#fb7185; color:#fff;">Aktif</span>
                @endif
            </p>
        </div>

        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 lg:gap-4 flex-wrap">
            <!-- Dropdown Tahun Ajaran -->
            <div class="flex items-center bg-slate-50 border border-slate-200 rounded-[10px] md:rounded-xl px-2.5 md:px-3 py-1.5 shadow-sm w-full lg:flex-1 lg:max-w-[400px] overflow-hidden lg:overflow-visible">
                <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400 mr-2 shrink-0"></i>
                <span class="text-xs font-bold text-slate-500 mr-2 shrink-0">Tahun Ajaran:</span>
                <select
                    class="bg-transparent text-sm font-bold text-slate-700 focus:outline-none cursor-pointer w-full max-w-full truncate min-w-0 lg:whitespace-normal lg:overflow-visible lg:truncate-none"
                    onchange="window.location.href='{{ route('student.nilai') }}?year_id='+this.value+'&semester={{ $semester }}'">
                    @foreach($academicYears as $year)
                        @php $kelasLabel = $classPerYear[$year->id] ?? null; @endphp
                        <option value="{{ $year->id }}" {{ $selectedYear?->id == $year->id ? 'selected' : '' }}>
                            {{ $year->year }}{{ $kelasLabel ? ' — Kelas ' . $kelasLabel : '' }}{{ $activeYear && $year->id === $activeYear->id ? ' (Aktif)' : '' }}
                        </option>
                    @endforeach
                    @if($academicYears->isEmpty())
                        <option value="">Belum ada data</option>
                    @endif
                </select>
            </div>

            <!-- Tombol Semester -->
            <div class="grid grid-cols-2 lg:flex gap-2 w-full lg:w-auto flex-shrink-0">
                <a href="{{ route('student.nilai', ['year_id' => $selectedYear?->id, 'semester' => 'odd']) }}"
                   class="min-w-0 w-full lg:w-auto px-3 sm:px-5 py-2.5 rounded-xl text-[11px] sm:text-xs font-extrabold transition-all text-center flex items-center justify-center gap-1.5 sm:gap-2
                   {{ $semester === 'odd' ? 'bg-[var(--theme-primary)] text-white shadow-md' : 'bg-[#f8fafc] border border-slate-100 text-slate-600 hover:bg-slate-100' }}">
                    <i data-lucide="book-open" class="w-3.5 h-3.5 shrink-0"></i>
                    <span class="truncate lg:overflow-visible lg:whitespace-nowrap">Smt Ganjil</span>
                </a>
                <a href="{{ route('student.nilai', ['year_id' => $selectedYear?->id, 'semester' => 'even']) }}"
                   class="min-w-0 w-full lg:w-auto px-3 sm:px-5 py-2.5 rounded-xl text-[11px] sm:text-xs font-extrabold transition-all text-center flex items-center justify-center gap-1.5 sm:gap-2
                   {{ $semester === 'even' ? 'bg-[var(--theme-primary)] text-white shadow-md' : 'bg-[#f8fafc] border border-slate-100 text-slate-600 hover:bg-slate-100' }}">
                    <i data-lucide="book-open" class="w-3.5 h-3.5 shrink-0"></i>
                    <span class="truncate lg:overflow-visible lg:whitespace-nowrap">Smt Genap</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Grades Table Box -->
    <div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-slate-100 flex flex-wrap items-center justify-between gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-white">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
                <h3 class="font-extrabold text-[var(--theme-primary)] text-base">Laporan Hasil Belajar</h3>
            </div>
            <span class="text-[11px] text-[var(--theme-text-light)] bg-[var(--theme-bg-light)] border border-[var(--theme-border-light)] px-3 py-1 rounded-full font-bold whitespace-nowrap">
                {{ $grades->count() }} Mata Pelajaran
            </span>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-sm min-w-[800px]">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-extrabold border-b border-slate-100">
                        <th class="px-6 py-4 text-left w-16">No</th>
                        <th class="px-6 py-4 text-left">Mata Pelajaran</th>
                        <th class="px-6 py-4 text-left">Guru Pengampu</th>
                        <th class="px-6 py-4 text-center w-24">UTS</th>
                        <th class="px-6 py-4 text-center w-24">UAS</th>
                        <th class="px-6 py-4 text-center w-24">Tugas</th>
                        <th class="px-6 py-4 text-center w-28">Nilai Akhir</th>
                        <th class="px-6 py-4 text-center w-28">Predikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($grades as $index => $grade)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4 font-mono text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $grade->teachingAssignment->subject->subject_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-500">
                                {{ $grade->teachingAssignment->teacher->full_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-600">
                                {{ $grade->mid_exam !== null ? $grade->mid_exam : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-600">
                                {{ $grade->final_exam !== null ? $grade->final_exam : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center font-semibold text-slate-600">
                                {{ $grade->assignment_score !== null ? $grade->assignment_score : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-blue-800">
                                {{ $grade->final_score !== null ? $grade->final_score : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($grade->grade_letter)
                                    @php
                                        $letter = strtoupper($grade->grade_letter);
                                        $badgeColor = 'bg-slate-100 text-slate-600';
                                        if ($letter === 'A') $badgeColor = 'bg-blue-100 text-blue-800 border border-blue-200';
                                        elseif ($letter === 'B') $badgeColor = 'bg-blue-100 text-blue-800 border border-blue-200';
                                        elseif ($letter === 'C') $badgeColor = 'bg-amber-100 text-amber-600 border border-amber-200';
                                        elseif ($letter === 'D') $badgeColor = 'bg-rose-100 text-rose-600 border border-rose-200';
                                    @endphp
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-bold {{ $badgeColor }}">
                                        {{ $letter }}
                                    </span>
                                @else
                                    <span class="text-slate-400 font-semibold">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i data-lucide="book-x" class="w-10 h-10 text-slate-300"></i>
                                    <p class="font-bold text-slate-500">Nilai untuk semester ini belum tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
