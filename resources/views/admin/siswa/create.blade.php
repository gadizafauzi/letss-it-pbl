@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-[30px] font-bold text-slate-800">
                    Tambah Siswa
                </h1>
            </div>

        </div>

        <form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                        {{-- TAB HEADER --}}
                        <div class="border-b border-slate-200 px-6 pt-5">

                            <div class="flex flex-wrap gap-2">

                                <button type="button" data-tab-target="tab-data-pribadi"
                                    class="h-11 px-5 rounded-t-2xl border-b-2 border-emerald-500 text-emerald-600 bg-emerald-50 text-sm font-bold transition-all">
                                    Data Pribadi
                                </button>

                                <button type="button" data-tab-target="tab-data-sekolah"
                                    class="h-11 px-5 rounded-t-2xl text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 text-sm font-semibold transition-all">
                                    Data Sekolah
                                </button>

                                <button type="button" data-tab-target="tab-data-keluarga"
                                    class="h-11 px-5 rounded-t-2xl text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 text-sm font-semibold transition-all">
                                    Data Keluarga
                                </button>

                            </div>

                        </div>

                        {{-- FORM CONTENT --}}
                        <div class="p-6">

                            {{-- ============================= --}}
                            {{-- TAB DATA PRIBADI --}}
                            {{-- ============================= --}}
                            <div id="tab-data-pribadi" class="tab-panel space-y-5">

                                {{-- FULL NAME --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                                        placeholder="Nama lengkap"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- GENDER --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Jenis Kelamin
                                    </label>

                                    <div class="flex items-center gap-6">

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="L"
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Laki-laki
                                        </label>

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="P"
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Perempuan
                                        </label>

                                    </div>
                                </div>

                                {{-- BIRTH PLACE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tempat Lahir
                                    </label>

                                    <input type="text" name="birth_place" value="{{ old('birth_place') }}"
                                        placeholder="Tempat lahir"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- BIRTH DATE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tanggal Lahir
                                    </label>

                                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- HOBBY --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Hobi
                                    </label>

                                    <input type="text" name="hobby" value="{{ old('hobby') }}" placeholder="Hobi"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- PHONE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        No. Handphone
                                    </label>

                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- ADDRESS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Alamat
                                    </label>

                                    <textarea rows="4" name="address" placeholder="Alamat tempat tinggal"
                                        class="w-full p-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm resize-none transition-all">{{ old('address') }}</textarea>
                                </div>

                            </div>

                            {{-- ============================= --}}
                            {{-- TAB DATA SEKOLAH --}}
                            {{-- ============================= --}}
                            <div id="tab-data-sekolah" class="tab-panel space-y-5 hidden">

                                {{-- NIS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NIS
                                    </label>

                                    <input type="text" name="nis" value="{{ old('nis') }}"
                                        placeholder="Masukkan NIS"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
            focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
            focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- NISN --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NISN
                                    </label>

                                    <input type="text" name="nisn" value="{{ old('nisn') }}"
                                        placeholder="Masukkan NISN"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
            focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
            focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- UNIT --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Unit Pendidikan
                                    </label>

                                    <select name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
            focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
            focus:border-emerald-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Unit
                                        </option>

                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}">
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- CLASS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Kelas
                                    </label>

                                    <select name="class_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
            focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
            focus:border-emerald-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Kelas
                                        </option>

                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">

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

                                {{-- ACADEMIC YEAR --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tahun Ajaran
                                    </label>

                                    <select name="academic_year_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
            focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
            focus:border-emerald-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Tahun Ajaran
                                        </option>

                                        @foreach ($academicYears as $academicYear)
                                            <option value="{{ $academicYear->id }}">
                                                {{ $academicYear->year }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- ============================= --}}
                                {{-- INFORMASI AKUN LOGIN --}}
                                {{-- ============================= --}}
                                <div class="rounded-3xl border border-amber-200 bg-amber-50 p-5">

                                    <div class="flex items-center gap-2 mb-4">

                                        <i data-lucide="shield-check" class="w-5 h-5 text-amber-600"></i>

                                        <h3 class="text-sm font-bold text-amber-800">
                                            Informasi Akun Login
                                        </h3>

                                    </div>

                                    <div class="space-y-4">

                                        {{-- USERNAME --}}
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                                Username Login
                                            </label>

                                            <input type="text" value="Menggunakan NIS siswa" readonly
                                                class="w-full h-12 px-4 rounded-2xl border border-amber-200
                    bg-white text-slate-500 text-sm">
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                                Password Default
                                            </label>

                                            <input type="text" value="12345678" readonly
                                                class="w-full h-12 px-4 rounded-2xl border border-amber-200
                    bg-white text-red-500 font-bold text-sm">
                                        </div>

                                        {{-- INFO --}}
                                        <div class="rounded-2xl bg-white border border-amber-100 p-4">

                                            <p class="text-xs text-amber-700 leading-relaxed">

                                                Sistem akan otomatis membuat akun login siswa menggunakan
                                                <span class="font-bold">NIS</span>
                                                sebagai username dan password default
                                                <span class="font-bold text-red-500">12345678</span>.

                                            </p>

                                            <p class="text-xs text-amber-700 mt-2 leading-relaxed">

                                                Setelah siswa berhasil login, password dapat diubah melalui
                                                menu profil akun masing-masing.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            {{-- ============================= --}}
                            {{-- TAB DATA KELUARGA --}}
                            {{-- ============================= --}}
                            <div id="tab-data-keluarga" class="tab-panel space-y-5 hidden">

                                {{-- FATHER NAME --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Ayah
                                    </label>

                                    <input type="text" name="father_name" value="{{ old('father_name') }}"
                                        placeholder="Nama Ayah"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- MOTHER NAME --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Ibu
                                    </label>

                                    <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                        placeholder="Nama Ibu"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- PARENT PHONE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        No. HP Orang Tua
                                    </label>

                                    <input type="text" name="parent_phone" value="{{ old('parent_phone') }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="xl:col-span-3 space-y-6">

                    {{-- STATUS --}}
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">

                        <h3 class="text-base font-bold text-slate-800 mb-5">
                            Status
                        </h3>

                        <div class="space-y-4">

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="inactive"
                                    class="text-emerald-500 focus:ring-emerald-200">
                                Tidak Aktif
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="active" checked
                                    class="text-emerald-500 focus:ring-emerald-200">
                                Aktif
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="graduated"
                                    class="text-emerald-500 focus:ring-emerald-200">
                                Tamat
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="transfer"
                                    class="text-emerald-500 focus:ring-emerald-200">
                                Pindah Sekolah
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="dropout"
                                    class="text-emerald-500 focus:ring-emerald-200">
                                Drop Out
                            </label>

                        </div>

                    </div>

                    {{-- FOTO --}}
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">

                        <h3 class="text-base font-bold text-slate-800 mb-4">
                            Foto
                        </h3>

                        <div
                            class="aspect-square rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50 flex items-center justify-center">

                            <div class="text-center">

                                <i data-lucide="user-circle-2" class="w-24 h-24 text-slate-300 mx-auto mb-3"></i>

                                <p class="text-xs text-slate-400">
                                    Preview Foto
                                </p>

                            </div>

                        </div>

                        <input type="file" name="photo"
                            class="mt-4 block w-full text-sm text-slate-500
                            file:mr-4 file:py-2.5 file:px-4
                            file:rounded-xl file:border-0
                            file:text-sm file:font-semibold
                            file:bg-emerald-50
                            file:text-emerald-600
                            hover:file:bg-emerald-100">

                    </div>



                    {{-- ACTION --}}
                    <div class="space-y-3">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                            text-white font-bold shadow-lg shadow-emerald-100 transition-all">

                            Simpan

                        </button>

                        <a href="{{ route('admin.siswa.index') }}"
                            class="w-full h-12 rounded-2xl bg-cyan-500 hover:bg-cyan-600
                            text-white font-bold inline-flex items-center justify-center transition-all">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

    {{-- TAB SWITCHER --}}
    <script>
        (function() {

            const tabs = document.querySelectorAll('[data-tab-target]');
            const panels = document.querySelectorAll('.tab-panel');

            function setActive(tabButton) {

                const targetId = tabButton.getAttribute('data-tab-target');

                tabs.forEach(btn => {

                    btn.classList.remove(
                        'border-b-2',
                        'border-emerald-500',
                        'text-emerald-600',
                        'bg-emerald-50',
                        'font-bold'
                    );

                    btn.classList.add(
                        'text-slate-500',
                        'hover:text-emerald-600',
                        'hover:bg-emerald-50',
                        'font-semibold'
                    );

                });

                tabButton.classList.remove(
                    'text-slate-500',
                    'hover:text-emerald-600',
                    'hover:bg-emerald-50',
                    'font-semibold'
                );

                tabButton.classList.add(
                    'border-b-2',
                    'border-emerald-500',
                    'text-emerald-600',
                    'bg-emerald-50',
                    'font-bold'
                );

                panels.forEach(panel => {
                    panel.classList.toggle('hidden', panel.id !== targetId);
                });

            }

            tabs.forEach(btn => {
                btn.addEventListener('click', function() {
                    setActive(btn);
                });
            });

            const defaultTab = document.querySelector(
                '[data-tab-target="tab-data-pribadi"]'
            );

            if (defaultTab) {
                setActive(defaultTab);
            }

        })();
    </script>
@endsection
