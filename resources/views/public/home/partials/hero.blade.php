{{-- HERO --}}
    <section class="hero-section relative overflow-hidden flex items-center">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        <div class="glow-emerald top-20 left-10"></div>
        <div class="glow-amber bottom-20 right-10"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-6 pb-20 sm:pt-8 sm:pb-28 lg:pt-10 lg:pb-36">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center -translate-y-6 lg:-translate-y-16">
                {{-- Left Text --}}
                <div class="lg:col-span-7 max-w-3xl text-left">

                    {{-- Accreditation stamp --}}
                    <div class="accreditation-stamp mb-6 reveal reveal-left">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                        <div class="accreditation-text">
                            <h5>Terakreditasi A</h5>
                            <p>BAN-PDM PROVINSI SUMATERA BARAT</p>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-sm font-semibold mb-6 reveal reveal-right">
                        <i data-lucide="sparkles" class="w-4 h-4 text-amber-400"></i>
                        Sekolah Islam Terpadu (JSIT)
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight tracking-tight reveal reveal-up">
                        Mendidik Generasi
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-amber-300">Qur'ani</span>
                        yang Berakhlak Mulia & Berprestasi
                    </h1>

                    <p class="mt-6 text-base sm:text-lg text-emerald-100/80 leading-relaxed max-w-xl reveal reveal-up">
                        SIT Mutiara Qur'an hadir di Nagari Cupak untuk membentuk generasi robbani yang mandiri, berkarakter mulia, cerdas akademis, serta mencintai Al-Qur'an.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-8 reveal reveal-up">
                        <a href="{{ route('public.ppdb.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-950 font-extrabold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                            Daftar PPDB Online
                        </a>
                        <a href="{{ route('public.profil.visi-misi') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                            Profil Sekolah
                        </a>
                    </div>
                </div>

                {{-- Right Visual representation --}}
                <div class="lg:col-span-5 hidden lg:block reveal reveal-up">
                    <div class="relative">
                        {{-- Decorative float card --}}
                        <div class="absolute top-4 -left-4 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 4s;">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                                <i data-lucide="award" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-xs font-black text-slate-800">Target Hafalan Mapan</h6>
                                <p class="text-[10px] text-slate-500">Up to 10 Juz Mutqin</p>
                            </div>
                        </div>

                        <div class="absolute -bottom-4 -right-4 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-emerald-100 shadow-xl flex items-center gap-3 animate-bounce" style="animation-duration: 5s;">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h6 class="text-xs font-black text-slate-800">Pembinaan Akhlak</h6>
                                <p class="text-[10px] text-slate-500">Mentoring Harian & Mabit</p>
                            </div>
                        </div>

                        <div class="w-full aspect-[4/5] rounded-[36px] bg-gradient-to-br from-emerald-800/80 to-emerald-950/80 border-4 border-white/10 shadow-2xl overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&q=80&w=800" alt="Siswa SIT Mutiara Qur'an" class="w-full h-full object-cover mix-blend-overlay opacity-65">
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-transparent to-transparent"></div>

                            <div class="absolute bottom-8 left-8 right-8 z-10 text-left">
                                <p class="text-xs font-extrabold text-amber-400 uppercase tracking-widest mb-2">Pendaftaran Sekolah</p>
                                <h3 class="text-xl font-bold text-white leading-snug">Berikan Pendidikan Agama dan Akademis Terbaik Bagi Putra-Putri Anda</h3>
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

