@extends('layouts.teacher')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">
        Data Siswa Kelas {{ $class->class_name }}
    </h1>

    <p class="text-sm text-slate-400 mt-1">
        Daftar siswa berdasarkan kelas yang dipilih
    </p>
</div>

<div class="modern-box overflow-hidden p-0">
    <div class="px-6 py-5 border-b border-slate-100">
        <h2 class="box-title">
            Siswa Kelas {{ $class->class_name }}
        </h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Nama Siswa</th>
                    <th class="px-6 py-4 text-left">NIS</th>
                    <th class="px-6 py-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse ($class->students as $index => $student)
                    <tr>
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-slate-700">
                            {{ $student->full_name }}
                        </td>
                        <td class="px-6 py-4 text-slate-600">
                            {{ $student->nis }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $student->status === 'active' ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }}">
                                {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-slate-400">
                            Tidak ada siswa di kelas ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
