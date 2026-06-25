@extends('layouts.admin')

@section('content')
    <div class="space-y-5">
        {{-- PAGE HEADER --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
            <div>
                <h1 class="text-[24px] font-bold text-slate-800 dark:text-slate-100 mb-1">
                    Data User (Akun)
                </h1>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('admin.user.create') }}"
                    class="inline-flex items-center gap-2 h-[42px] px-5 rounded-xl text-[13px] font-bold text-white
                           bg-gradient-to-br from-[#8DAEF5] to-[#4D7EEB] hover:opacity-90 shadow-md shadow-[#4D7EEB]/30 hover:shadow-lg hover:shadow-[#4D7EEB]/40 transition-all no-underline">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>Tambah Admin
                </a>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl px-5 py-4 shadow-sm">
            <form id="filterForm" action="{{ route('admin.user.index') }}" method="GET"
                class="flex flex-wrap items-center gap-2.5">

                {{-- Search --}}
                <div class="relative flex-1 min-w-[200px]">
                    <i data-lucide="search"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <input id="searchInput" type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, username, email..."
                        class="w-full h-[42px] pl-9 pr-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                              bg-sky-50 dark:bg-slate-900/50 text-[13px] text-slate-700 dark:text-slate-200 outline-none
                              focus:border-sky-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-slate-800 transition-all">
                </div>

                {{-- Role --}}
                <select name="role" onchange="document.getElementById('filterForm').submit()"
                    class="h-[42px] px-3 border-[1.5px] border-sky-100 dark:border-slate-600 rounded-[10px]
                           bg-sky-50 dark:bg-slate-900/50 text-[13px] text-slate-700 dark:text-slate-200 outline-none min-w-[130px]
                           focus:border-sky-400 dark:focus:border-blue-500 transition-all cursor-pointer">
                    <option value="">Semua Peran</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                    <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                </select>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] border-collapse">
                    <thead>
                        <tr class="bg-sky-50/50 dark:bg-slate-800/50 border-b-[1.5px] border-sky-100 dark:border-slate-700/50">
                            @foreach (['No', 'Nama', 'Username', 'Email', 'Role', 'Status'] as $h)
                                <th class="px-4 py-3.5 text-left text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">
                                    {{ $h }}
                                </th>
                            @endforeach
                            <th class="px-4 py-3.5 text-center text-[10px] font-bold uppercase tracking-[.06em] text-slate-500 dark:text-slate-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @php
                                $statusCls = match ($user->status) {
                                    'active' => 'bg-sky-50 dark:bg-sky-500/10 text-sky-600 dark:text-sky-400 border-sky-200',
                                    'inactive' => 'bg-slate-50 dark:bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-200',
                                    default => 'bg-slate-50',
                                };
                                $roleCls = match ($user->role) {
                                    'admin' => 'bg-purple-100 text-purple-700',
                                    'teacher' => 'bg-emerald-100 text-emerald-700',
                                    'student' => 'bg-blue-100 text-blue-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <tr class="border-b border-sky-50 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-xs text-slate-400 font-semibold">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="text-[13px] font-bold text-slate-800 dark:text-slate-200">{{ $user->name }}</div>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 bg-sky-50 dark:bg-slate-700/50 px-2.5 py-1 rounded-lg">
                                        {{ $user->username }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5 text-[13px] text-slate-500 dark:text-slate-400">
                                    {{ $user->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider {{ $roleCls }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusCls }}">
                                        {{ $user->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                              hover:bg-blue-50 hover:text-blue-500 text-slate-500 transition-all inline-flex items-center justify-center shadow-sm"
                                            title="Edit/Reset Password">
                                            <i data-lucide="square-pen" class="w-[14px] h-[14px]"></i>
                                        </a>
                                        @if($user->role === 'admin' && auth()->id() !== $user->id)
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 
                                                  hover:bg-red-50 hover:text-red-500 text-slate-500 transition-all inline-flex items-center justify-center shadow-sm cursor-pointer"
                                                title="Hapus">
                                                <i data-lucide="trash-2" class="w-[14px] h-[14px]"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-slate-500">Tidak ada data user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="px-5 py-4 border-t border-slate-100 dark:border-slate-700/50">
                @if ($users->hasPages())
                    <div class="w-full overflow-x-auto">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


