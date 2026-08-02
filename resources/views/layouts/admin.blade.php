<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Dashboard Admin' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout') }}">

    @vite(['resources/css/app.css'])
    
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
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- SWEETALERT 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1.0.8">

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
    <script src="{{ asset('js/admin_v3.js') }}"></script>

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

        // GLOBAL DELETE CONFIRMATION (SWEETALERT2)
        document.addEventListener('DOMContentLoaded', function() {
            // Remove native onsubmit from all delete forms
            document.querySelectorAll('form').forEach(form => {
                if (form.querySelector('input[name="_method"][value="DELETE"]')) {
                    form.removeAttribute('onsubmit');
                }
            });
        });

        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form && form.tagName === 'FORM') {
                const methodInput = form.querySelector('input[name="_method"][value="DELETE"]');
                if (methodInput) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus Data?',
                        text: "Data ini akan dihapus permanen!",
                        icon: 'warning',
                        width: '340px',
                        padding: '1.5em',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'px-4 py-2 text-sm text-white bg-red-500 hover:bg-red-600 rounded-xl font-medium shadow-sm mx-1.5 border-none outline-none',
                            cancelButton: 'px-4 py-2 text-sm text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium mx-1.5 border-none outline-none dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600',
                            popup: 'rounded-2xl dark:bg-slate-800 dark:text-slate-100 border dark:border-slate-700',
                            title: 'text-lg text-slate-800 dark:text-slate-100 mb-1',
                            htmlContainer: 'text-sm text-slate-500 dark:text-slate-400',
                            icon: 'scale-75 my-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            }
        });
        // GLOBAL ACTION CONFIRMATION HELPER
        window.confirmAction = function(e, title, text, confirmText, confirmColorClass) {
            e.preventDefault();
            const form = e.target.closest('form');
            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                width: '340px',
                padding: '1.5em',
                showCancelButton: true,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: `px-4 py-2 text-sm text-white ${confirmColorClass} rounded-xl font-medium shadow-sm mx-1.5 border-none outline-none`,
                    cancelButton: 'px-4 py-2 text-sm text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium mx-1.5 border-none outline-none dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600',
                    popup: 'rounded-2xl dark:bg-slate-800 dark:text-slate-100 border dark:border-slate-700',
                    title: 'text-lg text-slate-800 dark:text-slate-100 mb-1',
                    htmlContainer: 'text-sm text-slate-500 dark:text-slate-400',
                    icon: 'scale-75 my-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        };

        // UNSAVED CHANGES TRACKER
        let hasUnsavedChanges = false;
        let formIsSubmitting = false;
        let isPageLoaded = false;

        // Bypasses browser password manager auto-fills on load
        setTimeout(() => {
            isPageLoaded = true;
        }, 1000);

        document.addEventListener('DOMContentLoaded', function() {
            const trackChanges = (e) => {
                if (!isPageLoaded) return;
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT') {
                    const form = e.target.closest('form');
                    // Hanya lacak form POST (form data), abaikan GET (form pencarian/filter)
                    if (form && form.method.toUpperCase() === 'POST') {
                        if (e.target.type !== 'hidden' && e.target.type !== 'search') {
                            hasUnsavedChanges = true;
                        }
                    }
                }
            };
            
            document.body.addEventListener('input', trackChanges);
            document.body.addEventListener('change', trackChanges);

            document.body.addEventListener('submit', function(e) {
                formIsSubmitting = true;
            });
        });

        // Intercept link clicks with SweetAlert2
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.href.startsWith('javascript:') && !link.href.includes('#') && link.target !== '_blank') {
                if (hasUnsavedChanges && !formIsSubmitting) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Perubahan Belum Disimpan!',
                        text: 'Anda memiliki data yang belum disimpan. Yakin ingin pindah halaman?',
                        icon: 'warning',
                        width: '360px',
                        padding: '1.5em',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Tinggalkan',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'px-4 py-2 text-sm text-white bg-red-500 hover:bg-red-600 rounded-xl font-medium shadow-sm mx-1.5 border-none outline-none',
                            cancelButton: 'px-4 py-2 text-sm text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl font-medium mx-1.5 border-none outline-none dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600',
                            popup: 'rounded-2xl dark:bg-slate-800 dark:text-slate-100 border dark:border-slate-700',
                            title: 'text-lg text-slate-800 dark:text-slate-100 mb-1',
                            htmlContainer: 'text-sm text-slate-500 dark:text-slate-400',
                            icon: 'scale-75 my-2'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            hasUnsavedChanges = false;
                            window.location.href = link.href;
                        }
                    });
                }
            }
        });

        // Native browser warning for closing tab / reloading
        window.addEventListener('beforeunload', function(e) {
            if (hasUnsavedChanges && !formIsSubmitting) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
