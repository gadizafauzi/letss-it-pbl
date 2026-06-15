<div class="p-6">
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
                    <div class="mb-4 relative w-full aspect-[21/9] rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-900 shadow-inner group">
                        <img src="{{ str_starts_with($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}" alt="Hero Image Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white text-[12px] font-medium bg-black/50 px-3 py-1.5 rounded-lg backdrop-blur-md">Preview Potongan Banner</span>
                        </div>
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
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Arahkan Tombol Ke</label>
                    <select name="button_link" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        <option value="">-- Pilih Tujuan Buka --</option>
                        <option value="#profil" {{ old('button_link', $hero->button_link ?? '') == '#profil' ? 'selected' : '' }}>Bagian Profil Unit</option>
                        <option value="#fasilitas" {{ old('button_link', $hero->button_link ?? '') == '#fasilitas' ? 'selected' : '' }}>Bagian Fasilitas</option>
                        <option value="#ekskul" {{ old('button_link', $hero->button_link ?? '') == '#ekskul' ? 'selected' : '' }}>Bagian Ekstrakurikuler</option>
                        <option value="#prestasi" {{ old('button_link', $hero->button_link ?? '') == '#prestasi' ? 'selected' : '' }}>Bagian Prestasi</option>
                        <option value="/ppdb" {{ old('button_link', $hero->button_link ?? '') == '/ppdb' ? 'selected' : '' }}>Halaman Pendaftaran (PPDB)</option>
                    </select>
                </div>
                
                {{-- Status Aktif --}}
                <div class="md:col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="hero_active" value="1" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 text-blue-500 border-slate-300 rounded focus:ring-blue-500">
                    <label for="hero_active" class="text-sm font-semibold text-slate-700 dark:text-slate-300 cursor-pointer">Tampilkan Hero Section ini di halaman publik</label>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan Perubahan Hero
                </button>
            </div>
        </div>
    </form>
</div>
