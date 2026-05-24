@extends('layouts.teacher')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">
        Data Kelas
    </h1>

    <p class="text-sm text-slate-400 mt-1">
        Informasi kelas wali dan daftar siswa
    </p>
</div>

{{-- CARD INFO KELAS --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:border-emerald-300 hover:shadow-[-8px_12px_25px_rgba(16,185,129,0.18)]">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="school" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Kelas Wali
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900">
                {{ $class->class_name ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:border-blue-300 hover:shadow-[-8px_12px_25px_rgba(59,130,246,0.18)]">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="users" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Total Siswa
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900 counter" data-target="{{ $class ? $class->students->count() : 0 }}">
                {{ $class ? $class->students->count() : 0 }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:border-purple-300 hover:shadow-[-8px_12px_25px_rgba(168,85,247,0.18)]">
        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="calendar-days" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Tahun Ajaran
            </p>
            <h2 class="text-xl font-extrabold text-slate-900">
                {{ $class?->academicYear?->year ?? '-' }}
            </h2>
        </div>
    </div>

    <div class="dashboard-card bg-white border border-slate-200 rounded-3xl px-6 py-5 flex items-center gap-4 group transition-all duration-300 hover:-translate-y-1 hover:scale-[1.02] hover:border-orange-300 hover:shadow-[-8px_12px_25px_rgba(249,115,22,0.18)]">
        <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center transition-all duration-300 group-hover:-rotate-12 group-hover:scale-110 shrink-0">
            <i data-lucide="book-open-check" class="w-6 h-6"></i>
        </div>

        <div>
            <p class="text-sm font-semibold text-slate-400 mb-1">
                Semester
            </p>
            <h2 class="text-2xl font-extrabold text-slate-900">
                {{ $class?->academicYear?->active_semester === 'odd' ? 'Ganjil' : 'Genap' }}
            </h2>
        </div>
    </div>

</div>

{{-- FILTER --}}
<form method="GET" action="{{ route('teacher.wali-data-siswa') }}" class="modern-box mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Cari Siswa
            </label>

            <div class="relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>

                <input type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau NIS"
                    class="w-full h-12 rounded-xl border border-slate-200 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Status
            </label>

            <select name="status" onchange="this.form.submit()"
                class="w-full h-12 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
                <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

    </div>
</form>

{{-- TABEL SISWA --}}
<div class="modern-box overflow-hidden p-0">

    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
        <h2 class="box-title">
            Daftar Siswa Kelas {{ $class->class_name ?? '-' }}
        </h2>

        <button type="button"
            class="h-10 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold inline-flex items-center gap-2 transition-all">
            <i data-lucide="download" class="w-4 h-4"></i>
            Export
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">NIS</th>
                    <th class="px-6 py-4 text-left">NISN</th>
                    <th class="px-6 py-4 text-left">Nama Siswa</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($students as $index => $student)
                    <tr class="hover:bg-slate-50 transition-all">

                        <td class="px-6 py-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $student->nis }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $student->nisn }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-slate-700">
                            {{ $student->full_name }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $student->status === 'active' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }}">
                                {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">

                                <a href="{{ route('teacher.data-siswa', $class->id) }}"
                                    title="Detail Siswa"
                                    class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-all duration-200">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>

                                <a href="{{ route('teacher.wali-rekap-nilai') }}"
                                    title="Rekap Nilai"
                                    class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 hover:bg-purple-100 flex items-center justify-center transition-all duration-200">
                                    <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                                </a>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-slate-400">
                            Tidak ada data siswa.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
