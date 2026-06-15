<div id="tab-hero" class="tab-content hidden">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Hero Section Profil</h2>
            <p class="text-sm text-slate-500">Sesuaikan tampilan bagian atas (hero) halaman profil sekolah.</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Judul Utama</label>
                    <input type="text" name="title" value="{{ $hero->title }}" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Sub Judul</label>
                    <textarea name="subtitle" rows="3" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">{{ $hero->subtitle }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gambar Background / Hero</label>
                    @if($hero->image)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}" alt="Hero Image" class="w-full h-40 object-cover rounded-lg border border-slate-200">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <input type="checkbox" name="is_active" value="1" {{ $hero->is_active ? 'checked' : '' }} id="hero_active" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <label for="hero_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">Tampilkan Section Ini</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end border-t border-slate-200 dark:border-slate-700 pt-6">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-lg shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
