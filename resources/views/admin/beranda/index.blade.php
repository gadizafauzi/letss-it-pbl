@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- PAGE HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>

                <h1 class="text-[28px] font-semibold text-slate-800">
                    CMS - Beranda
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola konten halaman beranda website sekolah
                </p>

            </div>

            {{-- BUTTON --}}
            <div class="flex items-center gap-3">

                {{-- PREVIEW --}}
                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition-all inline-flex items-center gap-2 text-sm font-medium text-slate-700">

                    <i data-lucide="eye" class="w-4 h-4"></i>

                    Preview

                </button>

                {{-- SAVE --}}
                <button
                    class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white transition-all inline-flex items-center gap-2 text-sm font-semibold shadow-lg shadow-emerald-100">

                    <i data-lucide="save" class="w-4 h-4"></i>

                    Simpan Perubahan

                </button>

            </div>

        </div>

        {{-- HERO SECTION --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                        <i data-lucide="layout-template" class="w-5 h-5"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-semibold text-[var(--theme-primary)]">
                            Hero Section
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Banner utama halaman beranda
                        </p>

                    </div>

                </div>

                <label class="inline-flex items-center cursor-pointer">

                    <input type="checkbox" checked class="sr-only peer">

                    <div
                        class="relative w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-emerald-500 transition-all after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:w-5 after:h-5 after:rounded-full after:transition-all peer-checked:after:translate-x-full">
                    </div>

                </label>

            </div>

            {{-- BODY --}}
            <div class="p-6 grid grid-cols-1 xl:grid-cols-2 gap-6">

                {{-- LEFT --}}
                <div class="space-y-5">

                    {{-- TITLE --}}
                    <div>

                        <label class="text-sm font-medium text-slate-700">
                            Judul Hero
                        </label>

                        <input type="text" value="Selamat Datang di Sekolah Islam Terpadu"
                            class="mt-2 w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 text-sm">

                    </div>

                    {{-- SUBTITLE --}}
                    <div>

                        <label class="text-sm font-medium text-slate-700">
                            Deskripsi
                        </label>

                        <textarea rows="5"
                            class="mt-2 w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 text-sm resize-none">Membentuk generasi berakhlak mulia, cerdas, dan berprestasi.</textarea>

                    </div>

                    {{-- BUTTON --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>

                            <label class="text-sm font-medium text-slate-700">
                                Text Button
                            </label>

                            <input type="text" value="Daftar Sekarang"
                                class="mt-2 w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 text-sm">

                        </div>

                        <div>

                            <label class="text-sm font-medium text-slate-700">
                                Link Button
                            </label>

                            <input type="text" value="/ppdb"
                                class="mt-2 w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 text-sm">

                        </div>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div>

                    <label class="text-sm font-medium text-slate-700">
                        Gambar Hero
                    </label>

                    <div
                        class="mt-2 border-2 border-dashed border-slate-200 rounded-3xl p-6 bg-slate-50 flex flex-col items-center justify-center text-center min-h-[320px]">

                        <div
                            class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">

                            <i data-lucide="image-plus" class="w-8 h-8"></i>

                        </div>

                        <h3 class="text-sm font-semibold text-slate-700">
                            Upload Gambar Hero
                        </h3>

                        <p class="text-xs text-slate-400 mt-2 max-w-sm">
                            Format JPG, PNG atau WEBP. Ukuran maksimal 2MB.
                        </p>

                        <button
                            class="mt-5 h-11 px-5 rounded-2xl bg-white border border-slate-200 hover:bg-slate-100 transition-all text-sm font-medium text-slate-700 inline-flex items-center gap-2">

                            <i data-lucide="upload" class="w-4 h-4"></i>

                            Pilih Gambar

                        </button>

                    </div>

                </div>

            </div>

        </div>

        {{-- TENTANG SINGKAT --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">

                        <i data-lucide="badge-info" class="w-5 h-5"></i>

                    </div>

                    <div>

                        <h2 class="text-sm font-semibold text-[var(--theme-primary)]">
                            Tentang Singkat
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Informasi singkat tentang sekolah
                        </p>

                    </div>

                </div>

            </div>

            {{-- BODY --}}
            <div class="p-6 grid grid-cols-1 xl:grid-cols-2 gap-6">

                {{-- CONTENT --}}
                <div class="space-y-5">

                    <div>

                        <label class="text-sm font-medium text-slate-700">
                            Judul
                        </label>

                        <input type="text" value="Tentang Sekolah Kami"
                            class="mt-2 w-full h-12 px-4 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm">

                    </div>

                    <div>

                        <label class="text-sm font-medium text-slate-700">
                            Konten
                        </label>

                        <textarea rows="7"
                            class="mt-2 w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-400 text-sm resize-none">Sekolah Islam Terpadu adalah lembaga pendidikan yang mengintegrasikan pendidikan umum dengan pendidikan agama Islam.</textarea>

                    </div>

                </div>

                {{-- IMAGE --}}
                <div>

                    <label class="text-sm font-medium text-slate-700">
                        Gambar Tentang
                    </label>

                    <div
                        class="mt-2 border-2 border-dashed border-slate-200 rounded-3xl p-6 bg-slate-50 flex flex-col items-center justify-center text-center min-h-[300px]">

                        <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4">

                            <i data-lucide="image" class="w-8 h-8"></i>

                        </div>

                        <h3 class="text-sm font-semibold text-slate-700">
                            Upload Gambar
                        </h3>

                        <p class="text-xs text-slate-400 mt-2">
                            Maksimal ukuran 2MB
                        </p>

                        <button
                            class="mt-5 h-11 px-5 rounded-2xl bg-white border border-slate-200 hover:bg-slate-100 transition-all text-sm font-medium text-slate-700 inline-flex items-center gap-2">

                            <i data-lucide="upload" class="w-4 h-4"></i>

                            Upload Gambar

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
