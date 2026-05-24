@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-[30px] font-bold text-slate-800">
                    Edit Guru
                </h1>
            </div>

        </div>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.guru.update', $teacher->id) }}" method="POST">
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
                                    class="tab-button h-11 px-5 rounded-t-2xl border-b-2 border-emerald-500 text-emerald-600 bg-emerald-50 text-sm font-bold transition-all">

                                    Data Pribadi

                                </button>

                                <button type="button" data-tab-target="tab-data-kepegawaian"
                                    class="tab-button h-11 px-5 rounded-t-2xl text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 text-sm font-semibold transition-all">

                                    Data Kepegawaian

                                </button>

                            </div>

                        </div>

                        {{-- FORM CONTENT --}}
                        <div class="p-6">

                            {{-- TAB DATA PRIBADI --}}
                            <div id="tab-data-pribadi" class="tab-panel space-y-5">

                                {{-- FULL NAME --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="full_name"
                                        value="{{ old('full_name', $teacher->full_name) }}" placeholder="Nama lengkap"
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
                                                {{ old('gender', $teacher->gender) == 'male' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">

                                            Laki-laki

                                        </label>

                                        <label class="flex items-center gap-2 text-sm text-slate-700">

                                            <input type="radio" name="gender" value="female"
                                                {{ old('gender', $teacher->gender) == 'female' ? 'checked' : '' }}
                                                class="text-emerald-500 focus:ring-emerald-200">

                                            Perempuan

                                        </label>

                                    </div>

                                </div>

                                {{-- TEMPAT LAHIR --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tempat Lahir
                                    </label>

                                    <input type="text" name="birth_place"
                                        value="{{ old('birth_place', $teacher->birth_place) }}" placeholder="Tempat lahir"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                </div>

                                {{-- TANGGAL LAHIR --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Tanggal Lahir
                                    </label>

                                    <input type="date" name="birth_date"
                                        value="{{ old('birth_date', $teacher->birth_date) }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                </div>

                                {{-- PHONE --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        No. Handphone
                                    </label>

                                    <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
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

                                    <textarea rows="4" name="address" placeholder="Alamat"
                                        class="w-full p-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm resize-none transition-all">{{ old('address', $teacher->address) }}</textarea>

                                </div>

                            </div>

                            {{-- TAB DATA KEPEGAWAIAN --}}
                            <div id="tab-data-kepegawaian" class="tab-panel space-y-5 hidden">

                                {{-- NIP --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        NIP Pegawai
                                    </label>

                                    <input type="text" name="nip" value="{{ old('nip', $teacher->nip) }}"
                                        placeholder="Masukkan NIP"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                </div>

                                {{-- UNIT --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Unit Sekolah
                                    </label>

                                    <select name="unit_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                        <option value="">Pilih Unit</option>

                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ old('unit_id', $teacher->unit_id) == $unit->id ? 'selected' : '' }}>

                                                {{ $unit->unit_name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                {{-- JABATAN --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Jabatan
                                    </label>

                                    <select name="position_id"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                        <option value="">Pilih Jabatan</option>

                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ old('position_id', $teacher->position_id) == $position->id ? 'selected' : '' }}>

                                                {{ $position->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                {{-- PENDIDIKAN --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Pendidikan Terakhir
                                    </label>

                                    <input type="text" name="last_education"
                                        value="{{ old('last_education', $teacher->last_education) }}"
                                        placeholder="Contoh: S1 Pendidikan"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                </div>

                                {{-- STATUS KEPEGAWAIAN --}}
                                <div>

                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Status Kepegawaian
                                    </label>

                                    <select name="employment_status"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50
                                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400 text-sm transition-all">

                                        <option value="">Pilih Status</option>

                                        <option value="pegawai_tetap"
                                            {{ old('employment_status', $teacher->employment_status) == 'pegawai_tetap' ? 'selected' : '' }}>
                                            Pegawai Tetap
                                        </option>

                                        <option value="pegawai_tidak_tetap"
                                            {{ old('employment_status', $teacher->employment_status) == 'pegawai_tidak_tetap' ? 'selected' : '' }}>
                                            Pegawai Tidak Tetap
                                        </option>

                                    </select>

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

                                <input type="radio" name="status" value="active"
                                    {{ old('status', $teacher->status) == 'active' ? 'checked' : '' }}
                                    class="text-emerald-500 focus:ring-emerald-200">

                                Aktif

                            </label>

                            <label class="flex items-center gap-3 text-sm text-slate-700">

                                <input type="radio" name="status" value="inactive"
                                    {{ old('status', $teacher->status) == 'inactive' ? 'checked' : '' }}
                                    class="text-emerald-500 focus:ring-emerald-200">

                                Tidak Aktif

                            </label>

                        </div>

                    </div>

                    {{-- ACTION --}}
                    <div class="space-y-3">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                            text-white font-bold shadow-lg shadow-emerald-100 transition-all">

                            Simpan Perubahan

                        </button>

                        <a href="{{ route('admin.guru.index') }}"
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
        document.addEventListener('DOMContentLoaded', function() {

            const tabs = document.querySelectorAll('.tab-button');
            const panels = document.querySelectorAll('.tab-panel');

            function activateTab(button) {

                const target = button.getAttribute('data-tab-target');

                tabs.forEach(tab => {

                    tab.classList.remove(
                        'border-b-2',
                        'border-emerald-500',
                        'text-emerald-600',
                        'bg-emerald-50',
                        'font-bold'
                    );

                    tab.classList.add(
                        'text-slate-500',
                        'hover:text-emerald-600',
                        'hover:bg-emerald-50',
                        'font-semibold'
                    );

                });

                button.classList.remove(
                    'text-slate-500',
                    'hover:text-emerald-600',
                    'hover:bg-emerald-50',
                    'font-semibold'
                );

                button.classList.add(
                    'border-b-2',
                    'border-emerald-500',
                    'text-emerald-600',
                    'bg-emerald-50',
                    'font-bold'
                );

                panels.forEach(panel => {

                    if (panel.id === target) {
                        panel.classList.remove('hidden');
                    } else {
                        panel.classList.add('hidden');
                    }

                });

            }

            tabs.forEach(button => {

                button.addEventListener('click', function() {
                    activateTab(this);
                });

            });

            if (tabs.length > 0) {
                activateTab(tabs[0]);
            }

        });
    </script>
@endsection
