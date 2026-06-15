<div id="tab-brosur" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Brosur PPDB</h2>
            <p class="text-sm text-slate-500">Kelola file brosur (gambar/PDF) yang dapat diunduh oleh pengunjung.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-brosur')"
            class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Brosur
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($brochures as $brosur)
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-5 flex flex-col relative group shadow-sm hover:shadow-md transition-shadow">
            <div class="absolute top-4 right-4 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 dark:bg-slate-800/90 p-1 rounded-lg shadow-sm">
                <button type="button" onclick="editBrosur({{ json_encode($brosur) }})"
                    class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Edit">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                </button>
                <form action="{{ route('admin.ppdb.brochure.destroy', $brosur->id) }}" method="POST" class="contents"
                    onsubmit="return confirm('Yakin ingin menghapus brosur ini beserta file-nya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 flex items-center justify-center mb-4">
                <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <h3 class="text-base font-bold text-slate-800 dark:text-slate-100 mb-1 line-clamp-1">{{ $brosur->title }}</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-2 flex-grow">{{ $brosur->description }}</p>
            
            <div class="flex items-center justify-between text-xs border-t border-slate-100 dark:border-slate-700 pt-4">
                <span class="text-slate-500">Urutan: <strong>{{ $brosur->order }}</strong></span>
                @if($brosur->is_active)
                    <span class="px-2 py-0.5 font-semibold rounded-md bg-blue-50 text-blue-600">Aktif</span>
                @else
                    <span class="px-2 py-0.5 font-semibold rounded-md bg-slate-100 text-slate-600">Nonaktif</span>
                @endif
            </div>
            
            @php
                $path = $brosur->file_path;
                if (Str::startsWith($path, 'http')) {
                    $fileUrl = $path;
                } elseif (!str_contains($path, '/') && file_exists(public_path('images/' . $path))) {
                    // Jika path cuma nama file (dari seeder) dan ada di public/images
                    $fileUrl = asset('images/' . $path);
                } else {
                    $fileUrl = asset('storage/' . $path);
                }
            @endphp
            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                <a href="{{ $fileUrl }}" target="_blank" class="block w-full text-center py-2 bg-slate-50 hover:bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-xs font-semibold transition-colors">
                    <i data-lucide="external-link" class="w-3.5 h-3.5 inline-block mr-1"></i> Lihat File
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl text-slate-400">
            <i data-lucide="file-x-2" class="w-10 h-10 mb-2"></i>
            <p class="text-sm">Belum ada file brosur yang diunggah.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL TAMBAH BROSUR --}}
<div id="modal-add-brosur" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Brosur PPDB</h3>
            <button type="button" onclick="closeModal('modal-add-brosur')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.ppdb.brochure.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Brosur <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Brosur TK & SD"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" placeholder="Penjelasan singkat tentang isi brosur..."
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">File Brosur <span class="text-red-500">*</span></label>
                    <p class="text-xs text-slate-500 mb-2">Format: PDF, JPG, PNG, WEBP (Maks 5MB)</p>
                    <input type="file" name="file_path" required accept=".pdf,image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" value="{{ $brochures->count() + 1 }}" min="1" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="brosur_add_active" value="1" checked
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="brosur_add_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-brosur')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Upload Brosur</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT BROSUR --}}
<div id="modal-edit-brosur" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Brosur PPDB</h3>
            <button type="button" onclick="closeModal('modal-edit-brosur')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-brosur" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Brosur <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="edit_brosur_title" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="edit_brosur_description" rows="2"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Ganti File Brosur (Opsional)</label>
                    <p class="text-xs text-slate-500 mb-3">Biarkan kosong jika tidak ingin mengubah file lama.</p>
                    <input type="file" name="file_path" accept=".pdf,image/*"
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="edit_brosur_order" min="1" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="edit_brosur_active" value="1"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_brosur_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-brosur')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editBrosur(item) {
        let form = document.getElementById('form-edit-brosur');
        form.action = `/admin/cms/ppdb/brochure/${item.id}`;

        document.getElementById('edit_brosur_title').value       = item.title;
        document.getElementById('edit_brosur_description').value = item.description ?? '';
        document.getElementById('edit_brosur_order').value       = item.order;
        document.getElementById('edit_brosur_active').checked    = item.is_active == 1;

        openModal('modal-edit-brosur');
    }
</script>
@endpush
