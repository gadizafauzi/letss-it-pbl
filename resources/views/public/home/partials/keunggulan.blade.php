{{-- KEUNGGULAN TAMBAHAN --}}
    <section class="public-section relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-emerald-50/40">
        <!-- Floating Particles / Decorative Shapes -->
        <div class="absolute top-10 left-10 w-64 h-64 bg-emerald-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-amber-200/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 bg-cyan-200/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Small animated particles -->
        <div class="absolute bottom-1/4 left-10 w-4 h-4 bg-emerald-300 rounded-full opacity-40 pointer-events-none animate-ping" style="animation-duration: 3s;"></div>
        <div class="absolute top-1/4 right-20 w-3 h-3 bg-amber-300 rounded-full opacity-50 pointer-events-none animate-pulse" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-10 left-1/2 w-5 h-5 bg-blue-300 rounded-full opacity-30 pointer-events-none animate-bounce" style="animation-duration: 5s;"></div>
        
        <!-- Added particles -->
        <div class="absolute top-20 left-1/4 w-3 h-3 bg-teal-300 rounded-full opacity-40 pointer-events-none animate-ping" style="animation-duration: 4.5s; animation-delay: 1s;"></div>
        <div class="absolute bottom-1/3 right-1/4 w-6 h-6 bg-rose-200 rounded-full opacity-30 pointer-events-none animate-bounce" style="animation-duration: 6s; animation-delay: 0.5s;"></div>
        <div class="absolute top-1/2 right-10 w-4 h-4 bg-violet-300 rounded-full opacity-40 pointer-events-none animate-pulse" style="animation-duration: 3.5s; animation-delay: 1.5s;"></div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Mengapa Memilih Mutiara Qur'an?</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Fasilitas yang modern dan lingkungan yang aman bersinergi melahirkan kenyamanan belajar penuh berkah.</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $displayKeunggulan = [];
                    if (isset($keunggulan) && !$keunggulan->isEmpty()) {
                        $animClasses = ['reveal-bottom-left', 'reveal-top-zoom', 'reveal-bottom-right', 'reveal-left', 'reveal-zoom', 'reveal-right'];
                        $delays = ['150ms', '300ms', '450ms', '600ms', '750ms', '900ms'];
                        foreach ($keunggulan as $index => $item) {
                            $displayKeunggulan[] = [
                                'icon' => $item->icon,
                                'bg' => $item->bg_color ?: 'emerald',
                                'anim' => $animClasses[$index % 6],
                                'delay' => $delays[$index % 6],
                                'title' => $item->title,
                                'desc' => $item->description
                            ];
                        }
                    } else {
                        $displayKeunggulan = [
                            ['icon' => 'book-marked', 'bg' => 'amber', 'anim' => 'reveal-bottom-left', 'delay' => '150ms', 'title' => 'Kurikulum Merdeka + JSIT', 'desc' => 'Mengintegrasikan kurikulum nasional Kurikulum Merdeka dengan kurikulum kekhasan JSIT.'],
                            ['icon' => 'monitor', 'bg' => 'emerald', 'anim' => 'reveal-top-zoom', 'delay' => '300ms', 'title' => 'Laboratorium Komputer', 'desc' => 'Fasilitas komputer modern penunjang praktikum TIK dan pemrograman dasar sejak dini.'],
                            ['icon' => 'users-2', 'bg' => 'blue', 'anim' => 'reveal-bottom-right', 'delay' => '450ms', 'title' => 'Tenaga Pendidik Berdedikasi', 'desc' => 'Asatidzah lulusan perguruan tinggi terkemuka, bersertifikat pendidik, dan hafizh.'],
                            ['icon' => 'home', 'bg' => 'violet', 'anim' => 'reveal-left', 'delay' => '600ms', 'title' => 'Fasilitas Kelas Kondusif', 'desc' => 'Ruang kelas ber-AC, proyektor LCD, serta lingkungan asri yang jauh dari kebisingan.'],
                            ['icon' => 'shield-check', 'bg' => 'rose', 'anim' => 'reveal-zoom', 'delay' => '750ms', 'title' => 'Lingkungan Aman & Ramah', 'desc' => 'Keamanan terpadu 24 jam dengan sistem sekolah bebas bullying dan hangat.'],
                            ['icon' => 'activity', 'bg' => 'cyan', 'anim' => 'reveal-right', 'delay' => '900ms', 'title' => 'Ekstrakurikuler Variatif', 'desc' => 'Panahan, berkuda, karate, robotik, seni kaligrafi, tilawah, sepak bola, dan pramuka.'],
                        ];
                    }
                @endphp
                @foreach($displayKeunggulan as $item)
                    <div class="bg-white rounded-2xl p-4 md:p-6 lg:p-8 border border-slate-100 shadow-sm hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] hover:border-{{ $item['bg'] }}-300 transition-all duration-300 relative overflow-hidden group reveal reveal-program {{ $item['anim'] }}" style="transition-delay: {{ $item['delay'] }};">
                        
                        <!-- Shine effect passing across the card -->
                        <div class="shine-effect"></div>

                        <!-- Top soft glow on hover -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-{{ $item['bg'] }}-400 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Background abstract glint -->
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-gradient-to-br from-{{ $item['bg'] }}-100 to-white rounded-full opacity-40 group-hover:scale-[2.5] group-hover:opacity-70 transition-all duration-700 ease-out z-0 blur-2xl"></div>

                        <div class="relative z-10">
                            <div class="w-10 h-10 md:w-14 md:h-14 rounded-2xl bg-gradient-to-br from-{{ $item['bg'] }}-50 to-{{ $item['bg'] }}-100/60 text-{{ $item['bg'] }}-600 flex items-center justify-center mb-3 md:mb-6 shadow-inner group-hover:-translate-y-2 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 md:w-7 md:h-7"></i>
                            </div>
                            <h3 class="text-sm md:text-xl font-bold text-slate-800 mb-2 md:mb-3 group-hover:text-{{ $item['bg'] }}-600 transition-colors duration-300 line-clamp-2">{{ $item['title'] }}</h3>
                            <p class="text-xs md:text-sm text-slate-500 leading-relaxed line-clamp-3 md:line-clamp-none">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

