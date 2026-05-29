@extends('layouts.teacher')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900">
            Profil Guru
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Informasi data diri guru
        </p>
    </div>

    <button class="h-10 px-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold inline-flex items-center gap-2">
        <i data-lucide="edit-3" class="w-4 h-4"></i>
        Edit Profil
    </button>
</div>

<div class="modern-box overflow-hidden p-0 mb-6">

    <div class="h-28 bg-gradient-to-r from-blue-500 to-blue-600"></div>

    <div class="px-6 pb-6 -mt-10 flex items-end gap-5">
        <div class="w-24 h-24 rounded-2xl bg-white border border-slate-200 shadow-lg flex items-center justify-center text-slate-400">
            <i data-lucide="user-round" class="w-12 h-12"></i>
        </div>

        <div class="pb-2">
            <h2 class="text-xl font-extrabold text-slate-900">
                {{ $teacher->full_name }}
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                @if($homeroomClass)
                    Guru Mata Pelajaran & Wali Kelas {{ $homeroomClass->class_name }}
                @else
                    Guru Mata Pelajaran
                @endif
            </p>

            <div class="flex items-center gap-2 mt-2">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                    {{ strtoupper($teacher->status === 'active' ? 'Aktif' : 'Non-Aktif') }}
                </span>

                @foreach ($subjects as $subject)
                    <span class="bg-emerald-100 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold">
                        {{ $subject->subject_name }}
                    </span>
                @endforeach

                @if($homeroomClass)
                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold">
                        Wali Kelas
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="modern-box mb-6">

    <h2 class="box-title mb-5">
        Data Pribadi
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Nama Lengkap</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->full_name }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="badge-check" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">NIP</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->nip }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Pendidikan Terakhir</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->last_education ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="book-open" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Mata Pelajaran Diampu</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $subjects->pluck('subject_name')->implode(', ') ?: '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                <i data-lucide="mail" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Email</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->user->email ?? '-' }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center">
                <i data-lucide="phone" class="w-5 h-5"></i>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-semibold">Telepon</p>
                <p class="text-sm font-bold text-slate-700">
                    {{ $teacher->phone ?? '-' }}
                </p>
            </div>
        </div>

    </div>
</div>

<div class="modern-box">

    <h2 class="box-title mb-5 flex items-center gap-2">
        <i data-lucide="lock-keyhole" class="w-5 h-5 text-red-500"></i>
        Keamanan Akun
    </h2>

    <div class="space-y-4">

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Password Lama
            </label>
            <input type="password"
                placeholder="Masukkan password lama"
                class="w-full h-11 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Password Baru
            </label>
            <input type="password"
                placeholder="Masukkan password baru"
                class="w-full h-11 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 mb-2">
                Konfirmasi Password Baru
            </label>
            <input type="password"
                placeholder="Konfirmasi password baru"
                class="w-full h-11 rounded-xl border border-slate-200 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-100">
        </div>

        <div class="rounded-xl bg-yellow-50 border border-yellow-100 px-4 py-3 text-sm text-yellow-700">
            <span class="font-bold">Perhatian:</span>
            Setelah mengubah password, Anda akan logout otomatis dan harus login kembali.
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button class="h-11 flex-1 rounded-xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50">
                Batal
            </button>

            <button class="h-11 flex-1 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-bold">
                Ubah Password
            </button>
        </div>

    </div>

</div>

@endsection
