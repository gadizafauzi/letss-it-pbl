        {{-- SIDEBAR --}}
        <aside id="sidebar"
            class="sidebar fixed lg:relative z-50 lg:z-0 w-[290px] h-screen bg-white border-r border-slate-200 flex flex-col transition-all duration-300">
            {{-- LOGO --}}
            <div class="h-20 border-b border-slate-100 flex items-center justify-between px-6">

                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg shadow-blue-200">

                        <i data-lucide="school-2" class="w-6 h-6 text-white"></i>

                    </div>

                    <div class="logo-text">
                        <h1 class="text-sm font-extrabold tracking-tight text-slate-800">
                            SIT Mutiara Qur'an
                        </h1>

                        <p class="text-xs text-slate-400 mt-0.5">
                            Administrator Panel
                        </p>
                    </div>

                </div>

            </div>

            {{-- MENU --}}
            <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-7">

                {{-- DASHBOARD --}}
                <div>

                    <p class="sidebar-title">
                        Dashboard
                    </p>

                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link active-sidebar">

                        <span class="sidebar-icon">
                            <i data-lucide="layout-dashboard"></i>
                        </span>

                        <span class="sidebar-text">
                            Dashboard
                        </span>
                    </a>

                </div>

                {{-- DATA MASTER --}}
                <div>

                    <p class="sidebar-title">
                        Data Master
                    </p>

                    <div class="space-y-2">

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="graduation-cap"></i>
                            </span>

                            <span class="sidebar-text">
                                Data Siswa
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="badge-check"></i>
                            </span>

                            <span class="sidebar-text">
                                Data Guru
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="school"></i>
                            </span>

                            <span class="sidebar-text">
                                Data Kelas
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="book-copy"></i>
                            </span>

                            <span class="sidebar-text">
                                Mata Pelajaran
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="calendar-days"></i>
                            </span>

                            <span class="sidebar-text">
                                Tahun Ajaran
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="wallet"></i>
                            </span>


                            <span class="sidebar-text">
                                Pembayaran
                            </span>
                        </a>

                    </div>

                </div>




                {{-- CMS --}}
                <div>

                    <p class="sidebar-title">
                        CMS Sekolah
                    </p>

                    <div class="space-y-2">

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="home"></i>
                            </span>

                            <span class="sidebar-text">
                                Beranda
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="building-2"></i>
                            </span>

                            <span class="sidebar-text">
                                Profil Sekolah
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="layers-3"></i>
                            </span>

                            <span class="sidebar-text">
                                Unit Pendidikan
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="newspaper"></i>
                            </span>

                            <span class="sidebar-text">
                                Berita & Kegiatan
                            </span>
                        </a>

                        {{-- TAMBAHAN --}}
                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="file-text"></i>
                            </span>

                            <span class="sidebar-text">
                                Informasi PPDB
                            </span>
                        </a>

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="phone"></i>
                            </span>

                            <span class="sidebar-text">
                                Kontak
                            </span>
                        </a>

                    </div>

                </div>

                {{-- MANAJEMEN USER --}}
                <div>

                    <p class="sidebar-title">
                        Manajemen User
                    </p>

                    <div class="space-y-2">

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="users"></i>
                            </span>
                            <span class="sidebar-text">
                                Data User
                            </span>
                        </a>

                    </div>

                </div>

                {{-- PENGATURAN --}}
                <div>

                    <p class="sidebar-title">
                        Pengaturan
                    </p>

                    <div class="space-y-2">

                        <a href="#" class="sidebar-link">
                            <span class="sidebar-icon">
                                <i data-lucide="settings"></i>
                            </span>
                            <span class="sidebar-text">
                                Profil
                            </span>
                        </a>

                    </div>

                </div>

            </nav>

            {{-- FOOTER --}}
            <div class="p-4 border-t border-slate-100">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="logout-btn w-full h-12 rounded-2xl bg-red-500 hover:bg-red-600 transition-all duration-300 text-white font-semibold inline-flex items-center justify-center gap-3">

                        <i data-lucide="log-out"></i>

                        <span class="logout-text">
                            Logout
                        </span>

                    </button>
                </form>

            </div>

        </aside>