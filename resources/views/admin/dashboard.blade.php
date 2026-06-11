@extends('layouts.admin')

@section('content')
    {{-- PAGE TITLE --}}
    <div class="mb-6">

        <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
            Dashboard
        </h1>

        <p class="text-sm text-slate-400 mt-1">Selamat datang kembali, Admin</p>

    </div>

    {{-- STATS SECTION --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-10">

        <x-admin.stats-card title="Total Siswa" value="{{ $stats['totalSiswa'] }}" icon="graduation-cap" color="text-blue-500 dark:text-blue-400"
            bg="bg-blue-50 dark:bg-blue-900/40" />

        <x-admin.stats-card title="Total Guru" value="{{ $stats['totalGuru'] }}" icon="badge-check" color="text-indigo-500 dark:text-indigo-400"
            bg="bg-indigo-50 dark:bg-indigo-900/40" />

        <x-admin.stats-card title="Total Kelas" value="{{ $stats['totalKelas'] }}" icon="school" color="text-sky-500 dark:text-sky-400"
            bg="bg-sky-50 dark:bg-sky-900/40" />

        <x-admin.stats-card title="Pembayaran" value="Belum tersedia" icon="wallet" color="text-blue-400"
            bg="bg-blue-50 dark:bg-blue-900/40" />

    </div>

    {{-- ACTIVITY --}}
    <div class="modern-box p-7">

        <h3 class="text-xl font-semibold text-[var(--theme-primary)] dark:text-blue-400">
            Aktivitas Terbaru
        </h3>

        <p class="text-sm text-slate-500 mt-1">
            Aktivitas sistem terbaru
        </p>

    </div>
@endsection
