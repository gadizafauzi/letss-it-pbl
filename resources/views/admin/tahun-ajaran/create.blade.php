@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>
            <h1 class="text-[28px] font-semibold text-slate-800">
                Tambah Tahun Ajaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Tambahkan data tahun ajaran baru
            </p>
        </div>

        {{-- ERROR GLOBAL --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-2xl p-4 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-6">

                        {{-- TAHUN AJARAN --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Tahun Ajaran
                            </label>

                            <input type="text"
                                name="year"
                                value="{{ old('year') }}"
                                placeholder="Contoh: 2025/2026"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                            @error('year')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- SEMESTER --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Semester Aktif
                            </label>

                            <select name="active_semester"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-emerald-100
                                focus:border-emerald-400">

                                <option value="">
                                    Pilih Semester
                                </option>

                                <option value="odd"
                                    {{ old('active_semester') == 'odd' ? 'selected' : '' }}>
                                    Ganjil
                                </option>

                                <option value="even"
                                    {{ old('active_semester') == 'even' ? 'selected' : '' }}>
                                    Genap
                                </option>

                            </select>

                            @error('active_semester')
                                <p class="text-xs text-red-500 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- SEMESTER GANJIL --}}
                        <div class="space-y-4">

                            <h3 class="text-sm font-semibold text-slate-700">
                                Semester Ganjil
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                {{-- START ODD --}}
                                <div>
                                    <label class="block text-sm text-slate-600 mb-2">
                                        Tanggal Mulai
                                    </label>

                                    <input type="date"
                                        name="start_odd"
                                        value="{{ old('start_odd') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                        focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400">

                                    @error('start_odd')
                                        <p class="text-xs text-red-500 mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- END ODD --}}
                                <div>
                                    <label class="block text-sm text-slate-600 mb-2">
                                        Tanggal Selesai
                                    </label>

                                    <input type="date"
                                        name="end_odd"
                                        value="{{ old('end_odd') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                        focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400">

                                    @error('end_odd')
                                        <p class="text-xs text-red-500 mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        {{-- SEMESTER GENAP --}}
                        <div class="space-y-4">

                            <h3 class="text-sm font-semibold text-slate-700">
                                Semester Genap
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                {{-- START EVEN --}}
                                <div>
                                    <label class="block text-sm text-slate-600 mb-2">
                                        Tanggal Mulai
                                    </label>

                                    <input type="date"
                                        name="start_even"
                                        value="{{ old('start_even') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                        focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400">

                                    @error('start_even')
                                        <p class="text-xs text-red-500 mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- END EVEN --}}
                                <div>
                                    <label class="block text-sm text-slate-600 mb-2">
                                        Tanggal Selesai
                                    </label>

                                    <input type="date"
                                        name="end_even"
                                        value="{{ old('end_even') }}"
                                        class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                        focus:outline-none focus:ring-4 focus:ring-emerald-100
                                        focus:border-emerald-400">

                                    @error('end_even')
                                        <p class="text-xs text-red-500 mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ACTION --}}
                <div class="xl:col-span-3">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5 space-y-3 sticky top-6">

                        <button type="submit"
                            class="w-full h-12 rounded-2xl bg-emerald-500 hover:bg-emerald-600
                            text-white font-semibold transition-all shadow-lg shadow-emerald-100">

                            Simpan

                        </button>

                        <a href="{{ route('admin.tahun-ajaran.index') }}"
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
