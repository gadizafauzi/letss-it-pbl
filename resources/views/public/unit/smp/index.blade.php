@extends('layouts.unit')

@section('navbar')
    <x-public.unit-navbar unitLogo="images/smp.jpeg" unitName="SMP Islam Terpadu" />
@endsection

@section('footer')
    <x-public.unit-footer unitName="SMP Islam Terpadu" />
@endsection

@section('content')

<style>
    :root {
        --unit-accent:    #10b981;
        --unit-accent-lt: #6ee7b7;
    }

    .reveal {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }
    .reveal.reveal-left  { transform: translateX(-40px); }
    .reveal.reveal-right { transform: translateX(40px); }
    .reveal.visible {
        opacity: 1;
        transform: none;
    }

    .unit-section-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 1rem;
        border-radius: 999px;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.25);
        color: #6ee7b7;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1rem;
    }

    .unit-section-title {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 900;
        color: #0f172a;
        position: relative;
        display: inline-block;
        padding-bottom: 0.6rem;
    }
    .unit-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 48px;
        height: 4px;
        border-radius: 99px;
        background: linear-gradient(90deg, #10b981, #34d399);
    }
    .unit-section-title.light { color: white; }

    .unit-teacher-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.35s;
    }
    .unit-teacher-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(15,23,42,0.12);
        border-color: #10b981;
    }

    .unit-timeline-dot {
        width: 14px; height: 14px;
        border-radius: 50%;
        background: #10b981;
        border: 3px solid white;
        box-shadow: 0 0 0 3px rgba(16,185,129,0.3);
        position: absolute;
        left: -9px;
        top: 1.5rem;
        transition: transform 0.3s;
    }
    .unit-timeline-card:hover .unit-timeline-dot {
        transform: scale(1.4);
    }

    @keyframes float {
        0%   { transform: translateY(0px); }
        50%  { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .animate-floating { animation: float 6s ease-in-out infinite; }
</style>

    {{-- ════════════════════════════════════════════
         HERO SECTION
         ════════════════════════════════════════════ --}}
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden"
             style="background: linear-gradient(135deg, #022c22 0%, #064e3b 60%, #047857 100%);">

        <div class="absolute inset-0 opacity-20"
             style="background-image: radial-gradient(rgba(16,185,129,0.6) 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="absolute top-1/4 left-0 w-72 h-72 rounded-full opacity-20"
             style="background: radial-gradient(circle, #10b981, transparent 70%); filter: blur(40px);"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full opacity-10"
             style="background: radial-gradient(circle, #34d399, transparent 70%); filter: blur(60px);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-28 pb-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                {{-- Left text --}}
                <div class="reveal reveal-left">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-none tracking-tighter mt-2 mb-6">
                        SMP ISLAM<br>
                        <span style="background: linear-gradient(90deg, #10b981, #34d399); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TERPADU</span>
                    </h1>

                    <p class="text-lg text-slate-400 leading-relaxed mb-8 max-w-md">
                        Membangun generasi remaja yang unggul secara akademik, berkarakter islami kuat, dan siap menghadapi tantangan era global.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="#profil"
                           style="background: linear-gradient(135deg, #10b981, #059669); color: white;"
                           class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-sm shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <i data-lucide="info" class="w-5 h-5"></i>
                            Deskripsi Umum
                        </a>
                        <a href="#prestasi"
                           class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl font-bold text-sm text-white transition-all duration-300 hover:-translate-y-1"
                           style="border: 2px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.05);">
                            <i data-lucide="play-circle" class="w-5 h-5"></i>
                            Lihat Prestasi
                        </a>
                    </div>
                </div>

                <div class="relative hidden lg:block reveal reveal-right">
                    <div class="relative w-full h-[400px] lg:h-[500px] animate-floating">
                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-3xl opacity-20 animate-pulse"></div>
                        <img src="{{ asset('images/smp_dummy.png') }}" alt="SMP Islam Terpadu SIT Mutiara Qur'an" class="relative w-full h-full object-contain mix-blend-screen drop-shadow-2xl">
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── PROFIL SECTION ──────────────────────── --}}
    <section id="profil" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="unit-section-title block w-full">DESKRIPSI SMP</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal reveal-left p-4">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-100 to-green-50 rounded-3xl transform -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                        <div class="relative bg-white rounded-3xl shadow-xl p-8 border border-slate-100 flex items-center justify-center min-h-[350px]">
                            <img src="{{ asset('images/logomq.jpg') }}" alt="Logo SIT" class="w-48 h-48 object-contain animate-floating">
                        </div>
                    </div>
                </div>

                <div class="reveal reveal-right">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Pendidikan Menengah Berkualitas & Berkarakter</h3>
                    <div class="space-y-6 text-lg text-slate-600 leading-relaxed">
                        <p>
                            SMP Islam Terpadu SIT Mutiara Qur'an hadir sebagai solusi pendidikan menengah yang memadukan keunggulan akademik, teknologi, dan pendalaman ilmu agama (Diniyah) untuk mencetak lulusan yang siap bersaing di era global.
                        </p>
                        <p>
                            Dengan program bina pribadi islami (BPI), bahasa asing, dan sains, kami membimbing remaja untuk menemukan potensi terbaik mereka, melatih kepemimpinan, dan memperkuat identitas sebagai muslim sejati.
                        </p>
                        <p>
                            Siswa juga difasilitasi dengan berbagai kegiatan kokurikuler dan ekstrakurikuler yang sejalan dengan minat dan bakat mereka, mendorong tercapainya prestasi maksimal diimbangi pemahaman akhlak dan akidah.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ── GURU SECTION ────────────────────────── --}}
    <section id="guru" class="py-24" style="background: #f8fafc;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="unit-section-title block w-full">GURU & TENAGA PENDIDIK</h2>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Dibimbing oleh pendidik profesional, inspiratif, dan berpengalaman di bidang akademik serta ilmu syar'i.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $guru = [
                        ['https://images.unsplash.com/photo-1546961342-ea5f62d7e57f?auto=format&fit=crop&w=400&q=80','Ustadz Ahmad, M.Pd','Kepala Sekolah SMP'],
                        ['https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80','Ustadz Rizki, S.Pd','Guru Matematika & Sains'],
                        ['https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&w=400&q=80','Ustadzah Nisa, S.Pd.I','Guru Bahasa Arab'],
                        ['https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?auto=format&fit=crop&w=400&q=80','Ustadz Hasan, Lc','Guru Tahfidz & Diniyah'],
                    ];
                @endphp
                @foreach($guru as $idx => $g)
                <div class="unit-teacher-card reveal" style="transition-delay: {{ $idx * 80 }}ms">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ $g[0] }}" alt="{{ $g[1] }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    </div>
                    <div class="p-5 text-center">
                        <h3 class="font-bold text-slate-800 mb-1">{{ $g[1] }}</h3>
                        <p class="text-sm font-medium" style="color:#10b981;">{{ $g[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── EKSTRAKURIKULER ─────────────────────── --}}
    <section id="ekstrakurikuler" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="unit-section-title block w-full">EKSTRAKURIKULER</h2>
                <p class="text-slate-500 mt-4 max-w-xl mx-auto">Program pengembangan diri untuk menggali potensi, minat, dan bakat kepemimpinan siswa.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $ekskul = [
                        ['icon'=>'tent','title'=>'Pramuka SIT','img'=>'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80','desc'=>'Melatih kemandirian, kedisiplinan, dan jiwa kepemimpinan dasar.'],
                        ['icon'=>'book-open','title'=>'Tahfidz Club','img'=>'https://images.unsplash.com/photo-1585995604802-17c3fe6b53aa?auto=format&fit=crop&w=600&q=80','desc'=>'Program pengayaan hafalan Al-Qur\'an secara intensif dan terstruktur.'],
                        ['icon'=>'crosshair','title'=>'Panahan','img'=>'https://images.unsplash.com/photo-1567699532083-f34b686df3af?auto=format&fit=crop&w=600&q=80','desc'=>'Melatih fokus, ketenangan, dan menjalankan sunnah Rasulullah SAW.'],
                        ['icon'=>'flask-conical','title'=>'Olimpiade Sains','img'=>'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=600&q=80','desc'=>'Bimbingan khusus bagi siswa berprestasi di bidang sains dan matematika.'],
                        ['icon'=>'dribbble','title'=>'Futsal','img'=>'https://images.unsplash.com/photo-1529474944862-1acebdcbab31?auto=format&fit=crop&w=600&q=80','desc'=>'Membangun kebugaran fisik, sportivitas, dan kerjasama tim.'],
                        ['icon'=>'palette','title'=>'Seni & Kaligrafi','img'=>'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&w=600&q=80','desc'=>'Mengembangkan kreativitas melalui seni rupa dan kaligrafi Islam.'],
                    ];
                @endphp
                @foreach($ekskul as $idx => $e)
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 reveal"
                     style="transition-delay: {{ ($idx % 3) * 100 }}ms; aspect-ratio: 4/3;">
                    <img src="{{ $e['img'] }}" alt="{{ $e['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 transition-opacity duration-300"
                         style="background: linear-gradient(to top, rgba(2,44,34,0.9) 0%, rgba(2,44,34,0.3) 60%, transparent 100%);">
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <div class="w-9 h-9 rounded-xl mb-3 flex items-center justify-center"
                             style="background: rgba(16,185,129,0.2); color:#6ee7b7; border:1px solid rgba(16,185,129,0.3);">
                            <i data-lucide="{{ $e['icon'] }}" class="w-4 h-4"></i>
                        </div>
                        <h3 class="font-bold text-white mb-1">{{ $e['title'] }}</h3>
                        <p class="text-sm text-slate-300 leading-snug max-h-0 group-hover:max-h-16 overflow-hidden transition-all duration-500">{{ $e['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── FASILITAS SECTION ───────────────────── --}}
    <section id="fasilitas" class="py-24"
             style="background: linear-gradient(135deg, #022c22 0%, #064e3b 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="unit-section-title light block w-full">FASILITAS</h2>
                <p class="mt-4 max-w-xl mx-auto" style="color: rgba(255,255,255,0.5);">
                    Sarana pendukung lengkap untuk proses belajar mengajar yang efektif dan menyenangkan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="grid grid-cols-2 gap-3 reveal reveal-left">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=400&q=80"
                         class="rounded-2xl object-cover w-full" style="height:200px;" alt="Ruang Kelas">
                    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=400&q=80"
                         class="rounded-2xl object-cover w-full" style="height:200px;" alt="Perpustakaan">
                    <img src="https://images.unsplash.com/photo-1629752187687-3d3c7ea3a21b?auto=format&fit=crop&w=400&q=80"
                         class="rounded-2xl object-cover w-full col-span-2" style="height:200px;" alt="Laboratorium">
                </div>
                <div class="reveal reveal-right">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach([
                            ['monitor','Ruang Kelas Nyaman'],['laptop','Laboratorium Komputer'],
                            ['library','Perpustakaan'],['moon','Musholla Luas'],
                            ['activity','Lapangan Olahraga'],['stethoscope','Klinik / UKS'],
                            ['coffee','Kantin Sehat'],['cctv','Keamanan CCTV']
                        ] as $f)
                        <div class="flex items-center gap-3 p-4 rounded-xl transition-colors duration-300 hover:bg-white/5"
                             style="border: 1px solid rgba(255,255,255,0.05);">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background: rgba(16,185,129,0.12); color: #10b981;">
                                <i data-lucide="{{ $f[0] }}" class="w-4 h-4"></i>
                            </div>
                            <span class="text-sm font-semibold text-slate-300">{{ $f[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── PRESTASI SECTION ────────────────────── --}}
    <section id="prestasi" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="unit-section-title block w-full">PRESTASI</h2>
                <p class="text-slate-500 mt-4 max-w-xl mx-auto">Bukti dedikasi dan kualitas pendidikan SMP IT Mutiara Qur'an di berbagai kompetisi.</p>
            </div>

            <div class="relative ml-6 md:ml-0 md:max-w-2xl md:mx-auto"
                 style="border-left: 2px solid rgba(16,185,129,0.2);">
                @php
                    $prestasi = [
                        ['2024','Juara 1 Olimpiade Sains Tingkat Provinsi','Kategori Matematika pada kompetisi antar SMP IT.'],
                        ['2023','Juara Umum MTQ Pelajar Tingkat Kabupaten','Kategori Tartil dan Tahfidz Al-Qur\'an.'],
                        ['2023','Juara 2 Lomba Debat Bahasa Arab','Kompetisi antar SMP Islam se-Provinsi.'],
                        ['2022','Regu Tergiat Pramuka Penggalang','Jambore Tingkat Kecamatan dan Kabupaten.'],
                    ];
                @endphp
                @foreach($prestasi as $idx => $p)
                <div class="relative pl-8 pb-10 unit-timeline-card reveal" style="transition-delay: {{ $idx * 100 }}ms">
                    <div class="unit-timeline-dot"></div>
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 hover:border-emerald-200 hover:shadow-lg transition-all duration-300">
                        <span class="inline-block px-3 py-1 text-xs font-bold rounded-full mb-3"
                              style="background: rgba(16,185,129,0.1); color: #059669;">{{ $p[0] }}</span>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $p[1] }}</h3>
                        <p class="text-sm text-slate-500">{{ $p[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@push('scripts')
<script>
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
</script>
@endpush

@endsection
