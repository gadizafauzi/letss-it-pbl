    <aside id="sidebar" class="sidebar fixed lg:relative z-50 lg:z-0 w-[290px] h-screen bg-white border-r border-slate-200 flex flex-col transition-all duration-300">

    {{-- LOGO --}}
    <div class="h-20 border-b border-slate-100 flex items-center px-6 shrink-0">
        <div class="flex items-center gap-4">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                <i data-lucide="school" class="w-6 h-6 text-white"></i>
            </div>

            <div class="sidebar-text">
                <h1 class="text-sm font-extrabold tracking-tight text-slate-800">
                    SIT Mutiara Qur'an
                </h1>

                <p class="text-xs text-slate-400 mt-0.5">
                    Student Panel
                </p>
            </div>

        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-5 py-6 space-y-7">

        {{-- DASHBOARD --}}
        <div>
            <p class="sidebar-title">
                Dashboard
            </p>

            <a href="{{ route('student.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active-sidebar' : '' }}">

                <span class="sidebar-icon">
                    <i data-lucide="layout-dashboard"></i>
                </span>

                <span class="sidebar-text">
                    Dashboard
                </span>

            </a>
        </div>

        {{-- AKADEMIK --}}
        <div>
            <p class="sidebar-title">
                Akademik
            </p>

            <div class="space-y-2">

                <a href="{{ route('student.nilai') }}"
                    class="sidebar-link {{ request()->routeIs('student.nilai') ? 'active-sidebar' : '' }}">

                    <span class="sidebar-icon">
                        <i data-lucide="clipboard-list"></i>
                    </span>

                    <span class="sidebar-text">
                        Nilai
                    </span>

                </a>

                <a href="{{ route('student.tagihan') }}"
                    class="sidebar-link {{ request()->routeIs('student.tagihan') ? 'active-sidebar' : '' }}">

                    <span class="sidebar-icon">
                        <i data-lucide="wallet"></i>
                    </span>

                    <span class="sidebar-text">
                        Tagihan
                    </span>

                </a>

            </div>
        </div>

        {{-- AKUN --}}
        <div>
            <p class="sidebar-title">
                Akun
            </p>

            <a href="{{ route('student.profil') }}"
                class="sidebar-link {{ request()->routeIs('student.profil') ? 'active-sidebar' : '' }}">

                <span class="sidebar-icon">
                    <i data-lucide="user"></i>
                </span>

                <span class="sidebar-text">
                    Profil
                </span>

            </a>
        </div>

    </nav>

    {{-- LOGOUT --}}
    <div class="p-5 border-t border-slate-100 shrink-0">

        <button type="button" id="studentLogoutBtn"
            class="logout-btn w-full h-12 rounded-2xl bg-red-500 hover:bg-red-600 transition-all duration-300 text-white font-semibold inline-flex items-center justify-center gap-3">

            <i data-lucide="log-out" class="w-5 h-5"></i>

            <span class="sidebar-text">
                Logout
            </span>

        </button>

    </div>

</aside>
