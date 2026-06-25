@extends('layouts.public')

@section('content')
    {{-- HERO SECTION --}}
    @vite(['resources/css/public-ppdb.css', 'resources/js/public-ppdb.js'])
    <section class="page-hero relative overflow-hidden flex items-center min-h-[320px] bg-[#001a33]">
        
        {{-- Background Image with Overlays --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510531704581-5b28709e20eb?auto=format&fit=crop&q=80&w=1920" alt="Hero Background" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            {{-- Dark gradient to ensure text readability --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#002244] via-[#002244]/95 to-[#002244]/60"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        </div>

        {{-- Decorative Glows for Hero --}}
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden mix-blend-color-dodge">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-500/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 right-10 w-[30rem] h-[30rem] bg-emerald-500/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-8 pb-10">
            <div class="breadcrumb mb-6"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span
                    class="current">Profil</span></div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                {{-- Kiri: Teks --}}
                <div class="text-left reveal reveal-left delay-100">
                    <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight mb-4">
                        {{ $hero && $hero->title ? $hero->title : "Profil SIT Mutiara Qur'an" }}
                    </h1>
                    <p class="text-slate-100/80 text-base sm:text-lg mb-6 max-w-lg">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : "Membangun generasi Qur'ani yang berkarakter, berprestasi, dan berwawasan global." }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#profil-singkat' }}"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-400 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Jelajahi Profil' }}
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                @if($hero && !empty($hero->image))
                <div class="hidden lg:block relative reveal reveal-right delay-200" id="hero-image-container">
                    <div class="w-full aspect-[16/9] rounded-[24px] overflow-hidden border-4 border-white/10 shadow-2xl relative group">
                        
                        {{-- Inner Glow on Hover --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>

                        <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}"
                            alt="Hero Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                            onerror="document.getElementById('hero-image-container').style.display='none';">
                        
                        <div class="absolute inset-0 bg-[#002244]/20 pointer-events-none z-10 transition-opacity duration-500 group-hover:opacity-50"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    @include('components.public.profil-subnav')

    {{-- SECTION PROFIL SINGKAT --}}
    <section id="profil-singkat" class="public-section py-20 scroll-mt-32 relative z-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto text-[#002244] relative z-10 after:hidden">Profil Singkat Sekolah</h2>
                    {{-- Hand-drawn style underline --}}
                    <svg class="absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center relative z-10">
                
                {{-- EXTRA HEBOH: Floating Decorations (Abstract & Playful) --}}
                {{-- Spinning Amber Blob --}}
                <div class="absolute -top-10 right-0 lg:right-10 w-24 h-24 bg-amber-400 opacity-20 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] animate-[spin_12s_linear_infinite]"></div>
                {{-- Pulsing Blue Circle --}}
                <div class="absolute bottom-10 lg:bottom-20 left-[45%] w-20 h-20 bg-blue-300 opacity-20 rounded-full animate-pulse" style="animation-duration: 3s;"></div>
                {{-- Bouncing Outlined Circle --}}
                <div class="absolute top-1/4 left-5 lg:left-10 w-10 h-10 border-4 border-amber-300 opacity-40 rounded-full animate-bounce" style="animation-duration: 4s;"></div>
                {{-- Floating Star/Cross --}}
                <div class="absolute bottom-1/4 right-5 lg:right-1/4 w-8 h-8 text-emerald-400 opacity-50 animate-[spin_6s_linear_infinite]">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0l2.5 9.5L24 12l-9.5 2.5L12 24l-2.5-9.5L0 12l9.5-2.5z"/></svg>
                </div>
                {{-- Floating Zigzag --}}
                <div class="absolute top-10 left-1/3 text-blue-400 opacity-30 animate-bounce" style="animation-duration: 5s;">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="5,20 15,10 25,30 35,20"></polyline></svg>
                </div>
                {{-- Floating Paper Airplane --}}
                <div class="absolute -top-5 right-1/4 text-blue-500 opacity-40 animate-[bounce_6s_infinite]">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transform -rotate-12"><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon><line x1="22" y1="2" x2="11" y2="13"></line></svg>
                </div>

                <div class="lg:col-span-5 reveal reveal-left delay-100 flex flex-col items-center">
                    {{-- Image Container with Blob Shape --}}
                    <div class="relative w-full max-w-[280px] sm:max-w-[340px] aspect-square flex justify-center items-center mx-auto group">
                        
                        {{-- Spinning Dashed Ring (New) --}}
                        <div class="absolute inset-0 transform scale-[1.25] animate-[spin_20s_linear_infinite] z-0">
                            <svg viewBox="0 0 100 100" class="w-full h-full text-amber-400 opacity-50">
                                <circle cx="50" cy="50" r="48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-dasharray="6 6" />
                            </svg>
                        </div>

                        {{-- Background Accent Blob 1 (Amber) --}}
                        <div class="absolute inset-0 bg-amber-400 transform scale-[1.1] translate-x-6 translate-y-6 group-hover:scale-[1.15] group-hover:translate-x-8 group-hover:translate-y-8 transition-all duration-500" style="border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;"></div>
                        
                        {{-- Background Accent Blob 2 (Blue) --}}
                        <div class="absolute inset-0 bg-[#003f88] transform scale-[1.05] -translate-x-6 -translate-y-4 group-hover:scale-[1.1] group-hover:-translate-x-8 group-hover:-translate-y-6 transition-all duration-500" style="border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;"></div>
                        
                        {{-- Main Image Blob --}}
                        <div class="relative w-full h-full overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.2)] border-4 border-white bg-slate-100 z-10 group-hover:scale-105 transition-all duration-500" style="border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;">
                            <img src="{{ $welcomeMessage && $welcomeMessage->kepsek_photo ? (str_starts_with($welcomeMessage->kepsek_photo, 'http') ? $welcomeMessage->kepsek_photo : asset('storage/' . $welcomeMessage->kepsek_photo)) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600' }}"
                                alt="Sambutan Kepala Sekolah" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                    </div>
                    
                    {{-- Name Tag (Directly on white) --}}
                    <div class="mt-10 relative text-center w-full max-w-[280px] sm:max-w-[320px] z-20">
                        <p class="text-xs font-bold text-amber-500 mb-1 tracking-wider uppercase">{{ $welcomeMessage && $welcomeMessage->kepsek_title ? $welcomeMessage->kepsek_title : 'Kepala Sekolah SIT Mutiara Qur\'an' }}</p>
                        <h4 class="text-lg sm:text-xl font-black text-[#002244]">{{ $welcomeMessage && $welcomeMessage->kepsek_name ? $welcomeMessage->kepsek_name : 'Ustadz Ahmad Fauzi, S.Pd.I, M.Pd' }}</h4>
                    </div>
                </div>

                <div class="lg:col-span-7 reveal reveal-right delay-200 z-10">
                    {{-- Text Content (Directly on white background) --}}
                    <div class="pr-0 lg:pr-8 relative">
                        {{-- Huge Decorative Quote Mark --}}
                        <div class="absolute -top-12 -left-8 text-[10rem] text-amber-300 opacity-20 font-serif leading-none select-none z-0">"</div>
                        
                        <div class="relative z-10">
                            <div class="inline-block bg-amber-100 text-amber-600 font-extrabold text-xs tracking-widest uppercase px-4 py-1.5 rounded-full mb-4">
                                Sambutan Hangat
                            </div>
                            <h3 class="font-black text-[#002244] text-3xl sm:text-4xl mb-8 leading-tight">Bismillahirrahmanirrahim,</h3>
                        
                            <div class="space-y-5 text-slate-600 leading-relaxed text-sm sm:text-base text-justify">
                                @if ($welcomeMessage && $welcomeMessage->paragraphs)
                                    @php
                                        $paragraphs = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                                    @endphp
                                    @foreach ($paragraphs ?? [] as $paragraph)
                                        <p>{!! $paragraph !!}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION VISI & MISI --}}
    <section id="visi-misi" class="public-section py-16 scroll-mt-32 relative overflow-hidden bg-transparent">
        
        {{-- Dark Overlay with Slight Blur to enhance the background image --}}
        <div class="absolute inset-0 bg-[#002244]/70 backdrop-blur-[2px] z-0"></div>
        
        {{-- Subtle Background Decorations --}}
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-amber-500/10 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 reveal reveal-up">
                <div class="inline-block relative">
                    <h2 class="section-title light mx-auto relative z-10 after:hidden">Arah & Tujuan Pendidikan</h2>
                </div>
            </div>

            <div class="w-full">
                
                {{-- Accordion --}}
                <div class="space-y-6 reveal reveal-up delay-100" x-data="{ open: 'visi' }">
                    
                    {{-- VISI --}}
                    <div class="bg-white/90 backdrop-blur-md rounded-[2.5rem] shadow-xl border border-white/50 overflow-hidden transition-all duration-500 hover:shadow-2xl relative group"
                         :class="open === 'visi' ? 'ring-4 ring-emerald-400/30 bg-white scale-[1.02] z-10' : 'hover:scale-[1.01]'">
                        
                        {{-- Decorative Blob Background (Only visible when open) --}}
                        <div x-show="open === 'visi'" x-transition.opacity.duration.700ms class="absolute top-0 right-0 w-40 h-40 bg-emerald-200/40 rounded-full blur-3xl -z-10 animate-pulse"></div>

                        <button @click="open = open === 'visi' ? null : 'visi'" class="w-full px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between bg-transparent transition-all group">
                            <div class="flex items-center gap-4 text-left">
                                <div class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 shadow-md"
                                     :class="open === 'visi' ? 'bg-emerald-500 text-white scale-110 rotate-3' : 'bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200'">
                                    <i class="fas fa-eye text-xl transition-transform duration-500" :class="open === 'visi' ? 'scale-110' : ''"></i>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold transition-colors duration-300 tracking-tight"
                                    :class="open === 'visi' ? 'text-emerald-700' : 'text-[#002244] group-hover:text-emerald-600'">
                                    Visi SIT Mutiara Qur'an
                                </h3>
                            </div>
                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500 shadow-sm ml-4"
                                 :class="open === 'visi' ? 'bg-emerald-100 text-emerald-600 rotate-180' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-500'">
                                <i class="fas fa-chevron-down text-lg"></i>
                            </div>
                        </button>
                        
                        <div x-show="open === 'visi'" x-collapse.duration.500ms>
                            <div class="px-5 pb-5 sm:px-6 sm:pb-6 pt-1">
                                <div class="w-full h-px bg-emerald-100/50 mb-5"></div>
                                <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-medium">
                                    {{ $visi && $visi->text ? $visi->text : "Menjadi lembaga pendidikan Islam terpadu yang unggul dalam membentuk generasi Qur'ani, berakhlak mulia, cerdas, dan berdaya saing global." }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- MISI --}}
                    <div class="bg-white/90 backdrop-blur-md rounded-[2.5rem] shadow-xl border border-white/50 overflow-hidden transition-all duration-500 hover:shadow-2xl relative group"
                         :class="open === 'misi' ? 'ring-4 ring-amber-400/30 bg-white scale-[1.02] z-10' : 'hover:scale-[1.01]'">
                        
                        {{-- Decorative Blob Background (Only visible when open) --}}
                        <div x-show="open === 'misi'" x-transition.opacity.duration.700ms class="absolute top-0 right-0 w-40 h-40 bg-amber-200/40 rounded-full blur-3xl -z-10 animate-pulse"></div>
                        
                        <button @click="open = open === 'misi' ? null : 'misi'" class="w-full px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between bg-transparent transition-all group">
                            <div class="flex items-center gap-4 text-left">
                                <div class="flex-shrink-0 w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 shadow-md"
                                     :class="open === 'misi' ? 'bg-amber-500 text-white scale-110 -rotate-3' : 'bg-amber-100 text-amber-600 group-hover:bg-amber-200'">
                                    <i class="fas fa-bullseye text-xl transition-transform duration-500" :class="open === 'misi' ? 'scale-110' : ''"></i>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold transition-colors duration-300 tracking-tight"
                                    :class="open === 'misi' ? 'text-amber-700' : 'text-[#002244] group-hover:text-amber-600'">
                                    Misi SIT Mutiara Qur'an
                                </h3>
                            </div>
                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-500 shadow-sm ml-4"
                                 :class="open === 'misi' ? 'bg-amber-100 text-amber-600 rotate-180' : 'bg-slate-100 text-slate-400 group-hover:bg-amber-50 group-hover:text-amber-500'">
                                <i class="fas fa-chevron-down text-lg"></i>
                            </div>
                        </button>
                        
                        <div x-show="open === 'misi'" x-collapse.duration.500ms>
                            <div class="px-5 pb-5 sm:px-6 sm:pb-6 pt-1">
                                <div class="w-full h-px bg-amber-100/50 mb-5"></div>
                                @php
                                    $displayMisi = [];
                                    if (isset($misiItems) && !$misiItems->isEmpty()) {
                                        foreach ($misiItems as $item) {
                                            $displayMisi[] = $item->text;
                                        }
                                    }
                                @endphp
                                @if(!empty($displayMisi))
                                <ol class="space-y-4">
                                    @foreach ($displayMisi as $index => $item)
                                        <li class="flex gap-4 items-start">
                                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-sm shadow-sm">
                                                {{ $index + 1 }}
                                            </span>
                                            <p class="text-slate-700 text-base leading-relaxed pt-1 font-medium">
                                                {{ $item }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ol>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION SEJARAH (Timeline) --}}
    <section id="sejarah" class="public-section py-24 scroll-mt-32 relative overflow-hidden bg-slate-50">
        
        {{-- Decorative Background Elements --}}
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            {{-- Glowing Orbs --}}
            <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-emerald-200/30 blur-[100px]"></div>
            <div class="absolute top-[40%] -left-[10%] w-[40%] h-[40%] rounded-full bg-amber-200/30 blur-[100px]"></div>
            <div class="absolute -bottom-[20%] right-[20%] w-[30%] h-[30%] rounded-full bg-blue-200/30 blur-[100px]"></div>
            
            {{-- Subtle Dotted Grid Pattern --}}
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at center, #94a3b8 1px, transparent 1px); background-size: 32px 32px; opacity: 0.2;"></div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal reveal-up">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto text-[#002244] relative z-10 after:hidden">Perjalanan Kami</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-emerald-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            @php
                $displaySejarah = [];
                if (isset($sejarahItems) && !$sejarahItems->isEmpty()) {
                    foreach ($sejarahItems as $item) {
                        $displaySejarah[] = [
                            'tahun' => $item->year,
                            'judul' => $item->title,
                            'desc' => $item->description
                        ];
                    }
                }
            @endphp

            @if(!empty($displaySejarah))
            <div class="ppdb-timeline">
                @foreach ($displaySejarah as $i => $s)
                    @php
                        $revealClass = $i % 2 === 0 ? 'reveal-left' : 'reveal-right';
                        $delay = 'delay-' . (($i % 4) + 1) * 100;
                    @endphp
                    <div class="ppdb-timeline-item reveal reveal-repeat {{ $revealClass }} {{ $delay }}">
                        <div class="ppdb-timeline-dot-wrapper">
                            <div class="ppdb-timeline-dot">
                                <i data-lucide="check" class="w-5 h-5 text-slate-600"></i>
                            </div>
                        </div>
                        <div class="ppdb-timeline-content">
                            <span class="ppdb-timeline-date-badge">{{ $s['tahun'] }}</span>
                            <h3>{{ $s['judul'] }}</h3>
                            <p>{{ $s['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- SECTION STRUKTUR ORGANISASI --}}
    <section id="struktur-organisasi" class="public-section py-24 scroll-mt-32 relative overflow-hidden bg-white">
        
        {{-- Decorative Background --}}
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="absolute -top-20 -left-20 w-72 h-72 bg-blue-50 rounded-full blur-3xl opacity-70"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-50 rounded-full blur-3xl opacity-70"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="mb-12 reveal reveal-up">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto text-[#002244] relative z-10 after:hidden">Struktur Organisasi</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-amber-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 reveal reveal-zoom delay-100 transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/50 group relative">
                
                @if(isset($strukturOrganisasi) && $strukturOrganisasi->value)
                    <img src="{{ str_starts_with($strukturOrganisasi->value, 'http') ? $strukturOrganisasi->value : asset('storage/' . $strukturOrganisasi->value) }}" alt="Struktur Organisasi"
                        class="w-full h-auto rounded-[1.5rem] group-hover:scale-[1.01] transition-transform duration-500 origin-center">
                @else
                    <img src="{{ asset('images/struktur.png') }}" alt="Struktur Organisasi Default"
                        class="w-full h-auto rounded-[1.5rem] group-hover:scale-[1.01] transition-transform duration-500 origin-center">
                @endif
            </div>
        </div>
    </section>
@endsection
