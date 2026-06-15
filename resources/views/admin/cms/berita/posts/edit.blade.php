@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">

    {{-- PAGE HEADER --}}
    <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('admin.berita.posts.index') }}"
            class="w-9 h-9 rounded-xl bg-white/80 dark:bg-slate-800/80 border border-slate-200 dark:border-slate-700
                   flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                   hover:bg-white dark:hover:bg-slate-700 transition-all shadow-sm no-underline">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <div>
            <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-0.5">Edit Berita</h1>
            <p class="text-sm text-slate-400 dark:text-slate-500">Perbarui artikel: <span class="font-semibold text-slate-600 dark:text-slate-300">{{ Str::limit($post->title, 60) }}</span></p>
        </div>
    </div>

    @if($errors->any())
    <div class="p-4 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30">
        <div class="flex items-center gap-2 text-red-700 dark:text-red-400 font-bold text-sm mb-2">
            <i data-lucide="alert-circle" class="w-4 h-4"></i>Terdapat kesalahan:
        </div>
        <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
            @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.berita.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- KOLOM KIRI (konten utama) --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- JUDUL & SLUG --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Informasi Utama</h2>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="field_title" value="{{ old('title', $post->title) }}" required
                            placeholder="Masukkan judul berita..."
                            oninput="autoSlug()"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em]">Slug</label>
                            <button type="button" onclick="toggleSlugEdit()" id="btn-slug-edit"
                                class="text-[11px] text-sky-500 font-semibold hover:underline cursor-pointer">Edit</button>
                        </div>
                        <input type="text" name="slug" id="field_slug" value="{{ old('slug', $post->slug) }}" readonly
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-100 dark:bg-slate-700/50 text-[13px] text-slate-500 dark:text-slate-400
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600
                                   focus:ring-2 focus:ring-sky-100 transition-all">
                        <p class="text-[11px] text-slate-400 mt-1">URL: <span class="text-slate-500 dark:text-slate-400">/berita/<span id="slug-preview">{{ old('slug', $post->slug) }}</span></span></p>
                    </div>
                </div>

                {{-- RINGKASAN --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ringkasan</h2>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">Excerpt / Ringkasan</label>
                        <textarea name="excerpt" rows="3" maxlength="500"
                            placeholder="Ringkasan singkat yang tampil di daftar berita (maks. 500 karakter)..."
                            oninput="document.getElementById('excerpt-count').textContent = this.value.length"
                            class="w-full px-3.5 py-3 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600
                                   focus:ring-2 focus:ring-sky-100 transition-all resize-none">{{ old('excerpt', $post->excerpt) }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-1"><span id="excerpt-count">{{ strlen(old('excerpt', $post->excerpt ?? '')) }}</span>/500 karakter</p>
                    </div>
                </div>

                {{-- ISI BERITA --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Isi Berita <span class="text-red-500">*</span></h2>
                    <div>
                        <textarea name="body" id="field_body" rows="16" required
                            placeholder="Tulis isi berita di sini..."
                            class="w-full px-3.5 py-3 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600
                                   focus:ring-2 focus:ring-sky-100 transition-all resize-y font-mono leading-relaxed">{{ old('body', $post->body) }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-1">Mendukung HTML dasar (bold, italic, paragraf, link).</p>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN --}}
            <div class="space-y-5">

                {{-- PUBLIKASI --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Publikasi</h2>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">Status <span class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 transition-all">
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">Tanggal Publish</label>
                        <input type="datetime-local" name="publish_date"
                            value="{{ old('publish_date', $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 transition-all">
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $post->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-slate-300 text-sky-500 focus:ring-sky-400 cursor-pointer">
                        <label for="is_active" class="text-[13px] font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">
                            Tampilkan di halaman publik
                        </label>
                    </div>

                    {{-- Info Views --}}
                    <div class="flex items-center gap-2 pt-2 border-t border-slate-100 dark:border-slate-700">
                        <i data-lucide="eye" class="w-4 h-4 text-slate-300 dark:text-slate-600"></i>
                        <span class="text-[12px] text-slate-400">{{ number_format($post->views_count) }} tayangan</span>
                    </div>
                </div>

                {{-- KATEGORI --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kategori</h2>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-[.04em] mb-1.5">Pilih Kategori <span class="text-red-500">*</span></label>
                        <select name="category_id" required
                            class="w-full h-11 px-3.5 border-[1.5px] border-slate-200 dark:border-slate-600 rounded-xl
                                   bg-slate-50 dark:bg-slate-700 text-[13px] text-slate-800 dark:text-slate-200
                                   outline-none focus:border-sky-400 focus:bg-white dark:focus:bg-slate-600 transition-all">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- COVER IMAGE --}}
                <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl p-6 shadow-sm space-y-4">
                    <h2 class="text-[13px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Cover Image</h2>

                    {{-- Preview gambar lama --}}
                    @if($post->featured_image)
                    <div id="current-img-wrap">
                        <p class="text-[11px] text-slate-400 mb-1.5 font-medium">Gambar saat ini:</p>
                        <img src="{{ Str::startsWith($post->featured_image,'http') ? $post->featured_image : asset('storage/'.$post->featured_image) }}"
                            alt="cover" id="current-img"
                            class="w-full rounded-xl object-cover max-h-40 border border-slate-100 dark:border-slate-700">
                    </div>
                    @endif

                    <div id="drop-zone"
                        class="border-[2px] border-dashed border-slate-200 dark:border-slate-600 rounded-xl p-5 text-center
                               hover:border-sky-300 dark:hover:border-sky-600 transition-colors cursor-pointer {{ $post->featured_image ? 'mt-3' : '' }}"
                        onclick="document.getElementById('featured_image').click()">
                        <div id="img-placeholder">
                            <i data-lucide="image-plus" class="w-7 h-7 text-slate-300 dark:text-slate-600 mx-auto mb-1.5"></i>
                            <p class="text-[12px] text-slate-400 font-medium">{{ $post->featured_image ? 'Ganti gambar' : 'Klik untuk upload' }}</p>
                            <p class="text-[11px] text-slate-300 dark:text-slate-600 mt-0.5">JPG, PNG, WEBP — maks. 2MB</p>
                        </div>
                        <img id="img-preview" src="" alt="preview" class="hidden w-full rounded-lg object-cover max-h-36">
                    </div>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        class="hidden" onchange="previewImage(this)">
                    <button type="button" id="btn-remove-img" onclick="removeImage()" class="hidden w-full text-[12px] text-red-500 font-semibold hover:underline cursor-pointer">
                        Batalkan pilihan gambar baru
                    </button>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="flex flex-col gap-2.5">
                    <button type="submit"
                        class="w-full h-11 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] border-none rounded-xl
                               text-[13px] font-bold text-white flex items-center justify-center gap-2
                               cursor-pointer shadow-md shadow-[#4D7EEB]/30 hover:opacity-90 transition-all">
                        <i data-lucide="save" class="w-4 h-4"></i>Perbarui Berita
                    </button>
                    <a href="{{ route('admin.berita.posts.preview', $post->id) }}" target="_blank"
                        class="w-full h-11 border-[1.5px] border-sky-200 dark:border-sky-800 bg-sky-50 dark:bg-sky-900/20
                               rounded-xl text-[13px] font-semibold text-sky-600 dark:text-sky-400
                               flex items-center justify-center gap-2 hover:bg-sky-100 dark:hover:bg-sky-900/40 transition-all no-underline">
                        <i data-lucide="external-link" class="w-4 h-4"></i>Preview Publik
                    </a>
                    <a href="{{ route('admin.berita.posts.index') }}"
                        class="w-full h-11 border-[1.5px] border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800
                               rounded-xl text-[13px] font-semibold text-slate-500 dark:text-slate-400
                               flex items-center justify-center hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                        Kembali ke Daftar
                    </a>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    let slugEditable = false;

    function autoSlug() {
        if (slugEditable) return;
        const title = document.getElementById('field_title').value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        document.getElementById('field_slug').value = slug;
        document.getElementById('slug-preview').textContent = slug || '...';
    }

    function toggleSlugEdit() {
        slugEditable = !slugEditable;
        const slugInput = document.getElementById('field_slug');
        const btn = document.getElementById('btn-slug-edit');
        if (slugEditable) {
            slugInput.readOnly = false;
            slugInput.classList.remove('bg-slate-100', 'dark:bg-slate-700/50');
            slugInput.classList.add('bg-white', 'dark:bg-slate-600');
            btn.textContent = 'Kunci';
            slugInput.addEventListener('input', () => {
                document.getElementById('slug-preview').textContent = slugInput.value || '...';
            });
        } else {
            slugInput.readOnly = true;
            slugInput.classList.add('bg-slate-100', 'dark:bg-slate-700/50');
            slugInput.classList.remove('bg-white', 'dark:bg-slate-600');
            btn.textContent = 'Edit';
        }
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img-placeholder').classList.add('hidden');
                const preview = document.getElementById('img-preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                document.getElementById('btn-remove-img').classList.remove('hidden');
                const cur = document.getElementById('current-img');
                if (cur) cur.style.opacity = '0.4';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        document.getElementById('featured_image').value = '';
        document.getElementById('img-preview').classList.add('hidden');
        document.getElementById('img-preview').src = '';
        document.getElementById('img-placeholder').classList.remove('hidden');
        document.getElementById('btn-remove-img').classList.add('hidden');
        const cur = document.getElementById('current-img');
        if (cur) cur.style.opacity = '1';
    }

    // Drag & drop
    const dropZone = document.getElementById('drop-zone');
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-sky-400'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('border-sky-400'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-sky-400');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('featured_image').files = dt.files;
            previewImage(document.getElementById('featured_image'));
        }
    });
</script>
@endpush
