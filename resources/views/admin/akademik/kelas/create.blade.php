@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.kelas.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                Tambah Kelas
            </h1>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.kelas.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM SECTION --}}
                <div class="xl:col-span-8">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm overflow-hidden">

                        {{-- HEADER --}}
                        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700/50">
                            <h2 class="text-base font-bold text-slate-800 dark:text-slate-100">Informasi Kelas</h2>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Isi data kelas dengan lengkap.</p>
                        </div>

                        {{-- BODY --}}
                        <div class="p-6 space-y-5">

                            {{-- UNIT --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Unit Pendidikan <span class="text-red-500">*</span>
                                </label>
                                <select name="unit_id"
                                    class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                    focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30
                                    focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    <option value="">Pilih Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->unit_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- CLASS NAME --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Nama Kelas <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="class_name" value="{{ old('class_name') }}"
                                    placeholder="Contoh: 1A / VII A"
                                    class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                    focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30
                                    focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                @error('class_name')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- HOMEROOM --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Wali Kelas
                                </label>
                                <select name="homeroom_teacher_id"
                                    class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                    focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30
                                    focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                    <option value="">Pilih Wali Kelas</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ old('homeroom_teacher_id') == $teacher->id ? 'selected' : '' }}>


                                            {{ $teacher->full_name }} ({{ $teacher->unit->unit_name ?? 'Tanpa Unit' }})


                                        </option>
                                    @endforeach
                                </select>
                                @error('homeroom_teacher_id')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- SIDEBAR ACTION --}}
                <div class="xl:col-span-4">
                    <div class="space-y-4">

                        {{-- ACTION CARD --}}
                        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-3xl shadow-sm p-5">
                            <h3 class="text-sm font-bold text-slate-700 dark:text-slate-300 mb-4">Aksi</h3>
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90
                                    text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                                    Simpan
                                </button>
                                <a href="{{ route('admin.kelas.index') }}"
                                    class="w-full h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700
                                    text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                                    Batal
                                </a>
                            </div>
                        </div>

                        {{-- INFO CARD --}}
                        <div class="bg-sky-50 dark:bg-sky-900/20 border border-sky-100 dark:border-sky-800/40 rounded-3xl p-5">
                            <h3 class="text-sm font-bold text-sky-700 dark:text-sky-400 mb-2">Informasi</h3>
                            <p class="text-sm text-sky-600 dark:text-sky-500 leading-relaxed">
                                Pastikan nama kelas tidak duplikat dalam unit pendidikan yang sama.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection


