@extends('layouts.public')

@section('content')

    <section class="min-h-[80vh] flex items-center justify-center px-4" style="padding-top:72px;">
        <div class="text-center fade-up">
            <div class="w-24 h-24 rounded-3xl bg-red-50 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="alert-triangle" class="w-12 h-12 text-red-400"></i>
            </div>
            <h1 class="text-7xl font-black text-[#003f88] mb-2">404</h1>
            <h2 class="text-xl font-bold text-slate-600 mb-4">Halaman Tidak Ditemukan</h2>
            <p class="text-slate-400 mb-8 max-w-md mx-auto">Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.</p>
            <a href="{{ route('public.home') }}"
                class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-slate-700 to-[#003f88] text-white font-bold shadow-lg shadow-slate-200 hover:-translate-y-1 transition-all duration-300">
                <i data-lucide="home" class="w-5 h-5"></i>
                Kembali ke Beranda
            </a>
        </div>
    </section>

@endsection
