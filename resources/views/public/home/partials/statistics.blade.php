{{-- STATS --}}
    <section class="bg-white py-16 md:py-24 relative z-20">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                @forelse($statistics ?? [] as $index => $stat)
                @php
                    $colors = ['amber', 'emerald', 'teal', 'amber'];
                    $color = $colors[$index % 4];
                    $tColor = $color === 'amber' ? 'amber-400' : ($color === 'emerald' ? 'emerald-500' : 'teal-500');
                    $bgClass = $color === 'amber' ? 'bg-amber-50 text-amber-500' : ($color === 'emerald' ? 'bg-emerald-50 text-emerald-600' : 'bg-teal-50 text-teal-600');
                    $hoverBgClass = $color === 'amber' ? 'group-hover:bg-amber-500' : ($color === 'emerald' ? 'group-hover:bg-emerald-500' : 'group-hover:bg-teal-500');
                @endphp
                <div class="bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-{{ $tColor }} hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: {{ $index * 120 }}ms;">
                    <div class="w-16 h-16 rounded-2xl {{ $bgClass }} flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 {{ $hoverBgClass }} group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="{{ $stat->icon }}" class="w-8 h-8"></i>
                    </div>
                    <p class="text-3xl md:text-4xl font-extrabold text-slate-700 mb-1.5 tracking-tight stat-number" data-count="{{ $stat->number }}" data-suffix="{{ $stat->suffix ?? '' }}">0</p>
                    <p class="text-slate-500 font-semibold tracking-wide uppercase text-xs">{{ $stat->label }}</p>
                </div>
                @empty
                    <!-- Card 1: Siswa Aktif (Amber) -->
                    <div class="bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 0ms;">
                        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i data-lucide="users" class="w-8 h-8"></i>
                        </div>
                        <p class="text-3xl md:text-4xl font-extrabold text-slate-700 mb-1.5 tracking-tight stat-number" data-count="500" data-suffix="+">0</p>
                        <p class="text-slate-500 font-semibold tracking-wide uppercase text-xs">Siswa Aktif</p>
                    </div>
                    
                    <!-- Card 2: Tenaga Pendidik (Emerald) -->
                    <div class="bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-emerald-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 120ms;">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i data-lucide="graduation-cap" class="w-8 h-8"></i>
                        </div>
                        <p class="text-3xl md:text-4xl font-extrabold text-slate-700 mb-1.5 tracking-tight stat-number" data-count="35" data-suffix="+">0</p>
                        <p class="text-slate-500 font-semibold tracking-wide uppercase text-xs">Tenaga Pendidik</p>
                    </div>

                    <!-- Card 3: Rombel Kelas (Teal) -->
                    <div class="bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-teal-500 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 240ms;">
                        <div class="w-16 h-16 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i data-lucide="book-open" class="w-8 h-8"></i>
                        </div>
                        <p class="text-3xl md:text-4xl font-extrabold text-slate-700 mb-1.5 tracking-tight stat-number" data-count="18">0</p>
                        <p class="text-slate-500 font-semibold tracking-wide uppercase text-xs">Rombel Kelas</p>
                    </div>

                    <!-- Card 4: Tahun Berdiri (Amber) -->
                    <div class="bg-white rounded-[24px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-400 hover:shadow-[0_20px_40px_-12px_rgba(0,0,0,0.12)] hover:-translate-y-2.5 hover:scale-[1.03] transition-all duration-300 group reveal reveal-stat flex flex-col items-center text-center" style="transition-delay: 360ms;">
                        <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-4 group-hover:scale-110 group-hover:rotate-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <i data-lucide="building" class="w-8 h-8"></i>
                        </div>
                        <p class="text-3xl md:text-4xl font-extrabold text-slate-700 mb-1.5 tracking-tight stat-number" data-count="15" data-suffix=" Tahun">0</p>
                        <p class="text-slate-500 font-semibold tracking-wide uppercase text-xs">Tahun Berdiri</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

