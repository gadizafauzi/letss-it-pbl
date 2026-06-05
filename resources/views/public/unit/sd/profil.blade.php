@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><span class="current">SD Islam Terpadu</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">SD Islam Terpadu</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Pendidikan dasar 6 tahun yang memadukan kurikulum nasional dengan kurikulum keislaman.</p>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'sd', 'active' => 'profil'])
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><img src="{{ asset('images/sd.jpeg') }}" class="w-4 h-4 object-contain rounded-full bg-white p-0.5 inline mr-1"> SD Islam Terpadu</span>
                    <h2 class="section-title mb-4">Profil SD Islam Terpadu</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">SD Islam Terpadu SIT Mutiara Qur'an menyediakan pendidikan dasar selama 6 tahun dengan kurikulum yang mengintegrasikan ilmu pengetahuan umum dan keislaman secara menyeluruh.</p>
                    <p class="text-slate-500 leading-relaxed mb-6">Siswa dibimbing untuk menguasai ilmu pengetahuan, menghafal Al-Qur'an minimal 5 juz, serta memiliki akhlak mulia dan karakter yang kuat.</p>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach(['Target Hafal 5 Juz', 'Kurikulum Merdeka', 'Bahasa Arab & Inggris', 'Matematika & Sains', 'Pembinaan Akhlak', 'Outbound & Fieldtrip'] as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-amber-50/60">
                                <i data-lucide="check" class="w-4 h-4 text-amber-500 flex-shrink-0"></i>
                                <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="relative group py-6 px-2">
                    {{-- Main logo frame --}}
                    <div class="w-full rounded-2xl border border-amber-100 bg-gradient-to-br from-amber-50 via-white to-amber-50/40 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:border-amber-200" style="min-height: 300px; padding: clamp(24px,6%,56px);">
                        <img src="{{ asset('images/sd.jpeg') }}" alt="Logo SDIT Mutiara Qur'an"
                             class="max-h-52 sm:max-h-64 w-auto object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    {{-- Floating badge top-right: Target Hafalan --}}
                    <div class="absolute top-2 -right-2 sm:right-0 bg-white rounded-2xl shadow-lg border border-amber-100/80 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:4s;">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="book-open" class="w-3.5 h-3.5 text-amber-500"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">Target Hafalan</p>
                            <p class="text-xs font-black text-slate-800 mt-0.5">5 Juz</p>
                        </div>
                    </div>

                    {{-- Floating badge bottom-left: Usia --}}
                    <div class="absolute bottom-2 -left-2 sm:left-0 bg-white rounded-2xl shadow-lg border border-amber-100 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:5.5s;">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="users" class="w-3.5 h-3.5 text-amber-500"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">Usia Masuk</p>
                            <p class="text-xs font-black text-slate-800 mt-0.5">6 – 7 Tahun</p>
                        </div>
                    </div>

                    {{-- Pill akreditasi --}}
                    <div class="absolute bottom-10 right-4 bg-white/95 backdrop-blur-sm rounded-full px-3 py-1.5 flex items-center gap-1.5 border border-emerald-100 shadow-sm z-10">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500 flex-shrink-0"></i>
                        <span class="text-[11px] font-bold text-slate-700">Terakreditasi A</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
