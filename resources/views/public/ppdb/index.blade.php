@extends('layouts.public')
@section('content')
    @vite(['resources/css/public-ppdb.css', 'resources/js/public-ppdb.js'])

    <section class="page-hero relative overflow-hidden flex items-center min-h-[480px]">
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-8 pb-16">
            <div class="breadcrumb mb-8"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">PPDB</span></div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                {{-- Kiri: Teks & CTA --}}
                <div class="text-left reveal reveal-left delay-100">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-sm font-semibold mb-6">
                        <i data-lucide="megaphone" class="w-4 h-4 text-amber-400"></i>
                        {{ $hero && $hero->badge_text ? $hero->badge_text : 'Pendaftaran Dibuka TA ' . date('Y') . '/' . (date('Y')+1) }}
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-4">
                        {{ $hero && $hero->title ? $hero->title : 'Penerimaan Peserta Didik Baru' }}
                    </h1>
                    <p class="text-emerald-100/80 text-lg mb-8 max-w-lg">
                        {{ $hero && $hero->subtitle ? $hero->subtitle : "Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik, berkarakter mulia, dan berprestasi." }}
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ $hero && $hero->button_link ? $hero->button_link : '#informasi' }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-400 text-emerald-950 font-bold text-sm shadow-lg shadow-amber-500/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <i data-lucide="info" class="w-4 h-4"></i> {{ $hero && $hero->button_text ? $hero->button_text : 'Lihat Informasi PPDB' }}
                        </a>
                        <a href="{{ $hero && $hero->button_secondary_link ? $hero->button_secondary_link : '#brosur' }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="download" class="w-4 h-4"></i> {{ $hero && $hero->button_secondary_text ? $hero->button_secondary_text : 'Download Brosur' }}
                        </a>
                        <a href="#kontak" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 text-white font-bold text-sm hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                            <i data-lucide="phone" class="w-4 h-4"></i> Hubungi Panitia
                        </a>
                    </div>
                </div>

                {{-- Kanan: Gambar --}}
                <div class="hidden lg:block relative reveal reveal-right delay-200">
                    <div class="w-full aspect-[4/3] rounded-[32px] overflow-hidden border-4 border-white/10 shadow-2xl">
                        {{-- Menggunakan placeholder gambar sekolah / siswa belajar --}}
                        <img src="{{ $hero && $hero->image ? (Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image)) : 'https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=800' }}" alt="Kegiatan Belajar" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-emerald-900/20"></div>
                    </div>
                    
                    {{-- Floating Badge --}}
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-4 animate-bounce" style="animation-duration: 4s;">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-amber-500">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">Kuota Terbatas</p>
                            <p class="text-lg font-black text-slate-800">Daftar Segera!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.public.ppdb-subnav')

    {{-- ===== INFORMASI UNIT ===== --}}
    <section id="informasi" class="public-section pb-10 scroll-mt-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 reveal reveal-up">
                <h2 class="section-title mx-auto">Pendaftaran Siswa Baru</h2>
                <p class="section-subtitle mx-auto text-center">Bergabunglah bersama SIT Mutiara Qur'an untuk masa depan putra-putri Anda yang lebih baik.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $displayUnits = [];
                    if (isset($units) && !$units->isEmpty()) {
                        foreach ($units as $u) {
                            $slug = strtolower($u->unit_name);
                            $detail = $u->cmsUnitDetail;
                            if (Str::contains($slug, 'tk')) {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/tk.jpeg'),
                                    'gradient' => 'from-cyan-50 to-blue-50/50',
                                    'border' => 'border-cyan-200',
                                    'hover_shadow' => 'hover:shadow-cyan-200/50 hover:border-cyan-300',
                                    'blob' => 'bg-cyan-300/30',
                                    'text' => 'text-cyan-700',
                                    'title' => $detail && $detail->description_title ? $detail->description_title : 'TK Islam Terpadu',
                                    'usia' => $detail && $detail->target_age ? $detail->target_age : 'Usia 4-6 tahun',
                                    'kuota' => $detail && $detail->quota ? $detail->quota : '60 siswa',
                                    'reveal' => 'reveal-left',
                                    'delay' => 'delay-100'
                                ];
                            } elseif (Str::contains($slug, 'sd')) {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/sd.jpeg'),
                                    'gradient' => 'from-emerald-50 to-amber-50/50',
                                    'border' => 'border-emerald-200',
                                    'hover_shadow' => 'hover:shadow-emerald-200/50 hover:border-emerald-300',
                                    'blob' => 'bg-emerald-300/30',
                                    'text' => 'text-emerald-700',
                                    'title' => $detail && $detail->description_title ? $detail->description_title : 'SD Islam Terpadu',
                                    'usia' => $detail && $detail->target_age ? $detail->target_age : 'Usia 6-7 tahun',
                                    'kuota' => $detail && $detail->quota ? $detail->quota : '90 siswa',
                                    'reveal' => 'reveal-zoom',
                                    'delay' => 'delay-200'
                                ];
                            } else {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/smp.jpeg'),
                                    'gradient' => 'from-indigo-50 to-violet-50/50',
                                    'border' => 'border-indigo-200',
                                    'hover_shadow' => 'hover:shadow-indigo-200/50 hover:border-indigo-300',
                                    'blob' => 'bg-indigo-300/30',
                                    'text' => 'text-indigo-700',
                                    'title' => $detail && $detail->description_title ? $detail->description_title : 'SMP Islam Terpadu',
                                    'usia' => $detail && $detail->target_age ? $detail->target_age : 'Lulusan SD/MI',
                                    'kuota' => $detail && $detail->quota ? $detail->quota : '60 siswa',
                                    'reveal' => 'reveal-right',
                                    'delay' => 'delay-300'
                                ];
                            }
                            $displayUnits[] = $styles;
                        }
                    } else {
                        $displayUnits = [
                            [
                                'logo' => asset('images/tk.jpeg'),  
                                'gradient' => 'from-cyan-50 to-blue-50/50',
                                'border' => 'border-cyan-200',
                                'hover_shadow' => 'hover:shadow-cyan-200/50 hover:border-cyan-300',
                                'blob' => 'bg-cyan-300/30',
                                'text' => 'text-cyan-700',
                                'title' => 'TK Islam Terpadu',  
                                'usia' => 'Usia 4-6 tahun',  
                                'kuota' => '60 siswa', 
                                'reveal' => 'reveal-left', 
                                'delay' => 'delay-100'
                            ],
                            [
                                'logo' => asset('images/sd.jpeg'),  
                                'gradient' => 'from-emerald-50 to-amber-50/50',
                                'border' => 'border-emerald-200',
                                'hover_shadow' => 'hover:shadow-emerald-200/50 hover:border-emerald-300',
                                'blob' => 'bg-emerald-300/30',
                                'text' => 'text-emerald-700',
                                'title' => 'SD Islam Terpadu',  
                                'usia' => 'Usia 6-7 tahun',  
                                'kuota' => '90 siswa', 
                                'reveal' => 'reveal-zoom', 
                                'delay' => 'delay-200'
                            ],
                            [
                                'logo' => asset('images/smp.jpeg'), 
                                'gradient' => 'from-indigo-50 to-violet-50/50',
                                'border' => 'border-indigo-200',
                                'hover_shadow' => 'hover:shadow-indigo-200/50 hover:border-indigo-300',
                                'blob' => 'bg-indigo-300/30',
                                'text' => 'text-indigo-700',
                                'title' => 'SMP Islam Terpadu', 
                                'usia' => 'Lulusan SD/MI',   
                                'kuota' => '60 siswa', 
                                'reveal' => 'reveal-right', 
                                'delay' => 'delay-300'
                            ],
                        ];
                    }
                @endphp
                @foreach($displayUnits as $u)
                <div class="relative overflow-hidden group cursor-pointer rounded-[32px] p-8 text-center border bg-gradient-to-br {{ $u['gradient'] }} {{ $u['border'] }} shadow-lg jenjang-card {{ $u['hover_shadow'] }} reveal {{ $u['reveal'] }} {{ $u['delay'] }}">
                    {{-- Decorative Blobs --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full blur-2xl {{ $u['blob'] }} group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    <div class="absolute -bottom-12 -left-12 w-32 h-32 rounded-full blur-2xl {{ $u['blob'] }} group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>
                    
                    <div class="relative z-10 w-20 h-20 rounded-2xl bg-white/70 backdrop-blur-sm flex items-center justify-center mx-auto mb-6 p-3 border border-white shadow-sm group-hover:shadow-md transition-all duration-300">
                        <img src="{{ $u['logo'] }}" alt="Logo" class="w-full h-full object-contain drop-shadow-sm jenjang-logo">
                    </div>
                    
                    <h3 class="relative z-10 text-xl font-extrabold text-slate-800 mb-2 group-hover:{{ $u['text'] }} transition-colors duration-300">{{ $u['title'] }}</h3>
                    <p class="relative z-10 text-sm font-medium text-slate-500 mb-6">{{ $u['usia'] }}</p>
                    
                    <div class="relative z-10 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-md border border-white shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-current {{ $u['text'] }} animate-pulse"></span>
                        <span class="text-xs font-bold {{ $u['text'] }}">Kuota: {{ $u['kuota'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== TIMELINE PENDAFTARAN (DIPINDAH KE SINI) ===== --}}
    <section id="timeline" class="public-section py-16 bg-white scroll-mt-32">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 reveal reveal-up">
                <h2 class="section-title mx-auto">Timeline Pendaftaran</h2>
                <p class="section-subtitle mx-auto text-center">Ikuti setiap tahap seleksi sesuai jadwal yang telah ditetapkan.</p>
            </div>

            @php
                $displayTimeline = [];
                if (isset($timeline) && !$timeline->isEmpty()) {
                    foreach ($timeline as $t) {
                        $displayTimeline[] = [
                            'judul'   => $t->title,
                            'desc'    => $t->description,
                            'tanggal' => $t->date_range,
                            'status'  => $t->status,
                        ];
                    }
                } else {
                    $displayTimeline = [
                        [
                            'judul'   => 'Tahap Pendaftaran',
                            'desc'    => 'Pendaftaran Tim dan Submit Proposal',
                            'tanggal' => 'April — 13 Juni ' . date('Y'),
                            'status'  => 'Dibuka',
                        ],
                        [
                            'judul'   => 'Babak Penyisihan I',
                            'desc'    => 'Babak Penyisihan Pertama',
                            'tanggal' => '26 — 27 Juni ' . date('Y'),
                            'status'  => 'Segera',
                        ],
                        [
                            'judul'   => 'Babak Penyisihan II',
                            'desc'    => 'Seleksi lanjutan untuk mencari finalis.',
                            'tanggal' => '27 Juli — 8 Agustus ' . date('Y'),
                            'status'  => 'Menunggu',
                        ],
                        [
                            'judul'   => 'Pengumuman Finalis',
                            'desc'    => 'Tim yang lolos menuju tahap akhir.',
                            'tanggal' => '10 Agustus ' . date('Y'),
                            'status'  => 'Menunggu',
                        ],
                        [
                            'judul'   => 'Daftar Ulang',
                            'desc'    => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.',
                            'tanggal' => '16 — 30 Agustus ' . date('Y'),
                            'status'  => 'Menunggu',
                        ],
                    ];
                }
            @endphp

            <div class="timeline-wrapper">
                {{-- Garis background --}}
                <div class="timeline-line"></div>
                {{-- Garis progress berwarna --}}
                <div class="timeline-progress"></div>

                @foreach($displayTimeline as $i => $j)
                @php
                    $revealClass = $i % 2 === 0 ? 'reveal-left' : 'reveal-right';
                    $delay = 'delay-' . (($i % 4) + 1) * 100;
                @endphp
                <div class="timeline-item-container reveal {{ $revealClass }} {{ $delay }}">
                    <div class="timeline-node"></div>
                    <div class="timeline-content">
                        <span class="inline-block px-3 py-1 mb-3 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">{{ strtoupper($j['tanggal']) }}</span>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $j['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ $j['desc'] }}</p>
                        <div>
                            @if(strtolower($j['status']) === 'dibuka')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">🟢 {{ $j['status'] }}</span>
                            @elseif(strtolower($j['status']) === 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">✓ {{ $j['status'] }}</span>
                            @elseif(strtolower($j['status']) === 'segera')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">⏳ {{ $j['status'] }}</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600">🔵 {{ $j['status'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== ALUR PENDAFTARAN ===== --}}
    <section id="alur" class="public-section py-16 scroll-mt-32">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12 reveal reveal-up">
                <h2 class="section-title mx-auto">Langkah Mudah Mendaftar</h2>
            </div>
            @php
                $displayAlur = [];
                if (isset($steps) && !$steps->isEmpty()) {
                    foreach ($steps as $step) {
                        $displayAlur[] = [
                            'no' => $step->step_number,
                            'icon' => $step->icon ? $step->icon : 'file-edit',
                            'judul' => $step->title,
                            'desc' => $step->description,
                        ];
                    }
                } else {
                    $displayAlur = [
                        ['no' => '1', 'icon' => 'file-edit',     'judul' => 'Mengisi Formulir',  'desc' => 'Isi formulir pendaftaran online atau datang langsung ke sekolah.'],
                        ['no' => '2', 'icon' => 'folder-check',  'judul' => 'Melengkapi Berkas', 'desc' => 'Siapkan dan serahkan berkas persyaratan yang diperlukan.'],
                        ['no' => '3', 'icon' => 'clipboard-pen', 'judul' => 'Tes Seleksi',       'desc' => 'Calon siswa mengikuti tes baca tulis, wawancara, dan tes Al-Quran.'],
                        ['no' => '4', 'icon' => 'megaphone',     'judul' => 'Pengumuman',         'desc' => 'Hasil seleksi diumumkan melalui website dan WhatsApp.'],
                        ['no' => '5', 'icon' => 'badge-check',   'judul' => 'Daftar Ulang',       'desc' => 'Lakukan pembayaran dan daftar ulang untuk mengamankan tempat.'],
                    ];
                }
            @endphp
            <div class="space-y-0">
                @foreach($displayAlur as $i => $step)
                <div class="timeline-item reveal reveal-up delay-{{ ($i % 5 + 1) * 100 }}">
                    <div class="timeline-dot">{{ $step['no'] }}</div>
                    <div class="pt-1">
                        <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $step['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== SYARAT PENDAFTARAN ===== --}}
    <section id="syarat" class="public-section py-16 bg-slate-50/50 scroll-mt-32">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal reveal-up">
                <h2 class="section-title mx-auto">Syarat Pendaftaran</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $displaySyarat = [];
                    if (isset($units) && !$units->isEmpty()) {
                        foreach ($units as $u) {
                            $slug = strtolower($u->unit_name);
                            $reqList = isset($requirements[$u->id]) ? $requirements[$u->id]->pluck('text')->all() : [];
                            
                            if (empty($reqList)) {
                                if (Str::contains($slug, 'tk')) {
                                    $reqList = ['Usia minimal 4 tahun','Fotokopi akta kelahiran','Fotokopi KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'];
                                } elseif (Str::contains($slug, 'sd')) {
                                    $reqList = ['Usia minimal 6 tahun','Ijazah / surat keterangan TK','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'];
                                } else {
                                    $reqList = ['Ijazah / SKL SD','Rapor kelas 4, 5, 6','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'];
                                }
                            }

                            $detail = $u->cmsUnitDetail;
                            if (Str::contains($slug, 'tk')) {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/tk.jpeg'),
                                    'color' => 'cyan',
                                    'gradient' => 'from-cyan-50/70 to-blue-50/20',
                                    'border' => 'border-cyan-100',
                                    'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(6,182,212,0.3)] hover:border-cyan-300',
                                    'bgGlow' => 'from-cyan-50/0 to-cyan-100/60',
                                    'blob' => 'bg-cyan-300/20',
                                    'title' => 'TK',
                                    'items' => $reqList,
                                    'reveal' => 'reveal-left',
                                    'delay' => 'delay-100'
                                ];
                            } elseif (Str::contains($slug, 'sd')) {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/sd.jpeg'),
                                    'color' => 'emerald',
                                    'gradient' => 'from-emerald-50/70 to-amber-50/20',
                                    'border' => 'border-emerald-100',
                                    'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.3)] hover:border-emerald-300',
                                    'bgGlow' => 'from-emerald-50/0 to-emerald-100/60',
                                    'blob' => 'bg-emerald-300/20',
                                    'title' => 'SD',
                                    'items' => $reqList,
                                    'reveal' => 'reveal-zoom',
                                    'delay' => 'delay-200'
                                ];
                            } else {
                                $styles = [
                                    'logo' => $detail && $detail->description_logo ? (Str::startsWith($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo)) : asset('images/smp.jpeg'),
                                    'color' => 'indigo',
                                    'gradient' => 'from-indigo-50/70 to-violet-50/20',
                                    'border' => 'border-indigo-100',
                                    'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(99,102,241,0.3)] hover:border-indigo-300',
                                    'bgGlow' => 'from-indigo-50/0 to-indigo-100/60',
                                    'blob' => 'bg-indigo-300/20',
                                    'title' => 'SMP',
                                    'items' => $reqList,
                                    'reveal' => 'reveal-right',
                                    'delay' => 'delay-300'
                                ];
                            }
                            $displaySyarat[] = $styles;
                        }
                    } else {
                        $displaySyarat = [
                            [
                                'logo' => asset('images/tk.jpeg'),  
                                'color' => 'cyan',
                                'gradient' => 'from-cyan-50/70 to-blue-50/20',
                                'border' => 'border-cyan-100',
                                'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(6,182,212,0.3)] hover:border-cyan-300',
                                'bgGlow' => 'from-cyan-50/0 to-cyan-100/60',
                                'blob' => 'bg-cyan-300/20',
                                'title' => 'TK', 
                                'items' => ['Usia minimal 4 tahun','Fotokopi akta kelahiran','Fotokopi KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'], 
                                'reveal' => 'reveal-left', 
                                'delay' => 'delay-100'
                            ],
                            [
                                'logo' => asset('images/sd.jpeg'),  
                                'color' => 'emerald',  
                                'gradient' => 'from-emerald-50/70 to-amber-50/20',
                                'border' => 'border-emerald-100',
                                'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.3)] hover:border-emerald-300',
                                'bgGlow' => 'from-emerald-50/0 to-emerald-100/60',
                                'blob' => 'bg-emerald-300/20',
                                'title' => 'SD', 
                                'items' => ['Usia minimal 6 tahun','Ijazah / surat keterangan TK','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'], 
                                'reveal' => 'reveal-zoom', 
                                'delay' => 'delay-200'
                            ],
                            [
                                'logo' => asset('images/smp.jpeg'), 
                                'color' => 'indigo', 
                                'gradient' => 'from-indigo-50/70 to-violet-50/20',
                                'border' => 'border-indigo-100',
                                'hover_shadow' => 'hover:shadow-[0_20px_40px_-15px_rgba(99,102,241,0.3)] hover:border-indigo-300',
                                'bgGlow' => 'from-indigo-50/0 to-indigo-100/60',
                                'blob' => 'bg-indigo-300/20',
                                'title' => 'SMP',
                                'items' => ['Ijazah / SKL SD','Rapor kelas 4, 5, 6','Fotokopi akta & KK','Pas foto 3x4 (4 lembar)','Surat keterangan sehat'], 
                                'reveal' => 'reveal-right', 
                                'delay' => 'delay-300'
                            ],
                        ];
                    }
                @endphp
                @foreach($displaySyarat as $s)
                <div class="relative bg-gradient-to-br {{ $s['gradient'] }} border {{ $s['border'] }} p-8 rounded-[32px] overflow-hidden group cursor-pointer shadow-sm transition-all duration-500 hover:-translate-y-3 hover:scale-[1.03] {{ $s['hover_shadow'] }} reveal {{ $s['reveal'] }} {{ $s['delay'] }}">
                    
                    {{-- Decorative Blobs --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 {{ $s['blob'] }} rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 pointer-events-none"></div>

                    <!-- Glow Background on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-b {{ $s['bgGlow'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center mb-6 shadow-sm border border-slate-100 overflow-hidden transition-all duration-500 relative group-hover:shadow-md">
                            <img src="{{ $s['logo'] }}" alt="Logo {{ $s['title'] }}" class="w-full h-full object-contain p-2 drop-shadow-sm transition-transform duration-500 group-hover:scale-[1.15] group-hover:rotate-[4deg]">
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-4 transition-colors duration-300 group-hover:text-{{ $s['color'] }}-700">{{ $s['title'] }} Islam Terpadu</h3>
                        <ul class="space-y-3 text-sm text-slate-600 flex-grow">
                            @foreach($s['items'] as $item)
                            <li class="flex items-start gap-2 group-hover:text-slate-800 transition-colors duration-300">
                                <i data-lucide="check-circle" class="w-4 h-4 text-{{ $s['color'] }}-500 mt-0.5 flex-shrink-0 transition-transform duration-300 group-hover:scale-110"></i> 
                                <span>{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== FAQ ===== --}}
    <section id="faq" class="public-section py-20 bg-white relative overflow-hidden scroll-mt-32">
        {{-- Dekorasi background --}}
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-emerald-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-amber-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-3xl mx-auto relative z-10">
            <div class="text-center mb-16 flex flex-col items-center">
                <h2 class="section-title mx-auto faq-title transition-all duration-700 ease-out text-3xl md:text-4xl font-extrabold text-slate-800 mb-2" style="opacity: 0; transform: scale(0.92) translateY(15px); transition-delay: 150ms;">Pertanyaan yang Sering Diajukan</h2>
                <div class="faq-divider h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full mb-6 transition-all duration-700 ease-out" style="opacity: 0; transform: scaleX(0); transition-delay: 300ms; transform-origin: center;"></div>
                <p class="section-subtitle mx-auto text-center text-slate-500 faq-subtitle transition-all duration-700 ease-out max-w-xl" style="opacity: 0; transform: translateY(20px); transition-delay: 450ms;">
                    Temukan jawaban untuk pertanyaan umum seputar Penerimaan Peserta Didik Baru (PPDB) SIT Mutiara Qur'an.
                </p>
            </div>

            <div class="space-y-4 faq-container">
                @php
                    $displayFaqs = [];
                    if (isset($faqs) && !$faqs->isEmpty()) {
                        foreach ($faqs as $faq) {
                            $displayFaqs[] = [
                                'q' => $faq->question,
                                'a' => $faq->answer,
                            ];
                        }
                    } else {
                        $displayFaqs = [
                            ['q' => 'Kapan pendaftaran PPDB dibuka?',                       'a' => 'Pendaftaran PPDB dibuka mulai bulan Maret hingga Juni setiap tahunnya. Untuk informasi terbaru, silakan cek halaman Jadwal & Timeline.'],
                            ['q' => 'Apakah ada tes masuk untuk calon siswa?',               'a' => 'Ya, calon siswa akan mengikuti tes seleksi yang meliputi tes baca tulis, wawancara, dan tes kemampuan Al-Quran sesuai jenjang.'],
                            ['q' => 'Berapa biaya pendaftaran?',                             'a' => 'Biaya formulir pendaftaran sebesar Rp 150.000. Informasi biaya pendidikan lengkap akan disampaikan saat daftar ulang.'],
                            ['q' => 'Apakah tersedia program beasiswa?',                    'a' => 'Ya, kami menyediakan program beasiswa untuk siswa berprestasi dan siswa dari keluarga kurang mampu. Hubungi kami untuk informasi lebih lanjut.'],
                            ['q' => 'Bagaimana sistem pembelajaran di SIT Mutiara Quran?', 'a' => 'Kami menggunakan Kurikulum Merdeka yang diintegrasikan dengan kurikulum keislaman. Pembelajaran berlangsung dari pukul 07.00 hingga 15.30 WIB (fullday school).'],
                            ['q' => 'Apakah ada program tahfidz?',                          'a' => 'Ya, program tahfidz merupakan program unggulan kami. Target hafalan: TK (Juz 30), SD (5 Juz), SMP (10 Juz).'],
                            ['q' => 'Bagaimana cara mendaftar?',                            'a' => 'Anda bisa mendaftar secara online melalui website atau datang langsung ke sekolah. Lihat bagian Alur Pendaftaran di atas untuk detail langkah-langkahnya.'],
                        ];
                    }
                @endphp

                @foreach($displayFaqs as $i => $faq)
                @php
                    // Alternate slide directions: left, right, left, right
                    $translateClass = $i % 2 === 0 ? '-translate-x-8' : 'translate-x-8';
                    $delay = 400 + ($i * 120); // 0.12s increments
                @endphp
                <div class="faq-item-interactive bg-white border border-slate-200 rounded-2xl p-5 md:p-6 cursor-pointer opacity-0 {{ $translateClass }} transition-all duration-700 ease-out hover:-translate-y-1 hover:border-emerald-300 hover:bg-emerald-50/30 hover:shadow-lg hover:shadow-emerald-100/50 group" 
                     style="transition-delay: {{ $delay }}ms;"
                     onclick="toggleInteractiveFaq(this)">
                    <div class="flex items-start gap-4">
                        <div class="w-8 h-8 rounded-full bg-slate-50 border border-slate-100 text-slate-400 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 group-hover:text-emerald-600 group-hover:border-emerald-200 transition-colors faq-icon-box">
                            <span class="text-sm font-bold">{{ $i + 1 }}</span>
                        </div>
                        <div class="flex-grow pt-1 w-full">
                            <div class="flex items-center justify-between gap-4">
                                <h3 class="text-base md:text-lg font-bold text-slate-800 group-hover:text-emerald-700 transition-colors">{{ $faq['q'] }}</h3>
                                <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-100 transition-colors faq-chevron-wrapper">
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-hover:text-emerald-600 transition-transform duration-300 faq-chevron-icon"></i>
                                </div>
                            </div>
                            <div class="faq-answer-interactive grid transition-all duration-300 ease-in-out opacity-0" style="grid-template-rows: 0fr;">
                                <div class="overflow-hidden">
                                    <p class="text-sm md:text-base text-slate-600 leading-relaxed pt-4 pb-1 pr-8 border-t border-slate-100 mt-4">
                                        {{ $faq['a'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        /* Custom styles for FAQ interactive */
        .faq-item-interactive.is-active {
            border-color: #34d399; /* emerald-400 */
            background-color: #f0fdf4; /* emerald-50 */
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.1), 0 8px 10px -6px rgba(16, 185, 129, 0.1);
            border-left: 4px solid #10b981; /* Aksen hijau di kiri */
        }
        
        .faq-item-interactive.is-active .faq-icon-box {
            background-color: #10b981; /* emerald-500 */
            color: white;
            border-color: #10b981;
        }

        .faq-item-interactive.is-active h3 {
            color: #047857; /* emerald-700 */
        }

        .faq-item-interactive.is-active .faq-chevron-wrapper {
            background-color: #d1fae5; /* emerald-100 */
        }
        
        .faq-item-interactive.is-active .faq-chevron-icon {
            transform: rotate(180deg);
            color: #059669; /* emerald-600 */
        }

        .faq-item-interactive.is-active .faq-answer-interactive {
            grid-template-rows: 1fr !important;
            opacity: 1;
        }

        /* Animation visible states */
        .faq-badge.is-visible { opacity: 1 !important; transform: scale(1) translateY(0) !important; transition-timing-function: cubic-bezier(0.34, 1.56, 0.64, 1) !important; }
        .faq-title.is-visible { opacity: 1 !important; transform: scale(1) translateY(0) !important; }
        .faq-divider.is-visible { opacity: 1 !important; transform: scaleX(1) !important; }
        .faq-subtitle.is-visible { opacity: 1 !important; transform: translateY(0) !important; }
        .faq-item-interactive.is-visible { opacity: 1; transform: translateX(0) translateY(0); }

        /* Animation exit states */
        .faq-badge.is-hidden { opacity: 0 !important; transform: scale(0.9) translateY(-10px) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-title.is-hidden { opacity: 0 !important; transform: scale(0.96) translateY(-15px) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-divider.is-hidden { opacity: 0 !important; transform: scaleX(0) !important; transition-duration: 0.8s !important; transition-delay: 0ms !important; }
        .faq-subtitle.is-hidden { opacity: 0 !important; transform: translateY(-20px) !important; transition-duration: 1s !important; transition-delay: 0ms !important; }
    </style>

    <script>
        // Toggle FAQ Accordion
        function toggleInteractiveFaq(clickedItem) {
            const isActive = clickedItem.classList.contains('is-active');
            
            // Auto close others
            document.querySelectorAll('.faq-item-interactive').forEach(item => {
                item.classList.remove('is-active');
            });

            // If it wasn't active before, open it
            if (!isActive) {
                clickedItem.classList.add('is-active');
            }
        }

        // Intersection Observer for FAQ animations
        document.addEventListener('DOMContentLoaded', () => {
            const faqSection = document.getElementById('faq');
            if (!faqSection) return;

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const faqObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    const badge = entry.target.querySelector('.faq-badge');
                    const title = entry.target.querySelector('.faq-title');
                    const divider = entry.target.querySelector('.faq-divider');
                    const subtitle = entry.target.querySelector('.faq-subtitle');
                    const items = entry.target.querySelectorAll('.faq-item-interactive');

                    if (entry.isIntersecting) {
                        // Animate in
                        if(badge) { badge.classList.add('is-visible'); badge.classList.remove('is-hidden'); }
                        if(title) { title.classList.add('is-visible'); title.classList.remove('is-hidden'); }
                        if(divider) { divider.classList.add('is-visible'); divider.classList.remove('is-hidden'); }
                        if(subtitle) { subtitle.classList.add('is-visible'); subtitle.classList.remove('is-hidden'); }
                        
                        items.forEach(item => {
                            if(!item.classList.contains('is-visible')) {
                                item.classList.add('is-visible');
                                // Reset transition delay after animation so hover effect is snappy
                                setTimeout(() => {
                                    item.style.transitionDelay = '0ms';
                                }, parseInt(item.style.transitionDelay || 0) + 700);
                            }
                        });
                        
                    } else {
                        // Animate out (header elements only)
                        if(badge) { badge.classList.remove('is-visible'); badge.classList.add('is-hidden'); }
                        if(title) { title.classList.remove('is-visible'); title.classList.add('is-hidden'); }
                        if(divider) { divider.classList.remove('is-visible'); divider.classList.add('is-hidden'); }
                        if(subtitle) { subtitle.classList.remove('is-visible'); subtitle.classList.add('is-hidden'); }
                    }
                });
            }, observerOptions);

            faqObserver.observe(faqSection);
        });
    </script>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== BROSUR PPDB ===== --}}
    <section id="brosur" class="public-section py-16 bg-white scroll-mt-32">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 flex flex-col items-center">
                <h2 class="section-title mx-auto reveal reveal-zoom text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 to-emerald-500 mb-2" style="transition-delay: 150ms;">Download Brosur Lengkap</h2>
                <div class="h-1.5 w-24 mx-auto bg-gradient-to-r from-emerald-400 to-amber-400 rounded-full mb-6 reveal reveal-expand" style="transition-delay: 450ms;"></div>
                <p class="section-subtitle mx-auto text-center max-w-2xl reveal reveal-up" style="transition-delay: 300ms;">Unduh brosur resmi untuk melihat informasi lengkap mengenai jadwal pendaftaran, timeline, syarat, biaya pendidikan, program unggulan, fasilitas sekolah, dan informasi penting lainnya.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $displayBrosurs = [];
                    if (isset($brochures) && !$brochures->isEmpty()) {
                        foreach ($brochures as $i => $brochure) {
                            $reveals = ['reveal-left', 'reveal-up', 'reveal-zoom', 'reveal-right'];
                            $displayBrosurs[] = [
                                'title' => $brochure->title,
                                'desc' => $brochure->description,
                                'file' => Str::startsWith($brochure->file_path, 'http') ? $brochure->file_path : asset('storage/' . $brochure->file_path),
                                'delay' => 'delay-' . (($i % 4) + 1) * 100,
                                'reveal' => $reveals[$i % 4],
                            ];
                        }
                    } else {
                        $displayBrosurs = [
                            ['title' => 'Syarat PPDB TK/SD', 'desc' => 'Lihat persyaratan pendaftaran tingkat TK dan SD', 'file' => asset('images/syarat-tksd.jpeg'), 'delay' => 'delay-100', 'reveal' => 'reveal-left'],
                            ['title' => 'Biaya PPDB TK/SD', 'desc' => 'Lihat rincian biaya pendaftaran tingkat TK dan SD', 'file' => asset('images/biaya-tksd.jpeg'), 'delay' => 'delay-200', 'reveal' => 'reveal-up'],
                            ['title' => 'Syarat PPDB SMP', 'desc' => 'Lihat persyaratan pendaftaran tingkat SMP', 'file' => asset('images/syarat-smp.jpeg'), 'delay' => 'delay-300', 'reveal' => 'reveal-zoom'],
                            ['title' => 'Biaya PPDB SMP', 'desc' => 'Lihat rincian biaya pendaftaran tingkat SMP', 'file' => asset('images/biaya-smp.jpeg'), 'delay' => 'delay-400', 'reveal' => 'reveal-right'],
                        ];
                    }
                @endphp
                @foreach($displayBrosurs as $brosur)
                <div class="bg-white rounded-[20px] p-6 shadow-lg shadow-slate-200/50 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/80 hover:-translate-y-2 transition-all duration-300 flex flex-col group premium-card reveal {{ $brosur['reveal'] }} {{ $brosur['delay'] }}">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center mb-5 group-hover:scale-110 group-hover:bg-rose-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $brosur['title'] }}</h3>
                    <p class="text-sm text-slate-500 leading-relaxed mb-6 flex-grow">{{ $brosur['desc'] }}</p>
                    <div class="flex flex-col xl:flex-row gap-2 mt-auto">
                        <a href="{{ $brosur['file'] }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border-2 border-emerald-100 text-emerald-600 font-bold text-xs hover:bg-emerald-50 hover:border-emerald-200 transition-all duration-300">
                            <i data-lucide="eye" class="w-4 h-4"></i> Lihat
                        </a>
                        <a href="{{ $brosur['file'] }}" download class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-500 text-white font-bold text-xs shadow-md shadow-emerald-200 hover:bg-emerald-600 transition-all duration-300">
                            <i data-lucide="download" class="w-4 h-4"></i> Unduh
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="text-center mt-16 pt-10 border-t border-slate-100 reveal reveal-up delay-500">
                <p class="text-slate-500 mb-4">Masih ada pertanyaan atau butuh bantuan pendaftaran?</p>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282286204878' }}" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold shadow-lg shadow-emerald-200 hover:-translate-y-1 transition-all duration-300">
                    <i data-lucide="message-circle" class="w-5 h-5"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- DIVIDER --}}
    <div class="w-full h-px bg-slate-100"></div>

    {{-- ===== LOKASI SEKOLAH (MAPS) & HUBUNGI KAMI ===== --}}
    <section id="kontak" class="public-section py-16 bg-slate-50/50 scroll-mt-32">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal reveal-up">
                <h2 class="section-title mx-auto">Kontak & Lokasi</h2>
                <p class="section-subtitle mx-auto text-center">Kunjungi kami atau kirimkan pesan untuk pertanyaan seputar PPDB SIT Mutiara Qur'an.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                {{-- INFO & MAPS --}}
                <div class="lg:col-span-6 flex flex-col gap-6 reveal reveal-left delay-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Alamat</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                {!! nl2br(e($settings['address'] ?? "Karasak, Jorong Pasar Baru,\nCupak, Gunung Talang, Solok")) !!}
                            </p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-3">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Telepon / WA</h3>
                            <p class="text-xs text-slate-500">{{ $settings['phone'] ?? '+62 822-8620-4878' }}</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Email</h3>
                            <p class="text-xs text-slate-500">{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}</p>
                        </div>
                        <div class="feature-card p-5 bg-white">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center mb-3">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-800 mb-1">Jam Layanan</h3>
                            <p class="text-xs text-slate-500">{!! nl2br(e($settings['operational_hours'] ?? "Senin – Jum'at: 08.00 – 14.00 WIB")) !!}</p>
                        </div>
                    </div>
                    
                    {{-- Google Maps Frame --}}
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-lg flex-1" style="min-height: 280px;">
                        <iframe
                            src="{{ $settings['maps_embed'] ?? "https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31914.641419208794!2d100.598466!3d-0.8962703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2b356b0a8eba63%3A0x771bff3cc34e0a68!2sSDIT%20MUTIARA%20QURAN!5e0!3m2!1sid!2sid!4v1780587530868!5m2!1sid!2sid" }}"
                            width="100%"
                            height="100%"
                            style="border:0; display:block;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi SIT Mutiara Qur'an Nagari Cupak">
                        </iframe>
                    </div>
                </div>

                {{-- FORMULIR KONTAK --}}
                <div class="lg:col-span-6 bg-white p-8 rounded-3xl border border-slate-200/60 shadow-lg flex flex-col justify-between reveal reveal-right delay-200 premium-card">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-800 mb-6">Formulir Kontak</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" class="contact-input" placeholder="Masukkan nama lengkap Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                                <input type="email" class="contact-input" placeholder="contoh@email.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subjek</label>
                                <input type="text" class="contact-input" placeholder="Perihal pesan Anda">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pesan</label>
                                <textarea class="contact-input" rows="4" placeholder="Tulis pesan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-sm shadow-lg shadow-emerald-200 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                                <i data-lucide="send" class="w-4 h-4"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
