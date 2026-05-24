<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Guru' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 overflow-hidden">

<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden lg:hidden"></div>

<div class="flex h-screen overflow-hidden">

    @include('components.teacher.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @include('components.shared.header-teacher')

        <main class="flex-1 min-w-0 overflow-y-auto p-6 lg:p-8">
            @yield('content')
        </main>

    </div>

</div>

@include('components.teacher.logout-modal')

<script src="{{ asset('js/teacher.js') }}"></script>
<script>
    lucide.createIcons();
</script>

</body>
</html>
