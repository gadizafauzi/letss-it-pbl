@extends('layouts.admin')

@section('content')
<div class="space-y-5">

    {{-- PAGE HEADER --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
        <div>
            <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">Berita & Kegiatan</h1>
            <p class="text-sm text-slate-400 dark:text-slate-500">Kelola artikel berita dan kegiatan sekolah.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.berita.kategori.index') }}"
                class="inline-flex items-center gap-2 h-[42px] px-4 rounded-xl text-[13px] font-semibold text-slate-600 dark:text-slate-300
                       bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm no-underline">
                <i data-lucide="tag" class="w-4 h-4 text-slate-400"></i>Kategori
            </a>
            <a href="{{ route('admin.berita.posts.create') }}"
                class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                       bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 transition-all no-underline">
                <i data-lucide="plus" class="w-4 h-4"></i>Tambah Berita
            </a>
        </div>
    </div>

    {{-- TOAST --}}
    @if(session('success'))
        <div id="toast-success"
            class="fixed bottom-8 right-8 z-50 flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl shadow-green-500/20
                  bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 transition-all duration-500">
            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 flex-shrink-0">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
            </div>
            <div class="mr-4">
                <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">Berhasil!</h4>
                <p class="text-[13px] text-slate-600 dark:text-slate-400 mt-0.5">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <i data-lucide="x" class="w-[18px] h-[18px]"></i>
            </button>
        </div>
        <script>setTimeout(() => { const t = document.getElementById('toast-success'); if(t) t.remove(); }, 4000);</script>
    @endif

    {{-- FILTER --}}
    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
        <form id="filterForm" action="{{ route('admin.berita.posts.index') }}" method="GET"
            class="flex flex-wrap items-center gap-2.5">
            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px]">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari judul berita..."
                    class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                           bg-sky-50 dark:bg-slate-700 text-[13px] text-slate-700 dark:text-slate-200 outline-none
                           focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 focus:ring-2 focus:ring-sky-100 transition-all">
            </div>
            {{-- Kategori --}}
            <select name="category" onchange="this.form.submit()"
                class="h-[42px] px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                       bg-sky-50 dark:bg-slate-700 text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-[160px]
                       focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 transition-all">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
            {{-- Status --}}
            <select name="status" onchange="this.form.submit()"
                class="h-[42px] px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                       bg-sky-50 dark:bg-slate-700 text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-[140px]
                       focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 transition-all">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            @if(request()->hasAny(['search','category','status']))
            <a href="{{ route('admin.berita.posts.index') }}"
                class="h-[42px] px-4 rounded-[10px] text-[13px] font-semibold text-slate-500 dark:text-slate-400
                       bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-600 transition-all inline-flex items-center gap-1.5 no-underline">
                <i data-lucide="x" class="w-3.5 h-3.5"></i>Reset
            </a>
            @endif
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] border-collapse">
                <thead>
                    <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 w-[70px]">Cover</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Judul</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 min-w-[110px]">Kategori</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 min-w-[90px]">Penulis</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 min-w-[90px]">Status</th>
                        <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400 min-w-[100px]">Publish Date</th>
                        <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Views</th>
                        <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    @php
                        $isPublished = $post->status === 'published';
                        $isActive    = $post->is_active;
                        $catColor    = $post->category->color ?? 'slate';
                    @endphp
                    <tr class="border-b border-slate-100 dark:border-slate-700/50 hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                        {{-- Cover --}}
                        <td class="px-4 py-3">
                            @if($post->featured_image)
                            <div class="w-[60px] h-[42px] rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-700 flex-shrink-0">
                                <img src="{{ Str::startsWith($post->featured_image,'http') ? $post->featured_image : asset('storage/'.$post->featured_image) }}"
                                    alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="w-[60px] h-[42px] rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="image" class="w-5 h-5 text-slate-300 dark:text-slate-600"></i>
                            </div>
                            @endif
                        </td>
                        {{-- Judul --}}
                        <td class="px-4 py-3 max-w-[260px]">
                            <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200 leading-snug line-clamp-2">{{ $post->title }}</div>
                            @if($post->excerpt)
                            <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $post->excerpt }}</div>
                            @endif
                        </td>
                        {{-- Kategori --}}
                        <td class="px-4 py-3">
                            @if($post->category)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold
                                         bg-{{ $catColor }}-100 text-{{ $catColor }}-700 dark:bg-{{ $catColor }}-500/20 dark:text-{{ $catColor }}-400">
                                @if($post->category->icon)
                                <i data-lucide="{{ $post->category->icon }}" class="w-3 h-3"></i>
                                @endif
                                {{ $post->category->name }}
                            </span>
                            @else
                            <span class="text-[12px] text-slate-300 dark:text-slate-600">—</span>
                            @endif
                        </td>
                        {{-- Penulis --}}
                        <td class="px-4 py-3 text-[13px] text-slate-500 dark:text-slate-400">
                            {{ $post->author?->name ?? '—' }}
                        </td>
                        {{-- Status --}}
                        <td class="px-4 py-3">
                            <div class="flex flex-col gap-1">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold w-fit
                                    {{ $isPublished
                                        ? 'bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-400'
                                        : 'bg-slate-100 text-slate-500 dark:bg-slate-700 dark:text-slate-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $isPublished ? 'bg-sky-500' : 'bg-slate-400' }}"></span>
                                    {{ $isPublished ? 'Published' : 'Draft' }}
                                </span>
                                @if(!$isActive)
                                <span class="text-[10px] text-slate-400 dark:text-slate-500 font-medium">Tidak Aktif</span>
                                @endif
                            </div>
                        </td>
                        {{-- Publish Date --}}
                        <td class="px-4 py-3 text-[12px] text-slate-500 dark:text-slate-400 whitespace-nowrap">
                            {{ $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->translatedFormat('d M Y') : '—' }}
                        </td>
                        {{-- Views --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400">
                                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                <span class="text-[13px] font-bold">{{ number_format($post->views_count) }}</span>
                            </div>
                        </td>
                        {{-- Aksi --}}
                        <td class="px-4 py-3">
                            <div class="flex justify-center gap-1.5">
                                {{-- Preview --}}
                                <a href="{{ route('admin.berita.posts.preview', $post->id) }}" target="_blank"
                                    class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                                           hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:border-emerald-200 dark:hover:border-emerald-800
                                           text-emerald-500 dark:text-emerald-400 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                    title="Preview">
                                    <i data-lucide="eye" class="w-[14px] h-[14px]"></i>
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('admin.berita.posts.edit', $post->id) }}"
                                    class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                                           hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-200 dark:hover:border-blue-800
                                           text-blue-500 dark:text-blue-400 transition-all inline-flex items-center justify-center shadow-sm no-underline"
                                    title="Edit">
                                    <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                </a>
                                {{-- Hapus --}}
                                <form action="{{ route('admin.berita.posts.destroy', $post->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus berita \'{{ addslashes($post->title) }}\'?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                                               hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-200 dark:hover:border-red-800
                                               text-red-500 dark:text-red-400 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="flex flex-col items-center justify-center py-16 text-center">
                                <div class="w-20 h-20 bg-sky-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                                    <i data-lucide="newspaper" class="w-9 h-9 text-sky-300 dark:text-sky-700"></i>
                                </div>
                                <h3 class="text-base font-bold text-slate-700 dark:text-slate-300 mb-1">
                                    {{ request()->hasAny(['search','category','status']) ? 'Tidak Ada Hasil' : 'Belum Ada Berita' }}
                                </h3>
                                <p class="text-sm text-slate-400 mb-4">
                                    {{ request()->hasAny(['search','category','status']) ? 'Coba ubah filter pencarian Anda.' : 'Mulai tulis artikel berita pertama.' }}
                                </p>
                                @unless(request()->hasAny(['search','category','status']))
                                <a href="{{ route('admin.berita.posts.create') }}"
                                    class="inline-flex items-center gap-2 h-[38px] px-4 rounded-xl text-[13px] font-bold text-white
                                           bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md transition-all no-underline">
                                    <i data-lucide="plus" class="w-4 h-4"></i>Tambah Berita
                                </a>
                                @endunless
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BOTTOM BAR --}}
        @if($posts->total() > 0)
        <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">Tampilkan</span>
                <select name="per_page" form="filterForm" onchange="document.getElementById('filterForm').submit()"
                    class="h-[36px] px-2 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-lg
                           bg-sky-50 dark:bg-slate-700 text-[13px] font-bold text-slate-700 dark:text-slate-200 outline-none
                           focus:border-sky-400 dark:focus:border-blue-500 transition-all cursor-pointer">
                    @foreach([15, 25, 50] as $n)
                    <option value="{{ $n }}" {{ request('per_page', 15) == $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
                <span class="text-[13px] font-semibold text-slate-500 dark:text-slate-400">dari <strong>{{ $posts->total() }}</strong> berita</span>
            </div>
            @if($posts->hasPages())
            <div class="w-full sm:w-auto overflow-x-auto">
                {{ $posts->links() }}
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        let debounce;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(debounce);
                debounce = setTimeout(() => document.getElementById('filterForm').submit(), 500);
            });
        }
    });
</script>
@endpush
