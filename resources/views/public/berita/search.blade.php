@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.berita.index') }}">Berita</a><span>/</span><span class="current">Pencarian</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Cari Berita</h1>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-3xl mx-auto">
            <form class="mb-12 fade-up">
                <div class="relative">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" class="contact-input pl-14 py-5 text-base" placeholder="Cari berita, kegiatan, pengumuman...">
                </div>
            </form>
            <div class="text-center fade-up">
                <div class="w-20 h-20 rounded-3xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="search" class="w-10 h-10 text-slate-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-600 mb-2">Masukkan kata kunci</h3>
                <p class="text-sm text-slate-400">Ketik kata kunci untuk mencari berita yang Anda inginkan.</p>
            </div>
        </div>
    </section>
@endsection
