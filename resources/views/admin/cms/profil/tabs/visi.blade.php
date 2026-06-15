<div id="tab-visi" class="tab-content hidden">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Visi Sekolah</h2>
            <p class="text-sm text-slate-500">Kelola teks visi utama sekolah.</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.visi.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Teks Visi</label>
                <textarea name="text" rows="5" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" required>{{ $visi->text }}</textarea>
                <p class="text-xs text-slate-500 mt-1">Masukkan kalimat visi sekolah secara lengkap.</p>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <input type="checkbox" name="is_active" value="1" {{ $visi->is_active ? 'checked' : '' }} id="visi_active" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <label for="visi_active" class="text-sm font-medium text-slate-700 dark:text-slate-300">Tampilkan Visi Ini</label>
            </div>
        </div>

        <div class="flex justify-end border-t border-slate-200 dark:border-slate-700 pt-6">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-lg shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Visi
            </button>
        </div>
    </form>
</div>
