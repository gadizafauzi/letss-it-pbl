{{-- SIDEBAR --}}
<aside id="sidebar"
    class="sidebar fixed top-0 left-0 lg:relative z-50 lg:z-0 h-screen flex flex-col transition-all duration-300">

    {{-- LOGO --}}
    <div class="h-20 border-b border-white/[0.06] flex items-center justify-between px-4 lg:px-6">

        <div class="flex items-center gap-3">

            <div
                class="w-9 h-9 lg:w-12 lg:h-12 rounded-xl lg:rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-900/40">
                <i data-lucide="school-2" class="w-4 h-4 lg:w-6 lg:h-6 text-white"></i>
            </div>

            <div class="logo-text">
                <h1 class="text-sm font-extrabold tracking-tight text-slate-100">
                    SIT Mutiara Qur'an
                </h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    Administrator Panel
                </p>
            </div>

        </div>

    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 py-5 space-y-4">

        {{-- DASHBOARD --}}
        <div>

            <p class="sidebar-title">Dashboard</p>

            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active-sidebar' : '' }}">
                <span class="sidebar-icon"><i data-lucide="layout-dashboard"></i></span>
                <span class="sidebar-text">Dashboard</span>
            </a>

        </div>

        {{-- DATA MASTER --}}
        <div>

            <p class="sidebar-title">Data Master</p>

            <div class="space-y-2">

                {{-- DATA SISWA --}}
                <a href="{{ route('admin.siswa.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.siswa.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="graduation-cap"></i></span>
                    <span class="sidebar-text">Data Siswa</span>
                </a>

                {{-- DATA GURU --}}
                <a href="{{ route('admin.guru.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.guru.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="badge-check"></i></span>
                    <span class="sidebar-text">Data Guru</span>
                </a>

                {{-- DATA KELAS --}}
                <a href="{{ route('admin.kelas.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.kelas.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="school"></i></span>
                    <span class="sidebar-text">Data Kelas</span>
                </a>

                {{-- MATA PELAJARAN --}}
                <a href="{{ route('admin.mapel.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.mapel.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="book-copy"></i></span>
                    <span class="sidebar-text">Mata Pelajaran</span>
                </a>

                {{-- DATA MENGAJAR --}}
                <a href="{{ route('admin.mengajar.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.mengajar.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="book-open"></i></span>
                    <span class="sidebar-text">Data Mengajar</span>
                </a>

                {{-- TAHUN AJARAN --}}
                <a href="{{ route('admin.tahun-ajaran.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.tahun-ajaran.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="calendar-days"></i></span>
                    <span class="sidebar-text">Tahun Ajaran</span>
                </a>

                {{-- JABATAN --}}
                <a href="{{ route('admin.jabatan.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.jabatan.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="user-check"></i></span>
                    <span class="sidebar-text">Jabatan</span>
                </a>

                {{-- UNIT PENDIDIKAN --}}
                <a href="{{ route('admin.unit.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.unit.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="layers-3"></i></span>
                    <span class="sidebar-text">Unit Pendidikan</span>
                </a>

                {{-- PEMBAYARAN --}}
                <a href="{{ route('admin.pembayaran.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.pembayaran.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="wallet"></i></span>
                    <span class="sidebar-text">Pembayaran</span>
                </a>

            </div>

        </div>

        {{-- CMS --}}
        <div>

            <p class="sidebar-title">CMS Sekolah</p>

            <div class="space-y-2">

                {{-- BERANDA --}}
                <a href="{{ route('admin.beranda.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.beranda.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="home"></i></span>
                    <span class="sidebar-text">Beranda</span>
                </a>

                {{-- PROFIL SEKOLAH --}}
                <a href="{{ route('admin.profil.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.profil.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="building-2"></i></span>
                    <span class="sidebar-text">Profil Sekolah</span>
                </a>

                {{-- UNIT SEKOLAH (CMS) --}}
                <a href="{{ route('admin.unit-cms.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.unit-cms.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="layout-panel-left"></i></span>
                    <span class="sidebar-text">Unit Sekolah</span>
                </a>

                {{-- BERITA --}}
                <a href="{{ route('admin.berita.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.berita.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="newspaper"></i></span>
                    <span class="sidebar-text">Berita & Kegiatan</span>
                </a>

                {{-- PPDB --}}
                <a href="{{ route('admin.ppdb.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.ppdb.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="file-text"></i></span>
                    <span class="sidebar-text">Informasi PPDB</span>
                </a>

                {{-- KONTAK --}}
                <a href="{{ route('admin.kontak.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.kontak.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="phone"></i></span>
                    <span class="sidebar-text">Kontak</span>
                </a>

            </div>

        </div>

        {{-- USER --}}
        <div>

            <p class="sidebar-title">Manajemen User</p>

            <div class="space-y-2">

                <a href="{{ route('admin.user.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.user.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="users"></i></span>
                    <span class="sidebar-text">Data User</span>
                </a>

            </div>

        </div>

        {{-- PENGATURAN --}}
        <div>

            <p class="sidebar-title">Pengaturan</p>

            <div class="space-y-2">

                <a href="{{ route('admin.profile.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="settings"></i></span>
                    <span class="sidebar-text">Profil</span>
                </a>

            </div>

        </div>

    </nav>

    {{-- FOOTER --}}
    <div class="p-4 border-t border-white/[0.06]">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="logout-btn w-full h-12 rounded-2xl bg-red-500/20 hover:bg-red-500/30 border border-red-500/25 transition-all duration-300 text-red-400 hover:text-red-300 font-semibold inline-flex items-center justify-center gap-3">
                <i data-lucide="log-out"></i>
                <span class="logout-text">Logout</span>
            </button>
        </form>

    </div>

</aside>
