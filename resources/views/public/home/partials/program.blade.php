{{-- PROGRAM UNGGULAN --}}
    <section class="public-section bg-slate-50 relative overflow-hidden">
        <div class="glow-amber bottom-10 right-10"></div>
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <span class="section-badge reveal reveal-zoom" style="transition-delay: 0ms;"><i data-lucide="sparkles" class="w-4 h-4"></i> Program Unggulan</span>
                <h2 class="section-title reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Program Khusus Keislaman & Akademik</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Kurikulum keagamaan dan akademik yang dirancang secara matang untuk menyeimbangkan kecerdasan intelektual dan spiritual.</p>
            </div>

            {{-- Program Filter Tabs --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button onclick="filterPrograms('all', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-emerald-600 text-white shadow-md shadow-emerald-200 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 300ms;">Semua Program</button>
                <button onclick="filterPrograms('keislaman', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 450ms;">Keislaman</button>
                <button onclick="filterPrograms('akademik', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 600ms;">Akademik & IT</button>
                <button onclick="filterPrograms('karakter', this)" class="px-6 py-2.5 rounded-full text-sm font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition-all duration-500 filter-btn reveal reveal-up" style="transition-delay: 750ms;">Karakter & Pemimpin</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $programs = [
                        [
                            'icon' => 'book-open',
                            'title' => 'Tahfidz Qur\'an Mutqin',
                            'desc' => 'Program menghafal Al-Qur\'an terstruktur dengan metode talaqqi dan murojaah intensif untuk menjaga kualitas hafalan siswa (target mutqin).',
                            'detail' => 'Target: TK Juz 30, SD 5 Juz, SMP 10 Juz',
                            'category' => 'keislaman'
                        ],
                        [
                            'icon' => 'heart',
                            'title' => 'Pembiasaan Akhlakul Karimah',
                            'desc' => 'Internalisasi adab islami harian melalui Sholat Dhuha, Mabit (Malam Bina Iman dan Taqwa), Dzikir Pagi-Petang, serta pengawasan ibadah mandiri.',
                            'detail' => 'Karakter islami terintegrasi dalam keseharian',
                            'category' => 'keislaman'
                        ],
                        [
                            'icon' => 'languages',
                            'title' => 'Bilingual Environment',
                            'desc' => 'Peningkatan kapasitas bahasa asing (Arab & Inggris) yang digunakan dalam komunikasi harian ringan, doa, dan materi ajar tertentu.',
                            'detail' => 'Daily Arabic & English Conversation',
                            'category' => 'akademik'
                        ],
                        [
                            'icon' => 'code',
                            'title' => 'Digital Literacy & Coding',
                            'desc' => 'Khusus untuk tingkat SMP, dibekali dasar pemrograman komputer, logika digital, dan etika penggunaan teknologi informasi.',
                            'detail' => 'Kesiapan menghadapi era revolusi industri 4.0',
                            'category' => 'akademik'
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Mentoring & Halaqah',
                            'desc' => 'Kelompok bimbingan rohani khusus (liqo/mentoring) dengan rasio asatidzah kecil untuk memantau perkembangan emosional dan spiritual siswa.',
                            'detail' => 'Konseling terpadu yang penuh perhatian',
                            'category' => 'karakter'
                        ],
                        [
                            'icon' => 'compass',
                            'title' => 'Leadership & Outbound',
                            'desc' => 'Pelatihan kepemimpinan dasar, pramuka IT, kemah ukhuwah, dan kegiatan outbound untuk melatih kemandirian, keberanian, dan kerjasama tim.',
                            'detail' => 'Mencetak calon pemimpin umat masa depan',
                            'category' => 'karakter'
                        ]
                    ];
                @endphp
                @php
                    $animClasses = ['reveal-bottom-left', 'reveal-top', 'reveal-bottom-right', 'reveal-left', 'reveal-zoom', 'reveal-right'];
                @endphp
                @foreach($programs as $idx => $p)
                    <div tabindex="0" class="bg-white rounded-2xl p-6 min-h-[320px] md:min-h-[340px] flex flex-col border border-slate-100 shadow-sm hover:shadow-[0_20px_40px_-12px_rgba(52,211,153,0.25)] hover:scale-[1.03] hover:-translate-y-2 transition-all duration-500 relative overflow-hidden group reveal reveal-program program-item {{ $animClasses[$idx % 6] }} focus:outline-none" data-category="{{ $p['category'] }}" style="transition-delay: {{ 120 + ($idx * 150) }}ms;">
                        
                        <!-- Top Accent Bar -->
                        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-400 to-amber-400"></div>

                        <!-- Shine Effect -->
                        <div class="shine-effect"></div>

                        <!-- Background Hover Glow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-amber-50/50 opacity-0 group-hover:opacity-100 focus:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                        <!-- Default View (Icon + Title + Badge) -->
                        <div class="relative z-10 flex flex-col h-full transform transition-transform duration-500 group-hover:-translate-y-4 focus:-translate-y-4 flex-grow">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100/60 text-emerald-600 flex items-center justify-center mb-6 shadow-inner group-hover:-translate-y-1 group-hover:rotate-12 group-hover:scale-110 focus:-translate-y-1 focus:rotate-12 focus:scale-110 transition-transform duration-300">
                                <i data-lucide="{{ $p['icon'] }}" class="w-7 h-7"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-emerald-700 focus:text-emerald-700 transition-colors">{{ $p['title'] }}</h3>
                            <div class="mt-auto">
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-2 rounded-xl inline-block border border-emerald-100">
                                    {{ $p['detail'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Mobile Hint Indicator -->
                        <div class="absolute bottom-6 right-6 z-10 flex items-center gap-2 opacity-100 group-hover:opacity-0 focus:opacity-0 transition-opacity duration-300">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider md:hidden">Tap detail</span>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 animate-pulse">
                                <i data-lucide="mouse-pointer-click" class="w-4 h-4"></i>
                            </div>
                        </div>

                        <!-- Overlay Detail View -->
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 to-emerald-800/95 p-6 md:p-8 flex flex-col justify-center overflow-y-auto translate-y-full group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 ease-[cubic-bezier(0.2,0.8,0.2,1)] z-20 opacity-0 group-hover:opacity-100 focus:opacity-100 custom-scrollbar">
                            
                            <!-- Staggered Entry Elements -->
                            <div class="text-amber-400 mb-4 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-100 flex-shrink-0">
                                <i data-lucide="{{ $p['icon'] }}" class="w-10 h-10"></i>
                            </div>
                            
                            <h3 class="text-xl font-bold text-white mb-3 transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-150 flex-shrink-0">{{ $p['title'] }}</h3>
                            
                            <p class="text-emerald-50 text-sm leading-relaxed transform translate-y-8 group-hover:translate-y-0 focus:translate-y-0 transition-transform duration-500 delay-200 mb-auto">{{ $p['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

