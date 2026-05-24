@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">

            <div>

                <h1 class="text-[28px] font-semibold text-slate-800">
                    Pembayaran & Tagihan
                </h1>

            </div>

            {{-- ACTION BUTTON --}}
            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-3 w-full xl:w-auto">

                {{-- EXPORT --}}
                <button
                    class="h-11 px-5 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 transition-all inline-flex items-center justify-center gap-2 text-sm font-semibold text-slate-700">

                    <i data-lucide="download" class="w-4 h-4"></i>

                    Export

                </button>

                {{-- ADD --}}
                <button
                    class="h-11 px-6 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white transition-all inline-flex items-center justify-center gap-2 text-sm font-semibold shadow-lg shadow-emerald-100">

                    <i data-lucide="plus" class="w-4 h-4"></i>

                    Tambah Tagihan

                </button>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-slate-200 rounded-3xl overflow-hidden shadow-sm">

            {{-- FILTER --}}
            <div class="p-5 border-b border-slate-100">

                <div class="flex flex-col xl:flex-row xl:items-center gap-4">

                    {{-- SEARCH --}}
                    <div class="relative flex-1">

                        <i data-lucide="search" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input type="text" placeholder="Cari NIS atau nama siswa..."
                            class="w-full h-12 pl-12 pr-4 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 focus:border-emerald-400 transition-all text-sm text-slate-700">

                    </div>

                    {{-- FILTER --}}
                    <div class="flex flex-col sm:flex-row gap-3">

                        {{-- JENJANG --}}
                        <select
                            class="h-12 px-4 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 text-sm font-medium text-slate-700">

                            <option>Semua Jenjang</option>
                            <option>SD</option>
                            <option>SMP</option>

                        </select>

                        {{-- STATUS --}}
                        <select
                            class="h-12 px-4 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 text-sm font-medium text-slate-700">

                            <option>Semua Status</option>
                            <option>Lunas</option>
                            <option>Menunggu Verifikasi</option>
                            <option>Belum Bayar</option>

                        </select>

                        {{-- JENIS --}}
                        <select
                            class="h-12 px-4 rounded-2xl border border-slate-200 bg-white focus:outline-none focus:ring-4 focus:ring-emerald-100 text-sm font-medium text-slate-700">

                            <option>Semua Jenis</option>
                            <option>SPP</option>
                            <option>Daftar Ulang</option>
                            <option>Ujian</option>

                        </select>

                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[1200px]">

                    {{-- HEAD --}}
                    <thead class="bg-slate-50 border-b border-slate-100">

                        <tr>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                NIS
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Nama Siswa
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Jenjang
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Kelas
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Jenis Pembayaran
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Nominal
                            </th>

                            <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-center text-[11px] font-bold uppercase tracking-wide text-slate-500">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-slate-100">

                        {{-- ROW --}}
                        <tr class="hover:bg-slate-50/80 transition-all">

                            {{-- NIS --}}
                            <td class="px-6 py-5 text-sm font-semibold text-slate-700">
                                2024001
                            </td>

                            {{-- NAMA --}}
                            <td class="px-6 py-5 text-sm font-semibold text-slate-800">
                                Ahmad Fauzi
                            </td>

                            {{-- JENJANG --}}
                            <td class="px-6 py-5 text-sm text-slate-600">
                                SMP
                            </td>

                            {{-- KELAS --}}
                            <td class="px-6 py-5 text-sm text-slate-600">
                                7A
                            </td>

                            {{-- JENIS --}}
                            <td class="px-6 py-5 text-sm text-slate-600">
                                SPP Bulan Maret 2026
                            </td>

                            {{-- NOMINAL --}}
                            <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                Rp 500.000
                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-5 text-sm text-emerald-600 font-medium">
                                Lunas
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- DETAIL --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-700 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                    {{-- EDIT --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-500 hover:text-emerald-600 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="square-pen" class="w-4 h-4"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        {{-- ROW --}}
                        <tr class="hover:bg-slate-50/80 transition-all">

                            <td class="px-6 py-5 text-sm font-semibold text-slate-700">
                                2024002
                            </td>

                            <td class="px-6 py-5 text-sm font-semibold text-slate-800">
                                Fatimah Zahra
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                SMP
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                7A
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                SPP Bulan Maret 2026
                            </td>

                            <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                Rp 500.000
                            </td>

                            <td class="px-6 py-5 text-sm text-amber-500 font-medium">
                                Menunggu Verifikasi
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- DETAIL --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-700 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                    {{-- VERIFIKASI --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-500 hover:text-emerald-600 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="badge-check" class="w-4 h-4"></i>

                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="trash-2" class="w-4 h-4"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                        {{-- ROW --}}
                        <tr class="hover:bg-slate-50/80 transition-all">

                            <td class="px-6 py-5 text-sm font-semibold text-slate-700">
                                2024003
                            </td>

                            <td class="px-6 py-5 text-sm font-semibold text-slate-800">
                                Muhammad Rizki
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                SMP
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                7B
                            </td>

                            <td class="px-6 py-5 text-sm text-slate-600">
                                SPP Bulan Maret 2026
                            </td>

                            <td class="px-6 py-5 text-sm font-medium text-slate-700">
                                Rp 500.000
                            </td>

                            <td class="px-6 py-5 text-sm text-red-500 font-medium">
                                Belum Bayar
                            </td>

                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- DETAIL --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-700 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="eye" class="w-4 h-4"></i>

                                    </button>

                                    {{-- EDIT --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-500 hover:text-emerald-600 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="square-pen" class="w-4 h-4"></i>

                                    </button>

                                    {{-- DELETE --}}
                                    <button
                                        class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 inline-flex items-center justify-center transition-all">

                                        <i data-lucide="trash-2" class="w-4 h-4"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
