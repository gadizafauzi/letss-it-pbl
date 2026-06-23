@extends('layouts.public')
@section('content')
    <div class="page-hero">
        <div class="relative z-10 w-full">
            <div class="breadcrumb"><a href="{{ route('public.home') }}">Beranda</a><span>/</span><a href="{{ route('public.berita.index') }}">Berita</a><span>/</span><span class="current">Kategori</span></div>
            <h1 class="text-3xl sm:text-4xl font-black text-white">Kategori Berita</h1>
            <p class="text-emerald-200/70 mt-3">Jelajahi berita berdasarkan kategori.</p>
        </div>
    </div>
    <section class="public-section">
        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $displayCategories = [];
                    if (isset($categories) && !$categories->isEmpty()) {
                        foreach ($categories as $cat) {
                            $displayCategories[] = [
                                'icon' => $cat->icon ? $cat->icon : 'book-marked',
                                'title' => $cat->name,
                                'slug' => $cat->slug,
                                'count' => $cat->posts_count,
                                'color' => $cat->color ? $cat->color : 'emerald',
                            ];
                        }
                    }
                @endphp
                @if(!empty($displayCategories))
                @foreach($displayCategories as $k)
                <a href="{{ route('public.berita.category', $k['slug']) }}" class="feature-card flex items-center gap-4 fade-up">
                    <div class="w-14 h-14 rounded-2xl bg-{{ $k['color'] }}-50 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $k['icon'] }}" class="w-6 h-6 text-{{ $k['color'] }}-500"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[var(--theme-primary)]">{{ $k['title'] }}</h3>
                        <p class="text-sm text-slate-400">{{ $k['count'] }} artikel</p>
                    </div>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
