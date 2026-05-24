<aside id="sidebar" class="teacher-sidebar">

    {{-- LOGO --}}
    <div class="h-20 border-b border-slate-100 flex items-center px-6 shrink-0">
        <div class="flex items-center gap-4">

            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-emerald-200">
                <i data-lucide="school-2" class="w-6 h-6 text-white"></i>
            </div>

            <div class="teacher-sidebar-text">
                <h1 class="text-sm font-extrabold tracking-tight text-slate-800">
                    SIT Mutiara Qur'an
                </h1>

                <p class="text-xs text-slate-400 mt-0.5">
                    Teacher Panel
                </p>
            </div>

        </div>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-5 py-6 space-y-7">

        {{-- DASHBOARD --}}
        <div>
            <p class="teacher-sidebar-title">
                Dashboard
            </p>

            <a href="{{ route('teacher.dashboard') }}"
                class="teacher-sidebar-link {{ request()->routeIs('teacher.dashboard') ? 'teacher-active-sidebar' : '' }}">

                <span class="teacher-sidebar-icon">
                    <i data-lucide="layout-dashboard"></i>
                </span>

                <span class="teacher-sidebar-text">
                    Dashboard
                </span>

            </a>
        </div>

        {{-- AKADEMIK --}}
        <div>
            <p class="teacher-sidebar-title">
                Akademik
            </p>

            <div class="space-y-2">

                <a href="{{ route('teacher.kelas-saya') }}"
                    class="teacher-sidebar-link {{ request()->routeIs('teacher.kelas-saya') || request()->routeIs('teacher.data-siswa') ? 'teacher-active-sidebar' : '' }}">

                    <span class="teacher-sidebar-icon">
                        <i data-lucide="book-open"></i>
                    </span>

                    <span class="teacher-sidebar-text">
                        Kelas Saya
                    </span>

                </a>

                <a href="{{ route('teacher.input-nilai') }}"
                    class="teacher-sidebar-link {{ request()->routeIs('teacher.input-nilai') || request()->routeIs('teacher.input-nilai.assignment') ? 'teacher-active-sidebar' : '' }}">

                    <span class="teacher-sidebar-icon">
                        <i data-lucide="clipboard-check"></i>
                    </span>

                    <span class="teacher-sidebar-text">
                        Input Nilai
                    </span>

                </a>

            </div>
        </div>

        {{-- KHUSUS WALI KELAS --}}
        @if(isset($homeroomClass) && $homeroomClass)

            <div>
                <p class="teacher-sidebar-title">
                    Wali Kelas
                </p>

                <div class="space-y-2">

                    <a href="{{ route('teacher.wali-data-siswa') }}"
                        class="teacher-sidebar-link {{ request()->routeIs('teacher.wali-data-siswa') ? 'teacher-active-sidebar' : '' }}">

                        <span class="teacher-sidebar-icon">
                            <i data-lucide="school"></i>
                        </span>

                        <span class="teacher-sidebar-text">
                            Data Kelas
                        </span>

                    </a>

                    <a href="{{ route('teacher.wali-rekap-nilai') }}"
                        class="teacher-sidebar-link {{ request()->routeIs('teacher.wali-rekap-nilai') ? 'teacher-active-sidebar' : '' }}">

                        <span class="teacher-sidebar-icon">
                            <i data-lucide="bar-chart-3"></i>
                        </span>

                        <span class="teacher-sidebar-text">
                            Rekap Nilai
                        </span>

                    </a>

                </div>
            </div>

        @endif

        {{-- AKUN --}}
        <div>
            <p class="teacher-sidebar-title">
                Akun
            </p>

            <a href="{{ route('teacher.profil') }}"
                class="teacher-sidebar-link {{ request()->routeIs('teacher.profil') ? 'teacher-active-sidebar' : '' }}">

                <span class="teacher-sidebar-icon">
                    <i data-lucide="user-round"></i>
                </span>

                <span class="teacher-sidebar-text">
                    Profil
                </span>

            </a>
        </div>

    </nav>

    {{-- LOGOUT --}}
    <div class="p-5 border-t border-slate-100 shrink-0">

        <button type="button" id="teacherLogoutBtn"
            class="teacher-logout-btn w-full h-12 rounded-2xl bg-red-500 hover:bg-red-600 transition-all duration-300 text-white font-semibold inline-flex items-center justify-center gap-3">

            <i data-lucide="log-out" class="w-5 h-5"></i>

            <span class="teacher-sidebar-text">
                Logout
            </span>

        </button>

    </div>

</aside>
