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
                Edit Kelas
            </h1>
        </div>

        @if ($errors->any())
            <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400">
                <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kelas.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-9">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6 space-y-5">

                        {{-- UNIT --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Unit</label>
                            <select name="unit_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $class->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->unit_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- CLASS NAME --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Kelas</label>
                            <input type="text" name="class_name" value="{{ old('class_name', $class->class_name) }}"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                        </div>

                        {{-- WALI --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Wali Kelas</label>
                            <select name="homeroom_teacher_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600
                                focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Wali Kelas</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ $class->homeroom_teacher_id == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90
                            text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.kelas.index') }}"
                            class="w-full h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700
                            text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                            Batal
                        </a>
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection
