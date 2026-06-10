@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-[30px] font-bold text-slate-800">
                    Tambah Kelas
                </h1>
            </div>

        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM SECTION --}}
                <div class="xl:col-span-8">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

                        {{-- HEADER --}}
                        <div class="px-6 py-5 border-b border-slate-100">

                            <h2 class="text-lg font-bold text-[var(--theme-primary)]">
                                Informasi Kelas
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Isi data kelas dengan lengkap.
                            </p>

                        </div>

                        {{-- BODY --}}
                        <div class="p-6 space-y-5">

                            {{-- UNIT --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Unit Pendidikan
                                </label>

                                <select name="unit_id"
                                    class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                    focus:outline-none focus:ring-4 focus:ring-blue-100
                                    focus:border-blue-400 text-sm text-slate-700">

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

                                @error('unit_id')
                                    <p class="text-sm text-red-500 mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- CLASS NAME --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Kelas
                                </label>

                                <input type="text" name="class_name" value="{{ old('class_name') }}"
                                    placeholder="Contoh: 1A / VII A"
                                    class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                    focus:outline-none focus:ring-4 focus:ring-blue-100
                                    focus:border-blue-400 text-sm text-slate-700">

                                @error('class_name')
                                    <p class="text-sm text-red-500 mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                            {{-- HOMEROOM --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Wali Kelas
                                </label>

                                <select name="homeroom_teacher_id"
                                    class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                    focus:outline-none focus:ring-4 focus:ring-blue-100
                                    focus:border-blue-400 text-sm text-slate-700">

                                    <option value="">
                                        Pilih Wali Kelas
                                    </option>

                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ old('homeroom_teacher_id') == $teacher->id ? 'selected' : '' }}>

                                            {{ $teacher->full_name }} ({{ $teacher->unit->unit_name ?? 'Tanpa Unit' }})

                                        </option>
                                    @endforeach

                                </select>

                                @error('homeroom_teacher_id')
                                    <p class="text-sm text-red-500 mt-2">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SIDEBAR ACTION --}}
                <div class="xl:col-span-4">

                    <div class="space-y-5">

                        {{-- ACTION CARD --}}
                        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5">

                            <h3 class="text-base font-bold text-[var(--theme-primary)] mb-4">
                                Aksi
                            </h3>

                            <div class="space-y-3">

                                {{-- SAVE --}}
                                <button type="submit"
                                    class="w-full h-12 rounded-2xl bg-blue-500
                                    hover:bg-blue-600 transition-all
                                    text-white font-semibold shadow-lg shadow-blue-100">

                                    Simpan

                                </button>

                                {{-- CANCEL --}}
                                <a href="{{ route('admin.kelas.index') }}"
                                    class="w-full h-12 rounded-2xl bg-slate-100
                                    hover:bg-slate-200 transition-all
                                    text-slate-700 font-semibold
                                    inline-flex items-center justify-center">

                                    Batal

                                </a>

                            </div>

                        </div>

                        {{-- INFO CARD --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-3xl p-5">

                            <h3 class="text-sm font-bold text-blue-700 mb-2">
                                Informasi
                            </h3>

                            <p class="text-sm text-blue-600 leading-relaxed">
                                Pastikan nama kelas tidak duplikat dalam unit
                                pendidikan yang sama.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
