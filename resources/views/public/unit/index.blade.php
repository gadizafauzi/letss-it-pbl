@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Unit Pendidikan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Unit Pendidikan</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Jenjang pendidikan Islam terpadu dari TK hingga SMP.</p>
        </div>
    </div>

    <section class="public-section">
        <div class="w-full">
            @php
                $units = [
                    ['icon' => 'baby', 'color' => 'pink', 'title' => 'TK Islam Terpadu', 'desc' => 'Pembelajaran usia dini yang menyenangkan dengan pendekatan bermain dan mengenal Al-Qur\'an sejak dini.', 'route' => 'public.unit.tk.profil',
                     'features' => ['Iqra & Hijaiyah', 'Sentra Bermain', 'Hafalan Juz 30', 'Seni & Kreativitas']],
                    ['icon' => 'school', 'color' => 'emerald', 'title' => 'SD Islam Terpadu', 'desc' => 'Pendidikan dasar 6 tahun yang memadukan kurikulum nasional dengan kurikulum keislaman.', 'route' => 'public.unit.sd.profil',
                     'features' => ['Target 5 Juz', 'Matematika & Sains', 'Bahasa Arab & Inggris', 'Ekstrakurikuler']],
                    ['icon' => 'graduation-cap', 'color' => 'blue', 'title' => 'SMP Islam Terpadu', 'desc' => 'Jenjang menengah pertama yang mempersiapkan siswa untuk menjadi pribadi unggul.', 'route' => 'public.unit.smp.profil',
                     'features' => ['Target 10 Juz', 'Lab IPA & Komputer', 'English & Arabic', 'Leadership Camp']],
                ];
            @endphp

            <div class="space-y-16">
                @foreach($units as $i => $unit)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center fade-up">
                        <div class="{{ $i % 2 === 1 ? 'order-2 lg:order-1' : '' }}">
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-{{ $unit['color'] }}-50 text-{{ $unit['color'] }}-600 text-xs font-bold mb-4">
                                <i data-lucide="{{ $unit['icon'] }}" class="w-3.5 h-3.5"></i> {{ $unit['title'] }}
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-black text-slate-800 mb-4">{{ $unit['title'] }}</h2>
                            <p class="text-slate-500 leading-relaxed mb-6">{{ $unit['desc'] }}</p>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                @foreach($unit['features'] as $f)
                                    <div class="flex items-center gap-3 p-3 rounded-xl bg-{{ $unit['color'] }}-50/60">
                                        <i data-lucide="check" class="w-4 h-4 text-{{ $unit['color'] }}-500 flex-shrink-0"></i>
                                        <span class="text-sm font-semibold text-slate-700">{{ $f }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route($unit['route']) }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-500 text-white font-bold text-sm hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-emerald-200">
                                Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                        <div class="{{ $i % 2 === 1 ? 'order-1 lg:order-2' : '' }}">
                            <div class="w-full aspect-video rounded-3xl bg-gradient-to-br from-{{ $unit['color'] }}-100 to-{{ $unit['color'] }}-200 flex items-center justify-center">
                                <i data-lucide="{{ $unit['icon'] }}" class="w-24 h-24 text-{{ $unit['color'] }}-300"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
