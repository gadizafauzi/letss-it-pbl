@extends('layouts.student')

@section('content')
<div class="space-y-6 font-sans">

    <!-- Semester Selector & Title -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-extrabold text-slate-800 text-lg leading-tight">Daftar Nilai Semester</h2>
            <p class="text-xs text-slate-400 mt-1 font-medium">Tahun Ajaran Aktif: {{ $activeYear?->year ?? '-' }}</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Filter Kelas -->
            <div class="flex items-center bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 shadow-sm">
                <span class="text-xs font-bold text-slate-500 mr-2"><i data-lucide="layout-dashboard" class="w-4 h-4 inline-block mr-1"></i>Kelas:</span>
                <select class="bg-transparent text-sm font-bold text-slate-700 focus:outline-none cursor-pointer" onchange="window.location.href='?kelas='+this.value">
                    <option value="1">Kelas 1</option>
                    <option value="2">Kelas 2</option>
                    <option value="3">Kelas 3</option>
                    <option value="4">Kelas 4</option>
                    <option value="5">Kelas 5</option>
                    <option value="6">Kelas 6</option>
                </select>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('student.nilai', ['semester' => 'odd']) }}" 
                   class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition-all text-center flex items-center justify-center gap-2 
                   {{ $semester === 'odd' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-50 border border-slate-100 text-slate-600 hover:bg-slate-100' }}">
                    <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                    <span>Semester Ganjil</span>
                </a>
                <a href="{{ route('student.nilai', ['semester' => 'even']) }}" 
                   class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition-all text-center flex items-center justify-center gap-2 
                   {{ $semester === 'even' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-50 border border-slate-100 text-slate-600 hover:bg-slate-100' }}">
                    <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                    <span>Semester Genap</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Grades Table Box -->
    <div class="bg-white rounded-[24px] shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-emerald-50/50 to-white">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-emerald-600 h-5 rounded-full"></div>
                <h3 class="font-extrabold text-slate-800 text-base">Laporan Hasil Belajar</h3>
            </div>
            <span class="text-[11px] text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full font-bold">
                {{ $grades->count() }} Mata Pelajaran
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
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
                            <td class="px-6 py-4 text-center font-bold text-emerald-600">
                                {{ $grade->final_score !== null ? $grade->final_score : '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($grade->grade_letter)
                                    @php
                                        $letter = strtoupper($grade->grade_letter);
                                        $badgeColor = 'bg-slate-100 text-slate-600';
                                        if ($letter === 'A') $badgeColor = 'bg-emerald-100 text-emerald-600 border border-emerald-200';
                                        elseif ($letter === 'B') $badgeColor = 'bg-emerald-100 text-emerald-600 border border-emerald-200';
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
