@extends('layouts.public')

@section('content')

    {{-- HERO --}}
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                <span class="current">Visi & Misi</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Visi & Misi</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Arah dan tujuan pendidikan SIT Mutiara Qur'an dalam membentuk generasi Qur'ani.</p>
        </div>
    </div>

    {{-- SAMBUTAN --}}
    <section class="public-section islamic-pattern-bg relative overflow-hidden">
        <div class="glow-emerald top-10 left-10"></div>
        <div class="w-full max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                {{-- Kolom Foto --}}
                <div class="lg:col-span-5 flex justify-center fade-up">
                    <div class="sambutan-wrapper max-w-sm w-full">
                        <div class="sambutan-avatar-container">
                            <div class="sambutan-avatar-bg"></div>
                            <div class="sambutan-image-frame">
                                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600"
                                     alt="Kepala Sekolah SIT Mutiara Qur'an"
                                     class="w-full h-96 object-cover object-top">
                                <div class="sambutan-badge">Kepala Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Teks --}}
                <div class="lg:col-span-7 fade-up">
                    <span class="section-badge"><i data-lucide="quote" class="w-4 h-4"></i> Sambutan Kepala Sekolah</span>
                    <h2 class="section-title text-left mb-5">Assalamu'alaikum Warahmatullahi Wabarakatuh</h2>

                    <div class="space-y-4 text-slate-600 leading-relaxed text-sm sm:text-base">
                        <p class="font-bold text-slate-800 text-lg">Bismillahirrahmanirrahim,</p>
                        <p>
                            Puji syukur kepada Allah SWT, Shalawat dan Salam senantiasa tercurah kepada Baginda Nabi Muhammad SAW. Selamat datang di portal resmi <strong>SIT Mutiara Qur'an Nagari Cupak</strong>.
                        </p>
                        <p>
                            Sebagai lembaga pendidikan Islam terpadu, kami berkomitmen untuk melahirkan generasi Qur'an yang seimbang secara spiritual, intelektual, dan moral. Kami berupaya menghadirkan lingkungan belajar yang kondusif, kurikulum terintegrasi antara ilmu pengetahuan umum dan keislaman, serta pembinaan akhlak yang berkelanjutan.
                        </p>
                        <p>
                            Dengan dukungan asatidzah yang berkompeten dan fasilitas yang kondusif, kami siap berkolaborasi erat dengan para orang tua untuk mendampingi tumbuh kembang putra-putri tercinta menjadi calon pemimpin umat yang berakhlak mulia.
                        </p>
                    </div>

                    <div class="mt-8 border-t border-slate-100 pt-6">
                        <h4 class="text-base font-extrabold text-slate-800">Ustadz Ahmad Fauzi, S.Pd.I, M.Pd</h4>
                        <p class="text-xs font-semibold text-emerald-600 uppercase tracking-widest mt-1">Pimpinan & Kepala Sekolah SIT Mutiara Qur'an</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section class="public-section bg-slate-50">
        <div class="w-full max-w-7xl mx-auto">
            <div class="text-center mb-14 fade-up">
                <span class="section-badge"><i data-lucide="target" class="w-4 h-4"></i> Visi & Misi</span>
                <h2 class="section-title mx-auto">Arah & Tujuan Pendidikan Kami</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- VISI --}}
                <div class="feature-card bg-gradient-to-br from-emerald-600 to-emerald-700 border-0 fade-up">
                    <div class="feature-icon bg-white/20 text-white">
                        <i data-lucide="eye" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Visi</h3>
                    <p class="text-emerald-100 leading-relaxed text-lg font-medium">
                        "Menjadi lembaga pendidikan Islam terpadu yang unggul dalam membentuk generasi Qur'ani, berakhlak mulia, cerdas, dan berdaya saing global."
                    </p>
                </div>

                {{-- MISI --}}
                <div class="feature-card fade-up">
                    <div class="feature-icon bg-emerald-50 text-emerald-600">
                        <i data-lucide="list-checks" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[var(--theme-primary)] mb-4">Misi</h3>
                    <ul class="space-y-3">
                        @php
                            $misi = [
                                'Menyelenggarakan pendidikan yang mengintegrasikan kurikulum nasional dan keislaman.',
                                'Menumbuhkan kecintaan terhadap Al-Quran melalui program tahfidz.',
                                'Membina akhlak mulia dan karakter islami pada seluruh peserta didik.',
                                'Mengembangkan potensi akademik, minat, dan bakat siswa secara optimal.',
                                'Menciptakan lingkungan belajar yang aman, nyaman, dan kondusif.',
                                'Membangun kerjasama yang baik antara sekolah, orang tua, dan masyarakat.',
                            ];
                        @endphp
                        @foreach($misi as $item)
                            <li class="flex items-start gap-3 text-sm text-slate-600 leading-relaxed">
                                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                </span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
