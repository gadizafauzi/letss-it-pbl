@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.unit.index') }}">Unit</a><span>/</span><span class="current">SMP Islam Terpadu</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">SMP Islam Terpadu</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Jenjang menengah pertama yang mempersiapkan siswa unggul secara akademik dan spiritual.</p>
        </div>
    </div>
    @include('components.public.unit-subnav', ['unit' => 'smp', 'active' => 'profil'])
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                <div>
                    <span class="section-badge"><img src="{{ asset('images/smp.jpeg') }}" class="w-4 h-4 object-contain rounded-full bg-white p-0.5 inline mr-1"> SMP Islam Terpadu</span>
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
                <div class="relative group py-6 px-2">
                    {{-- Main logo frame --}}
                    <div class="w-full rounded-2xl border border-indigo-100 bg-gradient-to-br from-indigo-50 via-white to-indigo-50/40 flex items-center justify-center overflow-hidden transition-all duration-300 group-hover:shadow-xl group-hover:border-indigo-200" style="min-height: 300px; padding: clamp(24px,6%,56px);">
                        <img src="{{ asset('images/smp.jpeg') }}" alt="Logo SMPIT Mutiara Qur'an"
                             class="max-h-52 sm:max-h-64 w-auto object-contain drop-shadow-xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    {{-- Floating badge top-right: Target Hafalan --}}
                    <div class="absolute top-2 -right-2 sm:right-0 bg-white rounded-2xl shadow-lg border border-indigo-100/80 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:4s;">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="book-open" class="w-3.5 h-3.5 text-indigo-500"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">Target Hafalan</p>
                            <p class="text-xs font-black text-slate-800 mt-0.5">10 Juz</p>
                        </div>
                    </div>

                    {{-- Floating badge bottom-left: Jenjang --}}
                    <div class="absolute bottom-2 -left-2 sm:left-0 bg-white rounded-2xl shadow-lg border border-indigo-100 px-3 py-2 flex items-center gap-2.5 animate-bounce z-10" style="animation-duration:5.5s;">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0">
                            <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-indigo-600"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider leading-none">Masuk dari</p>
                            <p class="text-xs font-black text-slate-800 mt-0.5">Lulusan SD/MI</p>
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
