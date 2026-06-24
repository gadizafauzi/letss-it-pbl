<div id="tab-jenjang" class="tab-content hidden">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Jenjang Pendidikan Image</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Kelola gambar untuk bagian Jenjang Pendidikan Kami.</p>
        </div>
    </div>

    <form action="{{ route('admin.beranda.jenjang_image.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-2xl">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gambar Saat Ini</label>
            @if(isset($jenjang_image) && $jenjang_image->value)
                <div class="w-full max-w-xs rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700">
                    <img src="{{ str_starts_with($jenjang_image->value, 'http') ? $jenjang_image->value : Storage::url($jenjang_image->value) }}" alt="Jenjang Pendidikan" class="w-full h-auto object-cover">
                </div>
            @else
                <div class="w-full max-w-xs h-48 rounded-xl border-2 border-dashed border-slate-300 dark:border-slate-600 flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-400">
                    <div class="text-center">
                        <i data-lucide="image" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>
                        <span class="text-sm">Belum ada gambar</span>
                    </div>
                </div>
            @endif
        </div>

        <div>
            <label for="jenjang_image" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Upload Gambar Baru <span class="text-red-500">*</span></label>
            <input type="file" name="image" id="jenjang_image" accept="image/*" required
                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-slate-300">
            <p class="mt-1.5 text-xs text-slate-500 dark:text-slate-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
        </div>

        <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
            <button type="submit" class="inline-flex justify-center rounded-xl bg-blue-600 py-2.5 px-6 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
