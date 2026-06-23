@extends('layouts.admin')

@section('content')
    @php
        $activeStudentClass = $student->studentClasses->first();
        $initialPhoto = $student->photo ? Storage::url($student->photo) : '';
    @endphp

    <div class="space-y-6" x-data="studentForm('{{ old('unit_id', $student->unit_id) }}', '{{ old('class_id', $activeStudentClass->class_id ?? '') }}', '{{ $initialPhoto }}')">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.siswa.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                Edit Siswa
            </h1>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.siswa.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-9">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm overflow-hidden">

                        {{-- TAB HEADER --}}
                        <div class="border-b border-slate-200 dark:border-slate-700/50 px-6 pt-5">
                            <div class="flex flex-wrap gap-2">
                                <button type="button" @click="activeTab = 'pribadi'"
                                    :class="activeTab === 'pribadi' ? 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 font-semibold'"
                                    class="h-11 px-5 rounded-t-2xl text-sm transition-all">
                                    Data Pribadi
                                </button>
                                <button type="button" @click="activeTab = 'sekolah'"
                                    :class="activeTab === 'sekolah' ? 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 font-semibold'"
                                    class="h-11 px-5 rounded-t-2xl text-sm transition-all">
                                    Data Sekolah
                                </button>
                                <button type="button" @click="activeTab = 'keluarga'"
                                    :class="activeTab === 'keluarga' ? 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 font-semibold'"
                                    class="h-11 px-5 rounded-t-2xl text-sm transition-all">
                                    Data Keluarga
                                </button>
                            </div>
                        </div>

                        <div class="p-6">

                            {{-- TAB: DATA PRIBADI --}}
                            <div x-show="activeTab === 'pribadi'" class="space-y-5" x-transition.opacity.duration.300ms>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name"
                                        value="{{ old('full_name', $student->full_name) }}" placeholder="Nama lengkap"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                    @error('full_name')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- INFORMASI AKUN LOGIN --}}
                                <div class="rounded-[1.5rem] border border-amber-200 dark:border-amber-500/20 bg-amber-50 dark:bg-amber-500/10 p-5">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="shield-check" class="w-5 h-5 text-amber-600 dark:text-amber-400"></i>
                                            <h3 class="text-sm font-bold text-amber-800 dark:text-amber-300">Informasi Akun Login</h3>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Username Login</label>
                                            <input type="text" value="{{ $student->user->username ?? 'Tidak ada akun' }}"
                                                readonly
                                                class="w-full h-12 px-4 rounded-2xl border border-amber-200 dark:border-amber-500/30 bg-white dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 text-sm">
                                        </div>
                                        <div class="rounded-2xl bg-white/50 dark:bg-slate-800/30 border border-amber-100 dark:border-amber-500/20 p-4">
                                            <p class="text-xs text-amber-700 dark:text-amber-400 leading-relaxed">
                                                Catatan: Untuk mereset password siswa, silakan gunakan menu
                                                <span class="font-bold text-amber-800 dark:text-amber-300">Manajemen Pengguna</span>.
                                            </p>
                                        </div>
                                    </div>
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
                            <div x-show="activeTab === 'sekolah'" class="space-y-5" x-cloak x-transition.opacity.duration.300ms>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NIS <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nis" value="{{ old('nis', $student->nis) }}"
                                        placeholder="NIS"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                    @error('nis')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NISN <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nisn" value="{{ old('nisn', $student->nisn) }}"
                                        placeholder="NISN"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                    @error('nisn')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">NIK</label>
                                    <input type="text" name="nik" value="{{ old('nik', $student->nik) }}"
                                        placeholder="Masukkan NIK (16 digit)"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                    @error('nik')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Unit Pendidikan</label>
                                    <select name="unit_id" x-model="unitId"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                        <option value="">Pilih Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Kelas (Aktif) <span x-show="isLoadingClasses" class="text-blue-500 text-xs ml-2 animate-pulse">Memuat...</span></label>
                                    <select name="class_id" x-model="classId" :disabled="isLoadingClasses || !unitId"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all disabled:opacity-50">
                                        <option value="">Pilih Kelas</option>
                                        <template x-for="item in classes" :key="item.id">
                                            <option :value="item.id" x-text="item.class_name"></option>
                                        </template>
                                    </select>
                                    @error('class_id')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
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
                                    @error('academic_year_id')
                                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            {{-- TAB: DATA KELUARGA --}}
                            <div x-show="activeTab === 'keluarga'" class="space-y-5" x-cloak x-transition.opacity.duration.300ms>

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
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6">
                        <h3 class="text-base font-bold text-[var(--theme-primary)] dark:text-blue-400 mb-5">Status</h3>
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
                        @error('status')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- FOTO --}}
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6">
                        <h3 class="text-base font-bold text-[var(--theme-primary)] dark:text-blue-400 mb-4">Foto</h3>
                        <div class="aspect-square rounded-3xl border-2 border-dashed border-sky-200 dark:border-slate-600 bg-sky-50/50 dark:bg-slate-900/50 flex items-center justify-center overflow-hidden relative">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" alt="Preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!photoPreview">
                                <div class="text-center">
                                    <i data-lucide="user-circle-2" class="w-24 h-24 text-sky-200 dark:text-slate-600 mx-auto mb-3"></i>
                                    <p class="text-xs text-sky-400 dark:text-slate-500 font-medium">Preview Foto</p>
                                </div>
                            </template>
                        </div>
                        <input type="file" name="photo" accept="image/jpg,image/jpeg,image/png"
                            @change="handlePhotoUpload"
                            class="mt-4 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-600
                            hover:file:bg-blue-100">
                        @error('photo')
                            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ACTION --}}
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-lg shadow-[#4D7EEB]/30 transition-all">
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

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('studentForm', (initialUnitId, initialClassId, initialPhoto) => ({
                activeTab: 'pribadi',
                unitId: initialUnitId || '',
                classId: initialClassId || '',
                classes: [],
                isLoadingClasses: false,
                photoPreview: initialPhoto || '',

                init() {
                    if (this.unitId) {
                        this.loadClasses(this.unitId, this.classId);
                    }
                    this.$watch('unitId', (value) => {
                        this.classId = '';
                        this.loadClasses(value, '');
                    });
                },

                loadClasses(unitId, selectedClassId) {
                    if (!unitId) {
                        this.classes = [];
                        return;
                    }
                    this.isLoadingClasses = true;
                    fetch(`/admin/siswa/classes-by-unit/${unitId}`)
                        .then(r => r.json())
                        .then(data => {
                            this.classes = data;
                            if (selectedClassId) this.classId = selectedClassId;
                            this.isLoadingClasses = false;
                        })
                        .catch(() => {
                            this.classes = [];
                            this.isLoadingClasses = false;
                        });
                },

                handlePhotoUpload(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        this.photoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }));
        });
    </script>
    @endpush
@endsection


