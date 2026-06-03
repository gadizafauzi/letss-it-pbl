@extends('layouts.admin')

@section('content')
    {{-- PAGE TITLE --}}
    <div class="mb-6">

        <h1 class="text-[28px] font-semibold text-slate-800">
            Dashboard
        </h1>

        <p class="text-sm text-slate-400 mt-1">Selamat datang kembali, Admin</p>

    </div>

    {{-- STATS SECTION --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-10">

        <x-admin.stats-card title="Total Siswa" value="{{ $totalSiswa }}" icon="graduation-cap" color="text-blue-500"
            bg="bg-blue-50" />

        <x-admin.stats-card title="Total Guru" value="{{ $totalGuru }}" icon="badge-check" color="text-indigo-500"
            bg="bg-indigo-50" />

        <x-admin.stats-card title="Total Kelas" value="{{ $totalKelas }}" icon="school" color="text-sky-500"
            bg="bg-sky-50" />

        <x-admin.stats-card title="Pembayaran" value="Belum tersedia" icon="wallet" color="text-blue-400"
            bg="bg-blue-50" />

    </div>

    {{-- ACTIVITY --}}
    <div class="modern-box p-7">

        <h3 class="text-xl font-semibold text-slate-800">
            Aktivitas Terbaru
        </h3>

        <p class="text-sm text-slate-500 mt-1">
            Aktivitas sistem terbaru
        </p>

    </div>
@endsection
