@props([
    'id' => 'logoutModal',
    'cancelId' => 'cancelLogout',
    'action' => route('logout')
])

<div id="{{ $id }}" class="logout-modal fixed inset-0 z-[999] hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="logout-modal-box bg-white w-[380px] max-w-[92vw] rounded-3xl p-7 shadow-2xl text-center">
        <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center mx-auto mb-5">
            <i data-lucide="log-out" class="text-red-500 w-7 h-7"></i>
        </div>

        <h3 class="text-xl font-extrabold text-[var(--theme-primary)] font-sans">
            Keluar
        </h3>

        <p class="text-sm text-slate-500 mt-2">
            Apakah Anda yakin ingin keluar?
        </p>

        <div class="grid grid-cols-2 gap-4 mt-7">
            <button type="button" id="{{ $cancelId }}"
                class="w-full h-12 rounded-2xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold transition-all">
                Batal
            </button>
            <form action="{{ $action }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full h-12 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition-all">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
