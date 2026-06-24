@if ($hero)
{{-- HERO --}}
    <section class="hero-section relative overflow-hidden flex items-center min-h-[500px] md:min-h-[600px] lg:min-h-[calc(100vh-72px)] xl:min-h-[720px]">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        <div class="glow-blue top-20 left-10"></div>
        <div class="glow-amber bottom-20 right-10"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-16 pb-24 md:pt-20 lg:pt-12 lg:pb-32 xl:pt-16 xl:pb-40">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 xl:gap-16 items-center">
                {{-- Center Text --}}
                <div class="lg:col-span-12 max-w-4xl mx-auto text-center flex flex-col items-center">



                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-tight tracking-tight reveal reveal-up">
                        {!! str_replace("Qur'an", '<span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-400 to-amber-300">Qur\'an</span>', e($hero->title)) !!}
                    </h1>

                    <p class="mt-2 lg:mt-4 text-sm sm:text-base lg:text-lg text-slate-100/80 leading-relaxed max-w-2xl mx-auto reveal reveal-up">
                        {{ $hero->subtitle }}
                    </p>

                    <div class="flex flex-wrap justify-center gap-3 lg:gap-4 mt-4 lg:mt-6 reveal reveal-up">
                        @if ($hero->button_text)
                        <a href="{{ $hero->button_link ?? '#' }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 rounded-xl lg:rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 text-slate-950 font-extrabold text-xs lg:text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="file-text" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            {{ $hero->button_text }}
                        </a>
                        @endif
                        @if ($hero->button_secondary_text)
                        <a href="{{ $hero->button_secondary_link ?? '#' }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 rounded-xl lg:rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-xs lg:text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="building-2" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            {{ $hero->button_secondary_text }}
                        </a>
                        @endif
                    </div>
                </div>



            </div>
        </div>

        <!-- Animated Wave Divider (Bottom of Hero) -->
        <div class="absolute -bottom-[1px] left-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none">
            <svg class="relative block w-[200%] h-[80px] sm:h-[120px] md:h-[160px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 160" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="heroWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#002244" />
                        <stop offset="100%" stop-color="#002244" />
                    </linearGradient>
                </defs>
                <!-- Back wave (Soft Yellow Accent) -->
                <path class="anim-wave-back" d="M0,65 Q150,120 300,65 T600,65 Q750,120 900,65 T1200,65 V160 H0 Z" fill="#ffaa00" opacity="0.4"></path>
                <!-- Middle wave (Green/Teal Transparent) -->
                <path class="anim-wave-mid" d="M0,75 Q150,15 300,75 T600,75 Q750,15 900,75 T1200,75 V160 H0 Z" fill="url(#heroWaveGradient)" opacity="0.95"></path>
                <!-- Front wave (Solid White) -->
                <path class="anim-wave-front" d="M0,90 Q150,30 300,90 T600,90 Q750,30 900,90 T1200,90 V160 H0 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>
@endif

