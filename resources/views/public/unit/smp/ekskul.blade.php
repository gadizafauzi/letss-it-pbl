@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><a href="{{ route('public.unit.smp.profil') }}">SMP</a><span>/</span><span class="current">Ekstrakurikuler</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Ekstrakurikuler SMP</h1>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.smp.profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Profil</a>
            <a href="{{ route('public.unit.smp.guru') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Guru</a>
            <a href="{{ route('public.unit.smp.ekskul') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap bg-indigo-600 text-white">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.smp.fasilitas') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Fasilitas</a>
            <a href="{{ route('public.unit.smp.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="text-center mb-14 fade-up"><span class="section-badge"><i data-lucide="trophy" class="w-4 h-4"></i> Kegiatan</span><h2 class="section-title mx-auto">Ekstrakurikuler SMP</h2></div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php $ekskul = [['icon'=>'swords','title'=>'Pencak Silat','desc'=>'Bela diri tradisional tingkat lanjut.'],['icon'=>'target','title'=>'Panahan','desc'=>'Latihan panahan sesuai sunnah Rasulullah.'],['icon'=>'cpu','title'=>'Coding & Robotika','desc'=>'Pemrograman dan robotika untuk masa depan.'],['icon'=>'pen-tool','title'=>'Jurnalistik','desc'=>'Penulisan berita dan majalah sekolah.'],['icon'=>'mic','title'=>'Public Speaking','desc'=>'Latihan pidato dan debat.'],['icon'=>'volleyball','title'=>'Olahraga','desc'=>'Futsal, basket, dan badminton.']]; @endphp
                @foreach($ekskul as $e)
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-indigo-50 text-indigo-600"><i data-lucide="{{ $e['icon'] }}" class="w-6 h-6"></i></div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $e['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $e['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
