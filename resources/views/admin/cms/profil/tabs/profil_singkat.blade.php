<div id="tab-profil-singkat" class="tab-content hidden">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Profil Singkat & Sambutan</h2>
            <p class="text-sm text-slate-500">Sesuaikan sambutan hangat, deskripsi profil singkat, dan foto pimpinan/kepala sekolah.</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.profil-singkat.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $paragraphsText = '';
            if ($welcomeMessage && $welcomeMessage->paragraphs) {
                $paras = is_array($welcomeMessage->paragraphs) ? $welcomeMessage->paragraphs : json_decode($welcomeMessage->paragraphs, true);
                $paragraphsText = implode("\n\n", $paras ?? []);
            }
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Kiri: Teks Profil & Sambutan --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Sambutan (Title)</label>
                    <input type="text" name="title" value="{{ old('title', $welcomeMessage->title ?? '') }}" placeholder="Contoh: Bismillahirrahmanirrahim," class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kalimat Salam (Greeting)</label>
                    <input type="text" name="greeting" value="{{ old('greeting', $welcomeMessage->greeting ?? '') }}" placeholder="Contoh: Assalamu'alaikum Warahmatullahi Wabarakatuh," class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Isi Paragraf Profil Singkat & Sambutan</label>
                    <textarea name="paragraphs" rows="8" placeholder="Tuliskan isi sambutan/profil singkat di sini. Pisahkan tiap paragraf dengan baris baru (Enter)." class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-blue-500 font-normal leading-relaxed">{{ old('paragraphs', $paragraphsText) }}</textarea>
                    <p class="text-xs text-slate-500 mt-1">Gunakan tombol <strong>Enter</strong> dua kali untuk memisahkan antar paragraf.</p>
                </div>
            </div>

            {{-- Kanan: Data Kepala Sekolah / Pimpinan & Foto --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Pimpinan / Kepala Sekolah</label>
                    <input type="text" name="kepsek_name" value="{{ old('kepsek_name', $welcomeMessage->kepsek_name ?? '') }}" placeholder="Contoh: Ustadz Ahmad Fauzi, S.Pd.I, M.Pd" class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jabatan / Peran</label>
                    <input type="text" name="kepsek_title" value="{{ old('kepsek_title', $welcomeMessage->kepsek_title ?? '') }}" placeholder="Contoh: Kepala Sekolah SIT Mutiara Qur'an" class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 text-sm focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Foto Pimpinan / Kepala Sekolah</label>
                    @if($welcomeMessage && $welcomeMessage->kepsek_photo)
                        <div class="mb-3 w-32 h-32 rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                            <img src="{{ str_starts_with($welcomeMessage->kepsek_photo, 'http') ? $welcomeMessage->kepsek_photo : asset('storage/' . $welcomeMessage->kepsek_photo) }}" 
                                 alt="Foto Kepsek" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=600';">
                        </div>
                    @endif
                    <input type="file" name="kepsek_photo" accept="image/*" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, WEBP (Max 2MB). Kosongkan jika tidak ingin mengganti foto.</p>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $welcomeMessage->is_active ?? true) ? 'checked' : '' }} id="profil_singkat_active" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <label for="profil_singkat_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">Tampilkan Profil Singkat ini di Halaman Publik</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end border-t border-slate-200 dark:border-slate-700 pt-6">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Profil Singkat
            </button>
        </div>
    </form>
</div>
