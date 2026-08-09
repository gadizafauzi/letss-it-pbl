@extends('layouts.unit')

@section('navbar')
    <x-public.unit-navbar unitLogo="images/tk.jpeg" unitName="TK Islam Terpadu" textTheme="dark" />
@endsection

@section('footer')
    <x-public.unit-footer unitName="TK Islam Terpadu" />
@endsection

@section('content')
<div class="theme-tk">
    <style>
        :root {
            --unit-accent: #f97316;
            --unit-accent-lt: #fdba74;
        }

        /* ── Reveal animations ────────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .reveal.reveal-left {
            transform: translateX(-30px);
        }

        .reveal.reveal-right {
            transform: translateX(30px);
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* ── Section badge ────────────────────────── */
        .unit-section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.85rem;
            border-radius: 999px;
            background: rgba(234, 88, 12, 0.10);
            border: 1px solid rgba(234, 88, 12, 0.22);
            color: #ea580c;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 0.75rem;
        }


        /* ── Section subtitle ─────────────────────── */
        .unit-section-desc {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.7;
            max-width: 640px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0.75rem;
        }

        .unit-section-desc.light {
            color: rgba(255, 255, 255, 0.55);
        }

        /* ── Stat card ────────────────────────────── */
        .unit-stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            padding: 1.25rem;
            text-align: center;
            transition: background 0.3s, border-color 0.3s;
        }

        .unit-stat-card:hover {
            background: rgba(234, 88, 12, 0.08);
            border-color: rgba(234, 88, 12, 0.3);
        }

        /* ── Curriculum card ──────────────────────── */
        .unit-curriculum-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .unit-curriculum-card:hover {
            border-color: #f97316;
            box-shadow: 0 6px 24px rgba(234, 88, 12, 0.10);
            transform: translateY(-3px);
        }

        .unit-curriculum-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(234, 88, 12, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #f97316;
            transition: background 0.3s;
        }

        .unit-curriculum-card:hover .unit-curriculum-icon {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
        }

        /* ── Teacher card ─────────────────────────── */
        .unit-teacher-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .unit-teacher-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.09);
            border-color: #fdba74;
        }

        .unit-teacher-photo {
            aspect-ratio: 1 / 1;
            overflow: hidden;
        }

        .unit-teacher-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .unit-teacher-card:hover .unit-teacher-photo img {
            transform: scale(1.07);
        }

        .unit-teacher-info {
            padding: 0.75rem 0.85rem;
            text-align: center;
        }

        .unit-teacher-info h3 {
            font-size: 0.8rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unit-teacher-info p {
            font-size: 0.7rem;
            font-weight: 500;
            color: #f97316;
        }

        /* ── Timeline dot ─────────────────────────── */
        .unit-timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #f97316;
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.25);
            position: absolute;
            left: -8px;
            top: 1.4rem;
            transition: transform 0.3s;
        }

        .unit-timeline-card:hover .unit-timeline-dot {
            transform: scale(1.35);
        }

        /* ── Float animation ──────────────────────── */
        @keyframes float {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-16px); }
            100% { transform: translateY(0px); }
        }

        .animate-floating {
            animation: float 6s ease-in-out infinite;
        }

        /* ── Timeline line ────────────────────────── */
        .tl-line {
            background: linear-gradient(to bottom, #fb923c, #f97316, #ea580c);
            transform-origin: top center;
            transform: scaleY(0);
            transition: transform 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .tl-line.visible {
            transform: scaleY(1);
        }

        .tl-dot {
            animation: tl-dot-pulse 2.8s ease-in-out infinite;
        }

        @keyframes tl-dot-pulse {
            0%, 100% { box-shadow: 0 0 0 3px rgba(234, 88, 12,.28), 0 0 10px rgba(234, 88, 12,.22); }
            50%       { box-shadow: 0 0 0 5px rgba(234, 88, 12,.15), 0 0 18px rgba(234, 88, 12,.40); }
        }

        /* ── Beautiful Background Patterns ─────────────── */
        .tk-bg-dots {
            background-color: #ffedd5;
            background-image: radial-gradient(rgba(249, 115, 22, 0.16) 2px, transparent 2px);
            background-size: 32px 32px;
        }
        .tk-bg-solid {
            background-color: #ffffff;
        }
        .tk-bg-stripes {
            background-color: #ffffff;
            background-image: repeating-linear-gradient(45deg, rgba(249, 115, 22, 0.03) 0, rgba(249, 115, 22, 0.03) 2px, transparent 2px, transparent 16px);
        }
        .tk-bg-paper {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23noise)' opacity='0.05'/%3E%3C/svg%3E");
        }
        .tk-bg-grid {
            background-color: #ffedd5;
            background-image: linear-gradient(rgba(249, 115, 22, 0.09) 1.5px, transparent 1.5px),
                              linear-gradient(90deg, rgba(249, 115, 22, 0.09) 1.5px, transparent 1.5px);
            background-size: 40px 40px;
        }
    </style>

    {{-- ════════════════════════════════════════════
         HERO SECTION
         ════════════════════════════════════════════ --}}
    <style>
        /* ── Hero light theme ─────────────────────── */
        .tk-hero {
            background: linear-gradient(135deg, #fef7ed 0%, #fff7ed 40%, #fef3e2 70%, #fde8cd 100%);
            position: relative;
            overflow: hidden;
            min-height: auto;
            display: flex;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .tk-hero {
                min-height: 80vh;
            }
        }

        /* Decorative blobs */
        .tk-hero-blob-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            background: rgba(249, 115, 22, 0.06);
            top: -120px;
            right: -100px;
            animation: blobMorph 12s ease-in-out infinite;
        }
        .tk-hero-blob-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            background: rgba(249, 115, 22, 0.04);
            bottom: -80px;
            left: -60px;
            animation: blobMorph 15s ease-in-out infinite reverse;
        }
        @keyframes blobMorph {
            0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50%  { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }

        /* Image wrapper */
        .tk-hero-img-wrap {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin-left: auto;
            padding: 20px 30px 30px 10px;
        }

        /* Large organic blob behind — bottom-right cream accent */
        .tk-hero-img-blob {
            position: absolute;
            width: 78%;
            height: 85%;
            bottom: 8px;
            right: 8px;
            z-index: 0;
            background: #f5dfc4;
            border-radius: 62% 38% 54% 46% / 44% 56% 44% 56%;
            animation: blobFloat 16s ease-in-out infinite;
        }
        /* Extra small accent blob — top left */
        .tk-hero-img-blob2 {
            position: absolute;
            width: 140px;
            height: 140px;
            top: 10px;
            left: -10px;
            z-index: 0;
            background: #fde8cd;
            border-radius: 62% 38% 46% 54% / 56% 44% 56% 44%;
            animation: blobFloat 12s ease-in-out infinite reverse;
        }
        @keyframes blobFloat {
            0%   { border-radius: 62% 38% 46% 54% / 60% 44% 56% 40%; }
            33%  { border-radius: 48% 52% 58% 42% / 42% 58% 42% 58%; }
            66%  { border-radius: 54% 46% 38% 62% / 56% 40% 60% 44%; }
            100% { border-radius: 62% 38% 46% 54% / 60% 44% 56% 40%; }
        }

        /* Photo frame — organic blob clip */
        .tk-hero-img-frame {
            position: relative;
            z-index: 2;
            border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.13);
            animation: frameMorph 14s ease-in-out infinite;
        }
        @keyframes frameMorph {
            0%   { border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%; }
            33%  { border-radius: 44% 56% 56% 44% / 52% 44% 56% 48%; }
            66%  { border-radius: 56% 44% 48% 52% / 44% 52% 48% 56%; }
            100% { border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%; }
        }
        .tk-hero-img-frame img {
            width: 100%;
            display: block;
            aspect-ratio: 4/3;
            object-fit: cover;
        }

        /* Leaf group - top left of image */
        .tk-hero-leaves {
            position: absolute;
            top: -10px;
            left: -5px;
            z-index: 5;
            pointer-events: none;
        }
        .tk-hero-leaves .leaf {
            display: block;
        }
        .tk-hero-leaves .leaf-1 {
            width: 52px;
            height: auto;
            transform: rotate(-45deg) translateX(4px);
            margin-bottom: -14px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));
        }
        .tk-hero-leaves .leaf-2 {
            width: 42px;
            height: auto;
            transform: rotate(-5deg) translateX(22px);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.12));
        }

        /* Badge - bottom right circular stamp */
        .tk-hero-badge {
            position: absolute;
            right: 10px;
            bottom: 10px;
            width: 110px;
            height: 110px;
            z-index: 10;
        }
        @media (max-width: 1024px) {
            .tk-hero-badge { display: none; }
        }
        .tk-hero-badge-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #fffbf7;
            box-shadow: 0 8px 28px rgba(0,0,0,0.10), 0 0 0 4px rgba(249,115,22,0.08);
            border: 2px solid rgba(249, 115, 22, 0.18);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tk-hero-badge-inner .badge-flower {
            font-size: 1.5rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }
        .tk-hero-badge-inner svg.badge-text-svg {
            position: absolute;
            inset: 6px;
            width: calc(100% - 12px);
            height: calc(100% - 12px);
        }
        .tk-hero-badge-inner svg.badge-text-svg text {
            fill: #ea580c;
            font-size: 12px;
            font-weight: 700;
            font-style: italic;
            letter-spacing: 1px;
        }

        /* Breadcrumb for light bg */
        .tk-hero-breadcrumb a {
            color: #9ca3af;
            font-weight: 500;
            transition: color 0.3s;
        }
        .tk-hero-breadcrumb a:hover {
            color: #f97316;
        }
        .tk-hero-breadcrumb .separator {
            color: #d1d5db;
        }
        .tk-hero-breadcrumb .current {
            color: #f97316;
            font-weight: 600;
        }

        /* Title */
        .tk-hero-title {
            font-size: clamp(2.2rem, 4.5vw, 3.5rem);
            font-weight: 900;
            color: #1e293b;
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin-bottom: 0.85rem;
        }

        /* Subtitle */
        .tk-hero-subtitle {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.75;
            max-width: 460px;
            margin-bottom: 1.5rem;
        }

        /* Buttons */
        .tk-hero-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.3);
            transition: all 0.3s;
            text-decoration: none;
        }
        .tk-hero-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4);
        }
        .tk-hero-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: transparent;
            color: #ea580c;
            font-weight: 700;
            font-size: 0.85rem;
            border: 2px solid #fdba74;
            transition: all 0.3s;
            text-decoration: none;
        }
        .tk-hero-btn-secondary:hover {
            background: rgba(249, 115, 22, 0.06);
            border-color: #f97316;
            transform: translateY(-2px);
        }

        /* Tagline */
        .tk-hero-tagline {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(249, 115, 22, 0.12);
        }
        .tk-hero-tagline-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(249, 115, 22, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #f97316;
        }
        .tk-hero-tagline-text {
            font-size: 0.78rem;
            color: #64748b;
            line-height: 1.5;
            font-weight: 500;
        }
    </style>

    <section id="home" class="tk-hero">
        {{-- Background decorations --}}
        <div class="tk-hero-blob-1"></div>
        <div class="tk-hero-blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-10 lg:pt-24 lg:pb-12 xl:pt-28 xl:pb-16 w-full">
            {{-- Breadcrumb --}}
            <div class="tk-hero-breadcrumb flex items-center gap-3 mb-4 lg:mb-6 text-[0.95rem] reveal reveal-left">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span class="separator">/</span>
                <span class="current">TK Islam Terpadu</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left text --}}
                <div class="reveal reveal-left">
                    <h1 class="tk-hero-title">
                        @if($hero && $hero->title)
                            {{ $hero->title }}
                        @else
                            TK Islam<br>Terpadu
                        @endif
                    </h1>

                    <p class="tk-hero-subtitle">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : 'Membentuk karakter islami sejak usia dini dengan pendekatan belajar, bermain, dan berkarya yang menyenangkan.' }}
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil' }}" class="tk-hero-btn-primary">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Deskripsi Umum' }}
                        </a>
                        <a href="{{ $hero && $hero->button_secondary_link ? $hero->button_secondary_link : '#prestasi' }}" class="tk-hero-btn-secondary">
                            <i data-lucide="star" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_secondary_text ? $hero->button_secondary_text : 'Lihat Prestasi' }}
                        </a>
                    </div>
                </div>

                {{-- Right image --}}
                <div class="relative hidden lg:block reveal reveal-right">
                    <div class="tk-hero-img-wrap">
                        {{-- Small accent blob top-left --}}
                        <div class="tk-hero-img-blob2"></div>

                        {{-- Large organic blob bottom-right --}}
                        <div class="tk-hero-img-blob"></div>

                        {{-- Leaves top-left --}}
                        <div class="tk-hero-leaves">
                            <svg class="leaf leaf-1" viewBox="0 0 40 60" fill="#6aaa4e"><path d="M20 2C20 2 2 16 2 34c0 10 8 16 18 16s18-6 18-16C38 16 20 2 20 2zm0 42c-1.5 0-3-1-3-2.5 0-5 3-13 3-13s3 8 3 13c0 1.5-1.5 2.5-3 2.5z"/></svg>
                            <svg class="leaf leaf-2" viewBox="0 0 40 60" fill="#8dc26e"><path d="M20 2C20 2 2 16 2 34c0 10 8 16 18 16s18-6 18-16C38 16 20 2 20 2zm0 42c-1.5 0-3-1-3-2.5 0-5 3-13 3-13s3 8 3 13c0 1.5-1.5 2.5-3 2.5z"/></svg>
                        </div>

                        {{-- Main image --}}
                        <div class="tk-hero-img-frame">
                            <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : asset('images/tk_dummy.png') }}"
                                alt="TK Islam Terpadu SIT Mutiara Qur'an">
                        </div>

                        {{-- Badge bottom-right --}}
                        <div class="tk-hero-badge">
                            <div class="tk-hero-badge-inner">
                                <span class="badge-flower">🌼</span>
                                <svg class="badge-text-svg" viewBox="0 0 120 120">
                                    <defs>
                                        <path id="topArc" d="M 16,60 A 44,44 0 0,1 104,60" />
                                        <path id="bottomArc" d="M 104,68 A 44,44 0 0,1 16,68" />
                                    </defs>
                                    <text>
                                        <textPath href="#topArc" startOffset="50%" text-anchor="middle">
                                            Pendidikan Islami
                                        </textPath>
                                    </text>
                                    <text>
                                        <textPath href="#bottomArc" startOffset="50%" text-anchor="middle">
                                            Sejak Dini
                                        </textPath>
                                    </text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    {{-- ════════════════════════════════════════════
         STATISTICS SECTION
         ════════════════════════════════════════════ --}}
    @php
        $studentCount = $unit->students()->count();
        $teacherCount = $unit->teachers()->count();
        $classCount = $unit->schoolClasses()->count();

        // Fallback to mock data if actual DB counts are 0
        if ($studentCount === 0) {
            $studentCount = 75;
            $teacherCount = 12;
            $classCount = 4;
        }

        $statisticBg = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        $bgImageUrl = ($statisticBg && $statisticBg->value) ? (str_starts_with($statisticBg->value, 'http') ? $statisticBg->value : Storage::url($statisticBg->value)) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80';
    @endphp
    <section class="relative py-16 md:py-20 z-20 bg-gradient-to-b from-[#fde8cd] via-orange-50/10 to-white border-b border-slate-100 overflow-hidden">
        @if($bgImageUrl)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-[0.10] mix-blend-multiply" style="background-image: url('{{ $bgImageUrl }}');"></div>
        @endif

        <!-- Top Fade Overlay (Blends Hero light color into statistics) -->
        <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-[#fde8cd] to-transparent pointer-events-none z-10"></div>

        <!-- Bottom Fade Overlay -->
        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 max-w-6xl mx-auto">
                {{-- Siswa Aktif --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="users" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $studentCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Siswa Aktif</p>
                </div>

                {{-- Tenaga Pendidik --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 100ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="graduation-cap" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $teacherCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tenaga Pendidik</p>
                </div>

                {{-- Rombel Kelas --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 200ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="door-closed" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $classCount }}" data-suffix="">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Rombel Kelas</p>
                </div>

                {{-- Tahun Berdiri --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 300ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-orange-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-orange-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="building" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="10" data-suffix=" Tahun">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PROFIL SECTION
         ════════════════════════════════════════════ --}}
    <section id="profil" class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">DESKRIPSI TK</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal reveal-left p-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-100 to-orange-50 rounded-2xl transform -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-slate-100 flex items-center justify-center min-h-[300px]">
                            <img src="{{ $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : (file_exists(public_path('storage/' . $detail->description_logo)) ? asset('storage/' . $detail->description_logo) : asset($detail->description_logo))) : asset('images/logomq.jpg') }}" alt="Logo SIT"
                                class="w-40 h-40 object-contain animate-floating">
                        </div>
                    </div>
                </div>

                <div class="reveal reveal-right">
                    <h3 class="text-xl font-bold text-slate-800 mb-5">{{ $detail && $detail->description_title ? $detail->description_title : 'Pondasi Kuat untuk Generasi Qur\'ani' }}</h3>
                    <div class="space-y-4 text-[0.95rem] text-slate-600 leading-relaxed">
                        @if($detail && $detail->description_body)
                            {!! nl2br(e($detail->description_body)) !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- ════════════════════════════════════════════
         GURU SECTION — Auto-scroll carousel
         ════════════════════════════════════════════ --}}
    <section id="guru" class="relative py-24 overflow-hidden bg-cover bg-center bg-fixed bg-no-repeat"
        style="background-image: linear-gradient(to bottom, rgba(255, 237, 213, 0.88), rgba(255, 237, 213, 0.88)){{ $bgImageUrl ? ", url('" . $bgImageUrl . "')" : "" }};">

        {{-- Decorative Elements --}}
        <div class="absolute top-20 left-10 text-4xl opacity-30 animate-floating" style="animation-delay: 0s;">🌟</div>
        <div class="absolute bottom-20 right-10 text-5xl opacity-20 animate-floating" style="animation-delay: 1.5s;">🎨</div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">GURU & TENAGA PENDIDIK</h2>
            </div>

            {{-- Carousel wrapper --}}
            <div class="relative overflow-hidden" id="guruCarouselWrapper">

                <div id="guruCarouselTrack" class="flex gap-4 transition-transform duration-700 ease-in-out">
                    @php
                        $displayTeachers = [];
                        if (isset($teachers) && !$teachers->isEmpty()) {
                            foreach ($teachers as $item) {
                                if ($item->teacher) {
                                    $displayTeachers[] = [
                                        'name'  => $item->teacher->full_name,
                                        'position' => $item->jabatan ?: ($item->teacher->position ? $item->teacher->position->name : 'Tenaga Pendidik'),
                                        'photo' => $item->photo 
                                            ? (Str::startsWith($item->photo, 'http') ? $item->photo : asset('storage/' . $item->photo)) 
                                            : ($item->teacher->photo 
                                                ? (Str::startsWith($item->teacher->photo, 'http') ? $item->teacher->photo : asset('storage/' . $item->teacher->photo)) 
                                                : 'https://images.unsplash.com/photo-1546961342-ea5f62d7e57f?auto=format&fit=crop&w=400&q=80'),
                                    ];
                                }
                            }
                        }
                    @endphp
                    @if(!empty($displayTeachers))
                        @foreach ($displayTeachers as $idx => $g)
                        <div class="guru-card flex-shrink-0" style="width: calc(20% - 12.8px); min-width: 150px;">
                            <div class="rounded-2xl overflow-hidden shadow-md bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-xl" style="border:1px solid rgba(249,115,22,0.12);">
                                {{-- Photo --}}
                                <div style="aspect-ratio:3/4; overflow:hidden; position:relative;">
                                    <img src="{{ $g['photo'] }}" alt="{{ $g['name'] }}"
                                        style="width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease;">
                                    {{-- Gradient overlay bottom --}}
                                    <div style="position:absolute; inset:0; background: linear-gradient(to top, rgba(234,88,12,0.85) 0%, transparent 55%);"></div>
                                    {{-- Name on photo --}}
                                    <div style="position:absolute; bottom:0; left:0; right:0; padding:0.6rem 0.75rem;">
                                        <p style="font-size:0.7rem; font-weight:800; color:white; line-height:1.2; text-shadow: 0 1px 3px rgba(0,0,0,0.4);">{{ $g['name'] }}</p>
                                    </div>
                                </div>
                                {{-- Bottom bar --}}
                                <div style="padding:0.5rem 0.75rem; display:flex; align-items:center; gap:0.4rem; background:white;">
                                    <div style="width:6px; height:6px; border-radius:50%; background:#f97316; flex-shrink:0;"></div>
                                    <span style="font-size:0.65rem; color:#64748b; font-weight:600;">{{ $g['position'] }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>


    {{-- ════════════════════════════════════════════
         EKSTRAKURIKULER
         ════════════════════════════════════════════ --}}
    <section id="ekstrakurikuler" class="py-24 relative bg-white overflow-hidden">



        {{-- Decorative Elements --}}
        <div class="absolute top-1/4 right-1/4 text-4xl opacity-20 animate-floating" style="animation-delay: 0.5s;">⚽</div>
        <div class="absolute bottom-1/4 left-10 text-5xl opacity-20 animate-floating" style="animation-delay: 2s;">🎶</div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">EKSTRAKURIKULER</h2>

            </div>
            <div class="w-full">
                @php
                    $displayEkskuls = [];
                    if (isset($ekskuls) && !$ekskuls->isEmpty()) {
                        foreach ($ekskuls as $ekskul) {
                            $displayEkskuls[] = [
                                'icon' => $ekskul->icon ? $ekskul->icon : 'activity',
                                'title' => $ekskul->title,
                                'img' => $ekskul->image ? (Str::startsWith($ekskul->image, 'http') ? $ekskul->image : asset('storage/' . $ekskul->image)) : 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80',
                                'desc' => $ekskul->description,
                            ];
                        }
                    }

                    // Partitioning into rows
                    $rowsCount = 2;
                    if (count($displayEkskuls) >= 9) {
                        $rowsCount = 3;
                    }

                    $rows = array_fill(0, $rowsCount, []);
                    foreach ($displayEkskuls as $idx => $e) {
                        $rows[$idx % $rowsCount][] = $e;
                    }

                    // Repeat rows for smooth scrolling
                    $repeatedRows = [];
                    foreach ($rows as $rIdx => $rowItems) {
                        if (empty($rowItems)) continue;
                        $baseRow = $rowItems;
                        while (count($baseRow) < 8) {
                            $baseRow = array_merge($baseRow, $rowItems);
                        }
                        $repeatedRows[$rIdx] = array_merge($baseRow, $baseRow);
                    }
                @endphp

                @if(!empty($repeatedRows))
                <style>
                    .marquee-wrapper {
                        mask-image: linear-gradient(to right, transparent, white 16px, white calc(100% - 16px), transparent);
                        -webkit-mask-image: linear-gradient(to right, transparent, white 16px, white calc(100% - 16px), transparent);
                    }
                    
                    @keyframes marquee-to-left {
                        0% { transform: translateX(0); }
                        100% { transform: translateX(-50%); }
                    }
                    
                    @keyframes marquee-to-right {
                        0% { transform: translateX(-50%); }
                        100% { transform: translateX(0); }
                    }
                    
                    .animate-marquee-to-left {
                        animation: marquee-to-left 40s linear infinite;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        width: max-content !important;
                        flex-shrink: 0 !important;
                    }
                    
                    .animate-marquee-to-right {
                        animation: marquee-to-right 40s linear infinite;
                        display: flex !important;
                        flex-wrap: nowrap !important;
                        width: max-content !important;
                        flex-shrink: 0 !important;
                    }
                    
                    .ekskul-marquee-row:hover .animate-marquee-to-left,
                    .ekskul-marquee-row:hover .animate-marquee-to-right {
                        animation-play-state: paused;
                    }
                </style>

                <div class="w-full flex flex-col gap-6 relative z-10 marquee-wrapper overflow-hidden py-6">
                    @foreach($repeatedRows as $rIdx => $rowItems)
                        <div class="ekskul-marquee-row w-full overflow-hidden select-none">
                            <div class="flex flex-nowrap gap-6 {{ $rIdx % 2 == 0 ? 'animate-marquee-to-left' : 'animate-marquee-to-right' }}">
                                @foreach($rowItems as $e)
                                    <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 w-[260px] sm:w-[300px] h-[180px] sm:h-[210px] flex-shrink-0 hover:scale-105 cursor-pointer">
                                        <img src="{{ $e['img'] }}" alt="{{ $e['title'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 transition-opacity duration-300"
                                            style="background: linear-gradient(to top, rgba(2,44,34,0.92) 0%, rgba(2,44,34,0.28) 55%, transparent 100%);">
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
                                            <div class="w-8 h-8 rounded-lg mb-2 flex items-center justify-center bg-[#ea580c]/20 text-[#6ee7b7] border border-[#ea580c]/30">
                                                <i data-lucide="{{ $e['icon'] }}" class="w-3.5 h-3.5"></i>
                                            </div>
                                            <h3 class="font-bold text-white text-sm sm:text-base mb-1">{{ $e['title'] }}</h3>
                                            <p class="text-xs text-slate-300 leading-snug max-h-0 group-hover:max-h-16 overflow-hidden transition-all duration-500">
                                                {{ $e['desc'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         FASILITAS SECTION
         ════════════════════════════════════════════ --}}
    <section id="fasilitas" class="py-24 relative bg-slate-50 overflow-hidden">

        {{-- Decorative Elements --}}
        <div class="absolute top-20 right-10 text-5xl opacity-30 animate-floating" style="animation-delay: 1s;">🧩</div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-14 reveal">
                <h2 class="section-title">FASILITAS</h2>
            </div>

            @php
                $displayFacilities = [];
                if (isset($facilities) && !$facilities->isEmpty()) {
                    foreach ($facilities as $fac) {
                        $displayFacilities[] = [
                            'icon'  => $fac->icon ? $fac->icon : 'check-circle',
                            'title' => $fac->title,
                        ];
                    }
                }
                
                $colors = [
                    ['bg' => '#fefce8', 'icon' => '#eab308', 'border' => '#fef08a'], // Yellow
                    ['bg' => '#f0fdf4', 'icon' => '#22c55e', 'border' => '#bbf7d0'], // Green
                    ['bg' => '#eff6ff', 'icon' => '#3b82f6', 'border' => '#bfdbfe'], // Blue
                    ['bg' => '#fdf2f8', 'icon' => '#ec4899', 'border' => '#fbcfe8'], // Pink
                    ['bg' => '#faf5ff', 'icon' => '#a855f7', 'border' => '#e9d5ff'], // Purple
                    ['bg' => '#fff7ed', 'icon' => '#f97316', 'border' => '#fed7aa'], // Orange
                ];
            @endphp
            
            @if(!empty($displayFacilities))
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                @foreach ($displayFacilities as $idx => $f)
                    @php $c = $colors[$idx % count($colors)]; @endphp
                    <div class="reveal group" style="transition-delay: {{ ($idx % 5) * 70 }}ms;">
                        <div class="rounded-3xl p-5 md:p-6 text-center transition-all duration-400 ease-out transform group-hover:-translate-y-2 group-hover:shadow-xl bg-white h-full flex flex-col justify-center items-center"
                             style="border: 2px solid {{ $c['border'] }}; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                            
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl flex items-center justify-center mb-4 transition-all duration-500 group-hover:scale-110 group-hover:rotate-6"
                                 style="background: {{ $c['bg'] }}; color: {{ $c['icon'] }}; box-shadow: inset 0 -3px 0 rgba(0,0,0,0.05);">
                                <i data-lucide="{{ $f['icon'] }}" class="w-8 h-8 md:w-10 md:h-10"></i>
                            </div>
                            
                            <h3 class="font-extrabold text-slate-700 text-sm md:text-[15px] leading-tight">{{ $f['title'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PRESTASI SECTION — Photo cards
         ════════════════════════════════════════════ --}}
    <section id="prestasi" class="py-20 relative bg-white overflow-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="text-center mb-14 reveal">
                <h2 class="section-title">PRESTASI</h2>
            </div>

            @php
                $displayAchievements = [];
                if (isset($achievements) && !$achievements->isEmpty()) {
                    foreach ($achievements as $ach) {
                        $personPhoto = null;
                        $personName  = null;
                        
                        if ($ach->student) {
                            $personName  = $ach->student->full_name;
                            $personPhoto = $ach->student->photo
                                ? (Str::startsWith($ach->student->photo, 'http') ? $ach->student->photo : asset('storage/' . $ach->student->photo))
                                : null;
                        } elseif ($ach->teacher) {
                            $personName  = $ach->teacher->full_name;
                            $personPhoto = $ach->teacher->photo
                                ? (Str::startsWith($ach->teacher->photo, 'http') ? $ach->teacher->photo : asset('storage/' . $ach->teacher->photo))
                                : null;
                        }

                        $displayAchievements[] = [
                            'year'         => $ach->year,
                            'title'        => $ach->title,
                            'desc'         => $ach->description,
                            'level'        => $ach->level,
                            'studentName'  => $personName,
                            'studentPhoto' => $personPhoto,
                        ];
                    }
                }

                $lvlColor = [
                    'Internasional' => ['bg'=>'#fee2e2', 'text'=>'#dc2626'],
                    'Nasional'      => ['bg'=>'#ffedd5', 'text'=>'#ea580c'],
                    'Provinsi'      => ['bg'=>'#dbeafe', 'text'=>'#2563eb'],
                    'Kabupaten'     => ['bg'=>'#fef9c3', 'text'=>'#ca8a04'],
                    'Kecamatan'     => ['bg'=>'#f1f5f9', 'text'=>'#475569'],
                ];
            @endphp

            @if(!empty($displayAchievements))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($displayAchievements as $idx => $p)
                @php
                    $lc = $lvlColor[$p['level']] ?? $lvlColor['Kecamatan'];
                @endphp
                <div class="reveal group" style="transition-delay: {{ ($idx % 4) * 80 }}ms;">
                    <div class="rounded-2xl overflow-hidden bg-white shadow-md hover:shadow-xl transition-all duration-400 hover:-translate-y-2"
                        style="border:1px solid rgba(249,115,22,0.10);">

                        {{-- Photo area --}}
                        <div style="position:relative; aspect-ratio:4/3; overflow:hidden; background:#ffedd5;">
                            @if($p['studentPhoto'])
                                <img src="{{ $p['studentPhoto'] }}" alt="{{ $p['studentName'] }}"
                                    style="width:100%; height:100%; object-fit:cover; object-position:top; transition:transform 0.5s;">
                                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);"></div>
                            @else
                                {{-- Placeholder bila tidak ada foto --}}
                                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                                    <div style="width:72px; height:72px; border-radius:50%; background:rgba(249,115,22,0.15); display:flex; align-items:center; justify-content:center;">
                                        <i data-lucide="trophy" style="width:32px; height:32px; color:#f97316;"></i>
                                    </div>
                                </div>
                            @endif

                            {{-- Level badge top-left --}}
                            <span style="position:absolute; top:0.6rem; left:0.6rem; font-size:0.6rem; font-weight:800; padding:0.2rem 0.6rem; border-radius:999px;
                                background:{{ $lc['bg'] }}; color:{{ $lc['text'] }}; letter-spacing:0.05em; text-transform:uppercase;">
                                {{ $p['level'] }}
                            </span>

                            {{-- Year badge top-right --}}
                            <span style="position:absolute; top:0.6rem; right:0.6rem; font-size:0.6rem; font-weight:700; padding:0.2rem 0.55rem; border-radius:999px;
                                background:rgba(255,255,255,0.9); color:#f97316; border:1px solid rgba(249,115,22,0.2);">
                                {{ $p['year'] }}
                            </span>

                            {{-- Student name on photo bottom --}}
                            @if($p['studentName'])
                            <div style="position:absolute; bottom:0; left:0; right:0; padding:0.5rem 0.75rem;">
                                <p style="font-size:0.72rem; font-weight:700; color:white; text-shadow:0 1px 3px rgba(0,0,0,0.5); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $p['studentName'] }}
                                </p>
                            </div>
                            @endif
                        </div>

                        {{-- Info area --}}
                        <div style="padding:0.85rem 1rem;">
                            <div style="display:flex; align-items:flex-start; gap:0.5rem;">
                                <div style="width:28px; height:28px; border-radius:8px; flex-shrink:0; display:flex; align-items:center; justify-content:center; margin-top:2px;
                                    background:linear-gradient(135deg,#f97316,#ea580c);">
                                    <i data-lucide="trophy" style="width:13px; height:13px; color:white;"></i>
                                </div>
                                <div>
                                    <h3 style="font-size:0.78rem; font-weight:700; color:#1e293b; line-height:1.35; margin-bottom:0.35rem;">{{ $p['title'] }}</h3>
                                    @if($p['desc'])
                                    <p style="font-size:0.68rem; color:#64748b; line-height:1.55;">{{ Str::limit($p['desc'], 80) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    @push('scripts')
        <script>
            /* ── Reveal observer ── */
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    } else if (entry.target.classList.contains('reveal-repeat')) {
                        entry.target.classList.remove('visible');
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -50px 0px' });
            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

            /* ── Guru Carousel ── */
            (function() {
                const track = document.getElementById('guruCarouselTrack');
                if (!track) return;

                let cards = track.querySelectorAll('.guru-card');
                if (cards.length === 0) return;

                const originalCount = cards.length;
                
                // Clone cards to create an infinite loop effect
                // We clone them twice to be safe and ensure there's always enough items to fill the screen
                for(let i=0; i < 2; i++) {
                    cards.forEach(card => {
                        let clone = card.cloneNode(true);
                        track.appendChild(clone);
                    });
                }

                let current = 0;
                let autoTimer = null;
                let isTransitioning = false;

                function getCardW() {
                    const card = track.querySelector('.guru-card');
                    return card ? card.offsetWidth + 16 : 0; // 16px is gap-4
                }

                function next() {
                    if (isTransitioning) return;
                    isTransitioning = true;
                    
                    const cardW = getCardW();
                    current++;
                    
                    track.style.transition = 'transform 0.7s ease-in-out';
                    track.style.transform = `translateX(-${current * cardW}px)`;

                    // Once transition finishes, if we reached the cloned set, snap back to start invisibly
                    setTimeout(() => {
                        if (current === originalCount) {
                            track.style.transition = 'none';
                            current = 0;
                            track.style.transform = `translateX(0px)`;
                            // Force reflow
                            void track.offsetWidth;
                        }
                        isTransitioning = false;
                    }, 700);
                }

                function startAuto() {
                    stopAuto();
                    autoTimer = setInterval(next, 2000);
                }
                function stopAuto()  { clearInterval(autoTimer); }

                // Pause on hover
                const wrapper = document.getElementById('guruCarouselWrapper');
                if (wrapper) {
                    wrapper.addEventListener('mouseenter', stopAuto);
                    wrapper.addEventListener('mouseleave', startAuto);
                }

                startAuto();
                if(typeof lucide !== 'undefined') lucide.createIcons();
            })();
        </script>
    @endpush

</div>
@endsection
