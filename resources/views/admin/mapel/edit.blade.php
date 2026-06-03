@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>

            <h1 class="text-[30px] font-bold text-slate-800">
                Edit Mata Pelajaran
            </h1>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.mapel.update', $subject->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM INPUT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-5">

                        {{-- UNIT --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Unit
                            </label>

                            <select name="unit_id"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                                <option value="">
                                    Pilih Unit
                                </option>

                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit_id', $subject->unit_id) == $unit->id ? 'selected' : '' }}>

                                        {{ $unit->unit_name }}

                                    </option>
                                @endforeach

                            </select>

                            @error('unit_id')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- KODE MAPEL --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Kode Mapel
                            </label>

                            <input type="text" name="subject_code"
                                value="{{ old('subject_code', $subject->subject_code) }}"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                            @error('subject_code')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- NAMA MAPEL --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nama Mata Pelajaran
                            </label>

                            <input type="text" name="subject_name"
                                value="{{ old('subject_name', $subject->subject_name) }}"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400">

                            @error('subject_name')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">

                    <div class="space-y-3">

                        {{-- BUTTON UPDATE --}}
                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-blue-500 hover:bg-blue-600
                            text-white font-bold shadow-lg shadow-blue-100 transition-all">

                            Simpan Perubahan

                        </button>

                        {{-- BUTTON CANCEL --}}
                        <a href="{{ route('admin.mapel.index') }}"
                            class="w-full h-12 rounded-2xl bg-slate-100 hover:bg-slate-200
                            text-slate-700 font-bold inline-flex items-center justify-center transition-all">

                            Batal

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>
@endsection
