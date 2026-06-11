@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.mengajar.index') }}"
                class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Edit Data Mengajar</h1>
        </div>

        <form action="{{ route('admin.mengajar.update', $teachingAssignment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-9">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] shadow-sm p-6 space-y-5">

                        {{-- GURU --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Guru</label>
                            <select name="teacher_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Guru</option>
                                @foreach ($teachers as $t)
                                    <option value="{{ $t->id }}" {{ old('teacher_id', $teachingAssignment->teacher_id) == $t->id ? 'selected' : '' }}>
                                        {{ $t->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- MAPEL --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Mata Pelajaran</label>
                            <select name="subject_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($subjects as $s)
                                    <option value="{{ $s->id }}" {{ old('subject_id', $teachingAssignment->subject_id) == $s->id ? 'selected' : '' }}>
                                        {{ $s->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- KELAS --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kelas</label>
                            <select name="class_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $c)
                                    <option value="{{ $c->id }}" {{ old('class_id', $teachingAssignment->class_id) == $c->id ? 'selected' : '' }}>
                                        {{ $c->class_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- TAHUN AJARAN --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tahun Ajaran</label>
                            <select name="academic_year_id"
                                class="w-full h-12 px-4 rounded-2xl border bg-white/50 dark:bg-slate-900/50 border-sky-100 dark:border-slate-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm text-slate-700 dark:text-slate-200 transition-all">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($years as $y)
                                    <option value="{{ $y->id }}" {{ old('academic_year_id', $teachingAssignment->academic_year_id) == $y->id ? 'selected' : '' }}>
                                        {{ $y->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('academic_year_id')
                                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">
                    <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-3xl shadow-sm p-5 space-y-3">
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 text-white font-bold shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all border-none cursor-pointer">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.mengajar.index') }}"
                            class="w-full h-12 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold inline-flex items-center justify-center transition-all no-underline">
                            Batal
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
