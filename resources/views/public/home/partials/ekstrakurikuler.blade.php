{{-- EKSTRAKURIKULER --}}
<section class="py-12 md:py-16 bg-gradient-to-b from-white to-slate-50 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-10 w-72 h-72 rounded-full bg-blue-50/40 blur-3xl z-0 pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-80 h-80 rounded-full bg-amber-50/40 blur-3xl z-0 pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        {{-- Section Title --}}
        <div class="text-center mb-10 md:mb-12">
            <div class="inline-block relative mb-4">
                <h2 class="section-title reveal reveal-zoom after:hidden" style="transition-delay: 150ms;">Ekstrakurikuler Unggulan</h2>
                <svg class="absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                    <path d="M5 15Q50 5 100 10T195 15" />
                </svg>
            </div>
            <p class="text-slate-500 max-w-2xl mx-auto reveal reveal-up text-sm md:text-base leading-relaxed" style="transition-delay: 300ms;">
                SIT Mutiara Qur'an menyediakan berbagai pilihan kegiatan ekstrakurikuler untuk mengembangkan minat, bakat, kepemimpinan, serta karakter Islami putra-putri Anda.
            </p>
        </div>
    </div>

    {{-- Marquee Container --}}
    @php
        $fallbackEkskuls = [
            ['title' => 'Pramuka SIT', 'icon' => 'tent'],
            ['title' => 'Tahfidz Club', 'icon' => 'book-open'],
            ['title' => 'Futsal', 'icon' => 'dribbble'],
            ['title' => 'Panahan', 'icon' => 'crosshair'],
            ['title' => 'Olimpiade Sains', 'icon' => 'flask-conical'],
            ['title' => 'Seni & Kaligrafi', 'icon' => 'palette'],
            ['title' => 'Nasyid & Seni Gerak', 'icon' => 'music'],
            ['title' => 'English Fun', 'icon' => 'message-circle'],
            ['title' => 'Prakarya Kreatif', 'icon' => 'scissors'],
            ['title' => 'Outbound Kids', 'icon' => 'compass'],
            ['title' => 'Karate IT', 'icon' => 'shield-alert'],
            ['title' => 'Robotik & Coding', 'icon' => 'cpu'],
        ];

        $items = (isset($ekskuls) && $ekskuls->count() > 0) ? $ekskuls->toArray() : $fallbackEkskuls;

        // Map any unsupported/outdated icon names to valid Lucide icons
        $iconMap = [
            'dribbble' => 'trophy',
        ];

        foreach ($items as $idx => $item) {
            if (isset($item['icon']) && isset($iconMap[$item['icon']])) {
                $items[$idx]['icon'] = $iconMap[$item['icon']];
            }
        }

        // Separate items into two rows
        $row1 = [];
        $row2 = [];
        foreach ($items as $idx => $item) {
            if ($idx % 2 == 0) {
                $row1[] = $item;
            } else {
                $row2[] = $item;
            }
        }

        // Ensure at least 15 items in each base row for a sufficiently wide marquee track
        $row1Base = $row1;
        if (count($row1Base) > 0) {
            while (count($row1Base) < 15) {
                $row1Base = array_merge($row1Base, $row1);
            }
        }
        // Duplicate the base row once to have exactly two identical halves for the -50% translation loop
        $row1Repeated = array_merge($row1Base, $row1Base);

        $row2Base = $row2;
        if (count($row2Base) > 0) {
            while (count($row2Base) < 15) {
                $row2Base = array_merge($row2Base, $row2);
            }
        }
        $row2Repeated = array_merge($row2Base, $row2Base);
    @endphp

    <style>
        .marquee-wrapper {
            mask-image: linear-gradient(to right, transparent, white 60px, white calc(100% - 60px), transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, white 60px, white calc(100% - 60px), transparent);
        }
        
        @keyframes marquee-ltr {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        @keyframes marquee-rtl {
            0% { transform: translateX(0); }
            100% { transform: translateX(50%); }
        }
        
        .animate-marquee-ltr {
            animation: marquee-ltr 25s linear infinite;
            display: flex !important;
            flex-wrap: nowrap !important;
            width: max-content !important;
            flex-shrink: 0 !important;
        }
        
        .animate-marquee-rtl {
            animation: marquee-rtl 25s linear infinite;
            display: flex !important;
            flex-wrap: nowrap !important;
            width: max-content !important;
            flex-shrink: 0 !important;
            transform: translateX(-50%);
        }
        
        .marquee-track:hover .animate-marquee-ltr,
        .marquee-track:hover .animate-marquee-rtl {
            animation-play-state: paused;
        }
    </style>

    <div class="w-full flex flex-col gap-4 md:gap-6 relative z-10 marquee-wrapper overflow-hidden py-4">
        
        {{-- Row 1: Left Scrolling --}}
        <div class="marquee-track w-full overflow-hidden select-none">
            <div class="flex flex-nowrap gap-4 md:gap-6 animate-marquee-ltr">
                @foreach($row1Repeated as $item)
                    <div class="group flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] hover:border-amber-400 hover:shadow-[0_8px_20px_rgba(255,198,41,0.15)] hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] group-hover:bg-[#002244] group-hover:text-[#ffc629] transition-all duration-300 flex-shrink-0">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Row 2: Right Scrolling --}}
        <div class="marquee-track w-full overflow-hidden select-none">
            <div class="flex flex-nowrap gap-4 md:gap-6 animate-marquee-rtl">
                @foreach($row2Repeated as $item)
                    <div class="group flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] hover:border-amber-400 hover:shadow-[0_8px_20px_rgba(255,198,41,0.15)] hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] group-hover:bg-[#002244] group-hover:text-[#ffc629] transition-all duration-300 flex-shrink-0">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
