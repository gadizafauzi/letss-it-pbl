<div id="tab-hero" class="tab-content block">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Hero Section (PPDB)</h2>
        <p class="text-sm text-slate-500">Bagian paling atas pada halaman PPDB — judul, deskripsi, gambar, dan tombol CTA.</p>
    </div>

    <form action="{{ route('admin.ppdb.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Kolom Kiri: Teks --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Utama</label>
                    <input type="text" name="title" value="{{ old('title', $hero->title) }}"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sub Judul / Deskripsi</label>
                    <textarea name="subtitle" rows="3"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('subtitle', $hero->subtitle) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Badge (Label atas judul)</label>
                    <p class="text-xs text-slate-500 mb-1">Contoh: "Pendaftaran Dibuka TA 2025/2026"</p>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol Utama</label>
                        <p class="text-xs text-slate-500 mb-1">Tombol kuning (Bawaan: Lihat Informasi PPDB)</p>
                        <input type="text" name="button_text" value="{{ old('button_text', $hero->button_text) }}"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tujuan Tombol Utama</label>
                        <p class="text-xs text-slate-500 mb-1">Pilih section tujuan saat tombol diklik</p>
                        <select name="button_link"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Section --</option>
                            <option value="#informasi" {{ old('button_link', $hero->button_link) == '#informasi' ? 'selected' : '' }}>📋 Informasi Unit (TK/SD/SMP)</option>
                            <option value="#timeline"  {{ old('button_link', $hero->button_link) == '#timeline'  ? 'selected' : '' }}>📅 Timeline Pendaftaran</option>
                            <option value="#alur"      {{ old('button_link', $hero->button_link) == '#alur'      ? 'selected' : '' }}>🔄 Alur Pendaftaran</option>
                            <option value="#syarat"    {{ old('button_link', $hero->button_link) == '#syarat'    ? 'selected' : '' }}>📝 Syarat Pendaftaran</option>
                            <option value="#faq"       {{ old('button_link', $hero->button_link) == '#faq'       ? 'selected' : '' }}>❓ FAQ PPDB</option>
                            <option value="#brosur"    {{ old('button_link', $hero->button_link) == '#brosur'    ? 'selected' : '' }}>📄 Brosur PPDB</option>
                            <option value="#kontak"    {{ old('button_link', $hero->button_link) == '#kontak'    ? 'selected' : '' }}>📞 Kontak Panitia</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol Kedua</label>
                        <p class="text-xs text-slate-500 mb-1">Tombol transparan (Bawaan: Download Brosur)</p>
                        <input type="text" name="button_secondary_text" value="{{ old('button_secondary_text', $hero->button_secondary_text) }}"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tujuan Tombol Kedua</label>
                        <p class="text-xs text-slate-500 mb-1">Pilih section tujuan saat tombol diklik</p>
                        <select name="button_secondary_link"
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Section --</option>
                            <option value="#informasi" {{ old('button_secondary_link', $hero->button_secondary_link) == '#informasi' ? 'selected' : '' }}>📋 Informasi Unit (TK/SD/SMP)</option>
                            <option value="#timeline"  {{ old('button_secondary_link', $hero->button_secondary_link) == '#timeline'  ? 'selected' : '' }}>📅 Timeline Pendaftaran</option>
                            <option value="#alur"      {{ old('button_secondary_link', $hero->button_secondary_link) == '#alur'      ? 'selected' : '' }}>🔄 Alur Pendaftaran</option>
                            <option value="#syarat"    {{ old('button_secondary_link', $hero->button_secondary_link) == '#syarat'    ? 'selected' : '' }}>📝 Syarat Pendaftaran</option>
                            <option value="#faq"       {{ old('button_secondary_link', $hero->button_secondary_link) == '#faq'       ? 'selected' : '' }}>❓ FAQ PPDB</option>
                            <option value="#brosur"    {{ old('button_secondary_link', $hero->button_secondary_link) == '#brosur'    ? 'selected' : '' }}>📄 Brosur PPDB</option>
                            <option value="#kontak"    {{ old('button_secondary_link', $hero->button_secondary_link) == '#kontak'    ? 'selected' : '' }}>📞 Kontak Panitia</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Gambar & Status --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Gambar Hero</label>
                    <p class="text-xs text-slate-500 mb-2">Ditampilkan di sisi kanan hero (rasio 4:3, maks 2MB)</p>
                    @if($hero->image)
                        <div class="mb-3">
                            <img src="{{ Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/' . $hero->image) }}"
                                alt="Hero PPDB"
                                class="h-40 w-full object-cover rounded-xl border border-slate-200 bg-slate-100">
                            <p class="text-xs text-slate-400 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-3">Preview Tombol Publik</p>
                    <div class="flex flex-wrap gap-2 text-xs">
                        <span class="px-3 py-1.5 bg-amber-400 text-amber-950 rounded-lg font-bold">
                            {{ $hero->button_text ?: 'Lihat Informasi PPDB' }}
                        </span>
                        <span class="px-3 py-1.5 bg-white/20 border border-white/30 text-white bg-emerald-700 rounded-lg font-bold">
                            {{ $hero->button_secondary_text ?: 'Download Brosur' }}
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="ppdb_hero_active" value="1"
                        {{ $hero->is_active ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="ppdb_hero_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan Hero Section</label>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Hero PPDB
            </button>
        </div>
    </form>
</div>
