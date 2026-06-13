<div id="tab-keunggulan" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Keunggulan</h2>
            <p class="text-sm text-slate-500">Alasan mengapa memilih Mutiara Qur'an.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-keunggulan')" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Keunggulan
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Ikon & Warna</th>
                    <th class="px-4 py-3 font-semibold">Judul Keunggulan</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($keunggulans as $keunggulan)
                <tr>
                    <td class="px-4 py-3">{{ $keunggulan->order }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-{{ $keunggulan->bg_color }}-100 text-{{ $keunggulan->bg_color }}-600">
                                <i data-lucide="{{ $keunggulan->icon }}" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs text-slate-500">{{ $keunggulan->bg_color }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-200">
                        {{ $keunggulan->title }}
                        <div class="text-xs text-slate-500 mt-0.5 line-clamp-1" title="{{ $keunggulan->description }}">{{ Str::limit($keunggulan->description, 50) }}</div>
                    </td>
                    <td class="px-4 py-3">
                        @if($keunggulan->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-700">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" onclick="editKeunggulan({{ json_encode($keunggulan) }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                            <i data-lucide="edit" class="w-4 h-4"></i>
                        </button>
                        <form action="{{ route('admin.beranda.keunggulan.destroy', $keunggulan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus keunggulan ini?')">
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
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada data keunggulan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH KEUNGGULAN --}}
<div id="modal-add-keunggulan" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Keunggulan</h3>
            <button type="button" onclick="closeModal('modal-add-keunggulan')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.beranda.keunggulan.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Keunggulan</label>
                    <input type="text" name="title" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon)</label>
                        <input type="text" name="icon" value="check-circle" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Warna Background</label>
                        <select name="bg_color" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="blue">blue</option>
                            <option value="blue">Blue</option>
                            <option value="indigo">Indigo</option>
                            <option value="purple">Purple</option>
                            <option value="rose">Rose</option>
                            <option value="amber">Amber</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="keunggulan_active_add" value="1" checked class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="keunggulan_active_add" class="text-sm text-slate-700">Aktifkan Keunggulan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-keunggulan')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT KEUNGGULAN --}}
<div id="modal-edit-keunggulan" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-2xl p-6 shadow-xl relative my-auto">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Keunggulan</h3>
            <button type="button" onclick="closeModal('modal-edit-keunggulan')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-keunggulan" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Keunggulan</label>
                    <input type="text" name="title" id="edit_keu_title" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="edit_keu_desc" rows="2" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Lucide icon)</label>
                        <input type="text" name="icon" id="edit_keu_icon" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Warna Background</label>
                        <select name="bg_color" id="edit_keu_color" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="blue">blue</option>
                            <option value="blue">Blue</option>
                            <option value="indigo">Indigo</option>
                            <option value="purple">Purple</option>
                            <option value="rose">Rose</option>
                            <option value="amber">Amber</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" id="edit_keu_order" required class="w-full rounded-xl border border-slate-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="is_active" id="edit_keu_active" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_keu_active" class="text-sm text-slate-700">Aktifkan Keunggulan</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-keunggulan')" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editKeunggulan(keu) {
        let form = document.getElementById('form-edit-keunggulan');
        form.action = `/admin/cms/beranda/keunggulan/${keu.id}`;
        
        document.getElementById('edit_keu_title').value = keu.title;
        document.getElementById('edit_keu_desc').value = keu.description;
        document.getElementById('edit_keu_icon').value = keu.icon;
        document.getElementById('edit_keu_color').value = keu.bg_color;
        document.getElementById('edit_keu_order').value = keu.order;
        document.getElementById('edit_keu_active').checked = keu.is_active == 1;
        
        openModal('modal-edit-keunggulan');
    }
</script>
@endpush
