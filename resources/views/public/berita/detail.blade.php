@extends('layouts.public')
@section('content')

<style>
/* ============================================
   DETAIL BERITA — Compact Professional Layout
   ============================================ */

/* ---- Hero: compact ~200px ---- */
.detail-hero {
    padding-top: calc(72px + 1rem);
    padding-bottom: 72px;   /* space for card overlap */
    min-height: 200px;
    display: flex;
    align-items: flex-end;
    position: relative;
    overflow: hidden;
}

/* ---- Floating white card ---- */
.detail-card {
    position: relative;
    z-index: 20;
    margin: -60px auto 80px;
    width: 90%;
    max-width: 1150px;
    background: #ffffff;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(20, 61, 117, 0.09), 0 2px 8px rgba(0,0,0,0.04);
    border: 1px solid rgba(229, 231, 235, 0.7);
    padding: 2.5rem 3rem;
}

@media (max-width: 900px) {
    .detail-card { width: 94%; padding: 1.75rem 1.5rem; }
}

@media (max-width: 600px) {
    .detail-hero { padding-bottom: 58px; min-height: 175px; }
    .detail-card { width: 96%; padding: 1.25rem 1rem; border-radius: 18px; margin-top: -50px; }
}

/* ---- Title inside card ---- */
.detail-card .article-title {
    font-size: clamp(24px, 3.5vw, 40px);
    font-weight: 800;
    color: #143D75;
    line-height: 1.25;
    letter-spacing: -0.02em;
    margin-bottom: 12px;
}

/* ---- Metadata row ---- */
.detail-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0;
    margin-bottom: 24px;
    padding-bottom: 20px;
    border-bottom: 1px solid #f1f5f9;
}

.detail-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #94a3b8;
    font-size: 14px;
    font-weight: 500;
    padding: 0 18px;
    border-right: 1px solid #e2e8f0;
}
.detail-meta-item:first-child { padding-left: 0; }
.detail-meta-item:last-child  { border-right: none; }

@media (max-width: 480px) {
    .detail-meta-item { padding: 0 10px; font-size: 12px; }
}

/* ---- Featured image: centered 67% ---- */
.detail-featured-img {
    width: 67%;
    max-width: 760px;
    margin: 0 auto 2rem;
    border-radius: 12px;
    overflow: hidden;
    aspect-ratio: 16 / 9;
    box-shadow: 0 4px 20px rgba(20, 61, 117, 0.07);
    border: 1px solid #e5e7eb;
}
.detail-featured-img img { width: 100%; height: 100%; object-fit: cover; }

@media (max-width: 700px) {
    .detail-featured-img { width: 100%; }
}

/* ---- Article body ---- */
.detail-body {
    width: 90%;
    max-width: 860px;
    margin: 0 auto;
    font-size: 17.5px;
    line-height: 1.9;
    color: #374151;
}
.detail-body p  { margin-bottom: 1.35em; }
.detail-body h2 { font-size: 1.3em; font-weight: 800; color: #143D75; margin: 1.6em 0 0.5em; }
.detail-body h3 { font-size: 1.15em; font-weight: 700; color: #143D75; margin: 1.4em 0 0.4em; }
.detail-body ul,
.detail-body ol { padding-left: 1.5em; margin-bottom: 1.1em; }
.detail-body li { margin-bottom: 0.35em; }
.detail-body blockquote {
    border-left: 4px solid #FFC107;
    padding: 0.6em 1.1em;
    background: #fffbea;
    border-radius: 0 8px 8px 0;
    color: #64748b;
    margin: 1.4em 0;
    font-style: italic;
}
.detail-body a { color: #143D75; text-decoration: underline; }

@media (max-width: 700px) {
    .detail-body { width: 100%; font-size: 16px; }
}

/* ---- Related cards ---- */
.related-card {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #E5E7EB;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    transition: all 0.28s ease;
}
.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(20, 61, 117, 0.09);
    border-color: rgba(255, 193, 7, 0.45);
}
</style>

{{-- =============================
     HERO — compact ~200px
     ============================= --}}
<section class="detail-hero hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-pattern"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-1.5 text-xs text-white/55 font-medium mb-3">
            <a href="{{ route('public.home') }}" class="hover:text-[#FFC107] transition-colors">Beranda</a>
            <span class="text-white/30">/</span>
            <a href="{{ route('public.berita.index') }}" class="hover:text-[#FFC107] transition-colors">Berita</a>
            <span class="text-white/30">/</span>
            <span class="text-white/75 line-clamp-1 max-w-[200px]">{{ Str::limit($post->title, 38) }}</span>
        </nav>

        <h1 class="text-2xl sm:text-3xl font-black text-white leading-tight tracking-tight">
            Detail <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-400">Berita</span>
        </h1>
    </div>
</section>

{{-- =============================
     PAGE BODY
     ============================= --}}
<div class="bg-[#F8FAFC]" style="padding-bottom:4rem;">

    {{-- Subtle background ornaments --}}
    <div class="fixed top-1/3 left-4 w-24 h-24 pointer-events-none select-none" style="opacity:0.05; color:#FFC107; z-index:0;">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/>
        </svg>
    </div>

    {{-- =========================================================
         FLOATING ARTICLE CARD
         ========================================================= --}}
    <article class="detail-card">

        {{-- 1. Title --}}
        <h1 class="article-title">{{ $post->title }}</h1>

        {{-- 2. Metadata: Date | Author | Views --}}
        <div class="detail-meta">
            <div class="detail-meta-item flex items-center gap-2.5 text-slate-600">
                <div class="w-6 h-6 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 shadow-sm">
                    <i data-lucide="calendar" class="w-3 h-3"></i>
                </div>
                <span>{{ \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="detail-meta-item flex items-center gap-2.5 text-slate-600">
                <div class="w-6 h-6 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0 shadow-sm">
                    <i data-lucide="user" class="w-3 h-3"></i>
                </div>
                <span>{{ $post->author ? $post->author->name : 'Admin' }}</span>
            </div>
            @if($post->views_count)
            <div class="detail-meta-item flex items-center gap-2.5 text-slate-600">
                <div class="w-6 h-6 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0 shadow-sm">
                    <i data-lucide="eye" class="w-3 h-3"></i>
                </div>
                <span>{{ number_format($post->views_count) }} Dilihat</span>
            </div>
            @endif
        </div>

        {{-- 3. Featured Image --}}
        @if($post->featured_image)
            <div class="detail-featured-img">
                <img src="{{ Str::startsWith($post->featured_image, 'http')
                        ? $post->featured_image
                        : asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}" loading="lazy">
            </div>
        @else
            <div class="detail-featured-img flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                <i data-lucide="image" class="w-12 h-12 text-slate-300"></i>
            </div>
        @endif

        {{-- 4. Article Body --}}
        <div class="detail-body">
            {!! $post->body !!}
        </div>

        {{-- Back link --}}
        <div class="mt-10 pt-5 border-t border-slate-100"
             style="width:90%; max-width:860px; margin-left:auto; margin-right:auto;">
            <a href="{{ route('public.berita.index') }}"
               class="inline-flex items-center gap-2 text-[#143D75] font-bold text-sm hover:text-[#FFC107] transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                Kembali ke Portal Berita
            </a>
        </div>
    </article>

    {{-- =========================================================
         RELATED NEWS
         ========================================================= --}}
    @if(isset($relatedPosts) && !$relatedPosts->isEmpty())
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12" style="padding-bottom:2rem;">
            <div style="width:90%; max-width:1150px; margin:0 auto;">

                <div class="mb-8">
                    <div class="inline-block relative">
                        <h2 class="section-title mb-0 pb-0 after:hidden" style="color:#143D75;">
                            Berita &amp; Artikel <span style="color:#FFC107;">Terkait</span>
                        </h2>
                        <svg class="section-accent-line absolute w-full h-4 left-0 text-[#FFC107]"
                             style="bottom:-10px;"
                             viewBox="0 0 200 20" preserveAspectRatio="none"
                             fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                            <path d="M5 15Q50 5 100 10T195 15"/>
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-10">
                    @foreach($relatedPosts as $rPost)
                        <a href="{{ route('public.berita.detail', $rPost->slug) }}"
                           class="related-card flex flex-col no-underline group">
                            <div class="relative overflow-hidden flex-shrink-0" style="height:160px;">
                                <img src="{{ $rPost->featured_image
                                    ? (Str::startsWith($rPost->featured_image, 'http')
                                        ? $rPost->featured_image
                                        : asset('storage/' . $rPost->featured_image))
                                    : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80' }}"
                                     alt="{{ $rPost->title }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#143D75]/40 to-transparent"></div>
                                <span class="absolute top-3 left-3 text-[9px] font-black uppercase tracking-wider text-[#143D75] bg-[#FFC107] px-2.5 py-1 rounded-full">
                                    {{ $rPost->category ? $rPost->category->name : 'Umum' }}
                                </span>
                            </div>
                            <div class="p-4 flex flex-col flex-grow">
                                <span class="text-slate-400 text-xs font-semibold mb-1.5 block">
                                    {{ \Carbon\Carbon::parse($rPost->publish_date)->translatedFormat('d F Y') }}
                                </span>
                                <h3 class="text-sm sm:text-base font-bold leading-snug line-clamp-2 transition-colors"
                                    style="color:#143D75;">
                                    {{ $rPost->title }}
                                </h3>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    @endif

</div>

@endsection
