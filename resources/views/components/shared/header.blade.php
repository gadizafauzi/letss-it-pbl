            {{-- HEADER --}}
            <header
                class="h-20 bg-white border-b border-slate-200 shadow-sm px-6 lg:px-8 flex items-center justify-between">

                {{-- LEFT --}}
                <div class="flex items-center gap-4">

                    {{-- TOGGLE --}}
                    <button id="desktopToggle"
                        class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center transition-all duration-300 hover:bg-emerald-50 hover:border-emerald-100 hover:text-emerald-600">

                        <i data-lucide="menu" class="w-5 h-5"></i>

                    </button>

                    {{-- TITLE --}}
                    <div>

                        <h2 class="text-[22px] font-extrabold tracking-tight text-slate-800 leading-none">
                            Dashboard
                        </h2>

                        <p class="text-sm text-slate-500 mt-1 font-medium">
                            Selamat datang kembali
                        </p>

                    </div>

                </div>

                {{-- RIGHT --}}
                <div class="flex items-center gap-5">

                    {{-- DATE --}}
                    <div class="hidden md:block text-right">

                        <p class="text-sm font-medium text-slate-400">
                            Minggu, 10 Mei 2026
                        </p>

                    </div>

                    {{-- AVATAR --}}
                    <div class="relative">

                        <div
                            class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white font-bold shadow-lg shadow-emerald-200">

                            A

                        </div>

                        {{-- ONLINE DOT --}}
                        <span
                            class="absolute bottom-0 -right-1 w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full">
                        </span>

                    </div>

                </div>

            </header>
