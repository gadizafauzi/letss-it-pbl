<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout') }}">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    
    {{-- DARK MODE DETECTION (PREVENT FOUC) --}}
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- ALPINE JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>

<body class="bg-[#F0F4FA] dark:bg-slate-900 text-slate-800 dark:text-slate-100 overflow-hidden transition-colors duration-300">

    {{-- OVERLAY --}}
    <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/20 backdrop-blur-sm lg:hidden z-40">
    </div>

    <div class="flex h-screen overflow-hidden">

        {{-- SIDEBAR --}}
        @include('components.admin.sidebar')

        {{-- MAIN --}}
        <div id="mainContent" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 relative z-10">

            {{-- HEADER --}}
            @include('components.shared.header')

            {{-- CONTENT --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-5 lg:p-8">
                {{-- BREADCRUMBS SLOT --}}
                @yield('breadcrumbs')
                
                @yield('content')
            </main>

        </div>

    </div>

    {{-- THEME TOGGLE BUTTON --}}
    <button id="theme-toggle" type="button" class="fixed bottom-6 right-6 z-50 p-4 rounded-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-md shadow-[0_8px_30px_rgb(0,0,0,0.12)] border border-slate-200/60 dark:border-slate-700/60 text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-800 focus:outline-none transition-all duration-300 hover:-translate-y-1 group">
        <i id="theme-toggle-dark-icon" data-lucide="moon" class="hidden w-6 h-6 group-hover:text-blue-500 transition-colors"></i>
        <i id="theme-toggle-light-icon" data-lucide="sun" class="hidden w-6 h-6 group-hover:text-amber-500 transition-colors"></i>
    </button>

    {{-- LOGOUT MODAL --}}
    @include('components.admin.logout-modal')

    {{-- TOAST NOTIFICATION GLOBAL --}}
    @include('components.admin.toast')

    {{-- JS --}}
    <script src="{{ asset('js/admin.js') }}"></script>

    <script>
        lucide.createIcons();

        // THEME TOGGLE LOGIC
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

            // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
            
        });
    </script>

</body>

</html>
