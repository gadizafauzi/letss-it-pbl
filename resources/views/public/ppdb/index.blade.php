@extends('layouts.public')
@section('content')
    @vite(['resources/css/public-ppdb.css', 'resources/js/public-ppdb.js'])

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
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#informasi' }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-amber-400 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
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
                    <div class="w-full aspect-[16/9] rounded-[24px] overflow-hidden border-4 border-white/10 shadow-2xl relative group">
                        
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none"></div>

                        <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}" 
                             alt="Kegiatan Belajar" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
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
    <section id="timeline" class="public-section py-10 bg-white scroll-mt-32">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-10 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto relative z-10 text-[#002244] after:hidden">Timeline Pendaftaran</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-amber-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            @php
                $displayTimeline = [];
                if (isset($timeline) && !$timeline->isEmpty()) {
                    foreach ($timeline as $t) {
                        $displayTimeline[] = [
                            'judul'   => $t->title,
                            'desc'    => $t->description,
                            'tanggal' => $t->date_range,
                            'status'  => $t->status,
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
                    <div class="timeline-content">
                        <span class="inline-block px-2 py-0.5 mb-2 rounded-full text-xs font-bold bg-slate-50 text-[#003f88] border border-slate-100">{{ strtoupper($j['tanggal']) }}</span>
                        <h3 class="text-base font-bold text-[#003f88] mb-1.5">{{ $j['judul'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-3">{{ $j['desc'] }}</p>
                        <div>
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
    <section id="alur" class="public-section py-12 bg-slate-50 relative overflow-hidden scroll-mt-32">
        {{-- Decorative background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            <div class="text-center mb-10 reveal reveal-up relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto relative z-10 text-[#002244] after:hidden">Langkah Mudah Mendaftar</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-emerald-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
                <p class="text-slate-500 mt-6 max-w-2xl mx-auto">Ikuti panduan ringkas berikut untuk mendaftarkan putra-putri Anda ke SIT Mutiara Qur'an.</p>
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
            <div class="space-y-6 relative before:absolute before:inset-0 before:ml-8 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                @foreach($displayAlur as $i => $step)
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group reveal reveal-repeat reveal-up delay-{{ ($i % 5 + 1) * 100 }}">
                    
                    {{-- Icon Badge --}}
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-white border border-slate-200 shadow-lg shadow-slate-200/50 text-[#003f88] font-black text-lg shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 group-hover:scale-110 group-hover:bg-[#003f88] group-hover:text-white transition-all duration-300 z-10">
                        {{ $step['no'] }}
                    </div>
                    
                    {{-- Card --}}
                    <div class="w-[calc(100%-4.5rem)] md:w-[calc(50%-2.5rem)] bg-white p-4 rounded-2xl shadow-md shadow-slate-200/40 border border-slate-100 group-hover:-translate-y-1 group-hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-2 mb-1.5">
                            <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                <i data-lucide="{{ $step['icon'] }}" class="w-3.5 h-3.5"></i>
                            </div>
                            <h3 class="text-base font-bold text-[#003f88]">{{ $step['judul'] }}</h3>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed pl-9">{{ $step['desc'] }}</p>
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
    <section id="brosur" class="public-section py-16 bg-white scroll-mt-32">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 flex flex-col items-center relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto reveal reveal-zoom mb-2 relative z-10 text-[#002244] after:hidden" style="transition-delay: 150ms;">Download Brosur Lengkap</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-amber-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
                        <path d="M5 15Q50 5 100 10T195 15" />
                    </svg>
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                @php
                    $displayBrosurs = [];
                    if (isset($brochures) && !$brochures->isEmpty()) {
                        foreach ($brochures as $i => $brochure) {
                            $reveals = ['reveal-left', 'reveal-up', 'reveal-zoom', 'reveal-right'];
                            $displayBrosurs[] = [
                                'title' => $brochure->title,
                                'desc' => $brochure->description,
                                'file' => Str::startsWith($brochure->file_path, 'http') ? $brochure->file_path : asset('storage/' . $brochure->file_path),
                                'delay' => 'delay-' . (($i % 4) + 1) * 100,
                                'reveal' => $reveals[$i % 4],
                            ];
                        }
                    }
                @endphp
                @if(!empty($displayBrosurs))
                @foreach($displayBrosurs as $brosur)
                <div class="w-full sm:w-[calc(50%-12px)] lg:w-[calc(25%-18px)] bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 flex flex-col h-full group premium-card reveal {{ $brosur['reveal'] }} {{ $brosur['delay'] }}">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-[#003f88] group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#003f88] mb-2">{{ $brosur['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">{{ $brosur['desc'] }}</p>
                    <div class="grid grid-cols-2 gap-2 mt-auto">
                        <a href="{{ $brosur['file'] }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1.5 px-2 py-2.5 rounded-xl border-2 border-slate-100 text-[#003f88] font-bold text-[11px] sm:text-xs hover:bg-slate-50 hover:border-slate-200 transition-all duration-300">
                            <i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat
                        </a>
                        <a href="{{ $brosur['file'] }}" download class="flex-1 inline-flex items-center justify-center gap-1.5 px-2 py-2.5 rounded-xl bg-slate-700 text-white font-bold text-[11px] sm:text-xs shadow-md shadow-slate-200 hover:bg-[#003f88] transition-all duration-300">
                            <i data-lucide="download" class="w-3.5 h-3.5"></i> Unduh
                        </a>
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
    <section id="faq" class="public-section py-20 bg-white relative overflow-hidden scroll-mt-32">
        {{-- Dekorasi background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-slate-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-3xl mx-auto relative z-10">
            <div class="text-center mb-16 flex flex-col items-center relative z-10">
                <div class="inline-block relative">
                    <h2 class="section-title mx-auto faq-title transition-all duration-700 ease-out text-3xl md:text-4xl font-extrabold text-[#002244] relative z-10 mb-2 after:hidden" style="opacity: 0; transform: scale(0.92) translateY(15px); transition-delay: 150ms;">Pertanyaan yang Sering Diajukan</h2>
                    {{-- Decorative Underline --}}
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-emerald-400 z-0 opacity-60" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="5" stroke-linecap="round">
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
                    // Alternate slide directions: left, right, left, right
                    $translateClass = $i % 2 === 0 ? '-translate-x-8' : 'translate-x-8';
                    $delay = 400 + ($i * 120); // 0.12s increments
                @endphp
                <div class="faq-item-interactive bg-white border border-slate-200 rounded-2xl p-5 md:p-6 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-700 ease-out hover:-translate-y-1 hover:border-slate-400 hover:bg-slate-50/30 hover:shadow-lg hover:shadow-slate-100/50 group" 
                     style="transition-delay: {{ $delay }}ms;"
                     onclick="toggleInteractiveFaq(this)">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-slate-100 group-hover:text-[#003f88] group-hover:border-slate-200 transition-colors faq-icon-box">
                            <span class="text-sm font-bold">{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-grow pt-1 w-full">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-base md:text-lg font-bold text-[#003f88] group-hover:text-[#003f88] transition-colors">{{ $faq['q'] }}</h3>
                                <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-slate-100 transition-colors faq-chevron-wrapper">
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-[#003f88] transition-transform duration-300 faq-chevron-icon"></i>
                                </div>
                            </div>
                            <div class="faq-answer-interactive grid transition-all duration-300 ease-in-out opacity-0" style="grid-template-rows: 0fr;">
                                <div class="overflow-hidden">
                                    <p class="text-sm md:text-base text-slate-600 leading-relaxed pt-4 pb-1 pr-8 border-t border-slate-100 mt-4">
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
            border-color: #fbbf24; /* amber-400 */
            background-color: #fffbeb; /* amber-50 */
            box-shadow: 0 10px 25px -5px rgba(0, 63, 136, 0.1), 0 8px 10px -6px rgba(0, 63, 136, 0.1);
            border-left: 4px solid #d97706; /* amber-600 */
        }
        
        .faq-item-interactive.is-active .faq-icon-box {
            background-color: #d97706; /* amber-600 */
            color: white;
            border-color: #d97706;
        }

        .faq-item-interactive.is-active h3 {
            color: #92400e; /* amber-800 */
        }

        .faq-item-interactive.is-active .faq-chevron-wrapper {
            background-color: #fde68a; /* amber-200 */
        }
        
        .faq-item-interactive.is-active .faq-chevron-icon {
            transform: rotate(180deg);
            color: #92400e; /* amber-800 */
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
    <section id="kontak" class="public-section py-20 bg-slate-50 relative overflow-hidden scroll-mt-32">
        {{-- Decorative background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="w-full max-w-7xl mx-auto relative z-10">
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
                        <form class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" class="contact-input" placeholder="Masukkan nama lengkap Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                                <input type="email" class="contact-input" placeholder="contoh@email.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subjek</label>
                                <input type="text" class="contact-input" placeholder="Perihal pesan Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pesan</label>
                                <textarea class="contact-input" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-slate-700 to-[#003f88] text-white font-bold text-sm shadow-lg shadow-slate-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                                <i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
