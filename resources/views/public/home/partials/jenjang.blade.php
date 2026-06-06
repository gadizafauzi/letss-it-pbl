{{-- UNIT PENDIDIKAN PREVIEW --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <!-- Floating background blobs -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-sky-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-100/30 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="layers-3" class="w-4 h-4"></i> Unit Pendidikan</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Jenjang Pendidikan Kami</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Menyediakan jenjang pendidikan berkesinambungan dari usia emas anak hingga pra-remaja.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4 lg:px-0">
                @php
                    $units = [

                        [
                            'logo' => asset('images/tk.jpeg'),
                            'title' => 'TK Islam Terpadu',
                            'desc' => 'Pembelajaran bermain sambil belajar yang bermakna dengan fokus pengenalan huruf hijaiyah, adab dasar, dan hafalan surah pendek.',
                            'route' => 'public.unit.tk.index',
                            'anim' => 'anim-bottom-left',
                            'delay' => '0ms',
                            'borderHover' => 'hover:border-sky-300',
                            'shadowHover' => 'group-hover:shadow-sky-200/50',
                            'bgGlow' => 'from-sky-50/0 to-sky-100/60',
                            'innerGlow' => 'bg-sky-100/50',
                            'textHover' => 'group-hover:text-sky-700',
                            'btnHover' => 'text-sky-600 group-hover:bg-sky-600 group-hover:text-white group-hover:shadow-sky-600/30',
                        ],
                        [
                            'logo' => asset('images/sd.jpeg'),
                            'title' => 'SD Islam Terpadu',
                            'desc' => 'Pembentukan pondasi keilmuan akademis umum, penguatan hafalan Al-Qur\'an hingga 5 juz, pembiasaan ibadah mandiri, dan kemandirian.',
                            'route' => 'public.unit.sd.index',
                            'anim' => 'anim-zoom',
                            'delay' => '150ms',
                            'borderHover' => 'hover:border-amber-300',
                            'shadowHover' => 'group-hover:shadow-amber-200/50',
                            'bgGlow' => 'from-amber-50/0 to-amber-100/60',
                            'innerGlow' => 'bg-amber-100/50',
                            'textHover' => 'group-hover:text-amber-700',
                            'btnHover' => 'text-amber-600 group-hover:bg-amber-500 group-hover:text-white group-hover:shadow-amber-500/30',
                        ],
                        [
                            'logo' => asset('images/smp.jpeg'),
                            'title' => 'SMP Islam Terpadu',
                            'desc' => 'Pengembangan kemampuan analisis akademis, penguasaan literasi digital, hafalan Al-Qur\'an hingga 10 juz, dan pelatihan kepemimpinan.',
                            'route' => 'public.unit.smp.index',
                            'anim' => 'anim-bottom-right',
                            'delay' => '300ms',
                            'borderHover' => 'hover:border-indigo-300',
                            'shadowHover' => 'group-hover:shadow-indigo-200/50',
                            'bgGlow' => 'from-indigo-50/0 to-indigo-100/60',
                            'innerGlow' => 'bg-indigo-100/50',
                            'textHover' => 'group-hover:text-indigo-700',
                            'btnHover' => 'text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white group-hover:shadow-indigo-600/30',
                        ],
                    ];
                @endphp
                @foreach($units as $unit)
                    <div class="bg-white rounded-[32px] p-8 text-center reveal reveal-up group border border-slate-100 shadow-sm relative overflow-hidden transition-all duration-500 hover:-translate-y-3 hover:scale-[1.03] hover:shadow-[0_25px_50px_-12px_rgba(0,0,0,0.1)] {{ $unit['borderHover'] }} {{ $unit['anim'] }} flex flex-col h-full" style="transition-delay: {{ $unit['delay'] }};">
                        
                        <!-- Glow Background on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-b {{ $unit['bgGlow'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col flex-grow">
                            <!-- Logo Container -->
                            <div class="w-24 h-24 rounded-2xl bg-white flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100 overflow-hidden {{ $unit['shadowHover'] }} transition-all duration-500 relative">
                                <!-- Inner glow for logo -->
                                <div class="absolute inset-0 {{ $unit['innerGlow'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <img src="{{ $unit['logo'] }}" alt="Logo {{ $unit['title'] }}"
                                     class="w-full h-full object-contain p-2 relative z-10 transition-transform duration-500 group-hover:scale-[1.15] group-hover:rotate-[4deg]">
                            </div>
                            
                            <h3 class="text-2xl font-black text-slate-800 mb-3 {{ $unit['textHover'] }} transition-colors duration-300">{{ $unit['title'] }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-8 flex-grow group-hover:text-slate-600 transition-colors duration-300">{{ $unit['desc'] }}</p>
                            
                            <!-- Button Link -->
                            <div class="mt-auto">
                                <a href="{{ route($unit['route']) }}" class="inline-flex items-center justify-center w-full py-3.5 rounded-xl bg-slate-50 {{ $unit['btnHover'] }} font-bold transition-all duration-300 overflow-hidden relative">
                                    <span class="relative z-10 flex items-center gap-2 transform transition-transform duration-300 group-hover:translate-x-1.5 text-sm">
                                        Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

