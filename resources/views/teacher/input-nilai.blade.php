@extends('layouts.teacher')

@section('content')

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-bold flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
        {{ session('success') }}
    </div>
@endif

<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">
        Input Nilai
    </h1>

    <p class="text-sm text-slate-400 mt-1">
        Input dan update nilai siswa
    </p>
</div>

{{-- FILTER --}}
<div class="modern-box mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Kelas
            </label>

            <select onchange="if(this.value) window.location.href='/teacher/input-nilai/' + this.value" 
                class="w-full h-12 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
                <option value="">Pilih Kelas - Mapel</option>
                @foreach ($assignments as $assignment)
                    <option value="{{ $assignment->id }}" {{ $assignmentId == $assignment->id ? 'selected' : '' }}>
                        {{ $assignment->schoolClass->class_name }} - {{ $assignment->subject->subject_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Mata Pelajaran
            </label>

            <input type="text" readonly 
                value="{{ $selectedAssignment ? $selectedAssignment->subject->subject_name : '-' }}"
                class="w-full h-12 rounded-xl border border-slate-100 bg-slate-50 px-4 text-sm text-slate-500 focus:outline-none">
        </div>

    </div>

</div>

{{-- FORM INPUT NILAI --}}
<form action="{{ route('teacher.input-nilai.store') }}" method="POST">
    @csrf
    @if($selectedAssignment)
        <input type="hidden" name="assignment_id" value="{{ $selectedAssignment->id }}">
    @endif

    <div class="modern-box overflow-hidden p-0">

        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="box-title">
                Input Nilai - {{ $selectedAssignment ? $selectedAssignment->schoolClass->class_name . ' (' . $selectedAssignment->subject->subject_name . ')' : '-' }}
            </h2>

            @if($selectedAssignment && $students->isNotEmpty())
                <button type="submit"
                    class="h-10 px-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold inline-flex items-center gap-2 transition-all">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Semua
                </button>
            @endif
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
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($students as $index => $student)
                        @php
                            $grade = $student->grades->first();
                            $uts = $grade?->mid_exam;
                            $uas = $grade?->final_exam;
                            $tugas = $grade?->assignment_score;
                            $average = $grade?->final_score !== null ? round($grade->final_score, 1) : '-';
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
                                <input type="number" name="grades[{{ $student->id }}][uts]" value="{{ $uts }}" min="0" max="100" step="0.01"
                                    class="w-20 h-9 rounded-lg border border-slate-200 text-center text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <input type="number" name="grades[{{ $student->id }}][uas]" value="{{ $uas }}" min="0" max="100" step="0.01"
                                    class="w-20 h-9 rounded-lg border border-slate-200 text-center text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <input type="number" name="grades[{{ $student->id }}][tugas]" value="{{ $tugas }}" min="0" max="100" step="0.01"
                                    class="w-20 h-9 rounded-lg border border-slate-200 text-center text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $average }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-slate-400">
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
<div class="mt-5 rounded-xl bg-blue-50 border border-blue-100 px-5 py-4 text-sm text-blue-600">
    <span class="font-bold">Catatan:</span>
    Pastikan semua nilai sudah benar sebelum menyimpan. Nilai yang disimpan akan langsung terkirim ke sistem.
</div>

@endsection
