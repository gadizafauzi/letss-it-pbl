@if(isset($tujuanPendidikan) && !$tujuanPendidikan->isEmpty())
{{-- WHY CHOOSE US (TUJUAN PENDIDIKAN) --}}
    <section class="public-section bg-gradient-to-r from-[#002244]/95 via-[#002244]/80 to-transparent backdrop-blur-sm relative overflow-hidden">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-12 md:mb-20 flex flex-col items-center relative">
                <h2 class="section-title light reveal reveal-zoom mb-3" style="transition-delay: 150ms;">Tujuan Pendidikan</h2>
                <p class="text-slate-300 max-w-2xl mx-auto reveal reveal-up text-sm md:text-base" style="transition-delay: 300ms;">Membentuk generasi unggul dengan memadukan keislaman dan akademik secara komprehensif menuju tercapainya visi sekolah.</p>
            </div>
            
            @php
                $displayTujuan = [];
                foreach ($tujuanPendidikan as $index => $item) {
                    $displayTujuan[] = [
                        'icon' => $item->icon,
                        'bg' => $item->bg_color ?: 'emerald',
                        'title' => $item->title,
                        'desc' => $item->description,
                        'global_index' => $index
                    ];
                }
                $chunks = array_chunk($displayTujuan, 3);
                $totalItems = count($displayTujuan);
            @endphp

            <!-- Desktop Snake Timeline -->
            <div class="relative w-full max-w-6xl mx-auto hidden lg:block">
                @foreach($chunks as $rIdx => $chunk)
                    <div class="flex {{ $rIdx % 2 != 0 ? 'flex-row-reverse' : 'flex-row' }} items-stretch justify-start mb-8">
                        @foreach($chunk as $cIdx => $item)
                            @php
                                $isLtr = ($rIdx % 2 == 0);
                                $isLastInChunk = ($cIdx == count($chunk) - 1);
                                $isAbsoluteLast = ($item['global_index'] == $totalItems - 1);
                            @endphp
                            <div class="w-1/3 relative px-4 xl:px-8 flex flex-col group reveal reveal-up" style="transition-delay: {{ 150 + ($cIdx * 150) }}ms;">
                                <!-- Lines -->
                                @if(!$isAbsoluteLast)
                                    @if(!$isLastInChunk)
                                        <!-- Horizontal Line -->
                                        @if($isLtr)
                                            <div class="absolute top-8 left-[50%] w-full h-1.5 bg-gradient-to-r from-amber-400 to-amber-400/50 z-0 rounded-full"></div>
                                        @else
                                            <div class="absolute top-8 right-[50%] w-full h-1.5 bg-gradient-to-l from-amber-400 to-amber-400/50 z-0 rounded-full"></div>
                                        @endif
                                    @else
                                        <!-- Vertical Line Down -->
                                        <div class="absolute top-8 left-[50%] w-1.5 h-[calc(100%+2rem)] bg-gradient-to-b from-amber-400 to-amber-400/50 z-0 transform -translate-x-1/2 rounded-full"></div>
                                    @endif
                                @endif

                                <!-- Node -->
                                <div class="mx-auto w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-[#002244] border-4 border-amber-400 flex items-center justify-center text-white font-black text-xl lg:text-2xl shadow-[0_0_15px_rgba(251,191,36,0.5)] relative z-10 mb-4 lg:mb-5 group-hover:bg-amber-400 group-hover:text-[#002244] group-hover:scale-110 group-hover:-rotate-6 transition-all duration-300">
                                    {{ $item['global_index'] + 1 }}
                                </div>

                                <!-- Solid Card without Icons -->
                                <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-{{ $item['bg'] }}-400 transition-all duration-300 relative text-center group/card flex flex-col justify-center items-center overflow-hidden h-full">
                                    <p class="text-[13px] lg:text-sm font-medium text-slate-700 leading-relaxed whitespace-normal">
                                        {{ $item['desc'] ?: $item['title'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Mobile layout: Vertical Alternating timeline -->
            <div class="lg:hidden relative w-full px-2 mt-8">
                <!-- Center Vertical Line -->
                <div class="absolute left-1/2 top-2 bottom-0 w-1.5 bg-gradient-to-b from-amber-400 via-amber-400/50 to-transparent transform -translate-x-1/2 rounded-full z-0"></div>
                
                <div class="space-y-8 relative z-10">
                    @foreach($displayTujuan as $index => $item)
                        @php
                            $isLeft = ($index % 2 == 0);
                        @endphp
                        <div class="relative w-full flex items-center group reveal reveal-up" style="transition-delay: {{ 150 + (($index % 4) * 100) }}ms;">
                            
                            <!-- Left Side -->
                            <div class="w-1/2 pr-5 sm:pr-8 flex justify-end">
                                @if($isLeft)
                                    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-lg hover:-translate-y-1 hover:shadow-xl hover:border-{{ $item['bg'] }}-400 transition-all duration-300 w-full text-right relative overflow-hidden group/card">
                                        <p class="text-xs sm:text-sm font-medium text-slate-700 leading-relaxed whitespace-normal break-words">
                                            {{ $item['desc'] ?: $item['title'] }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Center Node -->
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#002244] border-4 border-amber-400 flex items-center justify-center text-white font-black text-base sm:text-lg shadow-[0_0_15px_rgba(251,191,36,0.5)] z-20 group-hover:bg-amber-400 group-hover:text-[#002244] group-hover:scale-110 transition-all duration-300">
                                {{ $index + 1 }}
                            </div>

                            <!-- Right Side -->
                            <div class="w-1/2 pl-5 sm:pl-8 flex justify-start">
                                @if(!$isLeft)
                                    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-lg hover:-translate-y-1 hover:shadow-xl hover:border-{{ $item['bg'] }}-400 transition-all duration-300 w-full text-left relative overflow-hidden group/card">
                                        <p class="text-xs sm:text-sm font-medium text-slate-700 leading-relaxed whitespace-normal break-words">
                                            {{ $item['desc'] ?: $item['title'] }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endif
