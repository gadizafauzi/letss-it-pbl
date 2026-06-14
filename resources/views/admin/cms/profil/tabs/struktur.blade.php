<div id="tab-struktur" class="tab-content hidden">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Struktur Organisasi</h2>
            <p class="text-sm text-slate-500">Kelola gambar struktur organisasi sekolah.</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.struktur.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="space-y-4 max-w-2xl">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gambar Struktur Organisasi</label>
                
                @if($struktur && $struktur->value)
                    <div class="mb-4 bg-slate-50 dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700">
                        <img src="{{ str_starts_with($struktur->value, 'http') ? $struktur->value : asset('storage/' . $struktur->value) }}" alt="Struktur Organisasi" class="max-w-full h-auto rounded-lg shadow-sm">
                    </div>
                @else
                    <div class="mb-4 p-6 bg-slate-50 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl flex flex-col items-center justify-center text-slate-500">
                        <i data-lucide="image" class="w-10 h-10 mb-2 text-slate-400"></i>
                        <p class="text-sm">Belum ada gambar struktur organisasi</p>
                    </div>
                @endif
                
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500" {{ !$struktur || !$struktur->value ? 'required' : '' }}>
                <p class="text-xs text-slate-500 mt-2">Format yang didukung: JPG, PNG, WEBP. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar saat ini.</p>
            </div>
        </div>

        <div class="flex border-t border-slate-200 dark:border-slate-700 pt-6">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                Upload & Simpan
            </button>
        </div>
    </form>
</div>
