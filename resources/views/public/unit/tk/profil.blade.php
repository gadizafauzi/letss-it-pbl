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
            <a href="{{ route('public.unit.tk.profil') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap bg-sky-500 text-white">Profil</a>
            <a href="{{ route('public.unit.tk.guru') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Guru</a>
            <a href="{{ route('public.unit.tk.ekskul') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Ekstrakurikuler</a>
            <a href="{{ route('public.unit.tk.fasilitas') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Fasilitas</a>
            <a href="{{ route('public.unit.tk.prestasi') }}" class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap text-slate-500 hover:bg-slate-100">Prestasi</a>
        </div>
    </div>
 
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><img src="{{ asset('images/logo_tk.png') }}" class="w-4 h-4 object-contain rounded-full bg-white p-0.5 inline mr-1"> TK Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil TK Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">TK Islam Terpadu SIT Mutiara Qur'an menyediakan pendidikan usia dini (4-6 tahun) dengan pendekatan bermain sambil belajar yang mengintegrasikan nilai-nilai Islam.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Anak-anak diperkenalkan dengan huruf hijaiyah, hafalan surat-surat pendek, doa harian, serta akhlak islami melalui kegiatan yang menyenangkan.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Iqra & Hijaiyah', 'Sentra Bermain', 'Hafalan Juz 30', 'Seni & Kreativitas', 'Motorik Halus & Kasar', 'Belajar Berhitung'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-sky-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-sky-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-sky-50 to-sky-100/60 border border-sky-100/50 flex items-center justify-center p-8">
                        <img src="{{ asset('images/logo_tk.png') }}" alt="Logo TKIT Mutiara Quran" class="w-32 h-32 md:w-40 md:h-40 object-contain drop-shadow-md hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
