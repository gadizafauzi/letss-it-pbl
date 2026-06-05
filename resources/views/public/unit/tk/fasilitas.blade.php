@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.tk.profil') }}">TK</a><span>/</span><span class="current">Fasilitas</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Fasilitas TK</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'tk', 'active' => 'fasilitas'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="building" class="w-4 h-4"></i> Fasilitas</span>
                <h2 class="section-title mx-auto">Fasilitas TK Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $fasilitas = [['icon'=>'home','title'=>'Ruang Kelas Ber-AC','desc'=>'Ruang kelas yang nyaman dan aman untuk anak usia dini.'],['icon'=>'trees','title'=>'Area Bermain Outdoor','desc'=>'Taman bermain luas dengan perlengkapan yang aman.'],['icon'=>'blocks','title'=>'Sentra Bermain Indoor','desc'=>'Area bermain dalam ruangan dengan mainan edukatif.'],['icon'=>'utensils','title'=>'Kantin Sehat','desc'=>'Menu makanan bergizi yang disiapkan khusus untuk anak-anak.'],['icon'=>'book','title'=>'Perpustakaan Mini','desc'=>'Koleksi buku cerita anak dan buku bergambar Islami.'],['icon'=>'shield-check','title'=>'CCTV & Keamanan','desc'=>'Sistem keamanan 24 jam untuk keselamatan anak-anak.']]; @endphp
                @foreach($fasilitas as $f)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-sky-50 text-sky-500"><i data-lucide="{{ $f['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
