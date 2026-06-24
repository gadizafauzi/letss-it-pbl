@if(isset($statistics) && count($statistics) > 0)
{{-- STATS --}}
    @php
        $bgImageUrl = (isset($statistic_bg_image) && $statistic_bg_image->value) ? (str_starts_with($statistic_bg_image->value, 'http') ? $statistic_bg_image->value : Storage::url($statistic_bg_image->value)) : '';
    @endphp
    <section class="relative py-16 md:py-24 z-20 bg-gradient-to-t from-amber-100/60 to-white">
        @if($bgImageUrl)
        <!-- If an image is uploaded, it will blend softly with the yellow background -->
        <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-10 mix-blend-multiply" style="background-image: url('{{ $bgImageUrl }}');"></div>
        @endif

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-10">
                @foreach($statistics as $index => $stat)
                <div class="flex flex-col items-center text-center reveal reveal-stat" style="transition-delay: {{ $index * 120 }}ms;">
                    <!-- Orange Icon Blob -->
                    <div class="relative mb-4 group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 border-2 border-amber-200 rounded-[40%_60%_70%_30%/40%_50%_60%_50%] transform -rotate-12 scale-110"></div>
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-amber-500 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] flex items-center justify-center text-white shadow-lg relative z-10 transform transition-transform duration-500 hover:rotate-12 hover:rounded-[50%]">
                            <i data-lucide="{{ $stat->icon }}" class="w-8 h-8 md:w-10 md:h-10 stroke-[1.5]"></i>
                        </div>
                    </div>
                    
                    <p class="text-3xl md:text-5xl font-black text-[#002244] mb-2 tracking-tight stat-number" data-count="{{ $stat->number }}" data-suffix="{{ $stat->suffix ?? '' }}">0</p>
                    <p class="text-slate-600 font-bold tracking-wide text-sm md:text-base">+ {{ $stat->label }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

