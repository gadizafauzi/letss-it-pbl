@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.sd.profil') }}">SD</a><span>/</span><span class="current">Fasilitas</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Fasilitas SD</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'sd', 'active' => 'fasilitas'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="building" class="w-4 h-4"></i> Fasilitas</span>
                <h2 class="section-title mx-auto">Fasilitas SD Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $fasilitas = [['icon'=>'monitor','title'=>'Lab Komputer','desc'=>'30 unit komputer dengan akses internet untuk pembelajaran TIK.'],['icon'=>'flask-conical','title'=>'Lab IPA','desc'=>'Laboratorium IPA dengan peralatan praktikum lengkap.'],['icon'=>'library','title'=>'Perpustakaan','desc'=>'Koleksi 5000+ buku pelajaran, fiksi, dan referensi Islam.'],['icon'=>'wifi','title'=>'Kelas Smart','desc'=>'Ruang kelas ber-AC dengan proyektor dan sound system.'],['icon'=>'trees','title'=>'Lapangan Olahraga','desc'=>'Lapangan futsal, badminton, dan area bermain outdoor.'],['icon'=>'utensils','title'=>'Kantin Sehat','desc'=>'Menu makanan bergizi dengan pengawasan higienitas ketat.']]; @endphp
                @foreach($fasilitas as $f)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-amber-50 text-amber-500"><i data-lucide="{{ $f['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
