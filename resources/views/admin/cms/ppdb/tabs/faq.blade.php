<div id="tab-faq" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">FAQ PPDB</h2>
            <p class="text-sm text-slate-500">Kelola pertanyaan yang sering diajukan khusus seputar pendaftaran.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-faq')"
            class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah FAQ
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold w-16">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Pertanyaan & Jawaban</th>
                    <th class="px-4 py-3 font-semibold w-24">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($faqs as $faq)
                <tr>
                    <td class="px-4 py-3 font-bold text-slate-600 dark:text-slate-400">{{ $faq->order }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-800 dark:text-slate-200 mb-1">{{ $faq->question }}</div>
                        <div class="text-xs text-slate-500 line-clamp-2" title="{{ $faq->answer }}">
                            {{ Str::limit($faq->answer, 120) }}
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        @if($faq->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="editFaq({{ json_encode($faq) }})"
                                class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <form action="{{ route('admin.ppdb.faq.destroy', $faq->id) }}" method="POST"
                                class="contents"
                                onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
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
                    <td colspan="4" class="px-4 py-10 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="help-circle" class="w-8 h-8 text-slate-300"></i>
                            <span class="text-sm">Belum ada data FAQ PPDB. Klik <strong>Tambah FAQ</strong> untuk memulai.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH FAQ --}}
<div id="modal-add-faq" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah FAQ PPDB</h3>
            <button type="button" onclick="closeModal('modal-add-faq')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.ppdb.faq.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Pertanyaan <span class="text-red-500">*</span></label>
                    <input type="text" name="question" required placeholder="Contoh: Kapan pendaftaran ditutup?"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jawaban <span class="text-red-500">*</span></label>
                    <textarea name="answer" rows="4" required placeholder="Tuliskan jawaban yang detail..."
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" value="{{ $faqs->count() + 1 }}" min="1" required
                        class="w-full md:w-1/3 rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="faq_add_active" value="1" checked
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="faq_add_active" class="text-sm text-slate-700 dark:text-slate-300">Aktifkan FAQ ini</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-faq')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT FAQ --}}
<div id="modal-edit-faq" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit FAQ PPDB</h3>
            <button type="button" onclick="closeModal('modal-edit-faq')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-faq" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Pertanyaan <span class="text-red-500">*</span></label>
                    <input type="text" name="question" id="edit_faq_question" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jawaban <span class="text-red-500">*</span></label>
                    <textarea name="answer" id="edit_faq_answer" rows="4" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan Tampil <span class="text-red-500">*</span></label>
                    <input type="number" name="order" id="edit_faq_order" min="1" required
                        class="w-full md:w-1/3 rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_faq_active" value="1"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_faq_active" class="text-sm text-slate-700 dark:text-slate-300">Aktifkan FAQ ini</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-faq')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editFaq(item) {
        let form = document.getElementById('form-edit-faq');
        form.action = `/admin/cms/ppdb/faq/${item.id}`;

        document.getElementById('edit_faq_question').value = item.question;
        document.getElementById('edit_faq_answer').value   = item.answer;
        document.getElementById('edit_faq_order').value    = item.order;
        document.getElementById('edit_faq_active').checked = item.is_active == 1;

        openModal('modal-edit-faq');
    }
</script>
@endpush
