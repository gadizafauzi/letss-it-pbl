@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.sd.profil') }}">SD</a><span>/</span><span class="current">Prestasi</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Prestasi SD</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'sd', 'active' => 'prestasi'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="trophy" class="w-4 h-4"></i> Prestasi</span>
                <h2 class="section-title mx-auto">Prestasi SD Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $prestasi = [['tahun'=>'2026','judul'=>'Juara 1 Olimpiade Sains','desc'=>'Juara 1 Olimpiade Sains tingkat Kota Bandung bidang IPA.'],['tahun'=>'2025','judul'=>'Juara 2 MTQ Provinsi','desc'=>'Juara 2 Musabaqah Tilawatil Quran tingkat Provinsi Jawa Barat.'],['tahun'=>'2025','judul'=>'Juara 1 Tahfidz','desc'=>'Juara 1 Lomba Tahfidz 5 Juz tingkat Kota.'],['tahun'=>'2024','judul'=>'Juara 3 Robotika','desc'=>'Juara 3 Kompetisi Robotika Anak tingkat Nasional.'],['tahun'=>'2024','judul'=>'Best Student Award','desc'=>'Penghargaan siswa terbaik dalam ajang JSIT Nasional.'],['tahun'=>'2023','judul'=>'Juara 1 Pidato','desc'=>'Juara 1 Lomba Pidato Bahasa Arab tingkat Provinsi.']]; @endphp
                @foreach($prestasi as $p)
                <div class="feature-card fade-up">
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-full">{{ $p['tahun'] }}</span>
                    <h3 class="text-lg font-bold text-slate-800 mt-3 mb-2">{{ $p['judul'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $p['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
