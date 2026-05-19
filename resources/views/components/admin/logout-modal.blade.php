    {{-- LOGOUT MODAL --}}
    <div id="logoutModal"
        class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/40 backdrop-blur-sm">

        <div class="bg-white w-[380px] max-w-[92vw] rounded-3xl p-7 shadow-2xl text-center">

            <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center mx-auto mb-5">

                <i data-lucide="log-out" class="text-red-500 w-7 h-7"></i>

            </div>

            <h3 class="text-xl font-extrabold text-slate-800">
                Logout Sistem
            </h3>

            <p class="text-sm text-slate-500 mt-2">
                Apakah Anda yakin ingin keluar dari dashboard?
            </p>

            <div class="grid grid-cols-2 gap-4 mt-7">

                <button id="cancelLogout"
                    class="h-12 rounded-2xl border border-slate-200 font-semibold hover:bg-slate-50 transition-all">

                    Batal

                </button>

                <button id="confirmLogout"
                    class="h-12 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition-all">

                    Logout

                </button>

            </div>

        </div>

    </div>