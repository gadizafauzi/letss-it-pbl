@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-[30px] font-bold text-slate-800">
                Tambah Mata Pelajaran
            </h1>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.mapel.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM INPUT --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-6">

                        {{-- UNIT --}}
                        <div>
                            <label for="unit_id" class="block text-sm font-semibold text-slate-700 mb-2">
                                Unit
                            </label>

                            <select id="unit_id" name="unit_id" required
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                            focus:outline-none focus:ring-4 focus:ring-blue-100
                            focus:border-blue-400 text-sm text-slate-700">

                                <option value="" disabled @selected(!old('unit_id'))>
                                    Pilih Unit
                                </option>

                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @selected(old('unit_id') == $unit->id)>
                                        {{ $unit->unit_name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('unit_id')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- KODE MAPEL --}}
                        <div>
                            <label for="subject_code" class="block text-sm font-semibold text-slate-700 mb-2">
                                Kode Mapel
                            </label>

                            <input id="subject_code" type="text" name="subject_code" value="{{ old('subject_code') }}"
                                required placeholder="Contoh: MPL001"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                            focus:outline-none focus:ring-4 focus:ring-blue-100
                            focus:border-blue-400 text-sm text-slate-700">

                            @error('subject_code')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NAMA MAPEL --}}
                        <div>
                            <label for="subject_name" class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Mata Pelajaran
                            </label>

                            <input id="subject_name" type="text" name="subject_name" value="{{ old('subject_name') }}"
                                required placeholder="Contoh: Matematika"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                            focus:outline-none focus:ring-4 focus:ring-blue-100
                            focus:border-blue-400 text-sm text-slate-700">

                            @error('subject_name')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5 space-y-3">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-blue-500 hover:bg-blue-600
                        text-white font-semibold shadow-lg shadow-blue-100 transition-all">

                            Simpan

                        </button>

                        <a href="{{ route('admin.mapel.index') }}"
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
