@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.smp.profil') }}">SMP</a><span>/</span><span class="current">Fasilitas</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Fasilitas SMP</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'smp', 'active' => 'fasilitas'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="building" class="w-4 h-4"></i> Fasilitas</span>
                <h2 class="section-title mx-auto">Fasilitas SMP Islam Terpadu</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $fasilitas = [['icon'=>'monitor','title'=>'Lab Komputer','desc'=>'40 unit komputer dengan akses internet high-speed.'],['icon'=>'flask-conical','title'=>'Lab IPA','desc'=>'Lab Fisika, Kimia, dan Biologi dengan peralatan lengkap.'],['icon'=>'library','title'=>'Perpustakaan Digital','desc'=>'Koleksi 8000+ buku dan akses e-library.'],['icon'=>'wifi','title'=>'Smart Classroom','desc'=>'Kelas ber-AC dengan smartboard interaktif.'],['icon'=>'dumbbell','title'=>'Lapangan & GOR','desc'=>'Lapangan olahraga multifungsi dan gedung olahraga.'],['icon'=>'mosque','title'=>'Musholla','desc'=>'Musholla luas untuk sholat berjamaah dan kajian.']]; @endphp
                @foreach($fasilitas as $f)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-indigo-50 text-indigo-600"><i data-lucide="{{ $f['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
