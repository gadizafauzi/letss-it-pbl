<div id="tab-alur" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Alur Pendaftaran</h2>
            <p class="text-sm text-slate-500">Kelola langkah-langkah panduan pendaftaran PPDB.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-alur')"
            class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Alur
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Langkah</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul & Deskripsi</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($steps as $step)
                <tr>
                    <td class="px-4 py-3 font-bold text-slate-600 dark:text-slate-400">{{ $step->order }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold">
                            {{ $step->step_number }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-800 dark:text-slate-200">{{ $step->title }}</div>
                        @if($step->description)
                            <div class="text-xs text-slate-500 mt-0.5 line-clamp-2" title="{{ $step->description }}">
                                {{ Str::limit($step->description, 80) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($step->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="editAlur({{ json_encode($step) }})"
                                class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <form action="{{ route('admin.ppdb.step.destroy', $step->id) }}" method="POST"
                                class="contents"
                                onsubmit="return confirm('Yakin ingin menghapus alur \'{{ addslashes($step->title) }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="list-ordered" class="w-8 h-8 text-slate-300"></i>
                            <span class="text-sm">Belum ada data alur pendaftaran. Klik <strong>Tambah Alur</strong> untuk memulai.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH ALUR --}}
<div id="modal-add-alur" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Alur Pendaftaran</h3>
            <button type="button" onclick="closeModal('modal-add-alur')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.ppdb.step.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Angka Langkah <span class="text-red-500">*</span></label>
                    <input type="number" name="step_number" value="{{ $steps->count() + 1 }}" required min="1"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Alur <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Mengisi Formulir"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Jelaskan langkah ini secara singkat..."
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" value="{{ $steps->count() + 1 }}" min="1" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="alur_add_active" value="1" checked
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="alur_add_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-alur')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT ALUR --}}
<div id="modal-edit-alur" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Alur Pendaftaran</h3>
            <button type="button" onclick="closeModal('modal-edit-alur')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-alur" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Angka Langkah <span class="text-red-500">*</span></label>
                    <input type="number" name="step_number" id="edit_alur_step_number" required min="1"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Alur <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="edit_alur_title" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="description" id="edit_alur_description" rows="3"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="edit_alur_order" min="1" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="edit_alur_active" value="1"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_alur_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-alur')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editAlur(item) {
        let form = document.getElementById('form-edit-alur');
        form.action = `/admin/cms/ppdb/step/${item.id}`;

        document.getElementById('edit_alur_step_number').value = item.step_number;
        document.getElementById('edit_alur_title').value       = item.title;
        document.getElementById('edit_alur_description').value = item.description ?? '';
        document.getElementById('edit_alur_order').value       = item.order;
        document.getElementById('edit_alur_active').checked    = item.is_active == 1;

        openModal('modal-edit-alur');
    }
</script>
@endpush
