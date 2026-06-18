<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIT Mutiara Quran' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Sekolah Islam Terpadu Mutiara Quran - Mendidik Generasi Qurani yang Berakhlak Mulia' }}">

    {{-- TAILWIND CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased">

    {{-- NAVBAR --}}
    @include('components.public.navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.public.footer')

    {{-- FLOATING WA BUTTON --}}
    <a id="waFloatBtn" href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6282286204878' }}" target="_blank" rel="noopener noreferrer" class="wa-float-btn" aria-label="Chat via WhatsApp">
        <span class="wa-tooltip">Chat via WhatsApp</span>
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 .5C7.44.5.5 7.44.5 16c0 2.78.73 5.53 2.12 7.94L.5 31.5l7.8-2.05A15.45 15.45 0 0 0 16 31.5C24.56 31.5 31.5 24.56 31.5 16S24.56.5 16 .5zm0 28.3a13.3 13.3 0 0 1-6.78-1.85l-.49-.29-5.08 1.34 1.36-4.96-.32-.51A13.29 13.29 0 0 1 2.7 16C2.7 9.15 8.15 3.7 16 3.7S29.3 9.15 29.3 16 23.85 28.8 16 28.8zm7.29-9.95c-.4-.2-2.36-1.16-2.72-1.3-.37-.13-.63-.2-.9.2-.27.4-1.04 1.3-1.27 1.56-.23.27-.47.3-.87.1-.4-.2-1.68-.62-3.2-1.97-1.18-1.05-1.98-2.35-2.21-2.75-.23-.4-.02-.61.17-.81.18-.18.4-.47.6-.7.2-.24.27-.4.4-.67.13-.27.07-.5-.03-.7-.1-.2-.9-2.16-1.23-2.96-.32-.78-.65-.67-.9-.68-.23 0-.5-.01-.77-.01-.27 0-.7.1-1.07.5-.37.4-1.4 1.37-1.4 3.33 0 1.97 1.44 3.87 1.64 4.14.2.27 2.83 4.32 6.86 5.89.96.41 1.71.66 2.29.84.96.3 1.84.26 2.53.16.77-.12 2.36-.96 2.7-1.9.33-.93.33-1.73.23-1.9-.1-.17-.37-.27-.77-.47z"/>
        </svg>
    </a>

    {{-- FLOATING BACK TO TOP --}}
    <button id="backToTop" class="fixed bottom-6 right-6 w-12 h-12 rounded-2xl bg-gradient-to-r from-emerald-600 to-emerald-700 text-white flex items-center justify-center shadow-lg shadow-emerald-700/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 translate-y-16 opacity-0 z-50 pointer-events-none" aria-label="Kembali ke atas">
        <i data-lucide="arrow-up" class="w-5 h-5"></i>
    </button>

    {{-- JS --}}
    <script src="{{ asset('js/public.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
