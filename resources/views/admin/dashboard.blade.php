@extends('layouts.admin')

@section('content')

    {{-- STATS SECTION --}}
    <div class="mb-10">

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

            <x-admin.stats-card
                title="Total Siswa"
                value="495"
                icon="graduation-cap"
                color="text-emerald-500"
                bg="bg-emerald-50"
            />

            <x-admin.stats-card
                title="Total Guru"
                value="32"
                icon="badge-check"
                color="text-cyan-500"
                bg="bg-cyan-50"
            />

            <x-admin.stats-card
                title="Total Kelas"
                value="18"
                icon="school"
                color="text-orange-500"
                bg="bg-orange-50"
            />

            <x-admin.stats-card
                title="Pembayaran"
                value="Rp12JT"
                icon="wallet"
                color="text-blue-500"
                bg="bg-blue-50"
            />

        </div>

    </div>

    {{-- ACTIVITY --}}
    <div class="modern-box p-7">

        <h3 class="text-2xl font-bold text-slate-900">
            Aktivitas Terbaru
        </h3>

        <p class="text-slate-500 mt-2">
            Aktivitas sistem terbaru
        </p>

    </div>

@endsection