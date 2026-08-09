@extends('layouts.unit')

@section('navbar')
    <x-public.unit-navbar unitLogo="images/smp.jpeg" unitName="SMP Islam Terpadu" textTheme="dark" />
@endsection

@section('footer')
    <x-public.unit-footer unitName="SMP Islam Terpadu" />
@endsection

@section('content')
<div class="theme-smp">
    <style>
        :root {
            --unit-accent: #3b82f6;
            --unit-accent-lt: #93c5fd;
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
            background: rgba(37, 99, 235, 0.10);
            border: 1px solid rgba(37, 99, 235, 0.22);
            color: #2563eb;
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
            background: rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.3);
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
            border-color: #3b82f6;
            box-shadow: 0 6px 24px rgba(37, 99, 235, 0.10);
            transform: translateY(-3px);
        }

        .unit-curriculum-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(37, 99, 235, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #3b82f6;
            transition: background 0.3s;
        }

        .unit-curriculum-card:hover .unit-curriculum-icon {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
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
            border-color: #93c5fd;
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
            color: #3b82f6;
        }

        /* ── Timeline dot ─────────────────────────── */
        .unit-timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3b82f6;
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
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
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-16px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-floating {
            animation: float 6s ease-in-out infinite;
        }

        /* ── Timeline line ────────────────────────── */
        .tl-line {
            background: linear-gradient(to bottom, #60a5fa, #3b82f6, #2563eb);
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

            0%,
            100% {
                box-shadow: 0 0 0 3px rgba(37, 99, 235, .28), 0 0 10px rgba(37, 99, 235, .22);
            }

            50% {
                box-shadow: 0 0 0 5px rgba(37, 99, 235, .15), 0 0 18px rgba(37, 99, 235, .40);
            }
        }

        @keyframes waveTranslateX {
            0% { transform: translateX(0); }
            100% { transform: translateX(-25%); }
        }
        .anim-wave-front {
            animation: waveTranslateX 8s ease-in-out infinite alternate;
        }
        .anim-wave-mid {
            animation: waveTranslateX 6s ease-in-out infinite alternate;
        }
        .anim-wave-back {
            animation: waveTranslateX 14s ease-in-out infinite alternate;
        }
    </style>

    {{-- Custom Styles for SMP Hero (aligned with TK) --}}
    <style>
        .smp-hero {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 40%, #f0fdfa 70%, #bae6fd 100%);
            position: relative;
            overflow: hidden;
            min-height: auto;
            display: flex;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .smp-hero {
                min-height: 80vh;
            }
        }

        /* Decorative blobs */
        .smp-hero-blob-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            background: rgba(14, 165, 233, 0.05);
            top: -120px;
            right: -100px;
            animation: smpBlobMorph 12s ease-in-out infinite;
        }
        .smp-hero-blob-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            background: rgba(14, 165, 233, 0.03);
            bottom: -80px;
            left: -60px;
            animation: smpBlobMorph 15s ease-in-out infinite reverse;
        }
        @keyframes smpBlobMorph {
            0%   { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50%  { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
            100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        }

        /* Image wrapper */
        .smp-hero-img-wrap {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin-left: auto;
            padding: 20px 30px 30px 10px;
        }

        /* Large organic blob behind */
        .smp-hero-img-blob {
            position: absolute;
            width: 78%;
            height: 85%;
            bottom: 8px;
            right: 8px;
            z-index: 0;
            background: #bae6fd;
            border-radius: 62% 38% 54% 46% / 44% 56% 44% 56%;
            animation: smpBlobFloat 16s ease-in-out infinite;
        }
        /* Extra small accent blob */
        .smp-hero-img-blob2 {
            position: absolute;
            width: 140px;
            height: 140px;
            top: 10px;
            left: -10px;
            z-index: 0;
            background: #e0f2fe;
            border-radius: 62% 38% 46% 54% / 56% 44% 56% 44%;
            animation: smpBlobFloat 12s ease-in-out infinite reverse;
        }
        @keyframes smpBlobFloat {
            0%   { border-radius: 62% 38% 46% 54% / 60% 44% 56% 40%; }
            33%  { border-radius: 48% 52% 58% 42% / 42% 58% 42% 58%; }
            66%  { border-radius: 54% 46% 38% 62% / 56% 40% 60% 44%; }
            100% { border-radius: 62% 38% 46% 54% / 60% 44% 56% 40%; }
        }

        /* Photo frame */
        .smp-hero-img-frame {
            position: relative;
            z-index: 2;
            border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            animation: smpFrameMorph 14s ease-in-out infinite;
            background: rgba(255, 255, 255, 0.4);
        }
        @keyframes smpFrameMorph {
            0%   { border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%; }
            33%  { border-radius: 44% 56% 56% 44% / 52% 44% 56% 48%; }
            66%  { border-radius: 56% 44% 48% 52% / 44% 52% 48% 56%; }
            100% { border-radius: 52% 48% 42% 58% / 48% 56% 44% 52%; }
        }
        .smp-hero-img-frame img {
            width: 100%;
            display: block;
            aspect-ratio: 4/3;
            object-fit: contain;
        }

        /* Leaves decoration */
        .smp-hero-leaves {
            position: absolute;
            top: -10px;
            left: -5px;
            z-index: 5;
            pointer-events: none;
        }
        .smp-hero-leaves .leaf-1 {
            width: 52px;
            height: auto;
            transform: rotate(-45deg) translateX(4px);
            margin-bottom: -14px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        .smp-hero-leaves .leaf-2 {
            width: 42px;
            height: auto;
            transform: rotate(-5deg) translateX(22px);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.08));
        }

        /* Badge stamp */
        .smp-hero-badge {
            position: absolute;
            right: 10px;
            bottom: 10px;
            width: 110px;
            height: 110px;
            z-index: 10;
        }
        @media (max-width: 1024px) {
            .smp-hero-badge { display: none; }
        }
        .smp-hero-badge-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #fdfcff;
            box-shadow: 0 8px 28px rgba(0,0,0,0.08), 0 0 0 4px rgba(14,165,233,0.06);
            border: 2px solid rgba(14, 165, 233, 0.18);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .smp-hero-badge-inner .badge-icon {
            font-size: 1.5rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }
        .smp-hero-badge-inner svg.badge-text-svg {
            position: absolute;
            inset: 6px;
            width: calc(100% - 12px);
            height: calc(100% - 12px);
        }
        .smp-hero-badge-inner svg.badge-text-svg text {
            fill: #0284c7;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        /* Breadcrumb style */
        .smp-hero-breadcrumb a {
            color: #0284c7;
            opacity: 0.8;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }
        .smp-hero-breadcrumb a:hover {
            color: #0369a1;
            opacity: 1;
        }
        .smp-hero-breadcrumb .separator {
            color: #cbd5e1;
        }
        .smp-hero-breadcrumb .current {
            color: #0284c7;
            font-weight: 700;
        }

        /* Title & Subtitle */
        .smp-hero-title {
            font-size: clamp(2.2rem, 4.5vw, 3.5rem);
            font-weight: 900;
            color: #002244;
            line-height: 1.1;
            letter-spacing: -0.02em;
            margin-bottom: 0.85rem;
        }
        .smp-hero-subtitle {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.75;
            max-width: 480px;
            margin-bottom: 1.5rem;
        }

        /* Buttons */
        .smp-hero-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.25);
            transition: all 0.3s;
            text-decoration: none;
        }
        .smp-hero-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.35);
        }
        .smp-hero-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            background: transparent;
            color: #0284c7;
            font-weight: 700;
            font-size: 0.85rem;
            border: 2px solid #7dd3fc;
            transition: all 0.3s;
            text-decoration: none;
        }
        .smp-hero-btn-secondary:hover {
            background: rgba(14, 165, 233, 0.05);
            border-color: #0ea5e9;
            transform: translateY(-2px);
        }
    </style>

    <section id="home" class="smp-hero">
        {{-- Background decorations --}}
        <div class="smp-hero-blob-1"></div>
        <div class="smp-hero-blob-2"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-10 lg:pt-24 lg:pb-12 xl:pt-28 xl:pb-16 w-full">
            {{-- Breadcrumb --}}
            <div class="smp-hero-breadcrumb flex items-center gap-3 mb-4 lg:mb-6 text-[0.95rem] reveal reveal-left">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span class="separator">/</span>
                <span class="current">SMP Islam Terpadu</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Left text --}}
                <div class="reveal reveal-left">
                    <h1 class="smp-hero-title">
                        @if($hero && $hero->title)
                            {{ $hero->title }}
                        @else
                            SMP Islam<br>Terpadu
                        @endif
                    </h1>

                    <p class="smp-hero-subtitle">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : 'Membangun generasi remaja yang unggul secara akademik, berkarakter islami kuat, dan siap menghadapi tantangan era global.' }}
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil' }}" class="smp-hero-btn-primary">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Deskripsi Umum' }}
                        </a>
                        <a href="{{ $hero && $hero->button_secondary_link ? $hero->button_secondary_link : '#prestasi' }}" class="smp-hero-btn-secondary">
                            <i data-lucide="star" class="w-4 h-4"></i>
                            {{ $hero && $hero->button_secondary_text ? $hero->button_secondary_text : 'Lihat Prestasi' }}
                        </a>
                    </div>
                </div>

                {{-- Right image --}}
                <div class="relative hidden lg:block reveal reveal-right">
                    <div class="smp-hero-img-wrap">
                        {{-- Small accent blob top-left --}}
                        <div class="smp-hero-img-blob2"></div>

                        {{-- Large organic blob bottom-right --}}
                        <div class="smp-hero-img-blob"></div>

                        {{-- Leaves top-left --}}
                        <div class="smp-hero-leaves">
                            <svg class="leaf leaf-1" viewBox="0 0 40 60" fill="#0ea5e9" opacity="0.8"><path d="M20 2C20 2 2 16 2 34c0 10 8 16 18 16s18-6 18-16C38 16 20 2 20 2zm0 42c-1.5 0-3-1-3-2.5 0-5 3-13 3-13s3 8 3 13c0 1.5-1.5 2.5-3 2.5z"/></svg>
                            <svg class="leaf leaf-2" viewBox="0 0 40 60" fill="#7dd3fc" opacity="0.6"><path d="M20 2C20 2 2 16 2 34c0 10 8 16 18 16s18-6 18-16C38 16 20 2 20 2zm0 42c-1.5 0-3-1-3-2.5 0-5 3-13 3-13s3 8 3 13c0 1.5-1.5 2.5-3 2.5z"/></svg>
                        </div>

                        {{-- Main image --}}
                        <div class="smp-hero-img-frame">
                            <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : asset('images/smp_dummy.png') }}"
                                alt="SMP Islam Terpadu SIT Mutiara Qur'an">
                        </div>

                        {{-- Badge bottom-right --}}
                        <div class="smp-hero-badge">
                            <div class="smp-hero-badge-inner">
                                <span class="badge-icon">🎓</span>
                                <svg class="badge-text-svg" viewBox="0 0 120 120">
                                    <defs>
                                        <path id="smpTopArc" d="M 16,60 A 44,44 0 0,1 104,60" />
                                        <path id="smpBottomArc" d="M 104,68 A 44,44 0 0,1 16,68" />
                                    </defs>
                                    <text>
                                        <textPath href="#smpTopArc" startOffset="50%" text-anchor="middle">
                                            Unggul Akademik
                                        </textPath>
                                    </text>
                                    <text>
                                        <textPath href="#smpBottomArc" startOffset="50%" text-anchor="middle">
                                            Karakter Islami
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
            $studentCount = 55;
            $teacherCount = 7;
            $classCount = 3;
        }

        $statisticBg = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        $bgImageUrl = ($statisticBg && $statisticBg->value) ? (str_starts_with($statisticBg->value, 'http') ? $statisticBg->value : Storage::url($statisticBg->value)) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80';
    @endphp
    <section class="relative py-16 md:py-20 z-20 bg-gradient-to-b from-[#bae6fd] via-blue-50/10 to-white border-b border-slate-100 overflow-hidden">
        @if($bgImageUrl)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-[0.10] mix-blend-multiply" style="background-image: url('{{ $bgImageUrl }}');"></div>
        @endif

        <!-- Top Fade Overlay (Blends Hero light color into statistics) -->
        <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-[#bae6fd] to-transparent pointer-events-none z-10"></div>

        <!-- Bottom Fade Overlay -->
        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-white to-transparent pointer-events-none z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10 max-w-6xl mx-auto">
                {{-- Siswa Aktif --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-blue-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-600 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="users" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $studentCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Siswa Aktif</p>
                </div>

                {{-- Tenaga Pendidik --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 100ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-blue-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-600 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="graduation-cap" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $teacherCount }}" data-suffix="+">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tenaga Pendidik</p>
                </div>

                {{-- Rombel Kelas --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 200ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-blue-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-600 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="door-closed" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="{{ $classCount }}" data-suffix="">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Rombel Kelas</p>
                </div>

                {{-- Tahun Berdiri --}}
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: 300ms;">
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-blue-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-600 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="building" class="w-6 h-6 md:w-7 md:h-7 stroke-[1.5]"></i>
                        </div>
                    </div>
                    <p class="text-2xl md:text-4xl font-black text-[#002244] mb-1 tracking-tight stat-number" data-count="8" data-suffix=" Tahun">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-xs sm:text-sm md:text-base">+ Tahun Berdiri</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PROFIL SECTION
         ════════════════════════════════════════════ --}}
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">DESKRIPSI SMP</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="reveal reveal-left p-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl transform -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                        <div class="relative bg-white rounded-2xl shadow-lg p-8 border border-slate-100 flex items-center justify-center min-h-[300px]">
                            <img src="{{ $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : (file_exists(public_path('storage/' . $detail->description_logo)) ? asset('storage/' . $detail->description_logo) : asset($detail->description_logo))) : asset('images/logomq.jpg') }}" alt="Logo SIT"
                                class="w-40 h-40 object-contain animate-floating">
                        </div>
                    </div>
                </div>

                <div class="reveal reveal-right">
                    <h3 class="text-xl font-bold text-slate-800 mb-5">{{ $detail && $detail->description_title ? $detail->description_title : 'Pendidikan Menengah Berkualitas & Berkarakter' }}</h3>
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
         GURU SECTION
         ════════════════════════════════════════════ --}}
    @php
        $statisticBg = \App\Models\CmsSetting::where('key', 'statistic_bg_image')->first();
        $bgImageUrl = ($statisticBg && $statisticBg->value) ? (str_starts_with($statisticBg->value, 'http') ? $statisticBg->value : Storage::url($statisticBg->value)) : 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1920&q=80';
    @endphp
    <section id="guru" class="relative py-20 overflow-hidden bg-cover bg-center bg-fixed bg-no-repeat" style="background-image: linear-gradient(to bottom, rgba(224, 242, 254, 0.88), rgba(224, 242, 254, 0.88)){{ $bgImageUrl ? ", url('" . $bgImageUrl . "')" : "" }};">
        <div class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white to-transparent pointer-events-none z-0"></div>
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-white to-transparent pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal">
                <h2 class="section-title">GURU & TENAGA PENDIDIK</h2>

            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $displayTeachers = [];
                    if (isset($teachers) && !$teachers->isEmpty()) {
                        foreach ($teachers as $item) {
                            if ($item->teacher) {
                                $displayTeachers[] = [
                                    'name' => $item->teacher->full_name,
                                    'position' => $item->jabatan ?: ($item->teacher->position ? $item->teacher->position->name : 'Guru/Staf'),
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
                    <div class="unit-teacher-card reveal" style="transition-delay: {{ $idx * 70 }}ms">
                        <div class="unit-teacher-photo">
                            <img src="{{ $g['photo'] }}" alt="{{ $g['name'] }}">
                        </div>
                        <div class="unit-teacher-info">
                            <h3>{{ $g['name'] }}</h3>
                            <p class="text-[10px] text-slate-500 font-bold mt-1 uppercase tracking-wider">{{ $g['position'] }}</p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         EKSTRAKURIKULER
         ════════════════════════════════════════════ --}}
    <section id="ekstrakurikuler" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         FASILITAS SECTION
         ════════════════════════════════════════════ --}}
    <section id="fasilitas" class="py-20 bg-slate-50 border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="section-title">FASILITAS</h2>
                <p class="unit-section-desc">Fasilitas penunjang kegiatan belajar mengajar yang lengkap dan memadai untuk mendukung tumbuh kembang siswa.</p>
            </div>

            @php
                $displayFacilities = [];
                if (isset($facilities) && !$facilities->isEmpty()) {
                    foreach ($facilities as $fac) {
                        $displayFacilities[] = [
                            'icon' => $fac->icon ? $fac->icon : 'check',
                            'title' => $fac->title,
                        ];
                    }
                }
                if (empty($displayFacilities)) {
                    $displayFacilities = [
                        ['icon' => 'monitor',     'title' => 'Ruang Kelas Nyaman'],
                        ['icon' => 'laptop',      'title' => 'Laboratorium Komputer'],
                        ['icon' => 'library',     'title' => 'Perpustakaan'],
                        ['icon' => 'moon',        'title' => 'Musholla Luas'],
                        ['icon' => 'activity',    'title' => 'Lapangan Olahraga'],
                        ['icon' => 'stethoscope', 'title' => 'Klinik / UKS'],
                        ['icon' => 'coffee',      'title' => 'Kantin Sehat'],
                        ['icon' => 'shield-check', 'title' => 'Keamanan CCTV'],
                    ];
                }
            @endphp
            @if(!empty($displayFacilities))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto reveal reveal-up">
                @foreach ($displayFacilities as $idx => $f)
                    @php
                        $iconName = is_array($f) ? $f['icon'] : $f[0];
                        $titleText = is_array($f) ? $f['title'] : $f[1];
                    @endphp
                    <div class="group flex items-center gap-4 bg-white hover:bg-slate-50 border border-slate-200/60 rounded-full p-2.5 pr-6 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md hover:border-blue-200" style="transition-delay: {{ $idx * 50 }}ms;">
                        <div class="w-12 h-12 rounded-full bg-white border-2 border-blue-600 flex items-center justify-center text-blue-600 shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105">
                            <i data-lucide="{{ $iconName }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-sm font-bold uppercase tracking-wider text-slate-700">{{ $titleText }}</span>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- ════════════════════════════════════════════
         PRESTASI SECTION — satu section, timeline modern
         ════════════════════════════════════════════ --}}
    <section id="prestasi" class="py-20 bg-white overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14 reveal">
                <h2 class="section-title">PRESTASI</h2>

            </div>

            <div class="relative tl-container">

                {{-- Vertical line --}}
                <div class="tl-line absolute top-0 bottom-0 w-px left-[10px] md:left-1/2 md:-translate-x-px"></div>

                @php
                    $displayAchievements = [];
                    if (isset($achievements) && !$achievements->isEmpty()) {
                        foreach ($achievements as $ach) {
                            $displayAchievements[] = [
                                'year' => $ach->year,
                                'title' => $ach->title,
                                'desc' => $ach->description,
                                'level' => $ach->level,
                                'side' => $ach->side ? $ach->side : 'left',
                            ];
                        }
                    }

                    $lvlStyle = [
                        'Internasional' => 'background:rgba(220,38,38,.10);  color:#dc2626;',
                        'Nasional'      => 'background:rgba(249,115,22,.10); color:#ea580c;',
                        'Provinsi'      => 'background:rgba(59,130,246,.10); color:#2563eb;',
                        'Kabupaten'     => 'background:rgba(37, 99, 235,.10); color:#2563eb;',
                        'Kecamatan'     => 'background:rgba(100,116,139,.10);color:#475569;',
                    ];
                @endphp
                @if(!empty($displayAchievements))

                @foreach ($displayAchievements as $idx => $p)
                    @php
                        $isLeft = $p['side'] === 'left';
                        $delay  = $idx * 120;
                        $ls     = $lvlStyle[$p['level']] ?? $lvlStyle['Kecamatan'];
                    @endphp

                    <div class="relative flex items-start mb-9 last:mb-0 reveal reveal-repeat pl-8 md:pl-0 {{ $isLeft ? 'md:flex-row' : 'md:flex-row-reverse' }}"
                        style="transition-delay: {{ $delay }}ms;">

                        {{-- Card --}}
                        <div class="w-full md:w-[calc(50%-28px)] {{ $isLeft ? 'md:pr-8' : 'md:pl-8' }}">
                            <div class="tl-card group bg-white border border-slate-100 rounded-[20px] p-5
                                        shadow-sm transition-all duration-300 ease-out
                                        hover:-translate-y-1 hover:shadow-lg hover:border-blue-300">

                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-bold rounded-full"
                                        style="background:rgba(37, 99, 235,.10); color:#2563eb;">
                                        {{ $p['year'] }}
                                    </span>
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full"
                                        style="{{ $ls }}">
                                        {{ $p['level'] }}
                                    </span>
                                </div>

                                <div class="flex items-start gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5"
                                        style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
                                        <i data-lucide="trophy" class="w-4 h-4 text-white"></i>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-800 leading-snug">{{ $p['title'] }}</h3>
                                </div>

                                <p class="text-xs text-slate-500 leading-relaxed pl-11">{{ $p['desc'] }}</p>
                            </div>
                        </div>

                        {{-- Dot --}}
                        <div class="tl-dot-wrap absolute left-[10px] md:left-1/2 -translate-x-1/2 flex items-center justify-center z-10"
                            style="top: 1.1rem;">
                            <span
                                class="tl-dot-glow absolute w-7 h-7 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                style="background:rgba(37, 99, 235,.15);"></span>
                            <span class="tl-dot relative w-[14px] h-[14px] rounded-full border-[2.5px] border-white"
                                style="background: linear-gradient(135deg,#60a5fa,#2563eb);
                                       box-shadow: 0 0 0 3px rgba(37, 99, 235,.28), 0 0 10px rgba(37, 99, 235,.25);">
                            </span>
                        </div>

                        {{-- Spacer --}}
                        <div class="hidden md:block md:w-[calc(50%-28px)]"></div>
                    </div>
                @endforeach
                @endif

            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            /* ── Reveal: masuk saat scroll turun, KELUAR saat scroll naik ── */
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    } else if (entry.target.classList.contains('reveal-repeat')) {
                        entry.target.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -50px 0px'
            });

            document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

            /* ── Timeline line grow/shrink ── */
            const tlLine = document.querySelector('.tl-line');
            if (tlLine) {
                new IntersectionObserver(([e]) => {
                    if (e.isIntersecting) {
                        tlLine.classList.add('visible');
                    } else {
                        tlLine.classList.remove('visible');
                    }
                }, {
                    threshold: 0.05
                }).observe(tlLine);
            }
        </script>
    @endpush
</div>
@endsection
