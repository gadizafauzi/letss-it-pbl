@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.sd.profil') }}">SD</a><span>/</span><span class="current">Ekstrakurikuler</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Ekstrakurikuler SD</h1>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'sd', 'active' => 'ekskul'])
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="trophy" class="w-4 h-4"></i> Kegiatan</span>
                <h2 class="section-title mx-auto">Ekstrakurikuler SD</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $ekskul = [['icon'=>'swords','title'=>'Pencak Silat','desc'=>'Bela diri tradisional untuk melatih ketangkasan dan disiplin.'],['icon'=>'target','title'=>'Panahan','desc'=>'Sunnah Rasulullah yang melatih fokus dan konsentrasi.'],['icon'=>'cpu','title'=>'Robotika','desc'=>'Pengenalan teknologi dan pemrograman dasar.'],['icon'=>'languages','title'=>'English Club','desc'=>'Peningkatan kemampuan bahasa Inggris aktif.'],['icon'=>'book-marked','title'=>'Tahfidz Club','desc'=>'Pembinaan hafalan Al-Quran intensif.'],['icon'=>'volleyball','title'=>'Futsal','desc'=>'Olahraga tim yang membangun sportivitas.']]; @endphp
                @foreach($ekskul as $e)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-amber-50 text-amber-500"><i data-lucide="{{ $e['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $e['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $e['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
