@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>
                <h1 class="text-[28px] font-bold text-slate-800">
                    Detail Guru
                </h1>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.guru.edit', $teacher->id) }}"
                    class="h-11 px-6 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold inline-flex items-center justify-center transition-all">
                    Edit
                </a>

                <a href="{{ route('admin.guru.index') }}"
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
                        <h2 class="text-xl font-bold text-[var(--theme-primary)]">{{ $teacher->full_name ?? '-' }}</h2>
                        <p class="text-sm text-slate-600 mt-1">
                            NIP: <span class="font-semibold">{{ $teacher->nip ?? '-' }}</span>
                            &nbsp;|&nbsp; Status:
                            <span class="font-semibold">{{ ucfirst($teacher->status ?? '-') }}</span>
                        </p>
                    </div>
                    <div class="w-24 h-24 rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 flex items-center justify-center">
                        @if (!empty($teacher->photo))
                            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="Foto Guru"
                                class="w-full h-full object-cover">
                        @else
                            <i data-lucide="badge-check" class="w-12 h-12 text-slate-300"></i>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Unit Sekolah</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->unit->unit_name ?? ($teacher->unit->name ?? '-') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Akun User</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->user->username ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Jenis Kelamin</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">
                            {{ $teacher->gender === 'male' ? 'Laki-laki' : ($teacher->gender === 'female' ? 'Perempuan' : '-') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Tempat Lahir</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->birth_place ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Tanggal Lahir</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->birth_date ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Pendidikan Terakhir</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->last_education ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Jabatan</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->position->name ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Status Kepegawaian</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->employment_status ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Telepon</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->phone ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wide text-slate-500">Alamat</p>
                        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $teacher->address ?? '-' }}</p>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
