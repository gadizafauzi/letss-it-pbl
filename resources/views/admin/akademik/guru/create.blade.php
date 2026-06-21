@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.guru.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                Tambah Guru
            </h1>
        </div>

        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm overflow-hidden">

                        {{-- TAB HEADER --}}
                        <div class="border-b border-slate-200 px-6 pt-5">

                            <div class="flex flex-wrap gap-2">

                                <button type="button" data-tab-target="tab-data-pribadi"
                                    class="h-11 px-5 rounded-t-2xl border-b-2 border-blue-500 text-blue-600 bg-blue-50 text-sm font-bold transition-all">
                                    Data Pribadi
                                </button>

                                <button type="button" data-tab-target="tab-data-kepegawaian"
                                    class="h-11 px-5 rounded-t-2xl text-slate-500 hover:text-blue-600 hover:bg-blue-50 text-sm font-semibold transition-all">
                                    Data Kepegawaian
                                </button>

                            </div>

                        </div>

                        {{-- FORM CONTENT --}}
                        <div class="p-6">

                            {{-- ============================= --}}
                            {{-- TAB DATA PRIBADI --}}
                            {{-- ============================= --}}
                            <div id="tab-data-pribadi" class="tab-panel space-y-5">

                                {{-- NIP --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NIP <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="nip" value="{{ old('nip') }}"
                                        placeholder="Masukkan NIP"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- FULL NAME --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                                        placeholder="Nama lengkap"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- GENDER --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Jenis Kelamin
                                    </label>

                                    <div class="flex items-center gap-6">

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="male"
                                                {{ old('gender') == 'male' ? 'checked' : '' }}
                                                class="text-blue-500 focus:ring-blue-200">
                                            Laki-laki
                                        </label>

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="female"
                                                {{ old('gender') == 'female' ? 'checked' : '' }}
                                                class="text-blue-500 focus:ring-blue-200">
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
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- BIRTH DATE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tanggal Lahir
                                    </label>

                                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- PHONE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        No. Handphone
                                    </label>

                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- ADDRESS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Alamat
                                    </label>

                                    <textarea rows="4" name="address" placeholder="Alamat tempat tinggal"
                                        class="w-full p-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm resize-none transition-all">{{ old('address') }}</textarea>
                                </div>

                            </div>

                            {{-- ============================= --}}
                            {{-- TAB DATA KEPEGAWAIAN --}}
                            {{-- ============================= --}}
                            <div id="tab-data-kepegawaian" class="tab-panel space-y-5 hidden">

                                {{-- UNIT --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Unit Sekolah <span class="text-red-500">*</span>
                                    </label>

                                    <select name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Unit
                                        </option>

                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- POSITION --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Jabatan
                                    </label>

                                    <select name="position_id"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Jabatan
                                        </option>

                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                {{-- LAST EDUCATION --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Pendidikan Terakhir
                                    </label>

                                    <input type="text" name="last_education" value="{{ old('last_education') }}"
                                        placeholder="Contoh: S1 Pendidikan"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">
                                </div>

                                {{-- EMPLOYMENT STATUS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Status Kepegawaian
                                    </label>

                                    <select name="employment_status"
                                        class="w-full h-12 px-4 rounded-2xl bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                        focus:border-blue-400 text-sm transition-all">

                                        <option value="">
                                            Pilih Status Kepegawaian
                                        </option>

                                        <option value="pegawai_tetap"
                                            {{ old('employment_status') == 'pegawai_tetap' ? 'selected' : '' }}>
                                            Pegawai Tetap
                                        </option>

                                        <option value="pegawai_tidak_tetap"
                                            {{ old('employment_status') == 'pegawai_tidak_tetap' ? 'selected' : '' }}>
                                            Pegawai Tidak Tetap
                                        </option>

                                    </select>
                                </div>

                                {{-- INFORMASI AKUN LOGIN --}}
                                <div class="rounded-3xl border border-amber-200 bg-amber-50 p-5">

                                    <h3 class="text-sm font-bold text-amber-800 mb-4">
                                        Informasi Akun Login
                                    </h3>

                                    <div class="space-y-4">

                                        {{-- USERNAME --}}
                                        <div>
                                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                                Username Login
                                            </label>

                                            <input type="text" value="Menggunakan NIP guru" readonly
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
                                                Sistem akan otomatis membuat akun login guru menggunakan
                                                <b>NIP</b> sebagai username dan password default
                                                <b>12345678</b>.
                                                Password dapat diubah setelah guru login.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="xl:col-span-3 space-y-6">

                    {{-- STATUS --}}
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-3xl shadow-sm p-6">

                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-5">
                            Status
                        </h3>

                        <div class="space-y-4">

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="active"
                                    {{ old('status', 'active') == 'active' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Aktif
                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">
                                <input type="radio" name="status" value="inactive"
                                    {{ old('status') == 'inactive' ? 'checked' : '' }}
                                    class="text-blue-500 focus:ring-blue-200">
                                Tidak Aktif
                            </label>

                        </div>

                    </div>

                    {{-- FOTO --}}
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-3xl shadow-sm p-6">

                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-4">
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
                            file:bg-blue-50
                            file:text-blue-600
                            hover:file:bg-blue-100">

                    </div>

                    {{-- ACTION --}}
                    <div class="space-y-3">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90
                            text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                            Simpan
                        </button>

                        <a href="{{ route('admin.guru.index') }}"
                            class="w-full h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700
                            text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
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
                        'border-blue-500',
                        'text-blue-600',
                        'bg-blue-50',
                        'font-bold'
                    );

                    btn.classList.add(
                        'text-slate-500',
                        'hover:text-blue-600',
                        'hover:bg-blue-50',
                        'font-semibold'
                    );

                });

                tabButton.classList.remove(
                    'text-slate-500',
                    'hover:text-blue-600',
                    'hover:bg-blue-50',
                    'font-semibold'
                );

                tabButton.classList.add(
                    'border-b-2',
                    'border-blue-500',
                    'text-blue-600',
                    'bg-blue-50',
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


