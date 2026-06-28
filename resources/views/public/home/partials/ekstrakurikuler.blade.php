{{-- EKSTRAKURIKULER --}}
<section class="py-12 md:py-16 bg-gradient-to-b from-white to-slate-50 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 left-10 w-72 h-72 rounded-full bg-blue-50/40 blur-3xl z-0 pointer-events-none"></div>
    <div class="absolute bottom-0 right-10 w-80 h-80 rounded-full bg-amber-50/40 blur-3xl z-0 pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
        <div class="text-center mb-10 md:mb-12">
            <div class="inline-block relative mb-4">
                <h2 class="section-title reveal reveal-zoom after:hidden" style="transition-delay: 150ms;">Ekstrakurikuler Unggulan</h2>
                <svg class="section-accent-line absolute w-full h-4 -bottom-2 left-0 text-amber-400 z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                    <path d="M5 15Q50 5 100 10T195 15" />
                </svg>
            </div>
            <p class="text-slate-500 max-w-2xl mx-auto reveal reveal-up text-sm md:text-base leading-relaxed" style="transition-delay: 300ms;">
                SIT Mutiara Qur'an menyediakan berbagai pilihan kegiatan ekstrakurikuler untuk mengembangkan minat, bakat, kepemimpinan, serta karakter Islami putra-putri Anda.
            </p>
        </div>
    </div>

    @php
        $fallbackEkskuls = [
            ['title' => 'Pramuka SIT',       'icon' => 'tent'],
            ['title' => 'Tahfidz Club',       'icon' => 'book-open'],
            ['title' => 'Futsal',             'icon' => 'trophy'],
            ['title' => 'Panahan',            'icon' => 'crosshair'],
            ['title' => 'Olimpiade Sains',    'icon' => 'flask-conical'],
            ['title' => 'Seni & Kaligrafi',   'icon' => 'palette'],
            ['title' => 'Nasyid & Seni Gerak','icon' => 'music'],
            ['title' => 'English Fun',        'icon' => 'message-circle'],
            ['title' => 'Prakarya Kreatif',   'icon' => 'scissors'],
            ['title' => 'Outbound Kids',      'icon' => 'compass'],
            ['title' => 'Karate',             'icon' => 'shield-alert'],
            ['title' => 'Robotik & Coding',   'icon' => 'cpu'],
        ];

        $iconMap = ['dribbble' => 'trophy'];

        $rawItems = (isset($ekskuls) && $ekskuls->count() > 0) ? $ekskuls->toArray() : $fallbackEkskuls;
        foreach ($rawItems as $i => $it) {
            if (isset($it['icon']) && isset($iconMap[$it['icon']])) {
                $rawItems[$i]['icon'] = $iconMap[$it['icon']];
            }
        }

        // Split into exactly 2 rows (interleave so each row gets similar items)
        $row1 = [];
        $row2 = [];
        foreach ($rawItems as $i => $it) {
            if ($i % 2 === 0) { $row1[] = $it; }
            else              { $row2[] = $it; }
        }

        // Each row needs at least 8 unique items before we duplicate for seamless loop
        if (count($row1) > 0) {
            while (count($row1) < 8) { $row1 = array_merge($row1, $row1); }
        }
        if (count($row2) > 0) {
            while (count($row2) < 8) { $row2 = array_merge($row2, $row2); }
        }
    @endphp

    {{-- ===== INLINE STYLES: True Infinite Marquee ===== --}}
    <style>
        /* Fade edges for elegant appearance */
        .ekskul-mask {
            -webkit-mask-image: linear-gradient(to right,
                transparent 0%,
                black 80px,
                black calc(100% - 80px),
                transparent 100%);
            mask-image: linear-gradient(to right,
                transparent 0%,
                black 80px,
                black calc(100% - 80px),
                transparent 100%);
        }

        /*
         * TRUE INFINITE MARQUEE TECHNIQUE:
         * The inner track contains [original items] + [duplicate items].
         * We animate from 0% to -50% (one full set width).
         * At -50% the duplicate set is positioned exactly where the original started.
         * CSS resets to 0% which is visually identical → seamless loop.
         */
        @keyframes ekskul-scroll-left {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes ekskul-scroll-right {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        .ekskul-track-left {
            display: flex;
            flex-wrap: nowrap;
            width: max-content;
            animation: ekskul-scroll-left 38s linear infinite;
            will-change: transform;
        }

        .ekskul-track-right {
            display: flex;
            flex-wrap: nowrap;
            width: max-content;
            animation: ekskul-scroll-right 38s linear infinite;
            will-change: transform;
        }

        /* Pause entire track on hover anywhere inside the row */
        .ekskul-row:hover .ekskul-track-left,
        .ekskul-row:hover .ekskul-track-right {
            animation-play-state: paused;
        }

        /* Card hover effects */
        .ekskul-pill:hover {
            border-color: #FFC107 !important;
            box-shadow: 0 10px 24px rgba(255, 193, 7, 0.22) !important;
            transform: scale(1.06) translateY(-2px);
        }
    </style>

    <div class="w-full flex flex-col gap-6 relative z-10 ekskul-mask overflow-hidden py-4">

        {{-- ===== ROW 1: Right → Left ===== --}}
        <div class="ekskul-row w-full overflow-hidden select-none">
            <div class="ekskul-track-left gap-4 md:gap-6">
                {{-- Original set --}}
                @foreach($row1 as $item)
                    <div class="ekskul-pill flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] transition-all duration-300 cursor-pointer flex-shrink-0 mx-2 md:mx-3" style="margin-right:0.75rem;">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] flex-shrink-0 group-hover:bg-[#002244] group-hover:text-[#FFC107] transition-all duration-300">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
                {{-- Duplicate set (seamless continuation) --}}
                @foreach($row1 as $item)
                    <div class="ekskul-pill flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] transition-all duration-300 cursor-pointer flex-shrink-0" style="margin-right:0.75rem;" aria-hidden="true">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] flex-shrink-0">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===== ROW 2: Left → Right ===== --}}
        <div class="ekskul-row w-full overflow-hidden select-none">
            <div class="ekskul-track-right gap-4 md:gap-6">
                {{-- Original set --}}
                @foreach($row2 as $item)
                    <div class="ekskul-pill flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] transition-all duration-300 cursor-pointer flex-shrink-0" style="margin-right:0.75rem;">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] flex-shrink-0">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
                {{-- Duplicate set (seamless continuation) --}}
                @foreach($row2 as $item)
                    <div class="ekskul-pill flex items-center gap-3 px-5 py-3 md:px-6 md:py-4 bg-white border border-slate-100 rounded-full shadow-[0_4px_12px_rgba(0,34,68,0.03)] transition-all duration-300 cursor-pointer flex-shrink-0" style="margin-right:0.75rem;" aria-hidden="true">
                        <div class="w-8 h-8 rounded-full bg-[#002244]/5 flex items-center justify-center text-[#002244] flex-shrink-0">
                            <i data-lucide="{{ $item['icon'] ?: 'sparkles' }}" class="w-4 h-4"></i>
                        </div>
                        <span class="text-sm md:text-base font-bold text-[#002244] tracking-wide whitespace-nowrap">{{ $item['title'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
