<div id="tab-timeline" class="tab-content hidden">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Timeline Pendaftaran</h2>
            <p class="text-sm text-slate-500">Kelola tahapan dan jadwal PPDB yang tampil di halaman publik.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-timeline')"
            class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-medium hover:bg-blue-700 flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Tahap
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                <tr>
                    <th class="px-4 py-3 rounded-l-xl font-semibold w-16">Urutan</th>
                    <th class="px-4 py-3 font-semibold">Judul & Deskripsi</th>
                    <th class="px-4 py-3 font-semibold">Tanggal / Periode</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Aktif</th>
                    <th class="px-4 py-3 rounded-r-xl font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                @forelse($timelines as $item)
                <tr>
                    <td class="px-4 py-3 font-bold text-slate-600 dark:text-slate-400">{{ $item->order }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-slate-800 dark:text-slate-200">{{ $item->title }}</div>
                        @if($item->description)
                            <div class="text-xs text-slate-500 mt-0.5 line-clamp-2" title="{{ $item->description }}">
                                {{ Str::limit($item->description, 80) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                        <span class="text-xs font-medium">{{ $item->date_range }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @php
                            $statusColor = match(strtolower($item->status)) {
                                'dibuka'   => 'bg-emerald-100 text-emerald-700',
                                'selesai'  => 'bg-slate-100 text-slate-600',
                                'segera'   => 'bg-amber-100 text-amber-700',
                                default    => 'bg-blue-100 text-blue-600',
                            };
                        @endphp
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($item->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-1">
                            <button type="button" onclick="editTimeline({{ json_encode($item) }})"
                                class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <form action="{{ route('admin.ppdb.timeline.destroy', $item->id) }}" method="POST"
                                class="contents"
                                onsubmit="return confirm('Yakin ingin menghapus tahap \'{{ addslashes($item->title) }}\'?')">
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
                            <i data-lucide="calendar-x" class="w-8 h-8 text-slate-300"></i>
                            <span class="text-sm">Belum ada data timeline. Klik <strong>Tambah Tahap</strong> untuk memulai.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     MODAL TAMBAH TIMELINE
═══════════════════════════════════════════════════════════════════════════ --}}
<div id="modal-add-timeline" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Tambah Tahap Timeline</h3>
            <button type="button" onclick="closeModal('modal-add-timeline')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form action="{{ route('admin.ppdb.timeline.store') }}" method="POST">
            @csrf
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Utama (Teks Samping) <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required placeholder="Contoh: Tahap Pendaftaran"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul dalam Card (Opsional)</label>
                    <input type="text" name="card_title" placeholder="Contoh: Pendaftaran Tim dan Submit Proposal"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Jika dikosongkan, akan otomatis menggunakan Judul Utama.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="description" rows="2" placeholder="Keterangan singkat tentang tahap ini..."
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal / Periode <span class="text-red-500">*</span></label>
                    <input type="text" name="date_range" required placeholder="Contoh: 1 April — 30 Juni 2026"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" required
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Menunggu">Menunggu</option>
                            <option value="Segera">Segera</option>
                            <option value="Dibuka">Dibuka</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan <span class="text-red-500">*</span></label>
                        <input type="number" name="order" value="{{ $timelines->count() + 1 }}" min="1" required
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="timeline_add_active" value="1" checked
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="timeline_add_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-add-timeline')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════
     MODAL EDIT TIMELINE
═══════════════════════════════════════════════════════════════════════════ --}}
<div id="modal-edit-timeline" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 backdrop-blur-sm overflow-y-auto pt-10 pb-10">
    <div class="bg-white dark:bg-slate-800 rounded-2xl w-full max-w-xl p-6 shadow-xl relative my-auto mx-4">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-lg font-bold text-slate-800 dark:text-slate-100">Edit Tahap Timeline</h3>
            <button type="button" onclick="closeModal('modal-edit-timeline')" class="text-slate-400 hover:text-slate-600">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit-timeline" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Utama (Teks Samping) <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="edit_timeline_title" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul dalam Card (Opsional)</label>
                    <input type="text" name="card_title" id="edit_timeline_card_title"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-slate-500 mt-1">Jika dikosongkan, akan otomatis menggunakan Judul Utama.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                    <textarea name="description" id="edit_timeline_description" rows="2"
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tanggal / Periode <span class="text-red-500">*</span></label>
                    <input type="text" name="date_range" id="edit_timeline_date_range" required
                        class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="edit_timeline_status" required
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Menunggu">Menunggu</option>
                            <option value="Segera">Segera</option>
                            <option value="Dibuka">Dibuka</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Urutan <span class="text-red-500">*</span></label>
                        <input type="number" name="order" id="edit_timeline_order" min="1" required
                            class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="edit_timeline_active" value="1"
                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                    <label for="edit_timeline_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan di halaman publik</label>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-timeline')"
                    class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function editTimeline(item) {
        let form = document.getElementById('form-edit-timeline');
        form.action = `/admin/cms/ppdb/timeline/${item.id}`;

        document.getElementById('edit_timeline_title').value       = item.title;
        document.getElementById('edit_timeline_card_title').value  = item.card_title ?? '';
        document.getElementById('edit_timeline_description').value = item.description ?? '';
        document.getElementById('edit_timeline_date_range').value  = item.date_range;
        document.getElementById('edit_timeline_order').value       = item.order;
        document.getElementById('edit_timeline_active').checked    = item.is_active == 1;

        // Set status select
        let statusSelect = document.getElementById('edit_timeline_status');
        for (let opt of statusSelect.options) {
            opt.selected = (opt.value === item.status);
        }

        openModal('modal-edit-timeline');
    }
</script>
@endpush
