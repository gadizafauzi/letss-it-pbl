@extends('layouts.teacher')

@section('content')

{{-- HEADER CARD --}}
<div class="rounded-[20px] p-4 md:p-6 flex items-center justify-between relative overflow-hidden shadow-sm mb-6 bg-gradient-to-br from-[var(--theme-primary)] to-[var(--theme-accent)]">
    <div class="absolute top-0 right-0 w-48 h-48 bg-[var(--bg-card)] opacity-5 rounded-full blur-3xl -mr-12 -mt-12 pointer-events-none"></div>
    <div class="absolute top-3 right-8 w-2.5 h-2.5 rounded-full opacity-35 pointer-events-none" style="background:#f472b6;"></div>
    <div class="absolute bottom-3 right-20 w-2 h-2 rounded-full opacity-25 pointer-events-none" style="background:#fb7185;"></div>
    
    <div class="relative z-10">
        <h1 class="text-xl md:text-2xl font-extrabold text-white">Data Siswa Kelas {{ $class->class_name }}</h1>
        <p class="text-blue-100 text-xs md:text-sm font-medium mt-1 opacity-90">Daftar siswa berdasarkan kelas yang dipilih</p>
    </div>

    {{-- KEMBALI BUTTON --}}
    <div class="relative z-10">
        <a href="{{ route('teacher.kelas-saya') }}" class="flex items-center gap-2 bg-[var(--bg-card)]/20 hover:bg-[var(--bg-card)]/30 text-white px-4 py-2 rounded-xl transition-all font-semibold text-sm backdrop-blur-sm border border-white/10">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>
    </div>
</div>

<div class="modern-box overflow-hidden p-0">
    <div class="px-6 py-5 border-b border-[var(--border-color)] bg-[var(--bg-card)] text-[var(--text-main)]">
        <h2 class="box-title">
            Siswa Kelas {{ $class->class_name }}
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-800/40 text-[var(--text-secondary)] text-xs uppercase font-bold border-b border-[var(--border-color)]">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Nama Siswa</th>
                    <th class="px-6 py-4 text-left">NIS</th>
                    <th class="px-6 py-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-[var(--border-color)]">
                @forelse ($class->studentClasses as $index => $studentClass)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-[var(--text-main)]">
                            {{ $studentClass->student->full_name }}
                        </td>
                        <td class="px-6 py-4 text-[var(--text-secondary)]">
                            {{ $studentClass->student->nis }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $studentClass->student->status === 'active' ? 'bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400' : 'bg-rose-100 text-rose-600' }}">
                                {{ $studentClass->student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-[var(--text-secondary)]">
                            Tidak ada siswa di kelas ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
