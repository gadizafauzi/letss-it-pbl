@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.guru.index') }}"
                    class="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all no-underline">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                    Detail Guru
                </h1>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.guru.edit', $teacher->id) }}"
                    class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                           bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 transition-all no-underline">
                    <i data-lucide="square-pen" class="w-4 h-4"></i>Edit Data
                </a>
            </div>
        </div>

        {{-- DETAIL CARD --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-[2rem] overflow-hidden shadow-sm">
            <div class="p-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-[var(--theme-primary)] dark:text-blue-400">
                            {{ $teacher->full_name ?? '-' }}
                        </h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                            NIP: <span class="font-semibold">{{ $teacher->nip ?? '-' }}</span> &nbsp;|&nbsp; Status:
                            <span class="font-semibold">{{ ucfirst($teacher->status ?? '-') }}</span>
                        </p>
                    </div>

                    @if (!empty($teacher->photo))
                        <div
                            class="w-24 h-24 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="Foto Guru"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div
                            class="w-24 h-24 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 flex items-center justify-center">
                            <i data-lucide="user-circle-2" class="w-12 h-12 text-slate-300 dark:text-slate-600"></i>
                        </div>
                    @endif
                </div>
            </div>

            {{-- TAB HEADER --}}
            <div class="border-b border-slate-200 dark:border-slate-700 px-6 pt-2 bg-white dark:bg-slate-800 rounded-b-none">
                <div class="flex flex-wrap gap-2">
                    <button type="button" data-tab-target="tab-data-pribadi"
                        class="tab-btn h-11 px-5 rounded-t-2xl border-b-2 border-blue-500 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 text-sm font-bold transition-all">
                        Data Pribadi
                    </button>
                    <button type="button" data-tab-target="tab-data-kepegawaian"
                        class="tab-btn h-11 px-5 rounded-t-2xl text-slate-500 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-sm font-semibold transition-all">
                        Data Kepegawaian
                    </button>
                </div>
            </div>

            {{-- TAB CONTENT --}}
            <div class="p-5 md:p-6 bg-slate-50/50 dark:bg-slate-800/20">
                
                {{-- TAB: DATA PRIBADI --}}
                <div id="tab-data-pribadi" class="tab-panel space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Nama Lengkap</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->full_name ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Jenis Kelamin</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">
                                {{ $teacher->gender === 'male' ? 'Laki-laki' : ($teacher->gender === 'female' ? 'Perempuan' : '-') }}
                            </p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Tempat Lahir</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->birth_place ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Tanggal Lahir</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->birth_date ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Pendidikan Terakhir</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->last_education ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">No. Handphone</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->phone ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2 border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Alamat</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200 leading-relaxed">{{ $teacher->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- TAB: DATA KEPEGAWAIAN --}}
                <div id="tab-data-kepegawaian" class="tab-panel space-y-5 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">NIP</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->nip ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Unit Sekolah</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->unit->unit_name ?? ($teacher->unit->name ?? '-') }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Jabatan</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->position->name ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Status Kepegawaian</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->employment_status ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Akun User</p>
                            <p class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">{{ $teacher->user->username ?? '-' }}</p>
                        </div>
                        <div class="border-b border-slate-100 dark:border-slate-700/50 pb-2">
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1">Status</p>
                            @php
                                $status = strtolower($teacher->status ?? '');
                                $statusLabel = match ($status) {
                                    'active' => 'Aktif',
                                    'inactive' => 'Tidak Aktif',
                                    default => ucfirst($status ?: '-'),
                                };
                                $statusCls = match ($status) {
                                    'active' => 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/20',
                                    default => 'bg-slate-50 text-slate-600 dark:bg-slate-500/10 dark:text-slate-400 border-slate-200 dark:border-slate-500/20',
                                };
                            @endphp
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold border {{ $statusCls }} mt-0.5">
                                {{ $statusLabel }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-btn');
            const panels = document.querySelectorAll('.tab-panel');

            function setActiveTab(btn) {
                const targetId = btn.getAttribute('data-tab-target');

                tabs.forEach(b => {
                    b.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600',
                        'bg-blue-50', 'font-bold');
                    b.classList.add('text-slate-500', 'hover:text-blue-600', 'hover:bg-blue-50',
                        'font-semibold');
                    
                    // Dark mode specifics
                    b.classList.remove('dark:text-blue-400', 'dark:bg-blue-500/10');
                    b.classList.add('dark:text-slate-400', 'dark:hover:text-blue-400', 'dark:hover:bg-blue-500/10');
                });

                btn.classList.remove('text-slate-500', 'hover:text-blue-600', 'hover:bg-blue-50',
                    'font-semibold');
                btn.classList.add('border-b-2', 'border-blue-500', 'text-blue-600', 'bg-blue-50',
                    'font-bold');
                
                // Dark mode specifics
                btn.classList.remove('dark:text-slate-400', 'dark:hover:text-blue-400', 'dark:hover:bg-blue-500/10');
                btn.classList.add('dark:text-blue-400', 'dark:bg-blue-500/10');

                panels.forEach(p => p.classList.toggle('hidden', p.id !== targetId));
            }

            tabs.forEach(btn => btn.addEventListener('click', () => setActiveTab(btn)));

            const defaultTab = document.querySelector('[data-tab-target="tab-data-pribadi"]');
            if (defaultTab) setActiveTab(defaultTab);
        });
    </script>
@endsection


