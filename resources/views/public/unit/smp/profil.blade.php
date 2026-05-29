@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><span class="current">SMP Islam Terpadu</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">SMP Islam Terpadu</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Jenjang menengah pertama yang mempersiapkan siswa unggul secara akademik dan spiritual.</p>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.smp.profil') }}" class="subnav-link {{ request()->routeIs('public.unit.smp.profil') ? 'active' : '' }}">Profil</a>
            <a href="{{ route('public.unit.smp.guru') }}" class="subnav-link {{ request()->routeIs('public.unit.smp.guru') ? 'active' : '' }}">Guru</a>
            <a href="{{ route('public.unit.smp.ekskul') }}" class="subnav-link {{ request()->routeIs('public.unit.smp.ekskul') ? 'active' : '' }}">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.smp.fasilitas') }}" class="subnav-link {{ request()->routeIs('public.unit.smp.fasilitas') ? 'active' : '' }}">Fasilitas</a>
            <a href="{{ route('public.unit.smp.prestasi') }}" class="subnav-link {{ request()->routeIs('public.unit.smp.prestasi') ? 'active' : '' }}">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><i data-lucide="graduation-cap" class="w-4 h-4"></i> SMP Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil SMP Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">SMP Islam Terpadu SIT Mutiara Qur'an mempersiapkan siswa untuk menjadi pribadi unggul yang siap menghadapi tantangan masa depan dengan bekal iman, ilmu, dan akhlak.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Dengan target hafalan minimal 10 juz, penguasaan bahasa Arab dan Inggris, serta program leadership, siswa dibekali kompetensi lengkap.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Target Hafal 10 Juz', 'Lab IPA & Komputer', 'English & Arabic', 'Leadership Camp', 'Penelitian Ilmiah', 'Bimbingan Konseling'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-blue-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-blue-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <i data-lucide="graduation-cap" class="w-32 h-32 text-blue-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
