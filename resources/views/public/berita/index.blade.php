@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><span class="current">Berita & Kegiatan</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Berita & Kegiatan</h1>
            <p class="text-emerald-200/70 mt-3 max-w-lg">Informasi terbaru seputar kegiatan dan pencapaian SIT Mutiara Qur'an.</p>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            @php
                $beritaList = [
                    ['judul'=>'Wisuda Tahfidz Angkatan ke-8','tanggal'=>'10 Mei 2026','kategori'=>'Tahfidz','excerpt'=>'Sebanyak 45 siswa berhasil menyelesaikan target hafalan Al-Quran dan diwisuda dalam acara yang penuh kebanggaan.','color'=>'emerald'],
                    ['judul'=>'Juara Olimpiade Sains Tingkat Kota','tanggal'=>'28 April 2026','kategori'=>'Prestasi','excerpt'=>'Tim olimpiade sains SIT Mutiara Quran berhasil meraih juara 1 dan 3 dalam Olimpiade Sains tingkat Kota Bandung.','color'=>'blue'],
                    ['judul'=>'Pembukaan PPDB 2026/2027','tanggal'=>'15 April 2026','kategori'=>'Pengumuman','excerpt'=>'Pendaftaran peserta didik baru tahun ajaran 2026/2027 resmi dibuka untuk jenjang PAUD, SD, dan SMP Islam Terpadu.','color'=>'amber'],
                    ['judul'=>'Field Trip ke Museum Geologi','tanggal'=>'5 April 2026','kategori'=>'Kegiatan','excerpt'=>'Siswa kelas 4-6 melaksanakan field trip edukatif ke Museum Geologi Bandung sebagai bagian dari pembelajaran IPA.','color'=>'violet'],
                    ['judul'=>'Pelatihan Guru Kurikulum Merdeka','tanggal'=>'22 Maret 2026','kategori'=>'Akademik','excerpt'=>'Seluruh guru mengikuti pelatihan implementasi Kurikulum Merdeka yang diintegrasikan dengan nilai-nilai keislaman.','color'=>'cyan'],
                    ['judul'=>'Lomba Kaligrafi & MTQ Internal','tanggal'=>'10 Maret 2026','kategori'=>'Kegiatan','excerpt'=>'Ajang tahunan lomba kaligrafi dan musabaqah tilawatil Quran yang diikuti seluruh siswa dengan penuh semangat.','color'=>'rose'],
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritaList as $berita)
                <div class="news-card fade-up">
                    <div class="news-card-img flex items-center justify-center bg-gradient-to-br from-{{ $berita['color'] }}-100 to-{{ $berita['color'] }}-200">
                        <i data-lucide="newspaper" class="w-16 h-16 text-{{ $berita['color'] }}-300"></i>
                    </div>
                    <div class="news-card-body">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold text-{{ $berita['color'] }}-600 bg-{{ $berita['color'] }}-50 px-2.5 py-1 rounded-full">{{ $berita['kategori'] }}</span>
                            <span class="text-xs text-slate-400">{{ $berita['tanggal'] }}</span>
                        </div>
                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-2 leading-snug">{{ $berita['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ $berita['excerpt'] }}</p>
                        <a href="{{ route('public.berita.detail') }}" class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm hover:underline mt-2">
                            Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
