@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.berita.index') }}">Berita</a><span>/</span><span class="current">Pencarian</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Cari Berita</h1>
        </div>
    </div>
    <section class="public-section">
        <div class="max-w-5xl mx-auto">
            <form action="{{ route('public.berita.search') }}" method="GET" class="mb-12 fade-up">
                <div class="relative">
                    <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="q" value="{{ $q ?? '' }}" class="contact-input pl-14 py-5 text-base" placeholder="Cari berita, kegiatan, pengumuman...">
                </div>
            </form>

            @if(isset($q) && $q !== '')
                @if(isset($posts) && !$posts->isEmpty())
                    <h2 class="text-xl font-bold text-slate-800 mb-6">Hasil Pencarian untuk: "{{ $q }}"</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                        @php
                            $tanggal = \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y');
                            $kategori = $post->category ? $post->category->name : 'Berita';
                            $color = $post->category ? $post->category->color : 'emerald';
                            $img = $post->featured_image ? (Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80';
                        @endphp
                        <div class="news-card fade-up group">
                            <div class="news-card-img relative overflow-hidden">
                                <img src="{{ $img }}" alt="{{ $post->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                                <span class="absolute top-3 left-3 text-xs font-bold text-white bg-{{ $color }}-500/90 backdrop-blur-sm px-2.5 py-1 rounded-full">{{ $kategori }}</span>
                            </div>
                            <div class="news-card-body">
                                <span class="text-xs text-slate-400 block mb-2">{{ $tanggal }}</span>
                                <h3 class="text-base font-bold text-[var(--theme-primary)] mb-2 leading-snug">{{ $post->title }}</h3>
                                <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ $post->excerpt }}</p>
                                <a href="{{ route('public.berita.detail', $post->slug) }}" class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm hover:underline mt-2">
                                    Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center fade-up mt-12 py-12">
                        <div class="w-20 h-20 rounded-3xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="frown" class="w-10 h-10 text-slate-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-600 mb-2">Tidak ada hasil ditemukan</h3>
                        <p class="text-sm text-slate-400">Tidak dapat menemukan berita dengan kata kunci "{{ $q }}". Coba cari kata kunci lain.</p>
                    </div>
                @endif
            @else
                <div class="text-center fade-up py-12">
                    <div class="w-20 h-20 rounded-3xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="search" class="w-10 h-10 text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-600 mb-2">Masukkan kata kunci</h3>
                    <p class="text-sm text-slate-400">Ketik kata kunci untuk mencari berita yang Anda inginkan.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
