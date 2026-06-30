@extends('layouts.public')
@section('content')
    @vite(['resources/css/public-ppdb.css', 'resources/js/public-ppdb.js'])

    <div x-data="{ showPreview: false, previewUrl: '', previewTitle: '', isImage: false }" class="relative w-full">

    <section class="page-hero relative overflow-hidden flex items-center min-h-[320px] bg-[#001a33]">
        
        {{-- Background Image with Overlays --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1510531704581-5b28709e20eb?auto=format&fit=crop&q=80&w=1920" alt="Hero Background" class="w-full h-full object-cover opacity-30 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-r from-[#002244] via-[#002244]/95 to-[#002244]/60"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
        </div>

        {{-- Decorative Glows for Hero --}}
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden mix-blend-color-dodge">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-500/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-10 right-10 w-[30rem] h-[30rem] bg-emerald-500/20 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-8 pb-10">
            <div class="breadcrumb mb-6"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">PPDB</span></div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                {{-- Kiri: Teks & CTA --}}
                <div class="text-left reveal reveal-left delay-100">
                    <h1 class="text-3xl sm:text-5xl font-black text-white leading-tight mb-4">
                        {{ $hero && $hero->title ? $hero->title : 'Penerimaan Peserta Didik Baru' }}
                    </h1>
                    <p class="text-slate-100/80 text-base sm:text-lg mb-6 max-w-lg">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : "Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik, berkarakter mulia, dan berprestasi." }}
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $hero && $hero->button_link && $hero->button_link !== '#informasi' ? $hero->button_link : '#timeline' }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-400 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="info" class="w-4 h-4"></i> {{ $hero && $hero->button_text ? $hero->button_text : 'Lihat Informasi' }}
                        </a>
                        <a href="#kontak" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="phone" class="w-4 h-4"></i> Hubungi Panitia
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                @if($hero && !empty($hero->image))
                <div class="hidden lg:block relative reveal reveal-right delay-200" id="hero-image-container">
                    <div class="w-full aspect-[16/9] rounded-[24px] overflow-hidden border-4 border-white/10 shadow-2xl relative group bg-slate-900/40 flex items-center justify-center">
                        
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>

                        <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}" 
                             alt="Kegiatan Belajar" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700"
                             onerror="document.getElementById('hero-image-container').style.display='none';">
                        
                        <div class="absolute inset-0 bg-[#002244]/20 pointer-events-none z-10 transition-opacity duration-500 group-hover:opacity-50"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    @include('components.public.ppdb-subnav')

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== TIMELINE PENDAFTARAN (DIPINDAH KE SINI) ===== --}}
    <section id="timeline" class="public-section py-16 bg-white scroll-mt-32">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto relative z-10 text-[#002244] after:hidden">Timeline Pendaftaran</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-emerald-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            @php
                $displayTimeline = [];
                if (isset($timeline) && !$timeline->isEmpty()) {
                    foreach ($timeline as $t) {
                        $displayTimeline[] = [
                            'judul'      => $t->title,
                            'card_title' => $t->card_title ?: $t->title, // Fallback to title
                            'desc'       => $t->description,
                            'tanggal'    => $t->date_range,
                            'status'     => $t->status,
                        ];
                    }
                }
            @endphp
            @if(!empty($displayTimeline))

            <div class="timeline-wrapper">
                {{-- Garis background --}}
                <div class="timeline-line"></div>
                {{-- Garis progress berwarna --}}
                <div class="timeline-progress"></div>

                @foreach($displayTimeline as $i => $j)
                @php
                    $revealClass = $i % 2 === 0 ? 'reveal-left' : 'reveal-right';
                    $delay = 'delay-' . (($i % 4) + 1) * 100;
                @endphp
                <div class="timeline-item-container reveal reveal-repeat {{ $revealClass }} {{ $delay }}">
                    <div class="timeline-node"></div>
                    
                    {{-- Sisi Teks Floating (Desktop) --}}
                    <div class="timeline-opposite hidden md:flex flex-col justify-center">
                        <h3 class="text-lg md:text-xl font-bold text-[#002244] mb-1">{{ $j['judul'] }}</h3>
                        @if(!empty($j['desc']))
                        <p class="text-sm text-slate-500">{{ $j['desc'] }}</p>
                        @endif
                    </div>

                    {{-- Sisi Card --}}
                    <div class="timeline-content !p-0 overflow-hidden shadow-sm border border-slate-200 flex flex-col">
                        <div class="bg-[#1e3a8a] text-white px-5 py-3 text-sm font-bold tracking-wide">
                            {{ strtoupper($j['tanggal']) }}
                        </div>
                        <div class="p-5 bg-white flex-grow">
                            <h3 class="text-base md:text-lg font-bold text-slate-800">{{ $j['card_title'] ?? $j['judul'] }}</h3>
                            
                            @if(!empty($j['status']))
                            <div class="mt-4">
                                @if(strtolower($j['status']) === 'dibuka')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-[#003f88]">🟢 {{ $j['status'] }}</span>
                                @elseif(strtolower($j['status']) === 'selesai')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">✓ {{ $j['status'] }}</span>
                                @elseif(strtolower($j['status']) === 'segera')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">⏳ {{ $j['status'] }}</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-[#003f88]">🔵 {{ $j['status'] }}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== ALUR PENDAFTARAN ===== --}}
    <section id="alur" class="public-section py-20 bg-gradient-to-r from-[#002244]/95 via-[#002244]/80 to-transparent backdrop-blur-sm relative overflow-hidden scroll-mt-32">
        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-10 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title light mx-auto relative z-10 after:hidden">Langkah Mudah Mendaftar</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0 opacity-100" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>
            @php
                $displayAlur = [];
                if (isset($steps) && !$steps->isEmpty()) {
                    foreach ($steps as $step) {
                        $displayAlur[] = [
                            'no' => $step->step_number,
                            'icon' => $step->icon ? $step->icon : 'file-edit',
                            'judul' => $step->title,
                            'desc' => $step->description,
                        ];
                    }
                }
            @endphp
            @if(!empty($displayAlur))
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-8 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-white/30 before:to-transparent">
                @foreach($displayAlur as $i => $step)
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group reveal reveal-repeat reveal-up delay-{{ ($i % 5 + 1) * 100 }}">
                    
                    {{-- Icon Badge --}}
                    <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-[#003f88] border-[3px] border-amber-400 text-white font-black text-xl shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 group-hover:scale-110 group-hover:bg-[#002244] shadow-lg shadow-black/20 transition-all duration-300 z-10">
                        {{ $step['no'] }}
                    </div>
                    
                    {{-- Card --}}
                    <div class="w-[calc(100%-5.5rem)] md:w-[calc(50%-3rem)] bg-white/95 backdrop-blur-sm p-6 rounded-3xl shadow-xl shadow-black/10 border border-white/20 group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:shadow-black/20 transition-all duration-300">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 text-amber-600 flex items-center justify-center shrink-0">
                                <i data-lucide="{{ $step['icon'] }}" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-base md:text-lg font-extrabold text-[#002244]">{{ $step['judul'] }}</h3>
                        </div>
                        <p class="text-xs md:text-sm text-slate-600 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    {{-- DIVIDER --}}

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== BROSUR PPDB ===== --}}
    <section id="brosur" class="py-16 bg-slate-50 scroll-mt-32">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-12 flex flex-col items-center relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto reveal reveal-zoom mb-2 relative z-10 text-[#002244] after:hidden" style="transition-delay: 150ms;">Download Brosur Lengkap</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-amber-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-wrap justify-start gap-3 sm:gap-6">
                @php
                    $displayBrosurs = [];
                    if (isset($brochures) && !$brochures->isEmpty()) {
                        foreach ($brochures as $i => $brochure) {
                            $reveals = ['reveal-left', 'reveal-up', 'reveal-zoom', 'reveal-right'];
                            $fileUrl = Str::startsWith($brochure->file_path, 'http') ? $brochure->file_path : asset('storage/' . $brochure->file_path);
                            $ext = strtolower(pathinfo($brochure->file_path, PATHINFO_EXTENSION));
                            $displayBrosurs[] = [
                                'title' => $brochure->title,
                                'desc' => $brochure->description,
                                'file' => $fileUrl,
                                'is_image' => in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg']),
                                'delay' => 'delay-' . (($i % 4) + 1) * 100,
                                'reveal' => $reveals[$i % 4],
                            ];
                        }
                    }
                @endphp
                @if(!empty($displayBrosurs))
                @foreach($displayBrosurs as $brosur)
                <div class="w-[calc(50%-6px)] sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] relative bg-white rounded-[20px] sm:rounded-[24px] p-4 sm:p-6 md:p-8 shadow-xl shadow-slate-200/40 border border-slate-100 hover:shadow-2xl hover:shadow-slate-300/60 hover:-translate-y-3 transition-all duration-500 flex flex-col h-full group premium-card reveal {{ $brosur['reveal'] }} {{ $brosur['delay'] }} overflow-hidden">
                    {{-- Decorative Background Elements --}}
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-gradient-to-br from-amber-100/50 to-transparent rounded-full blur-2xl group-hover:bg-amber-200/50 transition-colors duration-500 z-0"></div>
                    <div class="absolute -left-8 -bottom-8 w-32 h-32 bg-gradient-to-tr from-blue-100/50 to-transparent rounded-full blur-2xl group-hover:bg-blue-200/50 transition-colors duration-500 z-0"></div>
                    
                    {{-- Glowing Top Border --}}
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#003f88] via-emerald-400 to-amber-400 opacity-80 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

                    <div class="relative z-10 flex-grow flex flex-col">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 md:w-14 md:h-14 rounded-xl sm:rounded-2xl bg-gradient-to-br from-amber-50 to-orange-50 text-amber-600 flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 group-hover:rotate-3 group-hover:shadow-lg group-hover:shadow-amber-200/50 transition-all duration-500 border border-amber-100 shrink-0">
                            <i data-lucide="file-text" class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7"></i>
                        </div>
                        
                        <h3 class="text-base sm:text-lg md:text-xl font-extrabold text-[#002244] mb-2 group-hover:text-[#003f88] transition-colors duration-300">{{ $brosur['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-6 flex-grow group-hover:text-slate-600 transition-colors duration-300">{{ $brosur['desc'] }}</p>
                        
                        <div class="flex flex-col sm:flex-row gap-2 mt-auto">
                            <a href="{{ $brosur['file'] }}" download class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl bg-gradient-to-r from-[#003f88] to-[#002244] text-white font-bold text-xs sm:text-sm shadow-md shadow-[#003f88]/20 hover:shadow-lg hover:shadow-[#003f88]/40 hover:-translate-y-0.5 transition-all duration-300">
                                <i data-lucide="download" class="w-4 h-4 shrink-0"></i> Unduh
                            </a>
                            <a href="#" 
                               @click.prevent="previewUrl = '{{ $brosur['file'] }}'; previewTitle = '{{ addslashes($brosur['title']) }}'; isImage = {{ $brosur['is_image'] ? 'true' : 'false' }}; showPreview = true; $nextTick(() => { if(typeof lucide !== 'undefined') lucide.createIcons(); })" 
                               class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-[#003f88] font-bold text-xs sm:text-sm hover:bg-white hover:border-[#003f88]/30 hover:shadow-sm hover:text-[#002244] transition-all duration-300">
                                <i data-lucide="eye" class="w-4 h-4 shrink-0"></i> Pratinjau
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            {{-- CTA --}}
            <div class="text-center mt-16 pt-10 border-t border-slate-100 reveal reveal-up delay-500">
                <p class="text-slate-500 mb-4">Masih ada pertanyaan atau butuh bantuan pendaftaran?</p>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282286204878' }}" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-[#003f88] text-white font-bold shadow-lg shadow-[#003f88]/20 hover:-translate-y-1 hover:shadow-xl hover:bg-[#002244] transition-all duration-300">
                    <i data-lucide="message-circle" class="w-5 h-5"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>


    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== FAQ ===== --}}
    <section id="faq" class="public-section py-20 relative overflow-hidden scroll-mt-32 bg-white">
        {{-- Section-specific Pattern Parallax Background --}}
        <div class="absolute inset-0 bg-fixed bg-center bg-repeat z-0 opacity-100" style="background-image: url('{{ asset('images/faq-pattern.svg') }}'); background-size: 200px;"></div>
        {{-- Light Parallax Overlay --}}
        <div class="absolute inset-0 bg-white/75 z-0"></div>
        {{-- Dekorasi background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-40 pointer-events-none z-0"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-100 rounded-full blur-3xl opacity-40 pointer-events-none z-0"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-16 flex flex-col items-center relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto faq-title transition-all duration-700 ease-out text-3xl md:text-4xl font-extrabold text-[#002244] relative z-10 mb-2 after:hidden" style="opacity: 0; transform: scale(0.92) translateY(15px); transition-delay: 150ms;">Pertanyaan yang Sering Diajukan</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-amber-400 z-0 opacity-80" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="space-y-4 faq-container">
                @php
                    $displayFaqs = [];
                    if (isset($faqs) && !$faqs->isEmpty()) {
                        foreach ($faqs as $faq) {
                            $displayFaqs[] = [
                                'q' => $faq->question,
                                'a' => $faq->answer,
                            ];
                        }
                    }
                @endphp
                @if(!empty($displayFaqs))

                @foreach($displayFaqs as $i => $faq)
                @php
                    $translateClass = $i % 2 === 0 ? '-translate-x-4' : 'translate-x-4';
                    $delay = 400 + ($i * 100);
                @endphp
                <div class="faq-item-interactive bg-white border border-slate-100 rounded-3xl p-6 md:p-8 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-500 ease-out hover:-translate-y-1 hover:border-[#003f88]/20 hover:shadow-xl hover:shadow-[#003f88]/5 group relative overflow-hidden" 
                     style="transition-delay: {{ $delay }}ms;"
                     onclick="toggleInteractiveFaq(this)">
                    
                    {{-- Active Indicator Line --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-amber-400 opacity-0 transition-opacity duration-300 faq-active-indicator"></div>

                    <div class="flex items-start gap-4 md:gap-6 relative z-10">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-2xl bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-[#003f88] group-hover:text-white group-hover:border-[#003f88] group-hover:shadow-lg group-hover:shadow-[#003f88]/20 transition-all duration-300 faq-icon-box">
                            <span class="text-base md:text-lg font-black">{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-grow pt-1.5 w-full">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-base md:text-lg font-bold text-slate-800 group-hover:text-[#003f88] transition-colors leading-snug pr-4">{{ $faq['q'] }}</h3>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-100 transition-colors faq-chevron-wrapper">
                                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400 group-hover:text-amber-600 transition-transform duration-300 faq-chevron-icon"></i>
                                </div>
                            </div>
                            <div class="faq-answer-interactive grid transition-all duration-500 ease-in-out opacity-0" style="grid-template-rows: 0fr;">
                                <div class="overflow-hidden">
                                    <p class="text-sm md:text-base text-slate-600 leading-relaxed pt-5 pb-2 pr-8 border-t border-slate-100 mt-5">
                                        {{ $faq['a'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <style>
        /* Custom styles for FAQ interactive */
        .faq-item-interactive.is-active {
            border-color: #ffc629; /* amber-400 */
            background-color: #ffffff; 
            box-shadow: 0 16px 40px -10px rgba(0, 34, 68, 0.1), 0 8px 16px -6px rgba(0, 34, 68, 0.05);
        }
        
        .faq-item-interactive.is-active .faq-active-indicator {
            opacity: 1;
        }

        .faq-item-interactive.is-active .faq-icon-box {
            background-color: #003f88;
            color: white;
            border-color: #003f88;
            box-shadow: 0 4px 14px rgba(0, 63, 136, 0.2);
        }

        .faq-item-interactive.is-active h3 {
            color: #002244; 
        }

        .faq-item-interactive.is-active .faq-chevron-wrapper {
            background-color: #fef3c7; /* amber-100 */
        }
        
        .faq-item-interactive.is-active .faq-chevron-icon {
            transform: rotate(180deg);
            color: #d97706; /* amber-600 */
        }

        .faq-item-interactive.is-active .faq-answer-interactive {
            grid-template-rows: 1fr !important;
            opacity: 1;
        }

        /* Animation visible states */
        .faq-badge.is-visible { opacity: 1 !important; transform: scale(1) translateY(0) !important; transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1) !important; }
        .faq-title.is-visible { opacity: 1 !important; transform: scale(1) translateY(0) !important; }
        .faq-divider.is-visible { opacity: 1 !important; transform: scaleX(1) !important; }
        .faq-subtitle.is-visible { opacity: 1 !important; transform: translateY(0) !important; }
        .faq-item-interactive.is-visible { opacity: 1; transform: translateX(0) translateY(0); }

        /* Animation exit states */
        .faq-badge.is-hidden { opacity: 0 !important; transform: scale(0.9) translateY(-10px) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-title.is-hidden { opacity: 0 !important; transform: scale(0.96) translateY(-15px) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-divider.is-hidden { opacity: 0 !important; transform: scaleX(0) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-subtitle.is-hidden { opacity: 0 !important; transform: translateY(-20px) !important; transition-duration: 1s !important; transition-delay: 0ms !important; }
    </style>

    <script>
        // Toggle FAQ Accordion
        function toggleInteractiveFaq(clickedItem) {
            const isActive = clickedItem.classList.contains('is-active');
            
            // Auto close others
            document.querySelectorAll('.faq-item-interactive').forEach(item => {
                item.classList.remove('is-active');
            });

            // If it wasn't active before, open it
            if (!isActive) {
                clickedItem.classList.add('is-active');
            }
        }

        // Intersection Observer for FAQ animations
        document.addEventListener('DOMContentLoaded', () => {
            const faqSection = document.getElementById('faq');
            if (!faqSection) return;

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const faqObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    const badge = entry.target.querySelector('.faq-badge');
                    const title = entry.target.querySelector('.faq-title');
                    const divider = entry.target.querySelector('.faq-divider');
                    const subtitle = entry.target.querySelector('.faq-subtitle');
                    const items = entry.target.querySelectorAll('.faq-item-interactive');

                    if (entry.isIntersecting) {
                        // Animate in
                        if(badge) { badge.classList.add('is-visible'); badge.classList.remove('is-hidden'); }
                        if(title) { title.classList.add('is-visible'); title.classList.remove('is-hidden'); }
                        if(divider) { divider.classList.add('is-visible'); divider.classList.remove('is-hidden'); }
                        if(subtitle) { subtitle.classList.add('is-visible'); subtitle.classList.remove('is-hidden'); }
                        
                        items.forEach(item => {
                            if(!item.classList.contains('is-visible')) {
                                item.classList.add('is-visible');
                                // Reset transition delay after animation so hover effect is snappy
                                setTimeout(() => {
                                    item.style.transitionDelay = '0ms';
                                }, parseInt(item.style.transitionDelay || 0) + 700);
                            }
                        });
                        
                    } else {
                        // Animate out (header elements only)
                        if(badge) { badge.classList.remove('is-visible'); badge.classList.add('is-hidden'); }
                        if(title) { title.classList.remove('is-visible'); title.classList.add('is-hidden'); }
                        if(divider) { divider.classList.remove('is-visible'); divider.classList.add('is-hidden'); }
                        if(subtitle) { subtitle.classList.remove('is-visible'); subtitle.classList.add('is-hidden'); }
                    }
                });
            }, observerOptions);

            faqObserver.observe(faqSection);
        });
    </script>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== LOKASI SEKOLAH (MAPS) & HUBUNGI KAMI ===== --}}
    <section id="kontak" class="py-20 bg-slate-50 relative overflow-hidden scroll-mt-32">
        {{-- Decorative background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-12 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto relative z-10 text-[#002244] after:hidden">Kontak & Lokasi</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-emerald-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                {{-- INFO & MAPS --}}
                <div class="lg:col-span-6 flex flex-col gap-6 reveal reveal-left delay-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-[#003f88] flex items-center justify-center mb-3">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-[#003f88] mb-1">Alamat</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                {!! nl2br(e($settings['address'] ?? "Karasak, Jorong Pasar Baru,\nCupak, Gunung Talang, Solok")) !!}
                            </p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-[#003f88] mb-1">Telepon / WA</h3>
                            <p class="text-xs text-slate-500">{{ $settings['phone'] ?? '+62 822-8620-4878' }}</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-[#003f88] mb-1">Email</h3>
                            <p class="text-xs text-slate-500">{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center mb-3">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-[#003f88] mb-1">Jam Layanan</h3>
                            <p class="text-xs text-slate-500">{!! nl2br(e($settings['operational_hours'] ?? "Senin – Jum'at: 08.00 – 14.00 WIB")) !!}</p>
                        </div>
                    </div>
                    
                    {{-- Google Maps Frame --}}
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-lg flex-1" style="min-height: 280px;">
                        <iframe
                            src="{{ $settings['maps_embed'] ?? "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31914.641419208794!2d100.598466!3d-0.8962703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1780587530868!5m2!1sid!2sid" }}"
                            width="100%"
                            height="100%"
                            style="border:0; display:block;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi SIT Mutiara Qur'an Nagari Cupak">
                        </iframe>
                    </div>
                </div>

                {{-- FORMULIR KONTAK --}}
                <div class="lg:col-span-6 bg-white p-8 rounded-3xl border border-slate-200/60 shadow-lg flex flex-col justify-between reveal reveal-right delay-200 premium-card">
                    <div>
                        <h3 class="text-xl font-extrabold text-[#003f88] mb-6">Formulir Kontak</h3>
                        <form id="contactForm" class="space-y-4" onsubmit="sendToWhatsApp(event)">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" id="contactName" class="contact-input" placeholder="Masukkan nama lengkap Anda" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                                <input type="email" id="contactEmail" class="contact-input" placeholder="contoh@email.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subjek</label>
                                <input type="text" id="contactSubject" class="contact-input" placeholder="Perihal pesan Anda" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pesan</label>
                                <textarea id="contactMessage" class="contact-input" rows="4" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-500/30 hover:-translate-y-1 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-300">
                                <i class="fab fa-whatsapp text-lg"></i> Kirim via WhatsApp
                            </button>
                        </form>

                        <script>
                            function sendToWhatsApp(e) {
                                e.preventDefault();
                                
                                const name = document.getElementById('contactName').value;
                                const email = document.getElementById('contactEmail').value || '-';
                                const subject = document.getElementById('contactSubject').value;
                                const message = document.getElementById('contactMessage').value;
                                
                                const waText = `Halo Admin SIT Mutiara Qur'an, saya ingin bertanya tentang PPDB.\n\n*Nama:* ${name}\n*Email:* ${email}\n*Subjek:* ${subject}\n*Pesan:*\n${message}`;
                                
                                // Bersihkan nomor WA jika ada karakter selain angka
                                let waNumber = "{{ $settings['whatsapp_number'] ?? '6282286204878' }}";
                                waNumber = waNumber.replace(/\D/g, '');
                                if(waNumber.startsWith('0')) waNumber = '62' + waNumber.slice(1);
                                
                                const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(waText)}`;
                                window.open(waUrl, '_blank');
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PDF Preview Modal --}}
    <div x-show="showPreview" 
         class="fixed inset-0 z-[999] flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showPreview = false"></div>
        
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-100 w-full max-w-4xl h-[70vh] md:h-[85vh] relative z-10 flex flex-col transform transition-all duration-300"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4">
            
            <div class="px-4 py-3.5 md:px-6 md:py-4 bg-[#F8FAFC] border-b border-slate-100 flex justify-between items-center shrink-0">
                <h4 class="font-extrabold text-[#002244] text-base md:text-lg line-clamp-1" x-text="previewTitle">Pratinjau Dokumen</h4>
                <button @click="showPreview = false" class="w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-red-500 hover:border-red-100 hover:bg-red-50 smooth-transition shadow-sm">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <div class="flex-grow bg-slate-50 p-2 md:p-4 flex items-center justify-center relative overflow-hidden">
                <template x-if="isImage">
                    <img :src="previewUrl" class="max-h-full max-w-full object-contain rounded-2xl border border-slate-200 shadow-sm bg-white" />
                </template>
                <template x-if="!isImage">
                    <iframe :src="previewUrl" class="w-full h-full rounded-2xl border border-slate-200 shadow-inner bg-white" frameborder="0"></iframe>
                </template>
            </div>
            
            <div class="px-4 py-3 md:px-6 md:py-4 bg-[#F8FAFC] border-t border-slate-100 flex justify-end gap-2.5 shrink-0">
                <a :href="previewUrl" download class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-[#003f88] to-[#002244] text-white font-bold text-sm shadow-md hover:shadow-lg smooth-transition">
                    <i data-lucide="download" class="w-4 h-4"></i> Unduh
                </a>
                <button @click="showPreview = false" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-bold text-sm hover:bg-slate-50 smooth-transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
