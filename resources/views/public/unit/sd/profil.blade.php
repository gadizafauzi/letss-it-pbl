@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><span class="current">SD Islam Terpadu</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">SD Islam Terpadu</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Pendidikan dasar 6 tahun yang memadukan kurikulum nasional dengan kurikulum keislaman.</p>
        </div>
    </div>
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.sd.profil') }}" class="subnav-link {{ request()->routeIs('public.unit.sd.profil') ? 'active' : '' }}">Profil</a>
            <a href="{{ route('public.unit.sd.guru') }}" class="subnav-link {{ request()->routeIs('public.unit.sd.guru') ? 'active' : '' }}">Guru</a>
            <a href="{{ route('public.unit.sd.ekskul') }}" class="subnav-link {{ request()->routeIs('public.unit.sd.ekskul') ? 'active' : '' }}">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.sd.fasilitas') }}" class="subnav-link {{ request()->routeIs('public.unit.sd.fasilitas') ? 'active' : '' }}">Fasilitas</a>
            <a href="{{ route('public.unit.sd.prestasi') }}" class="subnav-link {{ request()->routeIs('public.unit.sd.prestasi') ? 'active' : '' }}">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><i data-lucide="school" class="w-4 h-4"></i> SD Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil SD Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">SD Islam Terpadu SIT Mutiara Qur'an menyediakan pendidikan dasar selama 6 tahun dengan kurikulum yang mengintegrasikan ilmu pengetahuan umum dan keislaman secara menyeluruh.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Siswa dibimbing untuk menguasai ilmu pengetahuan, menghafal Al-Qur'an minimal 5 juz, serta memiliki akhlak mulia dan karakter yang kuat.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Target Hafal 5 Juz', 'Kurikulum Merdeka', 'Bahasa Arab & Inggris', 'Matematika & Sains', 'Pembinaan Akhlak', 'Outbound & Fieldtrip'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-emerald-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-emerald-100 to-emerald-200 flex items-center justify-center">
                        <i data-lucide="school" class="w-32 h-32 text-emerald-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
