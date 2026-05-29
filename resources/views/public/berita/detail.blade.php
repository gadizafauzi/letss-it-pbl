@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.berita.index') }}">Berita</a><span>/</span><span class="current">Detail</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Detail Berita</h1>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-3xl mx-auto">
            <div class="fade-up">
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Tahfidz</span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-800 mt-4 mb-3">Wisuda Tahfidz Angkatan ke-8</h1>
                <div class="flex items-center gap-4 text-sm text-slate-400 mb-8">
                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-4 h-4"></i> 10 Mei 2026</span>
                    <span class="flex items-center gap-1"><i data-lucide="user" class="w-4 h-4"></i> Admin</span>
                </div>
                <div class="w-full aspect-video rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-200 flex items-center justify-center mb-8">
                    <i data-lucide="image" class="w-20 h-20 text-emerald-300"></i>
                </div>
                <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed space-y-4">
                    <p>Sebanyak 45 siswa SIT Mutiara Qur'an berhasil menyelesaikan target hafalan Al-Qur'an dan diwisuda dalam acara yang penuh kebanggaan dan rasa syukur.</p>
                    <p>Acara wisuda tahfidz ini merupakan angkatan ke-8 yang diselenggarakan setiap tahun sebagai bentuk apresiasi terhadap pencapaian siswa-siswi dalam menghafal Al-Qur'an.</p>
                    <p>Para wisudawan terdiri dari siswa SD dan SMP yang telah menyelesaikan hafalan mulai dari 3 juz hingga 10 juz. Mereka telah melalui proses muraja'ah dan ujian yang ketat.</p>
                    <p>Kepala Sekolah, Ustadz Ahmad Fauzi, dalam sambutannya menyampaikan rasa bangga dan berharap pencapaian ini bisa menjadi motivasi bagi siswa lainnya.</p>
                </div>
                <div class="mt-10 pt-8 border-t border-slate-200">
                    <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-2 text-emerald-600 font-bold text-sm hover:underline">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
