@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.guru.index') }}"
                    class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                    Detail Guru
                </h1>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.guru.edit', $teacher->id) }}"
                    class="h-[42px] px-6 rounded-xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 inline-flex items-center justify-center transition-all no-underline">
                    Edit Guru
                </a>
            </div>
        </div>

        {{-- DETAIL CARD --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] overflow-hidden shadow-sm">

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
