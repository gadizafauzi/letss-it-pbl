{{-- UNIT PENDIDIKAN --}}
<section class="public-section bg-slate-50 relative overflow-hidden">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        
        <div class="text-center mb-16">
            <div class="inline-block relative mb-4">
                <h2 class="section-title reveal reveal-zoom after:hidden" style="transition-delay: 150ms;">Jenjang Pendidikan Kami</h2>
                <svg class="section-accent-line absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                    <path d="M5 15Q50 5 100 10T195 15" />
                </svg>
            </div>
            <p class="text-slate-500 max-w-2xl mx-auto reveal reveal-up" style="transition-delay: 300ms;">Menyediakan pendidikan berkelanjutan dengan kurikulum Islami yang komprehensif.</p>
        </div>

        <div class="flex flex-row gap-4 md:gap-8 lg:gap-16 items-center">
            
            <!-- Left Column: Organic Blob Photo -->
            <div class="w-[40%] md:w-5/12 reveal reveal-right" style="transition-delay: 200ms;">
                <div class="relative w-full max-w-[260px] mx-auto pt-4 pb-4">
                    <!-- Decorations -->
                    <!-- Slanted Rectangle Background -->
                    <div class="absolute inset-0 m-auto w-48 h-48 md:w-64 md:h-64 rounded-[32px] bg-blue-100/60 blur-2xl z-0 transform scale-125 rotate-6"></div>
                    <div class="absolute inset-0 m-auto w-44 h-44 md:w-60 md:h-60 rounded-[32px] bg-gradient-to-tr from-amber-200 to-amber-100 z-0 transform -rotate-6 shadow-lg"></div>
                    
                    <style>
                        @keyframes float-box {
                            0% { transform: translateY(0px); }
                            50% { transform: translateY(-10px); }
                            100% { transform: translateY(0px); }
                        }
                        .animate-float-box {
                            animation: float-box 6s ease-in-out infinite;
                        }
                    </style>
                    <div class="relative z-10 animate-float-box flex justify-center items-center" 
                         style="width: 100%; aspect-ratio: 4/5;">
                        @if(isset($jenjang_image) && $jenjang_image->value)
                            <img src="{{ str_starts_with($jenjang_image->value, 'http') ? $jenjang_image->value : Storage::url($jenjang_image->value) }}" alt="Pendidikan Kami" class="w-full h-full object-contain">
                        @else
                            <img src="{{ asset('images/sd.jpeg') }}" alt="Mutiara Qur'an" class="w-full h-full object-contain mix-blend-multiply">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: 3 Vertical List Items -->
            <div class="w-[60%] md:w-7/12 flex flex-col justify-center">
                <div class="flex flex-col gap-2 lg:gap-3">
                    @php
                        $units = [
                            [
                                'icon' => 'baby',
                                'title' => 'TK Islam Terpadu',
                                'route' => 'public.unit.tk.index',
                                'delay' => '300ms',
                            ],
                            [
                                'icon' => 'backpack',
                                'title' => 'SD Islam Terpadu',
                                'route' => 'public.unit.sd.index',
                                'delay' => '400ms',
                            ],
                            [
                                'icon' => 'graduation-cap',
                                'title' => 'SMP Islam Terpadu',
                                'route' => 'public.unit.smp.index',
                                'delay' => '500ms',
                            ],
                        ];
                    @endphp

                    @foreach($units as $unit)
                        <a href="{{ route($unit['route']) }}" class="bg-white rounded-xl md:rounded-xl p-2 sm:p-3 lg:p-4 shadow-sm md:shadow-md shadow-slate-200/40 flex items-center border border-slate-100 hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(0,34,68,0.08)] transition-all duration-300 reveal reveal-up group" style="transition-delay: {{ $unit['delay'] }};">
                            <!-- Icon -->
                            <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 rounded-lg md:rounded-xl bg-[#002244]/5 flex items-center justify-center mr-3 lg:mr-4 text-[#002244] group-hover:scale-105 group-hover:bg-[#002244] group-hover:text-white transition-all duration-300 flex-shrink-0">
                                <i data-lucide="{{ $unit['icon'] }}" class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6"></i>
                            </div>
                            
                            <!-- Title -->
                            <div class="flex-grow text-left">
                                <h3 class="text-[13px] sm:text-sm lg:text-lg font-bold text-[#002244] leading-tight">{{ $unit['title'] }}</h3>
                            </div>
                            
                            <!-- Arrow -->
                            <div class="hidden sm:flex w-6 h-6 lg:w-8 lg:h-8 rounded-full bg-slate-50 items-center justify-center text-slate-400 group-hover:bg-amber-400 group-hover:text-[#002244] transition-all duration-300 flex-shrink-0">
                                <i data-lucide="arrow-right" class="w-3 h-3 lg:w-4 lg:h-4"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

