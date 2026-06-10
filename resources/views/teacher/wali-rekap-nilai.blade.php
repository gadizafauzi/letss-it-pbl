@extends('layouts.teacher')

@section('content')

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 dark:text-emerald-400"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 text-red-700 rounded-xl text-sm font-bold flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 dark:text-red-400"></i>
        {{ session('error') }}
    </div>
@endif

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

        <div class="flex items-center gap-2">
            <form id="publishForm" action="{{ route('teacher.wali-rekap-nilai.publish') }}" method="POST">
                @csrf
                <input type="hidden" name="semester" value="{{ $semester }}">
                <button type="button" onclick="openPublishModal()" class="h-10 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold inline-flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    Terbitkan Nilai
                </button>
            </form>

            <a href="{{ route('teacher.wali-rekap-nilai.export', request()->all()) }}"
                class="h-10 px-4 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white text-sm font-bold inline-flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                <i data-lucide="download" class="w-4 h-4"></i>
                Ekspor Nilai
            </a>
        </div>
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

{{-- MODAL KONFIRMASI TERBITKAN NILAI --}}
<div id="publishModal" class="fixed inset-0 z-50 hidden flex-col items-center justify-center">
    <div class="fixed inset-0 bg-slate-900/50 dark:bg-slate-900/80 backdrop-blur-sm transition-opacity" onclick="closePublishModal()"></div>
    <div class="relative bg-[var(--bg-card)] w-full max-w-md rounded-2xl shadow-xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 border border-[var(--border-color)] m-4" id="publishModalContent">
        <div class="p-6">
            <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-4">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold text-[var(--text-main)] mb-2">Terbitkan Nilai?</h3>
            <p class="text-[var(--text-secondary)] text-sm mb-6 leading-relaxed">
                Apakah Anda yakin ingin menerbitkan nilai untuk semester ini? Nilai yang sudah diterbitkan akan langsung bisa dilihat oleh semua siswa.
            </p>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closePublishModal()" class="px-5 py-2.5 rounded-xl border border-[var(--border-color)] text-[var(--text-secondary)] hover:bg-[var(--theme-bg-light)] hover:text-[var(--text-main)] font-semibold transition-colors">Batal</button>
                <button type="button" onclick="document.getElementById('publishForm').submit()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold transition-colors shadow-sm hover:shadow-md">Ya, Terbitkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openPublishModal() {
        const modal = document.getElementById('publishModal');
        const content = document.getElementById('publishModalContent');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger reflow
        void modal.offsetWidth;
        
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }

    function closePublishModal() {
        const modal = document.getElementById('publishModal');
        const content = document.getElementById('publishModalContent');
        
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>

@endsection
