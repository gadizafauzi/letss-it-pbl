{{-- TOPBAR --}}
<div class="hidden md:block w-full bg-[#ffc629] border-b border-[#002244]/10 h-10 select-none">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 h-full flex items-center justify-between text-[#002244] text-xs font-bold">
        {{-- Left Side: Social Media --}}
        <div class="flex items-center gap-3">
            <span class="tracking-wide">Follow Us:</span>
            <div class="flex items-center gap-2">
                {{-- Facebook --}}
                <a href="{{ $settings['facebook'] ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 rounded-full bg-[#002244] hover:bg-[#003f88] hover:scale-110 transition-all flex items-center justify-center text-white" 
                   title="Facebook">
                    <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>
                {{-- Instagram --}}
                <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 rounded-full bg-[#002244] hover:bg-[#003f88] hover:scale-110 transition-all flex items-center justify-center text-white" 
                   title="Instagram">
                    <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                    </svg>
                </a>
                {{-- YouTube --}}
                <a href="{{ $settings['youtube'] ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 rounded-full bg-[#002244] hover:bg-[#003f88] hover:scale-110 transition-all flex items-center justify-center text-white" 
                   title="YouTube">
                    <svg class="w-3.5 h-3.5 fill-none stroke-current" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/>
                    </svg>
                </a>
                {{-- WhatsApp --}}
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282286204878' }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 rounded-full bg-[#002244] hover:bg-[#003f88] hover:scale-110 transition-all flex items-center justify-center text-white" 
                   title="WhatsApp">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.003 5.324 5.328 0 11.859 0c3.166.001 6.141 1.233 8.377 3.469 2.235 2.237 3.465 5.212 3.464 8.379-.003 6.535-5.328 11.86-11.859 11.86-2.004-.001-3.973-.51-5.713-1.479L0 24zm6.59-4.846c1.6.95 3.197 1.449 4.808 1.451 5.348 0 9.7-4.35 9.703-9.699.001-2.592-1.007-5.029-2.84-6.863C16.429 2.21 14.004 1.202 11.86 1.202c-5.352 0-9.704 4.352-9.707 9.7-.001 1.714.463 3.39 1.34 4.881l-.994 3.63 3.72-.976-.172-.11zM15.86 18.04c-.218-.11-1.29-.636-1.49-.708-.2-.072-.346-.11-.49.11-.144.218-.562.708-.69.853-.128.145-.255.163-.473.054-.218-.11-.922-.34-1.756-1.084-.649-.578-1.087-1.293-1.214-1.512-.128-.218-.014-.336.096-.445.099-.099.218-.255.327-.382.11-.127.146-.218.218-.364.072-.146.036-.273-.018-.382-.054-.11-.49-1.18-.672-1.62-.177-.426-.358-.368-.49-.374-.127-.007-.273-.008-.418-.008-.146 0-.382.055-.582.273-.2.218-.764.746-.764 1.817 0 1.07.782 2.1.89 2.247.11.146 1.54 2.353 3.733 3.302.52.227.927.362 1.244.463.522.166 1 .142 1.377.086.42-.063 1.29-.527 1.472-1.036.182-.509.182-.945.127-1.036-.055-.09-.2-.144-.418-.255z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        {{-- Right Side: Contact Information --}}
        <div class="flex items-center gap-6 text-[#002244]/90 font-semibold">
            {{-- Address --}}
            <span class="flex items-center gap-1.5">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#002244] flex-shrink-0"></i>
                <span class="truncate max-w-[200px] lg:max-w-[320px]" title="{{ $settings['address'] ?? '' }}">
                    {{ $settings['address'] ?? 'Karasak, Cupak, Solok' }}
                </span>
            </span>
            {{-- Email --}}
            <a href="mailto:{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}" class="flex items-center gap-1.5 hover:text-[#003f88] transition-colors">
                <i data-lucide="mail" class="w-3.5 h-3.5 text-[#002244] flex-shrink-0"></i>
                <span>{{ $settings['email'] ?? 'info@sitmutiaraquran.sch.id' }}</span>
            </a>
            {{-- Phone --}}
            <a href="tel:{{ $settings['phone'] ?? '+6282286204878' }}" class="flex items-center gap-1.5 hover:text-[#003f88] transition-colors font-bold whitespace-nowrap">
                <i data-lucide="phone-call" class="w-3.5 h-3.5 text-[#002244] flex-shrink-0"></i>
                <span>{{ $settings['phone'] ?? '+62 822-8620-4878' }}</span>
            </a>
        </div>
    </div>
</div>
