@extends('layouts.public')
@section('content')

    {{-- Custom Styles for Portal Berita --}}
    <style>
        /* Smooth transitions */
        .smooth-transition {
            transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Scrollbar hiding utility */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Premium News Card (Matching Home & Detail Aesthetic) */
        .premium-card {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #E5E7EB;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .premium-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 35px rgba(20, 61, 117, 0.08);
            border-color: rgba(255, 193, 7, 0.4);
        }
    </style>

    {{-- ===== HERO (Perfect Consistency with Home Hero) ===== --}}
    <section class="hero-section relative overflow-hidden flex items-center py-12 md:py-16">
        <div class="hero-overlay"></div>
        <div class="hero-pattern"></div>
        
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 pt-16 pb-8">
            {{-- Breadcrumb --}}
            <div class="breadcrumb mb-3 text-xs sm:text-sm text-slate-300/80 flex items-center gap-2">
                <a href="{{ route('public.home') }}" class="hover:text-[#FFC107] smooth-transition">Beranda</a>
                <span class="text-slate-500">/</span>
                @if(isset($category))
                    <a href="{{ route('public.berita.index') }}" class="hover:text-[#FFC107] smooth-transition">Berita &amp; Artikel</a>
                    <span class="text-slate-500">/</span>
                    <span class="text-white font-semibold">{{ $category->name }}</span>
                @else
                    <span class="text-white font-semibold">Berita &amp; Artikel</span>
                @endif
            </div>
            
            {{-- Title --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight">
                @if(isset($category))
                    Kategori: <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-400">{{ $category->name }}</span>
                @else
                    Berita <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-amber-400">&amp; Artikel</span>
                @endif
            </h1>
        </div>
    </section>

    {{-- ===== MAIN PORTAL CONTENT ===== --}}
    <section class="py-16 bg-[#F8FAFC] relative overflow-hidden min-h-screen">
        
        {{-- ===== DECORATIVE ORNAMENTS (Aesthetic Consistency) ===== --}}
        {{-- Top Right: Newspaper Icon --}}
        <div class="absolute top-12 right-0 translate-x-12 w-48 h-48 text-[#143D75] opacity-5 pointer-events-none select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                <path d="M18 14h-8M15 18h-5M10 6h8v4h-8V6Z"/>
            </svg>
        </div>
        
        {{-- Left Center: Book Open Icon --}}
        <div class="absolute top-1/3 left-0 -translate-x-8 w-36 h-36 text-[#FFC107] opacity-5 pointer-events-none select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2zM22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
        </div>

        {{-- Bottom Left: Graduation Cap / Islamic Star Shape --}}
        <div class="absolute bottom-16 left-8 w-28 h-28 text-[#143D75] opacity-5 pointer-events-none select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                <path d="M6 12.5v5a6 6 0 0 0 12 0v-5"/>
            </svg>
        </div>

        {{-- Bottom Right: Pencil and Notebook Shape --}}
        <div class="absolute bottom-32 right-8 w-32 h-32 text-[#FFC107] opacity-5 pointer-events-none select-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                <path d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
            </svg>
        </div>

        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 relative z-10">

            {{-- ===== CLEAN FILTER & SEARCH CONTROL PANEL ===== --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-[#E5E7EB] mb-12">
                <div class="flex flex-col gap-6">
                    
                    {{-- Row 1: Search on Left, Sort Dropdown on Right (Balanced & Elegant) --}}
                    <div class="flex flex-col md:flex-row gap-4 justify-between items-stretch md:items-center">
                        {{-- Search Input Form --}}
                        <form method="GET" action="{{ route('public.berita.index') }}" class="flex-grow max-w-xl">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            <div class="relative w-full">
                                <input type="text" 
                                       name="q" 
                                       value="{{ request('q') }}" 
                                       placeholder="Cari berita..." 
                                       class="w-full pl-11 pr-4 py-3 rounded-full border border-[#E5E7EB] bg-[#F8FAFC] text-[#143D75] placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#FFC107] focus:border-transparent smooth-transition text-sm" />
                                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-4.5 h-4.5"></i>
                            </div>
                        </form>

                        {{-- Sort Dropdown --}}
                        <form method="GET" action="{{ route('public.berita.index') }}" class="w-full md:w-64">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('q'))
                                <input type="hidden" name="q" value="{{ request('q') }}">
                            @endif
                            <div class="relative w-full">
                                <select name="sort" 
                                        onchange="this.form.submit()" 
                                        class="w-full pl-4 pr-10 py-3 rounded-full border border-[#E5E7EB] bg-[#F8FAFC] text-[#143D75] font-bold focus:outline-none focus:ring-2 focus:ring-[#FFC107] focus:border-transparent smooth-transition text-sm appearance-none cursor-pointer">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="most_viewed" {{ request('sort') == 'most_viewed' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                                    <option value="newest_added" {{ request('sort') == 'newest_added' ? 'selected' : '' }}>Paling Baru Ditambahkan</option>
                                </select>
                                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 w-4.5 h-4.5 pointer-events-none"></i>
                            </div>
                        </form>
                    </div>

                    {{-- Row 2: Clean, Single-Line Horizontal Scrollable Category Pills (Extremely Premium) --}}
                    <div class="border-t border-slate-100 pt-4 flex items-center gap-2 overflow-x-auto scrollbar-none py-1 -mx-6 px-6 md:mx-0 md:px-0">
                        {{-- 'Semua' Pill --}}
                        <a href="{{ route('public.berita.index', ['q' => request('q'), 'sort' => request('sort')]) }}"
                           class="flex-shrink-0 px-5 py-2 rounded-full text-xs font-black uppercase tracking-wider border smooth-transition {{ !request('category') ? 'bg-[#FFC107] text-[#143D75] border-[#FFC107] shadow-sm' : 'bg-white text-[#143D75] border-[#143D75] hover:bg-[#143D75] hover:text-white' }}">
                            Semua
                        </a>

                        {{-- Category Pills --}}
                        @foreach($categories as $cat)
                            <a href="{{ route('public.berita.index', ['category' => $cat->slug, 'q' => request('q'), 'sort' => request('sort')]) }}"
                               class="flex-shrink-0 px-5 py-2 rounded-full text-xs font-black uppercase tracking-wider border smooth-transition {{ (request('category') == $cat->slug) ? 'bg-[#FFC107] text-[#143D75] border-[#FFC107] shadow-sm' : 'bg-white text-[#143D75] border-[#143D75] hover:bg-[#143D75] hover:text-white' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- ===== BERITA GRID ===== --}}
            @php
                $displayPosts = [];
                if (isset($posts) && !$posts->isEmpty()) {
                    foreach ($posts as $post) {
                        $displayPosts[] = [
                            'judul'    => $post->title,
                            'slug'     => $post->slug,
                            'tanggal'  => \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d F Y'),
                            'kategori' => $post->category ? $post->category->name : 'Umum',
                            'excerpt'  => $post->excerpt,
                            'img'      => $post->featured_image
                                ? (Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image))
                                : 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80',
                        ];
                    }
                }
            @endphp

            @if(!empty($displayPosts))
                {{-- Active Filter Header (Matching Home Style with Yellow Curved Accent Line) --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10">
                    <div class="inline-block relative">
                        <h2 class="section-title mb-0 pb-0 text-[#143D75] after:hidden">
                            @if(isset($category))
                                Kategori: <span class="text-[#FFC107]">{{ $category->name }}</span>
                            @else
                                Semua Berita &amp; Artikel
                            @endif
                        </h2>
                        <svg class="section-accent-line absolute w-full h-4 -bottom-2.5 left-0 text-[#FFC107] z-0" viewBox="0 0 200 20" preserveAspectRatio="none" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round">
                            <path d="M5 15Q50 5 100 10T195 15" />
                        </svg>
                    </div>
                    <span class="text-sm text-slate-500 font-bold bg-white px-4 py-2 rounded-full border border-[#E5E7EB] shadow-sm self-start sm:self-auto">
                        {{ $posts->total() }} Artikel ditemukan
                    </span>
                </div>

                {{-- The Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($displayPosts as $i => $berita)
                        <article class="premium-card flex flex-col h-full smooth-transition">
                            
                            {{-- Image Container --}}
                            <div class="relative overflow-hidden h-48 sm:h-52 flex-shrink-0 group">
                                <img src="{{ $berita['img'] }}"
                                     alt="{{ $berita['judul'] }}"
                                     class="w-full h-full object-cover smooth-transition group-hover:scale-105 duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#143D75]/60 to-transparent"></div>

                                {{-- Category badge --}}
                                <span class="absolute top-4 left-4 text-[10px] font-black uppercase tracking-wider text-[#143D75] bg-[#FFC107] px-3 py-1.5 rounded-full shadow-sm">
                                    {{ $berita['kategori'] }}
                                </span>
                            </div>

                            {{-- Card Body --}}
                            <div class="flex flex-col flex-grow p-6">
                                {{-- Date with calendar icon --}}
                                <div class="flex items-center gap-2.5 text-xs text-slate-500 font-semibold mb-3">
                                    <div class="w-6 h-6 rounded-full bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                                        <i data-lucide="calendar" class="w-3 h-3"></i>
                                    </div>
                                    {{ $berita['tanggal'] }}
                                </div>

                                {{-- Title --}}
                                <h3 class="text-lg font-bold text-[#143D75] mb-3 leading-snug line-clamp-2 hover:text-[#FFC107] smooth-transition">
                                    <a href="{{ route('public.berita.detail', $berita['slug']) }}" class="no-underline">
                                        {{ $berita['judul'] }}
                                    </a>
                                </h3>

                                {{-- Excerpt --}}
                                <p class="text-sm text-slate-500 leading-relaxed flex-grow line-clamp-3 mb-6">
                                    {{ $berita['excerpt'] }}
                                </p>

                                {{-- Read more --}}
                                <div class="mt-auto pt-4 border-t border-[#E5E7EB]">
                                    <a href="{{ route('public.berita.detail', $berita['slug']) }}" 
                                       class="inline-flex items-center gap-2 text-sm font-extrabold text-[#143D75] hover:text-[#FFC107] smooth-transition group no-underline">
                                        Baca Selengkapnya
                                        <i data-lucide="arrow-right" class="w-4.5 h-4.5 smooth-transition group-hover:translate-x-1.5"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if(isset($posts) && method_exists($posts, 'links'))
                    <div class="mt-16 flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif

            @else
                {{-- Empty State --}}
                <div class="bg-white border border-[#E5E7EB] rounded-3xl text-center py-20 px-4 shadow-sm max-w-lg mx-auto">
                    <div class="w-20 h-20 rounded-full bg-[#143D75]/5 flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="newspaper" class="w-10 h-10 text-[#143D75]"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#143D75] mb-3">Tidak Ada Berita Ditemukan</h3>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto mb-8 leading-relaxed">
                        Kami tidak dapat menemukan berita yang cocok dengan kriteria pencarian atau kategori Anda saat ini.
                    </p>
                    <a href="{{ route('public.berita.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#143D75] text-white font-bold text-sm hover:bg-[#FFC107] hover:text-[#143D75] smooth-transition shadow-md shadow-[#143D75]/10">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i> Reset Pencarian
                    </a>
                </div>
            @endif

        </div>
    </section>

@endsection
