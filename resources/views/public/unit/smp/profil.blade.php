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
            <a href="{{ route('public.unit.smp.profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap bg-indigo-600 text-white">Profil</a>
            <a href="{{ route('public.unit.smp.guru') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Guru</a>
            <a href="{{ route('public.unit.smp.ekskul') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.smp.fasilitas') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Fasilitas</a>
            <a href="{{ route('public.unit.smp.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Prestasi</a>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><img src="{{ asset('images/logo_smp.png') }}" class="w-4 h-4 object-contain rounded-full bg-white p-0.5 inline mr-1"> SMP Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil SMP Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">SMP Islam Terpadu SIT Mutiara Qur'an mempersiapkan siswa untuk menjadi pribadi unggul yang siap menghadapi tantangan masa depan dengan bekal iman, ilmu, dan akhlak.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Dengan target hafalan minimal 10 juz, penguasaan bahasa Arab dan Inggris, serta program leadership, siswa dibekali kompetensi lengkap.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Target Hafal 10 Juz', 'Lab IPA & Komputer', 'English & Arabic', 'Leadership Camp', 'Penelitian Ilmiah', 'Bimbingan Konseling'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-indigo-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-indigo-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-indigo-50 to-indigo-100/60 border border-indigo-100/50 flex items-center justify-center p-8">
                        <img src="{{ asset('images/logo_smp.png') }}" alt="Logo SMPIT Mutiara Qur'an" class="w-32 h-32 md:w-40 md:h-40 object-contain drop-shadow-md hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
