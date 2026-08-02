<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Guru' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1.0.8">
    <link rel="stylesheet" href="{{ asset('css/teacher.css') }}?v=2.0.0">

    <style>
        @php
            $teacher = auth()->user()->teacher ?? null;
            $unitName = $teacher ? strtolower($teacher->unit->unit_name ?? 'smp') : 'smp';
        @endphp

        :root {
            /* Warna Default (SMP - Tema Biru Tua) */
            --bg-sidebar: #3b5998;
            --bg-header: #ffffff;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;

            --theme-primary: #3b5998;
            --theme-primary-hover: #1e3a6e;
            --theme-accent: #5c7cfa;
            --theme-accent-hover: #3b5998;
            --theme-bg-light: #eef4ff;
            --theme-bg-workspace: #f1f5f9;
            --theme-border-light: #c9d8ff;
            --theme-text-light: #3b5998;
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: rgba(255, 255, 255, 0.9);
            
            --theme-stat-hover: rgba(59, 130, 246, 0.06);
            --theme-text-primary: #3b5998;
        }

        .dark {
            /* Tema Dark Teacher (Midnight Ocean) */
            --bg-sidebar: #1E3A8A; /* Blue 900 */
            --bg-header: #0A192F; /* Deep Navy */
            --bg-card: #112240; /* Rich Navy */
            --text-main: #F8FAFC;
            --text-secondary: #93C5FD;
            --border-color: #1E3A8A;

            --theme-primary: #3B82F6;
            --theme-primary-hover: #2563EB;
            --theme-accent: #60A5FA;
            --theme-accent-hover: #3B82F6;
            --theme-bg-light: #112240;
            --theme-bg-workspace: #060F1E;
            --theme-border-light: #1E3A8A;
            --theme-text-light: #BFDBFE;
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: #60A5FA;
            
            --theme-stat-hover: rgba(59, 130, 246, 0.2);
            --theme-text-primary: #60A5FA;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[var(--theme-bg-workspace)] text-[var(--text-main)] overflow-hidden transition-colors duration-300">

<div class="flex h-screen overflow-hidden">

    @include('components.teacher.sidebar')

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">

        @include('components.shared.header-teacher')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

</div>

<x-shared.logout-modal id="teacherLogoutModal" cancelId="teacherCancelLogout" action="{{ route('logout') }}" />

<script src="{{ asset('js/teacher.js') }}?v=2.0.0"></script>
<script>
    lucide.createIcons();

    // Theme Toggle Logic
    const themeToggleBtn = document.getElementById('themeToggle');
    
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });
    }
</script>

</body>
</html>
