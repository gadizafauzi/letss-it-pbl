<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white">Hero Section</h2>
        <p class="text-sm text-slate-500">Atur tampilan utama (banner) yang akan dilihat pertama kali pengunjung di halaman unit ini.</p>
    </div>

    <form action="{{ route('admin.unit-cms.hero.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            {{-- Image Upload --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Gambar Background Hero</label>
                @if($hero && $hero->image)
                    <div class="mb-4 bg-slate-50 dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700">
                        <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}" alt="Hero Image" class="w-full max-w-lg h-auto rounded-lg shadow-sm">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                <p class="text-xs text-slate-500 mt-1">Rekomendasi ukuran: 1920x1080px (Landscape), max 2MB.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Judul Utama --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Utama (Title)</label>
                    <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}" placeholder="Contoh: Selamat Datang di SD IT Mutiara Qur'an" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>

                {{-- Subjudul --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Singkat (Subtitle)</label>
                    <textarea name="subtitle" rows="3" placeholder="Mencetak generasi rabbani yang berakhlak mulia..." class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
                </div>

                {{-- Teks Tombol --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Teks Tombol CTA</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $hero->button_text ?? '') }}" placeholder="Daftar Sekarang" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>

                {{-- Link Tombol --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Link Tombol CTA</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $hero->button_link ?? '') }}" placeholder="/ppdb" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>
                
                {{-- Status Aktif --}}
                <div class="md:col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="hero_active" value="1" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="hero_active" class="text-sm font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">Tampilkan Hero Section ini di halaman publik</label>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Perubahan Hero
                </button>
            </div>
        </div>
    </form>
</div>
