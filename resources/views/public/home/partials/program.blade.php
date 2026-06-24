@if(isset($programs) && !$programs->isEmpty())
{{-- PROGRAM UNGGULAN --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="glow-amber bottom-10 right-10"></div>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <h2 class="section-title reveal reveal-zoom mb-2" style="transition-delay: 150ms;">Program Khusus Keislaman & Akademik</h2>


            </div>

            {{-- Program Filter Tabs --}}
            <div class="flex flex-nowrap md:flex-wrap justify-start md:justify-center gap-2 md:gap-3 mb-8 md:mb-12 overflow-x-auto pb-4 -mx-4 px-4 md:mx-0 md:px-0 custom-scrollbar snap-x">
                <button onclick="filterPrograms('all', this)" class="snap-start whitespace-nowrap flex-shrink-0 px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-[#003f88] text-white shadow-md shadow-slate-200 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 300ms;">Semua Program</button>
                <button onclick="filterPrograms('keislaman', this)" class="snap-start whitespace-nowrap flex-shrink-0 px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 450ms;">Keislaman</button>
                <button onclick="filterPrograms('akademik', this)" class="snap-start whitespace-nowrap flex-shrink-0 px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 600ms;">Akademik & IT</button>
                <button onclick="filterPrograms('karakter', this)" class="snap-start whitespace-nowrap flex-shrink-0 px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 750ms;">Karakter & Pemimpin</button>
            </div>

             <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                @php
                    $displayPrograms = [];
                    foreach ($programs as $prog) {
                        $displayPrograms[] = [
                            'icon' => $prog->icon,
                            'title' => $prog->title,
                            'desc' => $prog->description,
                            'detail' => $prog->detail,
                            'category' => $prog->category
                        ];
                    }
                    $animClasses = ['reveal-bottom-left', 'reveal-top', 'reveal-bottom-right', 'reveal-left', 'reveal-zoom', 'reveal-right'];
                @endphp
                @foreach($displayPrograms as $idx => $p)
                    <div tabindex="0" class="bg-white rounded-2xl p-3 sm:p-6 min-h-[180px] md:min-h-[340px] h-full flex-col border border-slate-100 shadow-sm hover:shadow-[0_20px_40px_-12px_rgba(0, 63, 136,0.25)] hover:scale-[1.03] hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group reveal reveal-program program-item {{ $animClasses[$idx % 6] }} focus:outline-none {{ $idx >= 4 ? 'hidden lg:flex' : 'flex' }}" data-category="{{ $p['category'] }}" style="transition-delay: {{ 120 + ($idx * 150) }}ms;">
                        
                        <!-- Top Accent Bar -->
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#005fc0] to-amber-400"></div>

                        <!-- Shine Effect -->
                        <div class="shine-effect"></div>

                        <!-- Background Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-amber-50/50 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <!-- Default View (Icon + Title + Badge) -->
                        <div class="relative z-10 flex flex-col h-full transform transition-transform duration-500 group-hover:-translate-y-4 focus:-translate-y-4 flex-grow">
                            <div class="w-8 h-8 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100/60 text-[#003f88] flex items-center justify-center mb-2 md:mb-6 shadow-inner group-hover:-translate-y-1 group-hover:rotate-12 group-hover:scale-110 focus:-translate-y-1 focus:rotate-12 focus:scale-110 transition-transform duration-300">
                                <i data-lucide="{{ $p['icon'] }}" class="w-4 h-4 md:w-7 md:h-7"></i>
                            </div>
                            <h3 class="text-sm md:text-xl font-bold text-[#003f88] mb-1.5 md:mb-4 group-hover:text-[#003f88] focus:text-[#003f88] transition-colors line-clamp-2">{{ $p['title'] }}</h3>
                            <div class="mt-auto pr-8 md:pr-0">
                                <span class="text-[9px] sm:text-[10px] md:text-xs font-bold text-[#003f88] bg-slate-50 px-1.5 py-1 md:px-3 md:py-1.5 rounded-lg md:rounded-xl inline-block border border-slate-100 line-clamp-2 leading-tight">
                                    {{ $p['detail'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Mobile Hint Indicator -->
                        <div class="absolute bottom-2.5 right-2.5 md:bottom-6 md:right-6 z-10 flex items-center gap-2 opacity-100 group-hover:opacity-0 focus:opacity-0 transition-opacity duration-300">
                            <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 animate-pulse">
                                <i data-lucide="mouse-pointer-click" class="w-3 h-3 md:w-4 md:h-4"></i>
                            </div>
                        </div>

                        <!-- Overlay Detail View -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#002244] to-[#003f88]/95 p-4 sm:p-6 md:p-8 flex flex-col justify-center overflow-y-auto translate-y-full group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 ease-[cubic-bezier(0.2,0.8,0.2,1)] z-20 opacity-0 group-hover:opacity-100 focus:opacity-100 custom-scrollbar">
                            
                            <!-- Staggered Entry Elements -->
                            <div class="text-amber-400 mb-2 md:mb-4 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-100 flex-shrink-0">
                                <i data-lucide="{{ $p['icon'] }}" class="w-7 h-7 md:w-10 md:h-10"></i>
                            </div>
                            
                            <h3 class="text-sm md:text-xl font-bold text-white mb-2 md:mb-3 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-150 flex-shrink-0 line-clamp-2">{{ $p['title'] }}</h3>
                            
                            <p class="text-slate-50 text-xs md:text-sm leading-relaxed transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-200 mb-auto line-clamp-3 md:line-clamp-none">{{ $p['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

