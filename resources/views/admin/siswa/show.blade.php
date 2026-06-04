@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
            <div>
                <h1 class="text-[28px] font-bold text-slate-800">
                    Detail Siswa
                </h1>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.siswa.edit', $student->id) }}"
                    class="h-11 px-6 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold inline-flex items-center justify-center transition-all">
                    <i data-lucide="square-pen" class="w-4 h-4 mr-2"></i>
                    Edit
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="h-11 px-6 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                    Kembali
                </a>
            </div>
        </div>

        {{-- DETAIL CARD --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[var(--theme-primary)]">
                            {{ $student->full_name }}
                        </h2>
                        <p class="text-sm text-slate-600 mt-1">
                            NIS: <span class="font-semibold">{{ $student->nis ?? '-' }}</span> &nbsp;|&nbsp; NISN:
                            <span class="font-semibold">{{ $student->nisn ?? '-' }}</span>
                        </p>
                    </div>

                    @if (!empty($student->photo))
                        <div
                            class="w-24 h-24 rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Foto Siswa"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="w-24 h-24 rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 flex items-center justify-center">
                            <i data-lucide="user-circle-2" class="w-12 h-12 text-slate-300"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Unit Pendidikan</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->unit->unit_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Kelas (Aktif)</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">
                            {{ optional($student->studentClasses->first())->schoolClass->class_name ?? '-' }}
                        </p>

                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">NIK</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->nik ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Jenis Kelamin</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">
                            {{ $student->gender === 'L' ? 'Laki-laki' : ($student->gender === 'P' ? 'Perempuan' : '-') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Status</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">
                            {{ $student->status ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Tempat Lahir</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->birth_place ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Tanggal Lahir</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->birth_date ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">No. HP</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->phone ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Alamat</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->address ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Nama Ayah</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->father_name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Nama Ibu</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->mother_name ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">No. HP Orang Tua</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $student->parent_phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
