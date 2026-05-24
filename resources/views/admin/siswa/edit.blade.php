@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
            <div>
                <h1 class="text-[28px] font-bold text-slate-800">
                    Edit Siswa
                </h1>
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

                <div class="xl:col-span-9">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                        <div class="border-b border-slate-200 px-6 pt-5">
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                    data-tab-target="tab-data-pribadi"
                                    class="h-11 px-5 rounded-t-2xl border-b-2 border-emerald-500 text-emerald-600 bg-emerald-50 text-sm font-bold transition-all">
                                    Data Pribadi
                                </button>

                                <button type="button"
                                    data-tab-target="tab-data-sekolah"
                                    class="h-11 px-5 rounded-t-2xl text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 text-sm font-semibold transition-all">
                                    Data Sekolah
                                </button>

                                <button type="button"
                                    data-tab-target="tab-data-keluarga"
                                    class="h-11 px-5 rounded-t-2xl text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 text-sm font-semibold transition-all">
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
                                    <input type="text" name="full_name" value="{{ old('full_name', $student->full_name) }}"
                                        placeholder="Nama lengkap"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Jenis Kelamin
                                    </label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="L"
                                                {{ old('gender', $student->gender) === 'L' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Laki-laki
                                        </label>

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="P"
                                                {{ old('gender', $student->gender) === 'P' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="birth_place" value="{{ old('birth_place', $student->birth_place) }}"
                                        placeholder="Tempat lahir"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date) }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Hobi</label>
                                    <input type="text" name="hobby" value="{{ old('hobby', $student->hobby) }}"
                                        placeholder="Hobi"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">No. Handphone</label>
                                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat</label>
                                    <textarea rows="4" name="address" placeholder="Alamat tempat tinggal"
                                        class="w-full p-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm resize-none transition-all">{{ old('address', $student->address) }}</textarea>
                                </div>

                            </div>

                            {{-- TAB: DATA SEKOLAH --}}
                            <div id="tab-data-sekolah" class="tab-panel space-y-5 hidden">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NIS</label>
                                    <input type="text" name="nis" value="{{ old('nis', $student->nis) }}" placeholder="NIS"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NISN</label>
                                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}" placeholder="NISN"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Unit Pendidikan</label>
                                    <select name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                        <option value="">Pilih Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}" {{ (string) old('unit_id', $student->unit_id) === (string) $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Kelas (Aktif)</label>
                                    @php
                                        $activeStudentClass = $student->studentClasses->first();
                                    @endphp
                                    <select name="class_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ (string) old('class_id', $activeStudentClass->class_id ?? '') === (string) $class->id ? 'selected' : '' }}>
                                                {{ $class->class_name }}
                                                @if (!empty($class->room)) - {{ $class->room }} @endif
                                                @if (!empty($class->level)) ({{ strtoupper($class->level) }}) @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Ajaran</label>
                                    <select name="academic_year_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        @foreach ($academicYears as $year)
                                            <option value="{{ $year->id }}" {{ (string) old('academic_year_id', $activeStudentClass->academic_year_id ?? '') === (string) $year->id ? 'selected' : '' }}>
                                                {{ $year-> year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            {{-- TAB: DATA KELUARGA --}}
                            <div id="tab-data-keluarga" class="tab-panel space-y-5 hidden">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Ayah</label>
                                    <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                                        placeholder="Nama Ayah"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Ibu</label>
                                    <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}"
                                        placeholder="Nama Ibu"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">No. HP Orang Tua</label>
                                    <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>
                            </div>
                        </div>

                        {{-- TAB SWITCHER --}}
                        <script>
                            (function() {
                                const tabs = document.querySelectorAll('[data-tab-target]');
                                const panels = document.querySelectorAll('.tab-panel');

                                function setActive(tabButton) {
                                    const targetId = tabButton.getAttribute('data-tab-target');

                                    tabs.forEach(btn => {
                                        btn.classList.remove('border-b-2','border-emerald-500','text-emerald-600','bg-emerald-50','font-bold');
                                        btn.classList.add('text-slate-500','hover:text-emerald-600','hover:bg-emerald-50','font-semibold');
                                    });

                                    tabButton.classList.remove('text-slate-500','hover:text-emerald-600','hover:bg-emerald-50','font-semibold');
                                    tabButton.classList.add('border-b-2','border-emerald-500','text-emerald-600','bg-emerald-50','font-bold');

                                    panels.forEach(panel => {
                                        panel.classList.toggle('hidden', panel.id !== targetId);
                                    });
                                }

                                tabs.forEach(btn => btn.addEventListener('click', () => setActive(btn)));

                                const defaultTab = document.querySelector('[data-tab-target="tab-data-pribadi"]');
                                if (defaultTab) setActive(defaultTab);
                            })();
                        </script>
                    </div>
                </div>

                <div class="xl:col-span-3 space-y-6">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                        <h3 class="text-base font-bold text-slate-800 mb-5">Status</h3>

                        <div class="space-y-4">
                            @php
                                $status = old('status', $student->status);
                            @endphp

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="inactive" {{ $status === 'inactive' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-200">
                                Tidak Aktif
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="active" {{ $status === 'active' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-200">
                                Aktif
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="graduated" {{ $status === 'graduated' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-200">
                                Tamat
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="transfer" {{ $status === 'transfer' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-200">
                                Pindah Sekolah
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="dropout" {{ $status === 'dropout' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-200">
                                Drop Out
                            </label>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                        <h3 class="text-base font-bold text-slate-800 mb-4">Foto</h3>

                        <div class="aspect-square rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 flex items-center justify-center">
                            <div class="text-center">
                                <i data-lucide="user-circle-2" class="w-24 h-24 text-slate-300 mx-auto mb-3"></i>
                                <p class="text-xs text-slate-400">Preview Foto</p>
                            </div>
                        </div>

                        <input type="file" name="photo" class="mt-4 block w-full text-sm text-slate-500">
                    </div>

                    <div class="space-y-3">
                        <button type="submit" class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold shadow-lg shadow-emerald-100 transition-all">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.siswa.index') }}" class="w-full h-12 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold inline-flex items-center justify-center transition-all">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

