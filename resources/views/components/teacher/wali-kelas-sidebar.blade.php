<aside id="sidebar" class="teacher-sidebar-panel sidebar z-50 w-[290px] flex flex-col min-h-screen transition-all duration-300">

    {{-- LOGO --}}
    <div class="h-20 flex items-center px-6 shrink-0">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-white flex items-center justify-center shadow-lg shrink-0 overflow-hidden" style="box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--theme-primary) 10%, transparent); box-shadow: 0 4px 6px -4px color-mix(in srgb, var(--theme-primary) 10%, transparent);">
                    <img src="{{ asset('images/logomq.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>

                <div class="logo-text flex-1 flex flex-col justify-center pr-4">
                    <h1 class="text-sm font-extrabold tracking-tight">
                        Wali Kelas Panel
                    </h1>
                    <p class="mt-0.5">
                        Mutiara Qur'an
                    </p>
                </div>
            </div>

            <!-- Close Button for Mobile -->
            <button type="button" class="mobile-close-btn lg:hidden text-white/70 hover:text-white transition-colors focus:outline-none shrink-0 pl-2">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="sidebar-menu flex-1 flex flex-col overflow-y-auto px-5 py-6 space-y-7">

        {{-- UTAMA WALI KELAS --}}
        <div>
            <p class="sidebar-title">Wali Kelas</p>
            <div class="space-y-2">
                <a href="{{ route('teacher.wali-kelas.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.wali-kelas.dashboard') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="layout-dashboard"></i></span>
                    <span class="sidebar-text">Dashboard Wali Kelas</span>
                </a>

                <a href="{{ route('teacher.wali-data-siswa') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.wali-data-siswa') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="users"></i></span>
                    <span class="sidebar-text">Data Siswa</span>
                </a>

                <a href="{{ route('teacher.wali-rekap-nilai') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.wali-rekap-nilai') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="bar-chart-3"></i></span>
                    <span class="sidebar-text">Rekap Nilai</span>
                </a>

                <a href="{{ route('coming-soon') }}" class="sidebar-link">
                    <span class="sidebar-icon"><i data-lucide="check-square"></i></span>
                    <span class="sidebar-text">Absensi Siswa</span>
                </a>

                <a href="{{ route('coming-soon') }}" class="sidebar-link">
                    <span class="sidebar-icon"><i data-lucide="sticky-note"></i></span>
                    <span class="sidebar-text">Catatan Wali Kelas</span>
                </a>
            </div>
        </div>

        {{-- AKADEMIK REGULER --}}
        <div>
            <p class="sidebar-title">Tugas Mengajar</p>
            <div class="space-y-2">
                <a href="{{ route('teacher.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.dashboard') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="monitor"></i></span>
                    <span class="sidebar-text">Dashboard Guru</span>
                </a>

                <a href="{{ route('teacher.kelas-saya') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.kelas-saya') || request()->routeIs('teacher.data-siswa') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="book-open"></i></span>
                    <span class="sidebar-text">Kelas Saya</span>
                </a>

                <a href="{{ route('teacher.input-nilai') }}"
                    class="sidebar-link {{ request()->routeIs('teacher.input-nilai') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="clipboard-check"></i></span>
                    <span class="sidebar-text">Input Nilai</span>
                </a>
            </div>
        </div>

        {{-- AKUN --}}
        <div>
            <p class="sidebar-title">Akun</p>
            <a href="{{ route('teacher.profil') }}"
                class="sidebar-link {{ request()->routeIs('teacher.profil') ? 'active-sidebar' : '' }}">
                <span class="sidebar-icon"><i data-lucide="user"></i></span>
                <span class="sidebar-text">Profil</span>
            </a>
        </div>

    </nav>

    {{-- LOGOUT --}}
    <div class="sidebar-logout mt-auto shrink-0 mb-2 lg:mb-4 border-t border-slate-100/10 pt-3 lg:pt-5">
        <button type="button" id="teacherLogoutBtn"
            class="sidebar-link w-full group !mb-0 !bg-transparent !shadow-none">
            <span class="sidebar-icon"><i data-lucide="log-out"></i></span>
            <div class="flex-1 pr-5 pl-4 logout-text transition-opacity duration-300">
                <div class="w-full h-11 rounded-xl bg-red-500 group-hover:bg-red-600 transition-all duration-300 text-white font-semibold flex items-center justify-center shadow-lg shadow-red-500/30">
                    Logout
                </div>
            </div>
        </button>
    </div>

</aside>

<script>
    if (window.innerWidth > 1024 && localStorage.getItem('teacherSidebarCollapsed') === 'true') {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.transition = 'none';
        sidebar.classList.add('sidebar-collapse');
        sidebar.offsetHeight;
        requestAnimationFrame(() => {
            sidebar.style.transition = '';
        });
    }
</script>
