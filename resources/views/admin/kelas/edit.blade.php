@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <div>
            <h1 class="text-[30px] font-bold text-slate-800">
                Edit Kelas
            </h1>
        </div>

        <form action="{{ route('admin.kelas.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                {{-- FORM --}}
                <div class="xl:col-span-9">

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 space-y-5">

                        {{-- UNIT --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Unit
                            </label>

                            <select name="unit_id" class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700">

                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ $class->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->unit_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- CLASS --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Nama Kelas
                            </label>

                            <input type="text" name="class_name" value="{{ old('class_name', $class->class_name) }}"
                                class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700">
                        </div>

                        {{-- WALI --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                Wali Kelas
                            </label>

                            <select name="homeroom_teacher_id" class="w-full h-12 px-4 rounded-2xl border border-slate-200
                                focus:outline-none focus:ring-4 focus:ring-blue-100
                                focus:border-blue-400 text-sm text-slate-700">

                                <option value="">
                                    Pilih Wali Kelas
                                </option>

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
                            class="w-full h-12 rounded-2xl bg-blue-500 hover:bg-blue-600
                            text-white font-bold transition-all shadow-lg shadow-blue-100">

                            Update

                        </button>

                        <a href="{{ route('admin.kelas.index') }}"
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
