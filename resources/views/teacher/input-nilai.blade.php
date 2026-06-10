@extends('layouts.teacher')

@section('content')

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 dark:text-emerald-400"></i>
        {{ session('success') }}
    </div>
@endif

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-6 relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-[var(--bg-card)] opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Input Nilai</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Input dan update nilai siswa</p>
    </div>
</div>

<div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden mb-6 p-6 text-[var(--text-main)]">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Kelas
            </label>

            <select onchange="if(this.value) window.location.href='/teacher/input-nilai/' + this.value" 
                class="w-full h-10 md:h-11 rounded-xl border border-[var(--border-color)] px-3 md:px-4 text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                <option value="">Pilih Kelas - Mapel</option>
                @foreach ($assignments as $assignment)
                    <option value="{{ $assignment->id }}" {{ $assignmentId == $assignment->id ? 'selected' : '' }}>
                        {{ $assignment->schoolClass->class_name }} - {{ $assignment->subject->subject_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-[var(--text-secondary)] mb-2">
                Mata Pelajaran
            </label>

            <input type="text" readonly 
                value="{{ $selectedAssignment ? $selectedAssignment->subject->subject_name : '-' }}"
                class="w-full h-10 md:h-11 rounded-xl border border-[var(--border-color)] bg-[var(--theme-bg-light)] px-3 md:px-4 text-xs md:text-sm text-[var(--text-secondary)] focus:outline-none">
        </div>

    </div>

</div>

{{-- FORM INPUT NILAI --}}
<form id="formNilai" action="{{ route('teacher.input-nilai.store') }}" method="POST">
    @csrf
    @if($selectedAssignment)
        <input type="hidden" name="assignment_id" value="{{ $selectedAssignment->id }}">
    @endif
    <div class="bg-[var(--bg-card)] rounded-[24px] shadow-sm border border-[var(--border-color)]/80 overflow-hidden p-0 text-[var(--text-main)]">

        <div class="px-5 md:px-6 py-4 md:py-5 border-b border-[var(--border-color)] flex flex-wrap items-center justify-between gap-3 bg-gradient-to-r from-[var(--theme-bg-light)] to-[var(--bg-card)] text-[var(--text-main)]">
            <div class="flex items-center gap-3">
                <div class="w-1 bg-[var(--theme-accent)] h-5 rounded-full"></div>
                <h2 class="font-extrabold text-[var(--theme-primary)] text-base">
                    Input Nilai - {{ $selectedAssignment ? $selectedAssignment->schoolClass->class_name . ' (' . $selectedAssignment->subject->subject_name . ')' : '-' }}
                </h2>
            </div>

            @if($selectedAssignment && $students->isNotEmpty())
                <button type="submit" form="formNilai"
                    class="h-10 px-4 rounded-xl bg-[var(--theme-primary)] hover:bg-[var(--theme-primary-hover)] text-white text-sm font-bold inline-flex items-center gap-2 transition-all shadow-sm hover:shadow-md">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Semua
                </button>
            @endif
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
                    </tr>
                </thead>

                <tbody class="divide-y divide-[var(--border-color)]">

                    @forelse($students as $index => $student)
                        @php
                            $grade = $student->grades->first();
                            $uts = $grade?->mid_exam;
                            $uas = $grade?->final_exam;
                            $tugas = $grade?->assignment_score;
                            $average = $grade?->final_score !== null ? round($grade->final_score, 1) : '-';
                        @endphp

                        <tr class="grade-row hover:bg-[var(--theme-bg-light)] transition-all">
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
                                <input type="number" name="grades[{{ $student->id }}][uts]" value="{{ $uts }}" min="0" max="100" step="0.01"
                                    class="grade-input w-20 h-9 rounded-lg border border-[var(--border-color)] text-center text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <input type="number" name="grades[{{ $student->id }}][uas]" value="{{ $uas }}" min="0" max="100" step="0.01"
                                    class="grade-input w-20 h-9 rounded-lg border border-[var(--border-color)] text-center text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <input type="number" name="grades[{{ $student->id }}][tugas]" value="{{ $tugas }}" min="0" max="100" step="0.01"
                                    class="grade-input w-20 h-9 rounded-lg border border-[var(--border-color)] text-center text-sm focus:outline-none focus:ring-2 focus:ring-[var(--theme-primary)] bg-[var(--bg-card)] text-[var(--text-main)]">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="average-display bg-[var(--theme-bg-light)] text-[var(--text-secondary)] px-3 py-1 rounded-full text-xs font-bold transition-all duration-300">
                                    {{ $average }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-[var(--text-secondary)]">
                                @if(!$selectedAssignment)
                                    Silakan pilih kelas terlebih dahulu.
                                @else
                                    Tidak ada data siswa di kelas ini.
                                @endif
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
</form>

{{-- CATATAN --}}
<div class="mt-5 rounded-xl bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-[var(--theme-border-light)] px-5 py-4 text-sm text-blue-600 dark:text-blue-400">
    <span class="font-bold">Catatan:</span>
    Pastikan semua nilai sudah benar sebelum menyimpan. Nilai yang disimpan akan langsung terkirim ke sistem.
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika merata-ratakan nilai otomatis saat diketik
        const rows = document.querySelectorAll('.grade-row');
        
        rows.forEach(row => {
            const inputs = row.querySelectorAll('.grade-input');
            const averageDisplay = row.querySelector('.average-display');
            
            const calculateAverage = () => {
                let sum = 0;
                let count = 0;
                
                inputs.forEach(input => {
                    const val = parseFloat(input.value);
                    if (!isNaN(val)) {
                        sum += val;
                        count++;
                    }
                });
                
                if (count > 0) {
                    const average = (sum / count).toFixed(1);
                    averageDisplay.textContent = average;
                    
                    // Beri efek warna jika sudah tuntas atau belum
                    if (average >= 75) {
                        averageDisplay.classList.remove('text-[var(--text-secondary)]', 'text-red-500');
                        averageDisplay.classList.add('text-emerald-600', 'bg-emerald-100', 'dark:bg-emerald-500/20');
                    } else {
                        averageDisplay.classList.remove('text-[var(--text-secondary)]', 'text-emerald-600', 'bg-emerald-100', 'dark:bg-emerald-500/20');
                        averageDisplay.classList.add('text-red-500');
                    }
                } else {
                    averageDisplay.textContent = '-';
                    averageDisplay.classList.remove('text-emerald-600', 'text-red-500', 'bg-emerald-100', 'dark:bg-emerald-500/20');
                    averageDisplay.classList.add('text-[var(--text-secondary)]');
                }
            };
            
            inputs.forEach(input => {
                input.addEventListener('input', calculateAverage);
            });
            
            // Hitung rata-rata awal saat halaman dimuat
            calculateAverage();
        });
    });
</script>

@endsection
