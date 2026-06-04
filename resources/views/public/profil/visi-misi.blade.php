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
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-up">
                    <div class="w-full aspect-[4/3] rounded-3xl bg-gradient-to-br from-emerald-100 to-emerald-200 flex items-center justify-center">
                        <i data-lucide="user-circle" class="w-32 h-32 text-emerald-300"></i>
                    </div>
                </div>
                <div class="fade-up">
                    <span class="section-badge"><i data-lucide="quote" class="w-4 h-4"></i> Sambutan Kepala Sekolah</span>
                    <h2 class="section-title mb-4">Assalamu'alaikum Warahmatullahi Wabarakatuh</h2>
                    <p class="text-slate-500 leading-relaxed mb-4">
                        Puji syukur kepada Allah SWT atas nikmat yang tak terhingga. SIT Mutiara Qur'an hadir sebagai lembaga pendidikan Islam Terpadu yang berkomitmen mendidik generasi Qur'ani.
                    </p>
                    <p class="text-slate-500 leading-relaxed mb-6">
                        Kami berupaya menghadirkan lingkungan belajar yang kondusif, kurikulum yang terintegrasi antara ilmu pengetahuan umum dan keislaman, serta pembinaan akhlak yang berkelanjutan.
                    </p>
                    <p class="font-bold text-slate-800">Ustadz Ahmad Fauzi, S.Pd.I, M.Pd</p>
                    <p class="text-sm text-slate-400">Kepala Sekolah SIT Mutiara Qur'an</p>
                </div>
            </div>
        </div>
    </section>

    {{-- VISI & MISI --}}
    <section class="public-section bg-slate-50">
        <div class="w-full">
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
