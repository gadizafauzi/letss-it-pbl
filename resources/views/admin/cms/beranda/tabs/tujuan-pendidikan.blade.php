<div id="tab-tujuan-pendidikan" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tujuan Pendidikan</h2>
            <p class="text-sm text-slate-500">Alasan mengapa memilih Mutiara Qur'an.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-tujuan-pendidikan')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Tujuan Pendidikan
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold w-20">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Isi Tujuan Pendidikan</th>
                    <th class="px-4 py-3 font-semibold w-24">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($tujuanPendidikans as $tujuanPendidikan)
                <tr>
                    <td class="px-4 py-3">{{ $tujuanPendidikan->order }}</td>
                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-200">
                        {{ $tujuanPendidikan->description ?: $tujuanPendidikan->title }}
                    </td>
                    <td class="px-4 py-3">
                        @if($tujuanPendidikan->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" onclick="editTujuanPendidikan({{ json_encode($tujuanPendidikan) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.beranda.tujuan_pendidikan.destroy', $tujuanPendidikan->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data tujuan pendidikan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH TUJUAN PENDIDIKAN --}}
<div id="modal-add-tujuan-pendidikan" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Tujuan Pendidikan</h3>
            <button type="button" onclick="closeModal('modal-add-tujuan-pendidikan')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.beranda.tujuan_pendidikan.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <!-- Hidden default values -->
                <input type="hidden" name="title" value="Tujuan Pendidikan">
                <input type="hidden" name="icon" value="check-circle">
                <input type="hidden" name="bg_color" value="amber">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Isi Tujuan Pendidikan</label>
                    <textarea name="description" rows="4" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan paragraf tujuan pendidikan di sini..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="tujuan_pendidikan_active_add" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="tujuan_pendidikan_active_add" class="text-sm text-slate-700">Aktifkan Tujuan Pendidikan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-tujuan-pendidikan')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT TUJUAN PENDIDIKAN --}}
<div id="modal-edit-tujuan-pendidikan" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Tujuan Pendidikan</h3>
            <button type="button" onclick="closeModal('modal-edit-tujuan-pendidikan')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-tujuan-pendidikan" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <!-- Hidden default values -->
                <input type="hidden" name="title" id="edit_keu_title" value="Tujuan Pendidikan">
                <input type="hidden" name="icon" id="edit_keu_icon" value="check-circle">
                <input type="hidden" name="bg_color" id="edit_keu_color" value="amber">

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Isi Tujuan Pendidikan</label>
                    <textarea name="description" id="edit_keu_desc" rows="4" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan paragraf tujuan pendidikan di sini..."></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_keu_order" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_keu_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_keu_active" class="text-sm text-slate-700">Aktifkan Tujuan Pendidikan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-tujuan-pendidikan')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editTujuanPendidikan(keu) {
        let form = document.getElementById('form-edit-tujuan-pendidikan');
        form.action = `/admin/cms/beranda/tujuan-pendidikan/${keu.id}`;
        
        document.getElementById('edit_keu_title').value = keu.title;
        document.getElementById('edit_keu_desc').value = keu.description;
        document.getElementById('edit_keu_icon').value = keu.icon;
        document.getElementById('edit_keu_color').value = keu.bg_color;
        document.getElementById('edit_keu_order').value = keu.order;
        document.getElementById('edit_keu_active').checked = keu.is_active == 1;
        
        openModal('modal-edit-tujuan-pendidikan');
    }
</script>
@endpush
