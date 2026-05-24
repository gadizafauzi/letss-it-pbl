@extends('layouts.teacher')

@section('content')

<div class="mb-6">

    <h1 class="text-2xl font-extrabold text-slate-900">
        Kelas Saya
    </h1>

    <p class="text-sm text-slate-400 mt-1">
        Daftar kelas yang Anda ampu
    </p>

</div>

<div class="modern-box overflow-hidden p-0">

    <div class="px-6 py-5 border-b border-slate-100">

        <h2 class="box-title">
            Daftar Kelas
        </h2>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">

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

            <tbody class="divide-y divide-slate-100">

                @forelse ($assignments as $assignment)
                    <tr class="hover:bg-slate-50 transition-all">

                        <td class="px-6 py-4 font-semibold text-slate-700">
                            {{ $assignment->class->class_name }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $assignment->subject->subject_name }}
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            {{ $assignment->class->students->count() }} siswa
                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold">
                                Aktif
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center gap-2">

                                {{-- LIHAT SISWA --}}
                                <a href="{{ route('teacher.data-siswa', $assignment->class->id) }}"
                                    title="Lihat Siswa"
                                    class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-all duration-200">

                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                </a>

                                {{-- INPUT NILAI --}}
                                <a href="{{ route('teacher.input-nilai.assignment', $assignment->id) }}"
                                    title="Input Nilai"
                                    class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 flex items-center justify-center transition-all duration-200">

                                    <i data-lucide="clipboard-pen-line" class="w-4 h-4"></i>

                                </a>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-slate-400">
                            Belum ada kelas yang diampu.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection
