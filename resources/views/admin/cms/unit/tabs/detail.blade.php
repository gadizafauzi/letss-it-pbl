<div class="p-6">
    <div class="mb-6">
        <h2 class="text-lg font-bold text-slate-800 dark:text-white">Detail Unit</h2>
        <p class="text-sm text-slate-500">Atur deskripsi, logo, usia target, dan informasi kuota untuk unit pendidikan ini.</p>
    </div>

    <form action="{{ route('admin.unit-cms.detail.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Logo Unit --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Logo Unit Sekolah (Opsional)</label>
                @if($detail && $detail->description_logo)
                    <div class="mb-4 bg-slate-50 dark:bg-slate-800 p-4 rounded-xl border border-slate-200 dark:border-slate-700 w-32 h-32 flex items-center justify-center">
                        <img src="{{ str_starts_with($detail->description_logo, 'http') ? $detail->description_logo : asset('storage/' . $detail->description_logo) }}" alt="Logo" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                <input type="file" name="description_logo" accept="image/*" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
            </div>

            {{-- Judul Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Judul Deskripsi</label>
                <input type="text" name="description_title" value="{{ old('description_title', $detail->description_title ?? '') }}" placeholder="Mengenal Lebih Dekat SD IT Mutiara Qur'an" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>

            {{-- Isi Deskripsi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Isi Deskripsi</label>
                <textarea name="description_body" rows="5" placeholder="Tuliskan profil singkat tentang unit pendidikan ini..." class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">{{ old('description_body', $detail->description_body ?? '') }}</textarea>
            </div>

            {{-- Target Usia --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Target Usia Siswa</label>
                <input type="text" name="target_age" value="{{ old('target_age', $detail->target_age ?? '') }}" placeholder="Contoh: 6 - 12 Tahun" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>

            {{-- Kuota Penerimaan --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kuota Penerimaan</label>
                <input type="text" name="quota" value="{{ old('quota', $detail->quota ?? '') }}" placeholder="Contoh: 60 Siswa / Tahun" class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-slate-50 dark:bg-slate-800 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
            </div>
        </div>

        <div class="flex justify-end pt-6 mt-6 border-t border-slate-100 dark:border-slate-700">
            <button type="submit" class="px-6 py-2.5 bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-medium rounded-xl shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Deskripsi Unit
            </button>
        </div>
    </form>
</div>
