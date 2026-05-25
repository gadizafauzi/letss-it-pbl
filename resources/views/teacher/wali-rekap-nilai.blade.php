@extends('layouts.teacher')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">
        Rekap Nilai
    </h1>

    <p class="text-sm text-slate-400 mt-1">
        Rekap nilai siswa kelas wali
    </p>
</div>

{{-- CARD --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
            <i data-lucide="school" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Kelas
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900">
                {{ $class->class_name ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
            <i data-lucide="users" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Total Siswa
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900">
                {{ $students ? $students->count() : 0 }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center">
            <i data-lucide="book-open-check" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Mata Pelajaran
            </p>
            <h2 class="text-xl font-extrabold text-slate-900 truncate max-w-[150px]" title="{{ $selectedSubject?->subject_name ?? '-' }}">
                {{ $selectedSubject?->subject_name ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center">
            <i data-lucide="award" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Rata-rata Kelas
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900">
                {{ $classAverage }}
            </h2>
        </div>
    </div>

</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('teacher.wali-rekap-nilai') }}" class="modern-box mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Semester
            </label>

            <select name="semester" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none">
                <option value="even" {{ $semester === 'even' ? 'selected' : '' }}>Genap</option>
                <option value="odd" {{ $semester === 'odd' ? 'selected' : '' }}>Ganjil</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Mata Pelajaran
            </label>

            <select name="subject_id" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none">
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
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Status
            </label>

            <select name="status" onchange="this.form.submit()" class="w-full h-12 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua</option>
                <option value="tuntas" {{ request('status') === 'tuntas' ? 'selected' : '' }}>Tuntas</option>
                <option value="belum_tuntas" {{ request('status') === 'belum_tuntas' ? 'selected' : '' }}>Belum Tuntas</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Cari Siswa
            </label>

            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa" class="w-full h-12 rounded-xl border border-slate-200 pl-11 pr-4 text-sm focus:outline-none">
            </div>
        </div>

    </div>
</form>

{{-- TABLE --}}
<div class="modern-box overflow-hidden p-0">

    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
        <h2 class="box-title">
            Rekap Nilai Siswa
        </h2>

        <button type="button"
            class="h-10 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold inline-flex items-center gap-2 transition-all">
            <i data-lucide="download" class="w-4 h-4"></i>
            Export Nilai
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
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

            <tbody class="divide-y divide-slate-100">

                @forelse($students as $index => $student)
                    @php
                        $grade = $student->grades->first();
                        $uts = $grade?->mid_exam !== null ? round($grade->mid_exam) : '-';
                        $uas = $grade?->final_exam !== null ? round($grade->final_exam) : '-';
                        $tugas = $grade?->assignment_score !== null ? round($grade->assignment_score) : '-';
                        $average = $grade?->final_score !== null ? round($grade->final_score, 1) : '-';
                        $isTuntas = $grade?->final_score !== null && $grade->final_score >= 75;
                    @endphp

                    <tr class="hover:bg-slate-50 transition-all">
                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $student->nis }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-slate-700">
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
                            <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-full text-xs font-bold">
                                {{ $average }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($grade?->final_score === null)
                                <span class="bg-slate-100 text-slate-400 px-3 py-1 rounded-full text-xs font-bold">
                                    Belum Dinilai
                                </span>
                            @elseif($isTuntas)
                                <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold">
                                    Tuntas
                                </span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                                    Belum Tuntas
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-slate-400">
                            Tidak ada data nilai siswa.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
