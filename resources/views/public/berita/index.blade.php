@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="breadcrumb">
                <a href="{{ route('public.home') }}">Beranda</a>
                <span>/</span>
                @if(isset($category))
                    <a href="{{ route('public.berita.index') }}">Berita & Kegiatan</a>
                    <span>/</span>
                    <span class="current">Kategori: {{ $category->name }}</span>
                @else
                    <span class="current">Berita & Kegiatan</span>
                @endif
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">
                @if(isset($category))
                    Kategori: {{ $category->name }}
                @else
                    Berita & Kegiatan
                @endif
            </h1>
            <p class="text-slate-200/70 mt-3 max-w-lg">Informasi terbaru seputar kegiatan dan pencapaian SIT Mutiara Qur'an.</p>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $displayPosts = [];
                if (isset($posts) && !$posts->isEmpty()) {
                    foreach ($posts as $post) {
                        $displayPosts[] = [
                            'judul' => $post->title,
                            'slug' => $post->slug,
                            'tanggal' => \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y'),
                            'kategori' => $post->category ? $post->category->name : 'Berita',
                            'color' => $post->category ? $post->category->color : 'blue',
                            'excerpt' => $post->excerpt,
                            'img' => $post->featured_image ? (Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80',
                        ];
                    }
                }
            @endphp
            @if(!empty($displayPosts))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($displayPosts as $berita)
                <div class="news-card fade-up group">
                    <div class="news-card-img relative overflow-hidden">
                        <img src="{{ $berita['img'] }}" alt="{{ $berita['judul'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                        <span class="absolute top-3 left-3 text-xs font-bold text-white bg-{{ $berita['color'] }}-500/90 backdrop-blur-sm px-2.5 py-1 rounded-full">{{ $berita['kategori'] }}</span>
                    </div>
                    <div class="news-card-body">
                        <span class="text-xs text-slate-400 block mb-2">{{ $berita['tanggal'] }}</span>
                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-2 leading-snug">{{ $berita['judul'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed mb-4">{{ $berita['excerpt'] }}</p>
                        <a href="{{ route('public.berita.detail', $berita['slug']) }}" class="inline-flex items-center gap-1 text-[#003f88] font-bold text-sm hover:underline mt-2">
                            Lihat Detail <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if(isset($posts) && method_exists($posts, 'links'))
                <div class="mt-12 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
