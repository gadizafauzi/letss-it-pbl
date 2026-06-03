@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-[28px] font-semibold text-slate-800">
                Tambah Data Mengajar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Tambahkan data guru mengajar
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('admin.mengajar.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM INPUT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-6">

                        {{-- GURU --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Guru
                            </label>

                            <select name="teacher_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                                <option value="">
                                    Pilih Guru
                                </option>

                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                                        {{ $teacher->full_name }}

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
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Mata Pelajaran
                            </label>

                            <select name="subject_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                                <option value="">
                                    Pilih Mata Pelajaran
                                </option>

                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                        {{ $subject->subject_name }}

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
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Kelas
                            </label>

                            <select name="class_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                                <option value="">
                                    Pilih Kelas
                                </option>

                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>

                                        {{ $class->class_name }}

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
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tahun Ajaran
                            </label>

                            <select name="academic_year_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                                <option value="">
                                    Pilih Tahun Ajaran
                                </option>

                                @foreach ($years as $year)
                                    {{-- INI YANG DIPERBAIKI --}}
                                    <option value="{{ $year->id }}"
                                        {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>

                                        {{ $year->year }}

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
                <div class="xl:col-span-3">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5 space-y-3 sticky top-6">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-blue-500 hover:bg-blue-600
                            text-white font-semibold transition-all shadow-lg shadow-blue-100">

                            Simpan

                        </button>

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
