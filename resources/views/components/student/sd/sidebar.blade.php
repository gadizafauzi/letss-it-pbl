<aside id="sidebar" class="student-sidebar-panel z-50 w-[290px] flex flex-col transition-all duration-300">

    {{-- LOGO --}}
    <div class="h-20 flex items-center px-6 shrink-0">
        <div class="flex items-center gap-3 w-full">

            <div class="w-11 h-11 rounded-2xl bg-white flex items-center justify-center shadow-lg shrink-0 overflow-hidden" style="box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--theme-primary) 10%, transparent); box-shadow: 0 4px 6px -4px color-mix(in srgb, var(--theme-primary) 10%, transparent);">
                <img src="{{ asset('images/logomq.jpg') }}" alt="Logo SD" class="w-full h-full object-cover">
            </div>

            <div class="logo-text flex-1 flex flex-col justify-center pr-4">
                <h1 class="text-sm font-extrabold tracking-tight">
                    SD Mutiara Qur'an
                </h1>
                <p class="mt-0.5">
                    Student Panel
                </p>
            </div>

        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-5 py-6 space-y-7">

        {{-- DASHBOARD --}}
        <div>
            <p class="sidebar-title">Dashboard</p>
            <a href="{{ route('student.sd.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('student.sd.dashboard') ? 'active-sidebar' : '' }}">
                <span class="sidebar-icon"><i data-lucide="layout-dashboard"></i></span>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </div>

        {{-- AKADEMIK --}}
        <div>
            <p class="sidebar-title">Akademik</p>
            <div class="space-y-2">
                <a href="{{ route('student.nilai') }}"
                    class="sidebar-link {{ request()->routeIs('student.nilai') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="clipboard-list"></i></span>
                    <span class="sidebar-text">Nilai</span>
                </a>
                
                <a href="{{ route('student.tagihan') }}"
                    class="sidebar-link {{ request()->routeIs('student.tagihan') ? 'active-sidebar' : '' }}">
                    <span class="sidebar-icon"><i data-lucide="wallet"></i></span>
                    <span class="sidebar-text">Tagihan</span>
                </a>
            </div>
        </div>

        {{-- AKUN --}}
        <div>
            <p class="sidebar-title">Akun</p>
            <a href="{{ route('student.profil') }}"
                class="sidebar-link {{ request()->routeIs('student.profil') ? 'active-sidebar' : '' }}">
                <span class="sidebar-icon"><i data-lucide="user"></i></span>
                <span class="sidebar-text">Profil</span>
            </a>
        </div>

    </nav>

    {{-- LOGOUT --}}
    <div class="mt-auto shrink-0 mb-4 border-t border-slate-100/10 pt-5">
        <button type="button" id="studentLogoutBtn"
            class="sidebar-link w-full group !mb-0 !bg-transparent !shadow-none">
            <span class="sidebar-icon">
                <i data-lucide="log-out"></i>
            </span>
            <div class="flex-1 pr-5 pl-4 logout-text transition-opacity duration-300">
                <div class="w-full h-11 rounded-xl bg-red-500 group-hover:bg-red-600 transition-all duration-300 text-white font-semibold flex items-center justify-center shadow-lg shadow-red-500/30">
                    Logout
                </div>
            </div>
        </button>
    </div>

</aside>

<script>
    if (window.innerWidth > 1024 && localStorage.getItem('studentSidebarCollapsed') === 'true') {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.transition = 'none';
        sidebar.classList.add('sidebar-collapse');
        sidebar.offsetHeight; 
        requestAnimationFrame(() => {
            sidebar.style.transition = '';
        });
    }
</script>
