@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.tk.profil') }}">TK</a><span>/</span><span class="current">Prestasi</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Prestasi TK</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.tk.profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Profil</a>
            <a href="{{ route('public.unit.tk.guru') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Guru</a>
            <a href="{{ route('public.unit.tk.ekskul') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.tk.fasilitas') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Fasilitas</a>
            <a href="{{ route('public.unit.tk.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap bg-sky-500 text-white">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="trophy" class="w-4 h-4"></i> Prestasi</span>
                <h2 class="section-title mx-auto">Prestasi TK Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $prestasi = [['tahun'=>'2025','judul'=>'Juara 1 Lomba Hafalan','desc'=>'Juara 1 Lomba Hafalan Surat Pendek tingkat Kecamatan.'],['tahun'=>'2025','judul'=>'Juara 2 Mewarnai','desc'=>'Juara 2 Lomba Mewarnai tingkat Kota Bandung.'],['tahun'=>'2024','judul'=>'Juara 1 Drumband','desc'=>'Juara 1 Festival Drumband Mini antar TK se-Bandung Raya.'],['tahun'=>'2024','judul'=>'Best Performance','desc'=>'Penampilan terbaik di Festival Anak Sholeh Jabar.'],['tahun'=>'2023','judul'=>'Juara 3 Storytelling','desc'=>'Juara 3 Lomba Bercerita Islami tingkat Provinsi.'],['tahun'=>'2023','judul'=>'Juara 1 Fashion Show','desc'=>'Juara 1 Fashion Show Busana Muslim Anak.']]; @endphp
                @foreach($prestasi as $p)
                <div class="feature-card fade-up">
                    <span class="text-xs font-bold text-sky-600 bg-sky-50 px-2.5 py-1 rounded-full">{{ $p['tahun'] }}</span>
                    <h3 class="text-lg font-bold text-slate-800 mt-3 mb-2">{{ $p['judul'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $p['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
