<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js for GPA line chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1.0.7">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}?v=1.0.2">

    <script>
        // Prevent FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @php
        $studentLayout = \App\Models\Student::with('unit')->where('user_id', auth()->id())->first();
        $unitNameLayout = strtolower($studentLayout->unit->unit_name ?? 'smp');
    @endphp

    @if($unitNameLayout === 'tk')
    <style>
        :root {
            --theme-primary: #F97316; /* Orange 500 */
            --theme-primary-hover: #EA580C; /* Orange 600 */
            --theme-accent: #3B82F6; /* Blue 500 */
            --theme-accent-hover: #2563EB; /* Blue 600 */
            --theme-bg-light: #FFF7ED; /* Orange 50 */
            --theme-bg-workspace: #FFEDD5; /* Orange 100 */
            --theme-border-light: #FDBA74; /* Orange 300 */
            --theme-text-light: #C2410C; /* Orange 700 */
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: rgba(255, 255, 255, 0.9);
            --theme-stat-hover: rgba(249, 115, 22, 0.1);
            --theme-print-bg: #EFF6FF; /* Blue 50 */
            --theme-print-text: #1D4ED8; /* Blue 700 */
            --theme-print-icon: #3B82F6; /* Blue 500 */
            --theme-print-hover: #DBEAFE; /* Blue 100 */
            --theme-logo-url: url('{{ asset("images/tk.jpeg") }}');
            
            --bg-sidebar: var(--theme-primary);
            --bg-banner: linear-gradient(135deg, #F97316, #3B82F6);
            --glow-banner: 0 8px 30px rgba(249, 115, 22, 0.3);
            --bg-header: var(--theme-bg-light);
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-secondary: #64748b;
            --theme-text-primary: var(--theme-primary);
        }
        .dark {
            --bg-sidebar: #0F172A; /* Slate 900 */
            --bg-banner: linear-gradient(135deg, #1E293B, #0F172A);
            --glow-banner: 0 8px 30px rgba(0, 0, 0, 0.4);
            --bg-header: #020617; /* Slate 950 */
            --bg-card: #1E293B; /* Slate 800 */
            --text-main: #F8FAFC;
            --text-secondary: #94A3B8; /* Slate 400 */
            
            --theme-primary: #F97316;
            --theme-primary-hover: #EA580C;
            --theme-accent: #3B82F6;
            --theme-accent-hover: #2563EB;
            --theme-bg-light: #1E293B;
            --theme-bg-workspace: #020617; /* Slate 950 */
            --theme-border-light: #334155; /* Slate 700 */
            --theme-text-light: #CBD5E1;
            --theme-text-primary: #FB923C;
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: #FB923C;
            --theme-stat-hover: rgba(249, 115, 22, 0.15);
            --theme-print-bg: #1E293B;
            --theme-print-text: #BFDBFE;
            --theme-print-icon: #60A5FA;
            --theme-print-hover: #334155;
            --border-color: #334155;
        }
    </style>
    @elseif($unitNameLayout === 'sd')
    <style>
        :root {
            --theme-primary: #5B3CC4;
            --theme-primary-hover: #8B5CF6;
            --theme-accent: #8B5CF6;
            --theme-accent-hover: #8B5CF6;
            --theme-bg-light: #F1ECFF;
            --theme-bg-workspace: #F8F7FC;
            --theme-border-light: #D8CCFF;
            --border-color: #0f172a;
            --theme-text-light: #4C1D95;
            --theme-icon-active: #5B3CC4;
            --theme-icon-indicator: #5B3CC4;
            --theme-stat-hover: rgba(139, 92, 246, 0.14);
            --theme-print-bg: #FEF3C7;
            --theme-print-text: #A16207;
            --theme-print-icon: #FACC15;
            --theme-print-hover: #FDE68A;
            --theme-logo-url: url('{{ asset("images/logomq.jpg") }}');
            
            --bg-sidebar: var(--theme-primary);
            --bg-banner: linear-gradient(135deg, #5B3CC4, #8B5CF6);
            --glow-banner: 0 8px 30px rgba(91, 60, 196, 0.3);
            --bg-header: var(--theme-bg-light);
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-secondary: #64748b;
            --theme-text-primary: var(--theme-primary);
        }
        .dark {
            --bg-sidebar: #312E81;
            --bg-banner: linear-gradient(135deg, #312E81, #1F1147);
            --glow-banner: 0 8px 30px rgba(0, 0, 0, 0.4);
            --bg-header: #1F1147;
            --bg-card: #2E1065;
            --text-main: #F8FAFC;
            --text-secondary: #D8B4FE;
            
            --theme-primary: #8B5CF6;
            --theme-primary-hover: #A78BFA;
            --theme-accent: #A78BFA;
            --theme-accent-hover: #C4B5FD;
            --theme-bg-light: #2E1065;
            --theme-bg-workspace: #1E1B4B;
            --theme-border-light: #4C1D95;
            --border-color: #000000;
            --theme-text-light: #F8FAFC;
            --theme-icon-active: #F8FAFC;
            --theme-icon-indicator: #A78BFA;
            --theme-stat-hover: rgba(167, 139, 250, 0.2);
            --theme-print-bg: #4C1D95;
            --theme-print-text: #FDE68A;
            --theme-print-icon: #FACC15;
            --theme-print-hover: #5B3CC4;
            --theme-text-primary: #A78BFA;
        }
    </style>
    @else
    <style>
        :root {
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
            --theme-stat-hover: rgba(92, 124, 250, 0.1);
            --theme-print-bg: #fef2f2;
            --theme-print-text: #ef4444;
            --theme-print-icon: #ef4444;
            --theme-print-hover: #fee2e2;
            --theme-logo-url: url('{{ asset("images/smp.jpeg") }}');
            
            --bg-sidebar: var(--theme-primary);
            --bg-banner: linear-gradient(135deg, #4F74E8, #6D8CFF);
            --glow-banner: 0 8px 30px rgba(79, 116, 232, 0.3);
            --bg-header: var(--theme-bg-light);
            --bg-card: #ffffff;
            --border-color: #0f172a;
            --text-main: #1e293b;
            --text-secondary: #64748b;
            --theme-text-primary: var(--theme-primary);
        }
        .dark {
            --bg-sidebar: #1E3A8A; /* Blue 900 */
            --bg-banner: linear-gradient(135deg, #1E3A8A, #172554);
            --glow-banner: 0 8px 30px rgba(0, 0, 0, 0.4);
            --bg-header: #0A192F; /* Deep Navy */
            --bg-card: #112240; /* Rich Navy for cards */
            --text-main: #F8FAFC;
            --text-secondary: #93C5FD;
            
            --theme-primary: #3B82F6; /* Blue 500 */
            --theme-primary-hover: #2563EB;
            --theme-accent: #60A5FA; /* Blue 400 */
            --theme-accent-hover: #3B82F6;
            --theme-bg-light: #112240;
            --theme-bg-workspace: #060F1E; /* Darkest Navy */
            --theme-border-light: #1E3A8A;
            --theme-text-light: #BFDBFE;
            --theme-text-primary: #60A5FA;
            --theme-icon-active: #ffffff;
            --theme-icon-indicator: #60A5FA;
            --theme-stat-hover: rgba(59, 130, 246, 0.2);
            --theme-print-bg: #1E3A8A;
            --theme-print-text: #FECACA;
            --theme-print-icon: #F87171;
            --theme-print-hover: #172554;
            --border-color: #1E3A8A;
        }
    </style>
    @endif
</head>

<body class="bg-[var(--theme-bg-workspace)] text-[var(--text-main)] overflow-hidden transition-colors duration-300">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-[100dvh] w-full overflow-hidden max-w-full">

    @include('components.student.sidebar')

    {{-- Konten utama: pada mobile diberi margin-left 64px agar icon strip tidak menutupi konten --}}
    <div id="mainContent" class="flex-1 flex flex-col overflow-hidden">

        @include('components.shared.header-student')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 md:p-8">
            @yield('content')
        </main>

    </div>

</div>

<!-- Logout Confirmation Modal -->
<x-shared.logout-modal id="studentLogoutModal" cancelId="studentCancelLogout" action="{{ route('logout') }}" />

<script src="{{ asset('js/students.js') }}"></script>

</body>
</html>
