@extends('layouts.admin')

@section('content')
    @php
        $activeStudentClass = $student->studentClasses->first();
    @endphp

    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
            <div>
                <h1 class="text-[28px] font-bold text-slate-800">Edit Siswa</h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.siswa.index') }}"
                    class="h-11 px-6 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                    Kembali
                </a>
            </div>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.siswa.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-9">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                        {{-- TAB HEADER --}}
                        <div class="border-b border-slate-200 px-6 pt-5">
                            <div class="flex flex-wrap gap-2">
                                <button type="button" data-tab-target="tab-data-pribadi"
                                    class="tab-btn h-11 px-5 rounded-t-2xl border-b-2 border-blue-500 text-blue-600 bg-blue-50 text-sm font-bold transition-all">
                                    Data Pribadi
                                </button>
                                <button type="button" data-tab-target="tab-data-sekolah"
                                    class="tab-btn h-11 px-5 rounded-t-2xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 text-sm font-semibold transition-all">
                                    Data Sekolah
                                </button>
                                <button type="button" data-tab-target="tab-data-keluarga"
                                    class="tab-btn h-11 px-5 rounded-t-2xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 text-sm font-semibold transition-all">
                                    Data Keluarga
                                </button>
                            </div>
                        </div>

                        <div class="p-6">

                            {{-- TAB: DATA PRIBADI --}}
                            <div id="tab-data-pribadi" class="tab-panel space-y-5">

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name"
                                        value="{{ old('full_name', $student->full_name) }}" placeholder="Nama lengkap"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">Jenis Kelamin</label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="L"
                                                {{ old('gender', $student->gender) === 'L' ? 'checked' : '' }}
                                                class="text-blue-500 focus:ring-blue-200">
                                            Laki-laki
                                        </label>
                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="P"
                                                {{ old('gender', $student->gender) === 'P' ? 'checked' : '' }}
                                                class="text-blue-500 focus:ring-blue-200">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="birth_place"
                                        value="{{ old('birth_place', $student->birth_place) }}" placeholder="Tempat lahir"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="birth_date"
                                        value="{{ old('birth_date', $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') : '') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Hobi</label>
                                    <input type="text" name="hobby" value="{{ old('hobby', $student->hobby) }}"
                                        placeholder="Hobi"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">No. Handphone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat</label>
                                    <textarea rows="4" name="address" placeholder="Alamat tempat tinggal"
                                        class="w-full p-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm resize-none transition-all">{{ old('address', $student->address) }}</textarea>
                                </div>

                            </div>

                            {{-- TAB: DATA SEKOLAH --}}
                            <div id="tab-data-sekolah" class="tab-panel space-y-5 hidden">

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NIS <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nis" value="{{ old('nis', $student->nis) }}"
                                        placeholder="NIS"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NISN <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}"
                                        placeholder="NISN"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NIK</label>
                                    <input type="text" name="nik" value="{{ old('nik', $student->nik) }}"
                                        placeholder="Masukkan NIK (16 digit)"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Unit Pendidikan</label>
                                    <select id="unit_select" name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                        <option value="">Pilih Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ (string) old('unit_id', $student->unit_id) === (string) $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Kelas (Aktif)</label>
                                    <select id="class_select" name="class_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ (string) old('class_id', $activeStudentClass->class_id ?? '') === (string) $class->id ? 'selected' : '' }}>
                                                {{ $class->class_name }}
                                                @if (!empty($class->room))
                                                    - {{ $class->room }}
                                                @endif
                                                @if (!empty($class->level))
                                                    ({{ strtoupper($class->level) }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Ajaran</label>
                                    <select name="academic_year_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        @foreach ($academicYears as $year)
                                            <option value="{{ $year->id }}"
                                                {{ (string) old('academic_year_id', $activeStudentClass->academic_year_id ?? '') === (string) $year->id ? 'selected' : '' }}>
                                                {{ $year->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            {{-- TAB: DATA KELUARGA --}}
                            <div id="tab-data-keluarga" class="tab-panel space-y-5 hidden">

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Ayah</label>
                                    <input type="text" name="father_name"
                                        value="{{ old('father_name', $student->father_name) }}" placeholder="Nama Ayah"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Ibu</label>
                                    <input type="text" name="mother_name"
                                        value="{{ old('mother_name', $student->mother_name) }}" placeholder="Nama Ibu"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">No. HP Orang Tua</label>
                                    <input type="text" name="parent_phone"
                                        value="{{ old('parent_phone', $student->parent_phone) }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="xl:col-span-3 space-y-6">

                    {{-- STATUS --}}
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                        <h3 class="text-base font-bold text-slate-800 mb-5">Status</h3>
                        <div class="space-y-4">
                            @php $status = old('status', $student->status); @endphp

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="inactive"
                                    {{ $status === 'inactive' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Tidak Aktif
                            </label>
                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="active"
                                    {{ $status === 'active' ? 'checked' : '' }} class="text-blue-500 focus:ring-blue-200">
                                Aktif
                            </label>
                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="graduated"
                                    {{ $status === 'graduated' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Tamat
                            </label>
                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="transfer"
                                    {{ $status === 'transfer' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Pindah Sekolah
                            </label>
                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="dropout"
                                    {{ $status === 'dropout' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Drop Out
                            </label>
                        </div>
                    </div>

                    {{-- FOTO --}}
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                        <h3 class="text-base font-bold text-slate-800 mb-4">Foto</h3>
                        <div id="photo-preview-wrapper"
                            class="aspect-square rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 flex items-center justify-center overflow-hidden">
                            @if ($student->photo)
                                <img id="photo-preview" src="{{ Storage::url($student->photo) }}" alt="Foto Siswa"
                                    class="w-full h-full object-cover">
                                <div class="text-center hidden" id="photo-placeholder">
                                    <i data-lucide="user-circle-2" class="w-24 h-24 text-slate-300 mx-auto mb-3"></i>
                                    <p class="text-xs text-slate-400">Preview Foto</p>
                                </div>
                            @else
                                <div class="text-center" id="photo-placeholder">
                                    <i data-lucide="user-circle-2" class="w-24 h-24 text-slate-300 mx-auto mb-3"></i>
                                    <p class="text-xs text-slate-400">Preview Foto</p>
                                </div>
                                <img id="photo-preview" src="" alt="Preview"
                                    class="hidden w-full h-full object-cover">
                            @endif
                        </div>
                        <input type="file" name="photo" id="photo_input" accept="image/jpg,image/jpeg,image/png"
                            class="mt-4 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-600
                            hover:file:bg-blue-100">
                    </div>

                    {{-- ACTION --}}
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold shadow-lg shadow-blue-100 transition-all">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.siswa.index') }}"
                            class="w-full h-12 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold inline-flex items-center justify-center transition-all">
                            Batal
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ============================================================
            // TAB SWITCHER
            // ============================================================
            const tabs = document.querySelectorAll('.tab-btn');
            const panels = document.querySelectorAll('.tab-panel');

            function setActiveTab(btn) {
                const targetId = btn.getAttribute('data-tab-target');

                tabs.forEach(b => {
                    b.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600',
                        'bg-blue-50', 'font-bold');
                    b.classList.add('text-slate-500', 'hover:text-blue-600', 'hover:bg-blue-50',
                        'font-semibold');
                });

                btn.classList.remove('text-slate-500', 'hover:text-blue-600', 'hover:bg-blue-50',
                    'font-semibold');
                btn.classList.add('border-b-2', 'border-blue-500', 'text-blue-600', 'bg-blue-50',
                    'font-bold');

                panels.forEach(p => p.classList.toggle('hidden', p.id !== targetId));
            }

            tabs.forEach(btn => btn.addEventListener('click', () => setActiveTab(btn)));
            const defaultTab = document.querySelector('[data-tab-target="tab-data-pribadi"]');
            if (defaultTab) setActiveTab(defaultTab);

            // ============================================================
            // AJAX: FILTER KELAS BERDASARKAN UNIT
            // ============================================================
            const unitSelect = document.getElementById('unit_select');
            const classSelect = document.getElementById('class_select');

            const currentClassId = "{{ old('class_id', $activeStudentClass->class_id ?? '') }}";
            const initialUnitId = unitSelect ? unitSelect.value : '';

            if (unitSelect && classSelect && initialUnitId) {
                loadClasses(initialUnitId, currentClassId);
            }

            if (unitSelect && classSelect) {
                unitSelect.addEventListener('change', function() {
                    loadClasses(this.value, '');
                });
            }

            function loadClasses(unitId, selectedClassId) {
                classSelect.innerHTML = '<option value="">Memuat kelas...</option>';

                if (!unitId) {
                    classSelect.innerHTML = '<option value="">Pilih Kelas</option>';
                    return;
                }

                fetch(`/admin/siswa/classes-by-unit/${unitId}`)
                    .then(r => r.json())
                    .then(classes => {
                        classSelect.innerHTML = '<option value="">Pilih Kelas</option>';
                        classes.forEach(item => {
                            const selected = String(item.id) === String(selectedClassId) ? 'selected' :
                                '';
                            classSelect.innerHTML +=
                                `<option value="${item.id}" ${selected}>${item.class_name}</option>`;
                        });
                    })
                    .catch(() => {
                        classSelect.innerHTML = '<option value="">Gagal memuat kelas</option>';
                    });
            }

            // ============================================================
            // PHOTO PREVIEW
            // ============================================================
            const photoInput = document.getElementById('photo_input');
            const photoPreview = document.getElementById('photo-preview');
            const photoPlaceholder = document.getElementById('photo-placeholder');

            if (photoInput) {
                photoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        photoPreview.src = e.target.result;
                        photoPreview.classList.remove('hidden');
                        if (photoPlaceholder) photoPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                });
            }

        });
    </script>
@endsection
