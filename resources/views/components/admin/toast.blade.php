@if (session('success') || session('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-500"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed bottom-8 right-8 z-[100] flex items-center gap-3 px-5 py-4 rounded-2xl shadow-2xl bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-white/80 dark:border-slate-700/60 {{ session('success') ? 'shadow-green-500/20' : 'shadow-red-500/20' }}">
         
        <div class="flex items-center justify-center w-10 h-10 rounded-full flex-shrink-0 {{ session('success') ? 'bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400' : 'bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400' }}">
            <i data-lucide="{{ session('success') ? 'check-circle-2' : 'alert-circle' }}" class="w-5 h-5"></i>
        </div>
        
        <div class="mr-4">
            <h4 class="text-sm font-bold text-slate-800 dark:text-slate-100">
                {{ session('success') ? 'Berhasil!' : 'Gagal!' }}
            </h4>
            <p class="text-[13px] text-slate-600 dark:text-slate-400 mt-0.5">
                {{ session('success') ?? session('error') }}
            </p>
        </div>
        
        <button type="button" @click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors cursor-pointer border-none bg-transparent">
            <i data-lucide="x" class="w-[18px] h-[18px]"></i>
        </button>
    </div>
@endif
