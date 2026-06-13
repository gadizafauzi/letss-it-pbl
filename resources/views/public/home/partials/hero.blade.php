{{-- HERO --}}
    <section class="hero-section relative overflow-hidden flex items-center min-h-[calc(100vh-72px)] xl:min-h-[720px]">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        <div class="glow-emerald top-20 left-10"></div>
        <div class="glow-amber bottom-20 right-10"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-10 pb-28 lg:pt-12 lg:pb-32 xl:pt-16 xl:pb-40">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 xl:gap-16 items-center">
                {{-- Left Text --}}
                <div class="lg:col-span-7 max-w-3xl text-left">

                    {{-- Accreditation stamp --}}
                    @if ($hero && $hero->badge_text)
                        @php
                            $badgeParts = explode(' - ', $hero->badge_text, 2);
                        @endphp
                        <div class="accreditation-stamp mb-4 lg:mb-6 reveal reveal-left">
                            <i data-lucide="shield-check" class="w-5 h-5 lg:w-6 lg:h-6"></i>
                            <div class="accreditation-text">
                                <h5 class="text-xs lg:text-sm">{{ $badgeParts[0] }}</h5>
                                <p class="text-[10px] lg:text-xs">{{ $badgeParts[1] ?? '' }}</p>
                            </div>
                        </div>
                    @else
                        <div class="accreditation-stamp mb-4 lg:mb-6 reveal reveal-left">
                            <i data-lucide="shield-check" class="w-5 h-5 lg:w-6 lg:h-6"></i>
                            <div class="accreditation-text">
                                <h5 class="text-xs lg:text-sm">Terakreditasi A</h5>
                                <p class="text-[10px] lg:text-xs">BAN-PDM PROVINSI SUMATERA BARAT</p>
                            </div>
                        </div>
                    @endif

                    <div class="inline-flex items-center gap-2 px-3 py-1.5 lg:px-4 lg:py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-xs lg:text-sm font-semibold mb-4 lg:mb-6 reveal reveal-right">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 lg:w-4 lg:h-4 text-amber-400"></i>
                        Sekolah Islam Terpadu (JSIT)
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-tight tracking-tight reveal reveal-up">
                        @if ($hero && $hero->title)
                            {!! str_replace("Qur'an", '<span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-amber-300">Qur\'an</span>', e($hero->title)) !!}
                        @else
                            Mendidik Generasi
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-amber-300">Qur'ani</span>
                            yang Berakhlak Mulia & Berprestasi
                        @endif
                    </h1>

                    <p class="mt-4 lg:mt-6 text-sm sm:text-base lg:text-lg text-emerald-100/80 leading-relaxed max-w-xl reveal reveal-up">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : "SIT Mutiara Qur'an hadir di Nagari Cupak untuk membentuk generasi robbani yang mandiri, berkarakter mulia, cerdas akademis, serta mencintai Al-Qur'an." }}
                    </p>

                    <div class="flex flex-wrap gap-3 lg:gap-4 mt-6 lg:mt-8 reveal reveal-up">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : route('public.ppdb.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 rounded-xl lg:rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-950 font-extrabold text-xs lg:text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="file-text" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            {{ $hero && $hero->button_text ? $hero->button_text : 'Daftar PPDB Online' }}
                        </a>
                        <a href="{{ $hero && $hero->button_secondary_link ? $hero->button_secondary_link : route('public.profil.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 rounded-xl lg:rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-xs lg:text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="building-2" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            {{ $hero && $hero->button_secondary_text ? $hero->button_secondary_text : 'Profil Sekolah' }}
                        </a>
                    </div>
                </div>

                {{-- Right Visual representation --}}
                <div class="lg:col-span-5 hidden lg:block reveal reveal-up">
                    <div class="relative max-w-sm xl:max-w-md mx-auto">
                        {{-- Decorative float card --}}
                        <div class="absolute -top-6 -left-8 z-20 bg-white/95 backdrop-blur-md p-3 lg:p-4 rounded-xl lg:rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-lg lg:rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                                <i data-lucide="award" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-[10px] lg:text-xs font-black text-slate-800">Target Hafalan Mapan</h6>
                                <p class="text-[9px] lg:text-[10px] text-slate-500">Up to 10 Juz Mutqin</p>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -right-6 z-20 bg-white/95 backdrop-blur-md p-3 lg:p-4 rounded-xl lg:rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 5s;">
                            <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-lg lg:rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <i data-lucide="users" class="w-4 h-4 lg:w-5 lg:h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-[10px] lg:text-xs font-black text-slate-800">Pembinaan Akhlak</h6>
                                <p class="text-[9px] lg:text-[10px] text-slate-500">Mentoring Harian & Mabit</p>
                            </div>
                        </div>

                        <div class="w-full aspect-square xl:aspect-[4/5] rounded-[24px] lg:rounded-[36px] bg-gradient-to-br from-emerald-800/80 to-emerald-950/80 border-4 border-white/10 shadow-2xl overflow-hidden relative">
                            <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : 'https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&q=80&w=800' }}" alt="Siswa SIT Mutiara Qur'an" class="w-full h-full object-cover mix-blend-overlay opacity-65">
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-transparent to-transparent"></div>

                            <div class="absolute bottom-6 left-6 right-6 lg:bottom-8 lg:left-8 lg:right-8 z-10 text-left">
                                <p class="text-[10px] lg:text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-1 lg:mb-2">Pendaftaran Sekolah</p>
                                <h3 class="text-sm lg:text-xl font-bold text-white leading-snug">Berikan Pendidikan Agama dan Akademis Terbaik Bagi Putra-Putri Anda</h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Animated Wave Divider (Bottom of Hero) -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-20 pointer-events-none">
            <svg class="relative block w-[200%] h-[80px] sm:h-[120px] md:h-[160px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 160" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="heroWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#0d9488" />
                        <stop offset="100%" stop-color="#059669" />
                    </linearGradient>
                </defs>
                <!-- Back wave (Soft Yellow Accent) -->
                <path class="anim-wave-back" d="M0,65 Q150,120 300,65 T600,65 Q750,120 900,65 T1200,65 V160 H0 Z" fill="#fbbf24" opacity="0.4"></path>
                <!-- Middle wave (Green/Teal Transparent) -->
                <path class="anim-wave-mid" d="M0,75 Q150,15 300,75 T600,75 Q750,15 900,75 T1200,75 V160 H0 Z" fill="url(#heroWaveGradient)" opacity="0.95"></path>
                <!-- Front wave (Solid White) -->
                <path class="anim-wave-front" d="M0,90 Q150,30 300,90 T600,90 Q750,30 900,90 T1200,90 V160 H0 Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

