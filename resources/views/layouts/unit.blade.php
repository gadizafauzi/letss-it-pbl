<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'SIT Mutiara Quran' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Sekolah Islam Terpadu Mutiara Quran - Mendidik Generasi Qurani yang Berakhlak Mulia' }}">

    {{-- TAILWIND VIA VITE --}}
    @vite(['resources/css/app.css'])

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

<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- NAVBAR --}}
    @yield('navbar')

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @yield('footer')

    {{-- FLOATING BACK TO TOP --}}
    <button id="backToTop" class="fixed bottom-6 right-6 w-12 h-12 rounded-2xl bg-gradient-to-r from-blue-600 to-blue-700 text-white flex items-center justify-center shadow-lg shadow-blue-700/20 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 translate-y-16 opacity-0 z-50 pointer-events-none" aria-label="Kembali ke atas">
        <i data-lucide="arrow-up" class="w-5 h-5"></i>
    </button>

    {{-- JS --}}
    <script src="{{ asset('js/public.js') }}"></script>
    <script>
        // Init Lucide
        lucide.createIcons();

        // Back to top functionality
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopButton.classList.remove('translate-y-16', 'opacity-0', 'pointer-events-none');
            } else {
                backToTopButton.classList.add('translate-y-16', 'opacity-0', 'pointer-events-none');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
