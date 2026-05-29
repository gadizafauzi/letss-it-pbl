@extends('layouts.public')

@section('content')

    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a><span>/</span>
                <a href="{{ route('public.unit.index') }}">Unit</a><span>/</span>
                <span class="current">TK Islam Terpadu</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">TK Islam Terpadu</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Membentuk karakter islami sejak usia dini dengan pendekatan bermain sambil belajar.</p>
        </div>
    </div>

    {{-- SUB NAV --}}
    <div class="bg-white border-b border-slate-200 sticky top-[72px] z-30">
        <div class="w-full flex gap-2 overflow-x-auto py-3 public-subnav-container no-scrollbar">
            <a href="{{ route('public.unit.tk.profil') }}" class="subnav-link {{ request()->routeIs('public.unit.tk.profil') ? 'active' : '' }}">Profil</a>
            <a href="{{ route('public.unit.tk.guru') }}" class="subnav-link {{ request()->routeIs('public.unit.tk.guru') ? 'active' : '' }}">Guru</a>
            <a href="{{ route('public.unit.tk.ekskul') }}" class="subnav-link {{ request()->routeIs('public.unit.tk.ekskul') ? 'active' : '' }}">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.tk.fasilitas') }}" class="subnav-link {{ request()->routeIs('public.unit.tk.fasilitas') ? 'active' : '' }}">Fasilitas</a>
            <a href="{{ route('public.unit.tk.prestasi') }}" class="subnav-link {{ request()->routeIs('public.unit.tk.prestasi') ? 'active' : '' }}">Prestasi</a>
        </div>
    </div>

    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><i data-lucide="baby" class="w-4 h-4"></i> TK Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil TK Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">TK Islam Terpadu SIT Mutiara Qur'an menyediakan pendidikan usia dini (4-6 tahun) dengan pendekatan bermain sambil belajar yang mengintegrasikan nilai-nilai Islam.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Anak-anak diperkenalkan dengan huruf hijaiyah, hafalan surat-surat pendek, doa harian, serta akhlak islami melalui kegiatan yang menyenangkan.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Iqra & Hijaiyah', 'Sentra Bermain', 'Hafalan Juz 30', 'Seni & Kreativitas', 'Motorik Halus & Kasar', 'Belajar Berhitung'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-pink-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-pink-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                        <i data-lucide="baby" class="w-32 h-32 text-pink-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
