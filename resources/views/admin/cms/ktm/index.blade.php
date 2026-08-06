@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-[28px] font-semibold text-slate-800 dark:text-slate-100">
        CMS Template Kartu Tanda Murid (KTM)
    </h1>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
        Kelola gambar latar belakang (*background template*) kartu identitas siswa untuk unit SD dan SMP.
    </p>
</div>

@if (session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center gap-3">
    <i data-lucide="check-circle" class="w-5 h-5 shrink-0 text-emerald-600"></i>
    <span class="text-sm font-medium">{{ session('success') }}</span>
</div>
@endif

@if ($errors->any())
<div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600">
    <div class="flex items-center gap-2 mb-2">
        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
        <p class="text-sm font-bold">Terjadi Kesalahan</p>
    </div>
    <ul class="list-disc ml-8 text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- GUIDELINE ALERT --}}
<div class="mb-6 p-5 rounded-2xl bg-blue-50/80 dark:bg-slate-800/80 border border-blue-200 dark:border-slate-700">
    <div class="flex items-start gap-3">
        <div class="p-2 bg-blue-600 text-white rounded-xl shadow-md shrink-0">
            <i data-lucide="info" class="w-5 h-5"></i>
        </div>
        <div>
            <h3 class="text-sm font-bold text-slate-800 dark:text-slate-100">Petunjuk Upload Template KTM</h3>
            <p class="text-xs text-slate-600 dark:text-slate-300 mt-1 leading-relaxed">
                • Gambar template digunakan sebagai latar belakang kartu pelajar.<br>
                • **Rekomendasi Dimensi**: <strong>420 x 260 pixel</strong> (Rasio 16:10) bertipe <strong>PNG / JPG</strong> (Maks. 2MB).<br>
                • Pastikan area untuk teks (Nama, NISN, Foto Siswa) tidak tertutup elemen penting pada desain background baru.
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- UNIT SD --}}
    @php
        $bgSd = $ktmSd && $ktmSd->value ? asset('storage/' . $ktmSd->value) : asset('images/ktmSD.png');
        $isSdCustom = $ktmSd && $ktmSd->value;
    @endphp
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-sm">
                        SD
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-slate-800 dark:text-slate-100">Template KTM Unit SD</h2>
                        <p class="text-xs text-slate-400">Kartu Tanda Murid SD</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $isSdCustom ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300' }}">
                    {{ $isSdCustom ? 'Custom Template' : 'Default Template' }}
                </span>
            </div>

            {{-- PREVIEW CARD --}}
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">Live Preview Background</label>
                <div class="w-full rounded-2xl overflow-hidden shadow-md border border-slate-200 dark:border-slate-700 relative bg-slate-100 dark:bg-slate-900" style="aspect-ratio: 420/260;">
                    <img id="preview-sd" src="{{ $bgSd }}" alt="KTM SD Template" class="w-full h-full object-cover">
                </div>
            </div>

            {{-- UPLOAD FORM --}}
            <form action="{{ route('admin.cms.ktm.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="unit" value="sd">
                
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Upload Background Baru</label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg" onchange="previewImage(this, 'preview-sd')"
                        class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/40 dark:file:text-blue-300 hover:file:bg-blue-100 cursor-pointer border border-slate-200 dark:border-slate-700 rounded-xl p-1">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-2">
                        <i data-lucide="upload" class="w-4 h-4"></i>
                        Simpan Template SD
                    </button>
            </form>

            @if ($isSdCustom)
            <form action="{{ route('admin.cms.ktm.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan template SD ke versi default?')">
                @csrf
                <input type="hidden" name="unit" value="sd">
                <button type="submit" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-200 font-medium text-xs rounded-xl transition-all flex items-center gap-1.5" title="Reset ke Template Bawaan">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    Reset
                </button>
            </form>
            @endif
                </div>
        </div>
    </div>

    {{-- UNIT SMP --}}
    @php
        $bgSmp = $ktmSmp && $ktmSmp->value ? asset('storage/' . $ktmSmp->value) : asset('images/ktmSMP.png');
        $isSmpCustom = $ktmSmp && $ktmSmp->value;
    @endphp
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-sm">
                        SMP
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-slate-800 dark:text-slate-100">Template KTM Unit SMP</h2>
                        <p class="text-xs text-slate-400">Kartu Tanda Murid SMP</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $isSmpCustom ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-300' : 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300' }}">
                    {{ $isSmpCustom ? 'Custom Template' : 'Default Template' }}
                </span>
            </div>

            {{-- PREVIEW CARD --}}
            <div class="mb-5">
                <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-2">Live Preview Background</label>
                <div class="w-full rounded-2xl overflow-hidden shadow-md border border-slate-200 dark:border-slate-700 relative bg-slate-100 dark:bg-slate-900" style="aspect-ratio: 420/260;">
                    <img id="preview-smp" src="{{ $bgSmp }}" alt="KTM SMP Template" class="w-full h-full object-cover">
                </div>
            </div>

            {{-- UPLOAD FORM --}}
            <form action="{{ route('admin.cms.ktm.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="unit" value="smp">
                
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Upload Background Baru</label>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/jpg" onchange="previewImage(this, 'preview-smp')"
                        class="block w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/40 dark:file:text-blue-300 hover:file:bg-blue-100 cursor-pointer border border-slate-200 dark:border-slate-700 rounded-xl p-1">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-2">
                        <i data-lucide="upload" class="w-4 h-4"></i>
                        Simpan Template SMP
                    </button>
            </form>

            @if ($isSmpCustom)
            <form action="{{ route('admin.cms.ktm.reset') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan template SMP ke versi default?')">
                @csrf
                <input type="hidden" name="unit" value="smp">
                <button type="submit" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-200 font-medium text-xs rounded-xl transition-all flex items-center gap-1.5" title="Reset ke Template Bawaan">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    Reset
                </button>
            </form>
            @endif
                </div>
        </div>
    </div>

</div>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
