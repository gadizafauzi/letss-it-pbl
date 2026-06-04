@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-[30px] font-bold text-slate-800">
                    Tambah Guru
                </h1>
            </div>

        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{--
              Catatan:
              - Form guru mengikuti struktur tab 1 halaman.
              - Validasi & simpan mengikuti GuruController@store.
              - Password default (123456) akan dipakai untuk membuat record user.
            --}}

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- LEFT CONTENT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                        {{-- TAB HEADER (1 TAB SAJA) --}}
                        <div class="border-b border-slate-200 px-6 pt-5">
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                    data-tab-target="tab-data-pribadi"
                                    class="h-11 px-5 rounded-t-2xl border-b-2 border-emerald-500 text-emerald-600 bg-emerald-50 text-sm font-bold transition-all">
                                    Data Pribadi
                                </button>
                            </div>
                        </div>

                        {{-- FORM CONTENT --}}
                        <div class="p-6">

                            {{-- TAB DATA PRIBADI --}}
                            <div id="tab-data-pribadi" class="tab-panel space-y-5">

                                {{-- NIP --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NIP <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="nip" value="{{ old('nip') }}"
                                        placeholder="NIP"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- NIP PEGWAI (=> user_id) --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NIP Pegawai <span class="text-red-500">*</span>
                                    </label>

                                    <select name="user_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                        <option value="">-- Pilih NIP Pegawai --</option>
                                        {{--
                                          $users disiapkan oleh controller setelah perbaikan.
                                          Jika belum ada, halaman ini tetap render tapi dropdown kosong.
                                        --}}
                                        @foreach ($users ?? [] as $user)
                                            <option value="{{ $user->id }}" {{ (string) old('user_id') === (string) $user->id ? 'selected' : '' }}>
                                                {{ $user->username }} - {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- FULL NAME --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama lengkap <span class="text-red-500">*</span>
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
                                            <input type="radio" name="gender" value="male"
                                                {{ old('gender') === 'male' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Laki-laki
                                        </label>

                                        <label class="flex items-center gap-2 text-sm text-slate-700">
                                            <input type="radio" name="gender" value="female"
                                                {{ old('gender') === 'female' ? 'checked' : '' }}
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
                                        placeholder="Tempat Lahir"
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

                                {{-- LAST EDUCATION --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Pendidikan Terakhir
                                    </label>

                                    <input type="text" name="last_education" value="{{ old('last_education') }}"
                                        placeholder="-- Pilih Strata / Pendidikan Terakhir --"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- UNIT SEKOLAH --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Unit Sekolah <span class="text-red-500">*</span>
                                    </label>

                                    <select name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                        <option value="">-- Pilih Unit Sekolah --</option>
                                        @foreach ($units ?? [] as $unit)
                                            <option value="{{ $unit->id }}" {{ (string) old('unit_id') === (string) $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- POSITION (Jabatan) --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Jabatan <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="position" value="{{ old('position') }}"
                                        placeholder="-- Pilih Jabatan --"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- EMPLOYMENT STATUS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Status Kepegawaian <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="employment_status" value="{{ old('employment_status') }}"
                                        placeholder="-- Pilih Status Kepegawaian --"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- ADDRESS --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Alamat
                                    </label>

                                    <textarea rows="4" name="address" placeholder="Alamat Tempat Tinggal"
                                        class="w-full p-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm resize-none transition-all">{{ old('address') }}</textarea>
                                </div>

                                {{-- PHONE --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Telpon/HP
                                    </label>

                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        placeholder="Telpon/HP Pegawai"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">
                                </div>

                                {{-- STATUS (aktif/inaktif) --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-3">
                                        Status <span class="text-red-500">*</span>
                                    </label>

                                    <div class="space-y-2">
                                        <label class="flex items-center gap-3 text-sm text-slate-700">
                                            <input type="radio" name="status" value="inactive"
                                                {{ old('status') === 'inactive' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Tidak Aktif
                                        </label>
                                        <label class="flex items-center gap-3 text-sm text-slate-700">
                                            <input type="radio" name="status" value="active"
                                                {{ old('status') === 'active' || old('status') === null ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">
                                            Aktif
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="xl:col-span-3 space-y-6">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                        <h3 class="text-base font-bold text-[var(--theme-primary)] mb-5">
                            Password Default
                        </h3>
                        <p class="text-sm text-slate-600">
                            Default password: <span class="font-bold">123456</span>
                            <br>
                            Sistem akan menggunakan password default saat membuat User untuk NIP Pegawai.
                        </p>
                    </div>

                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold shadow-lg shadow-emerald-100 transition-all">
                            Simpan
                        </button>

                        <a href="{{ route('admin.guru.index') }}"
                            class="w-full h-12 rounded-2xl bg-cyan-500 hover:bg-cyan-600 text-white font-bold inline-flex items-center justify-center transition-all">
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

            const defaultTab = document.querySelector('[data-tab-target="tab-data-pribadi"]');
            if (defaultTab) setActive(defaultTab);
        })();
    </script>
@endsection

