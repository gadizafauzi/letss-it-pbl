{{-- PPDB POPUP MODAL --}}
    <div id="ppdbPopup" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#002244]/60 backdrop-blur-sm transition-opacity duration-300 opacity-0" id="ppdbOverlay"></div>
        
        <!-- Modal Content -->
        <div class="relative w-full max-w-2xl bg-white rounded-[32px] shadow-2xl p-6 md:p-10 transform scale-95 opacity-0 transition-all duration-300" id="ppdbModalContent">
            <!-- Close Button -->
            <button id="closePpdbBtn" class="absolute top-4 right-4 md:top-6 md:right-6 w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-rose-100 hover:text-rose-600 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            
            <div class="text-center mb-8 pr-8 md:pr-0">
                <span class="inline-block px-4 py-1.5 rounded-full bg-amber-100 text-amber-700 text-xs font-bold uppercase tracking-wider mb-4">Informasi PPDB 2026/2027</span>
                <h3 class="text-2xl md:text-3xl font-black text-[#003f88] mb-3">Pendaftaran Telah Dibuka!</h3>
                <p class="text-slate-500 text-sm md:text-base leading-relaxed">Pendaftaran peserta didik baru SIT Mutiara Qur'an telah dibuka. Pilih brosur berikut untuk melihat informasi syarat, biaya, dan alur pendaftaran.</p>
            </div>
            
            <!-- Grid Brosur -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                <a href="{{ asset('images/syarat-tksd.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-slate-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-slate-100 text-[#003f88] flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003f88] text-sm">Syarat PPDB TK/SD</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat persyaratan</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/biaya-tksd.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-amber-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003f88] text-sm">Biaya PPDB TK/SD</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat rincian biaya</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/syarat-smp.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-slate-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-slate-100 text-[#003f88] flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003f88] text-sm">Syarat PPDB SMP</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat persyaratan</p>
                    </div>
                </a>
                
                <a href="{{ asset('images/biaya-smp.jpeg') }}" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-amber-200 bg-slate-50 hover:bg-white group transition-all">
                    <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="wallet" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#003f88] text-sm">Biaya PPDB SMP</h4>
                        <p class="text-xs text-slate-500 mt-0.5">Lihat rincian biaya</p>
                    </div>
                </a>
            </div>
            
            <div class="text-center">
                <button id="closePpdbFooterBtn" class="px-8 py-3 rounded-xl bg-slate-100 text-slate-600 font-bold hover:bg-slate-200 transition-colors text-sm">Tutup</button>
            </div>
        </div>
    </div>

