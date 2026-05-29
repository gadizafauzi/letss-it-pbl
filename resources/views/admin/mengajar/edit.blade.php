@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-[28px] font-bold text-slate-800">
                Edit Data Mengajar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui data pengajaran guru
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.mengajar.update', $teachingAssignment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-8">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-5">

                        {{-- GURU --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Guru
                            </label>

                            <select name="teacher_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                                <option value="">
                                    Pilih Guru
                                </option>

                                @foreach ($teachers as $t)
                                    <option value="{{ $t->id }}"
                                        {{ old('teacher_id', $teachingAssignment->teacher_id) == $t->id ? 'selected' : '' }}>

                                        {{ $t->full_name }}

                                    </option>
                                @endforeach

                            </select>

                            @error('teacher_id')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- MAPEL --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Mata Pelajaran
                            </label>

                            <select name="subject_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                                <option value="">
                                    Pilih Mata Pelajaran
                                </option>

                                @foreach ($subjects as $s)
                                    <option value="{{ $s->id }}"
                                        {{ old('subject_id', $teachingAssignment->subject_id) == $s->id ? 'selected' : '' }}>

                                        {{ $s->subject_name }}

                                    </option>
                                @endforeach

                            </select>

                            @error('subject_id')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- KELAS --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Kelas
                            </label>

                            <select name="class_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                                <option value="">
                                    Pilih Kelas
                                </option>

                                @foreach ($classes as $c)
                                    <option value="{{ $c->id }}"
                                        {{ old('class_id', $teachingAssignment->class_id) == $c->id ? 'selected' : '' }}>

                                        {{ $c->class_name }}

                                    </option>
                                @endforeach

                            </select>

                            @error('class_id')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- TAHUN AJARAN --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Tahun Ajaran
                            </label>

                            <select name="academic_year_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                                <option value="">
                                    Pilih Tahun Ajaran
                                </option>

                                @foreach ($years as $y)
                                    <option value="{{ $y->id }}"
                                        {{ old('academic_year_id', $teachingAssignment->academic_year_id) == $y->id ? 'selected' : '' }}>

                                        {{ $y->year }}

                                    </option>
                                @endforeach

                            </select>

                            @error('academic_year_id')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-4">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5 space-y-3">

                        {{-- BUTTON UPDATE --}}
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                            text-white font-semibold transition-all shadow-lg shadow-emerald-100">

                            Update

                        </button>

                        {{-- BUTTON BATAL --}}
                        <a href="{{ route('admin.mengajar.index') }}"
                            class="w-full h-12 rounded-2xl bg-slate-100 hover:bg-slate-200
                            text-slate-700 font-semibold inline-flex items-center justify-center transition-all">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
