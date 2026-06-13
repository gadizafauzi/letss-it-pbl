        <div id="tab-hero" class="tab-content block">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Hero Section (Home)</h2>
                <p class="text-sm text-slate-500">Bagian paling atas pada halaman beranda.</p>
            </div>
            <form action="{{ route('admin.beranda.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Utama</label>
                            <input type="text" name="title" value="{{ old('title', $hero->title) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sub Judul</label>
                            <textarea name="subtitle" rows="3" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('subtitle', $hero->subtitle) }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol 1 (Kiri)</label>
                                <p class="text-xs text-slate-500 mb-2">Tombol utama warna kuning (Bawaan: Daftar PPDB Online)</p>
                                <input type="text" name="button_text" value="{{ old('button_text', $hero->button_text) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link Tujuan Tombol 1</label>
                                <p class="text-xs text-slate-500 mb-2">Pilih halaman tujuan saat tombol diklik</p>
                                <select name="button_link" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Tidak ada link --</option>
                                    <option value="/ppdb" {{ old('button_link', $hero->button_link) == '/ppdb' ? 'selected' : '' }}>Halaman PPDB</option>
                                    <option value="/profil" {{ old('button_link', $hero->button_link) == '/profil' ? 'selected' : '' }}>Halaman Profil Sekolah</option>
                                    <option value="/berita" {{ old('button_link', $hero->button_link) == '/berita' ? 'selected' : '' }}>Halaman Berita</option>
                                    <option value="/unit/tk" {{ old('button_link', $hero->button_link) == '/unit/tk' ? 'selected' : '' }}>Halaman Unit TK</option>
                                    <option value="/unit/sd" {{ old('button_link', $hero->button_link) == '/unit/sd' ? 'selected' : '' }}>Halaman Unit SD</option>
                                    <option value="/unit/smp" {{ old('button_link', $hero->button_link) == '/unit/smp' ? 'selected' : '' }}>Halaman Unit SMP</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Tombol 2 (Kanan)</label>
                                <p class="text-xs text-slate-500 mb-2">Tombol transparan (Bawaan: Profil Sekolah)</p>
                                <input type="text" name="button_secondary_text" value="{{ old('button_secondary_text', $hero->button_secondary_text) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Link Tujuan Tombol 2</label>
                                <p class="text-xs text-slate-500 mb-2">Pilih halaman tujuan saat tombol diklik</p>
                                <select name="button_secondary_link" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Tidak ada link --</option>
                                    <option value="/ppdb" {{ old('button_secondary_link', $hero->button_secondary_link) == '/ppdb' ? 'selected' : '' }}>Halaman PPDB</option>
                                    <option value="/profil" {{ old('button_secondary_link', $hero->button_secondary_link) == '/profil' ? 'selected' : '' }}>Halaman Profil Sekolah</option>
                                    <option value="/berita" {{ old('button_secondary_link', $hero->button_secondary_link) == '/berita' ? 'selected' : '' }}>Halaman Berita</option>
                                    <option value="/unit/tk" {{ old('button_secondary_link', $hero->button_secondary_link) == '/unit/tk' ? 'selected' : '' }}>Halaman Unit TK</option>
                                    <option value="/unit/sd" {{ old('button_secondary_link', $hero->button_secondary_link) == '/unit/sd' ? 'selected' : '' }}>Halaman Unit SD</option>
                                    <option value="/unit/smp" {{ old('button_secondary_link', $hero->button_secondary_link) == '/unit/smp' ? 'selected' : '' }}>Halaman Unit SMP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Teks Badge (Label atas)</label>
                            <input type="text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Gambar/Ilustrasi</label>
                            @if($hero->image)
                                <img src="{{ Str::startsWith($hero->image, 'http') ? $hero->image : asset('storage/'.$hero->image) }}" alt="Hero" class="h-32 object-contain bg-slate-100 rounded-lg mb-2">
                            @endif
                            <input type="file" name="image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="flex items-center gap-2 mt-6">
                            <input type="checkbox" name="is_active" id="hero_active" value="1" {{ $hero->is_active ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                            <label for="hero_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan Hero Section</label>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors">Simpan Hero</button>
                </div>
            </form>
        </div>
