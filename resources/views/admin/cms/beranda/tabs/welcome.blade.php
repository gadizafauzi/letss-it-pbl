        <div id="tab-welcome" class="tab-content hidden">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-slate-800 dark:text-slate-100">Welcome Message</h2>
                <p class="text-sm text-slate-500">Pesan sambutan dari pimpinan sekolah.</p>
            </div>
            <form action="{{ route('admin.beranda.welcome.update', $welcome->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Judul Sambutan</label>
                            <input type="text" name="title" value="{{ old('title', $welcome->title) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Salam Pembuka</label>
                            <input type="text" name="greeting" value="{{ old('greeting', $welcome->greeting) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Isi Sambutan (Setiap baris baru akan menjadi paragraf baru)</label>
                            <textarea name="paragraphs" rows="6" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">{{ old('paragraphs', is_array($welcome->paragraphs) ? implode("\n", $welcome->paragraphs) : '') }}</textarea>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama Pimpinan</label>
                                <input type="text" name="kepsek_name" value="{{ old('kepsek_name', $welcome->kepsek_name) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Jabatan</label>
                                <input type="text" name="kepsek_title" value="{{ old('kepsek_title', $welcome->kepsek_title) }}" class="w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Foto Pimpinan</label>
                            @if($welcome->kepsek_photo)
                                <img src="{{ Str::startsWith($welcome->kepsek_photo, 'http') ? $welcome->kepsek_photo : asset('storage/'.$welcome->kepsek_photo) }}" alt="Kepsek" class="h-24 w-24 object-cover rounded-full mb-2">
                            @endif
                            <input type="file" name="kepsek_photo" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="flex items-center gap-2 mt-6">
                            <input type="checkbox" name="is_active" id="welcome_active" value="1" {{ $welcome->is_active ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500 border border-slate-300">
                            <label for="welcome_active" class="text-sm text-slate-700 dark:text-slate-300">Tampilkan Welcome Message</label>
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors">Simpan Sambutan</button>
                </div>
            </form>
        </div>
