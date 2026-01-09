<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts - Source Serif 4 & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,500;0,8..60,600;0,8..60,700;1,8..60,400&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* ========== CSS VARIABLES - DESIGN SYSTEM ========== */
        :root {
            /* Bright Mode Colors */
            --bg-primary: #F3F5F7;
            --bg-card: #FFFFFF;
            --bg-sidebar: #EEF1F4;
            --border-color: #D9DEE5;

            --text-primary: #1F2933;
            --text-secondary: #4B5563;
            --text-muted: #6B7280;

            --accent: #3B8E91;
            --accent-hover: #317A7D;
            --accent-subtle: rgba(59, 142, 145, 0.1);

            --destructive: #B24A4A;
            --destructive-hover: #C85E5E;

            --badge-bg: #E6F2F2;
            --badge-text: #2F6F73;

            /* Scrollbar */
            --scrollbar-track: #E5E7EB;
            --scrollbar-thumb: #A9B4C2;
            --scrollbar-thumb-hover: #7C8796;
        }

        .dark {
            /* Dark Mode Colors */
            --bg-primary: #0E141B;
            --bg-card: #161D26;
            --bg-sidebar: #0B1117;
            --border-color: #243041;

            --text-primary: #E6EBF0;
            --text-secondary: #A9B4C2;
            --text-muted: #7C8796;

            --accent: #4FA3A5;
            --accent-hover: #6BBBBC;
            --accent-subtle: rgba(79, 163, 165, 0.12);

            --destructive: #C25C5C;
            --destructive-hover: #D87474;

            --badge-bg: #1E2B33;
            --badge-text: #8FD0D1;

            /* Scrollbar */
            --scrollbar-track: #161D26;
            --scrollbar-thumb: #243041;
            --scrollbar-thumb-hover: #2F3F52;
        }

        /* ========== TYPOGRAPHY ========== */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-primary);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .heading {
            font-family: 'Source Serif 4', Georgia, serif;
            font-weight: 600;
            line-height: 1.3;
            color: var(--text-primary);
        }

        h1 {
            font-size: 2rem;
        }

        h2 {
            font-size: 1.5rem;
        }

        h3 {
            font-size: 1.25rem;
        }

        h4 {
            font-size: 1.125rem;
        }

        h5,
        h6 {
            font-size: 1rem;
        }

        /* ========== BUTTONS ========== */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            color: white;
            background-color: var(--accent);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            transform: translateY(0);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--accent-hover);
            border-radius: 0 0 0.5rem 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover::before {
            height: 4px;
            bottom: -4px;
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:active::before {
            height: 2px;
            bottom: -2px;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            color: var(--text-primary);
            background-color: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            transform: translateY(0);
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--border-color);
            border-radius: 0 0 0.5rem 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: var(--bg-primary);
            border-color: var(--text-muted);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary:hover::before {
            height: 4px;
            bottom: -4px;
        }

        .btn-secondary:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
        }

        .btn-secondary:active::before {
            height: 2px;
            bottom: -2px;
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            color: white;
            background-color: var(--destructive);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            transform: translateY(0);
        }

        .btn-danger::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--destructive-hover);
            border-radius: 0 0 0.5rem 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background-color: var(--destructive-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .btn-danger:hover::before {
            height: 4px;
            bottom: -4px;
        }

        .btn-danger:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-danger:active::before {
            height: 2px;
            bottom: -2px;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Logout button in sidebar */
        .btn-logout {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            font-weight: 500;
            color: var(--text-primary);
            background-color: transparent;
            border: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .btn-logout:hover {
            background-color: var(--destructive);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-logout:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* ========== FORMS ========== */
        .form-label {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.375rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            color: var(--text-primary);
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 0.375rem;
            transition: all 0.15s ease;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-subtle);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-muted);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ========== CARDS ========== */
        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* ========== BADGES ========== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.625rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--badge-text);
            background-color: var(--badge-bg);
            border-radius: 0.25rem;
        }

        /* ========== TABLES ========== */
        .table-hover tbody tr {
            transition: background-color 0.15s ease;
        }

        .table-hover tbody tr:hover {
            background-color: var(--accent-subtle);
        }

        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--scrollbar-track);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--scrollbar-thumb-hover);
        }

        /* ========== ANIMATIONS ========== */
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            animation: fadeIn 0.3s ease-out;
        }

        /* ========== SIDEBAR ========== */
        .sidebar-transition {
            transition: width 250ms ease;
        }

        /* ========== PRINT STYLES ========== */
        @media print {

            .no-print,
            aside,
            nav[class*="fixed"],
            button,
            a[href*="export"],
            form,
            .bg-sky-500.text-white {
                display: none !important;
            }

            body,
            #app,
            main {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                overflow: visible !important;
                background: white !important;
            }

            .ml-64 {
                margin-left: 0 !important;
            }

            table {
                border-collapse: collapse !important;
                width: 100% !important;
                font-size: 12px !important;
            }

            th,
            td {
                border: 1px solid #777 !important;
                padding: 6px !important;
                color: black !important;
            }

            h1 {
                font-size: 20px !important;
                margin-bottom: 10px !important;
                color: black !important;
            }

            p {
                font-size: 12px !important;
                color: #444 !important;
            }
        }
    </style>

    <script>
        // Auto-refresh CSRF token every 60 minutes to prevent page expiration
        @auth
            setInterval(function () {
                fetch('{{ route("dashboard") }}', {
                    method: 'GET',
                    credentials: 'same-origin'
                })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newToken = doc.querySelector('meta[name="csrf-token"]');
                        if (newToken) {
                            document.querySelector('meta[name="csrf-token"]').setAttribute('content', newToken
                                .getAttribute('content'));
                            console.log('CSRF token refreshed');
                        }
                    })
                    .catch(error => console.error('Error refreshing CSRF token:', error));
            }, 3600000); // 60 minutes
        @endauth
    </script>
</head>

</head>

<body class="transition-colors duration-300" x-data="{ 
          sidebarOpen: false, 
          darkMode: localStorage.getItem('darkMode') === 'true',
          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          }
      }"
    x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');">
    <!-- Dark Mode Toggle Floating Button -->
    <div x-data="{
        x: window.innerWidth - 100,
        y: window.innerHeight - 100,
        isDragging: false,
        startX: 0,
        startY: 0,
        initialX: 0,
        initialY: 0,
        hasMoved: false,
        init() {
            // Restore position if saved
            const savedPos = localStorage.getItem('darkModeBtnPos');
            if (savedPos) {
                const pos = JSON.parse(savedPos);
                this.x = Math.min(window.innerWidth - 60, Math.max(0, pos.x));
                this.y = Math.min(window.innerHeight - 60, Math.max(0, pos.y));
            }
        },
        startDrag(e) {
            // Prevent default to avoid text selection etc
            // e.preventDefault(); 
            this.isDragging = true;
            this.hasMoved = false;
            this.startX = e.clientX || e.touches[0].clientX;
            this.startY = e.clientY || e.touches[0].clientY;
            this.initialX = this.x;
            this.initialY = this.y;
        },
        onDrag(e) {
            if (!this.isDragging) return;
            
            const clientX = e.clientX || (e.touches ? e.touches[0].clientX : 0);
            const clientY = e.clientY || (e.touches ? e.touches[0].clientY : 0);

            const dx = clientX - this.startX;
            const dy = clientY - this.startY;

            if (Math.abs(dx) > 2 || Math.abs(dy) > 2) {
                this.hasMoved = true;
            }

            this.x = this.initialX + dx;
            this.y = this.initialY + dy;
            
            // Boundary constraints
            this.x = Math.max(0, Math.min(window.innerWidth - 60, this.x));
            this.y = Math.max(0, Math.min(window.innerHeight - 60, this.y));
        },
        stopDrag() {
            if (this.isDragging) {
                this.isDragging = false;
                // Save position
                localStorage.setItem('darkModeBtnPos', JSON.stringify({x: this.x, y: this.y}));
            }
        }
    }" x-init="init()" @mousemove.window="onDrag($event)" @touchmove.window="onDrag($event)"
        @mouseup.window="stopDrag()" @touchend.window="stopDrag()"
        class="fixed z-50 cursor-grab touch-none active:cursor-grabbing"
        :style="`top: ${y}px; left: ${x}px; touch-action: none;`">
        <button @mousedown="startDrag($event)" @touchstart="startDrag($event)" @click="if(!hasMoved) toggleTheme()"
            class="w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transform hover:scale-110 transition-all duration-300 border-2 border-white/20 backdrop-blur-sm group"
            :class="darkMode ? 'bg-slate-800 text-yellow-400 border-slate-600' : 'bg-white text-sky-600 border-sky-100'"
            title="Toggle Dark Mode">
            <!-- Sun Icon (for Dark Mode) -->
            <svg x-show="darkMode" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 rotate-90" x-transition:enter-end="opacity-100 rotate-0"
                class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <!-- Moon Icon (for Light Mode) -->
            <svg x-show="!darkMode" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -rotate-90" x-transition:enter-end="opacity-100 rotate-0"
                class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>

            <!-- Pulse Glow Effect -->
            <div class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                :class="darkMode ? 'bg-yellow-400/20' : 'bg-sky-400/20 animate-pulse'"></div>
        </button>
    </div>

    @auth
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside @mouseenter="sidebarOpen = true" @mouseleave="sidebarOpen = false" :class="sidebarOpen ? 'w-64' : 'w-20'"
                class="sidebar-transition text-white flex flex-col relative z-10"
                style="background-color: var(--bg-sidebar); border-right: 1px solid var(--border-color);">
                <!-- Logo & Toggle -->
                <div class="flex items-center justify-between p-4" style="border-bottom: 1px solid var(--border-color);">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center"
                            style="background-color: var(--accent);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div x-show="sidebarOpen" x-transition class="overflow-hidden">
                            <h1 class="text-lg font-bold whitespace-nowrap" style="color: var(--text-primary);">DigiLib</h1>
                            <p class="text-xs whitespace-nowrap"
                                style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Perpustakaan Digital
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                        style="{{ request()->routeIs('dashboard') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                        :title="!sidebarOpen ? 'Dashboard' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Dashboard</span>
                    </a>

                    <!-- Buku -->
                    <a href="{{ route('books.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                        style="{{ request()->routeIs('books.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                        :title="!sidebarOpen ? 'Buku' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Buku</span>
                    </a>

                    <!-- Kategori -->
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                        style="{{ request()->routeIs('categories.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                        :title="!sidebarOpen ? 'Kategori' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Kategori</span>
                    </a>

                    <!-- Peminjaman -->
                    <a href="{{ route('loans.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                        style="{{ request()->routeIs('loans.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                        :title="!sidebarOpen ? 'Peminjaman' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Peminjaman</span>
                    </a>

                    <!-- Anggota -->
                    <a href="{{ route('members.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                        style="{{ request()->routeIs('members.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                        onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                        onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                        :title="!sidebarOpen ? 'Anggota' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Anggota</span>
                    </a>

                    @if(auth()->user()->isAdmin())
                        <!-- Petugas (Admin Only) -->
                        <a href="{{ route('users.index') }}"
                            class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-150"
                            style="{{ request()->routeIs('users.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                            onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                            onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                            :title="!sidebarOpen ? 'Petugas' : ''">
                            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Petugas</span>
                        </a>
                    @endif

                    <!-- Laporan -->
                    <div x-data="{ open: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-3 rounded-lg transition-all duration-150"
                            style="{{ request()->routeIs('reports.*') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-primary);' }}"
                            onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='var(--accent-subtle)'"
                            onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'"
                            :title="!sidebarOpen ? 'Laporan' : ''">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Laporan</span>
                            </div>
                            <svg x-show="sidebarOpen" :class="open ? 'rotate-180' : ''"
                                class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open && sidebarOpen" x-transition class="ml-9 mt-2 space-y-1">
                            <a href="{{ route('reports.daily') }}"
                                class="block px-3 py-2 text-sm rounded-lg transition-colors"
                                style="{{ request()->routeIs('reports.daily') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-secondary);' }}"
                                onmouseover="this.style.backgroundColor='var(--accent-subtle)'"
                                onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'">
                                Laporan Harian
                            </a>
                            <a href="{{ route('reports.overdue') }}"
                                class="block px-3 py-2 text-sm rounded-lg transition-colors"
                                style="{{ request()->routeIs('reports.overdue') ? 'background-color: var(--accent-subtle); color: var(--accent);' : 'color: var(--text-secondary);' }}"
                                onmouseover="this.style.backgroundColor='var(--accent-subtle)'"
                                onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent'">
                                Keterlambatan
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Info & Logout -->
                <div style="border-top: 1px solid var(--border-color); padding: 1rem;">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold"
                            style="background-color: var(--accent); color: white;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div x-show="sidebarOpen" x-transition class="flex-1 overflow-hidden">
                            <p class="text-sm font-semibold truncate"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs truncate"
                                style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">
                                {{ ucfirst(auth()->user()->role) }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout space-x-3" :title="!sidebarOpen ? 'Logout' : ''">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden transition-colors duration-300">
                <header
                    style="background-color: var(--bg-card); border-bottom: 1px solid var(--border-color); padding: 0.75rem 1.5rem;"
                    class="transition-colors duration-300">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:gap-0">
                        <!-- Date & Timezones -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 lg:gap-6">
                            <!-- Date -->
                            <div style="border-right: 1px solid var(--border-color);" class="lg:pr-6">
                                <p class="text-sm font-semibold"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    <!-- Full date for desktop -->
                                    <span
                                        class="hidden sm:inline">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                                    <!-- Short date for mobile -->
                                    <span class="sm:hidden">{{ now()->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                </p>
                            </div>

                            <!-- Indonesian Timezones -->
                            <div class="flex items-center gap-2 sm:gap-3 lg:gap-4 overflow-x-auto pb-1 sm:pb-0">
                                <!-- WIB -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center transition-colors"
                                        style="background-color: var(--badge-bg);">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" style="color: var(--badge-text);" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium"
                                            style="color: var(--text-muted); font-family: 'Inter', sans-serif;">WIB</p>
                                        <p class="text-sm font-bold tabular-nums"
                                            style="color: var(--text-primary); font-family: 'Inter', sans-serif;"
                                            id="time-wib">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <div class="h-7 sm:h-8 w-px flex-shrink-0" style="background-color: var(--border-color);">
                                </div>

                                <!-- WITA -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center transition-colors"
                                        style="background-color: var(--badge-bg);">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" style="color: var(--badge-text);" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium"
                                            style="color: var(--text-muted); font-family: 'Inter', sans-serif;">WITA</p>
                                        <p class="text-sm font-bold tabular-nums"
                                            style="color: var(--text-primary); font-family: 'Inter', sans-serif;"
                                            id="time-wita">{{ \Carbon\Carbon::now('Asia/Makassar')->format('H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <div class="h-7 sm:h-8 w-px flex-shrink-0" style="background-color: var(--border-color);">
                                </div>

                                <!-- WIT -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center transition-colors"
                                        style="background-color: var(--badge-bg);">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" style="color: var(--badge-text);" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium"
                                            style="color: var(--text-muted); font-family: 'Inter', sans-serif;">WIT</p>
                                        <p class="text-sm font-bold tabular-nums"
                                            style="color: var(--text-primary); font-family: 'Inter', sans-serif;"
                                            id="time-wit">{{ \Carbon\Carbon::now('Asia/Jayapura')->format('H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center gap-2 sm:gap-3 pt-2 lg:pt-0"
                            style="border-top: 1px solid var(--border-color);" class="lg:border-t-0">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center transition-shadow flex-shrink-0"
                                style="background-color: var(--accent);">
                                <span class="text-sm font-bold text-white"
                                    style="font-family: 'Inter', sans-serif;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold truncate"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">
                                    {{ ucfirst(auth()->user()->role) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Real-time Clock Update Script -->
                <script>
                    function updateClocks() {
                        const now = new Date();

                        // WIB (GMT+7)
                        const wib = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
                        const wibElement = document.getElementById('time-wib');
                        if (wibElement) {
                            wibElement.textContent = wib.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        }

                        // WITA (GMT+8)
                        const wita = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Makassar' }));
                        const witaElement = document.getElementById('time-wita');
                        if (witaElement) {
                            witaElement.textContent = wita.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        }

                        // WIT (GMT+9)
                        const wit = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jayapura' }));
                        const witElement = document.getElementById('time-wit');
                        if (witElement) {
                            witElement.textContent = wit.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        }
                    }

                    // Update immediately
                    updateClocks();

                    // Update every second
                    setInterval(updateClocks, 1000);
                </script>



                <!-- Flash Messages handled by notifications component -->

                <!-- Main Content Area -->
                <main class="flex-1 overflow-y-auto p-6">
                    @yield('content')
                </main>

                <!-- Footer -->
                <footer
                    style="background-color: var(--bg-card); border-top: 1px solid var(--border-color); padding: 1rem 1.5rem;"
                    class="transition-colors duration-300">
                    <p class="text-center text-sm" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">
                        &copy; {{ date('Y') }} Sistem Perpustakaan Digital. UAS Pemrograman Web Lanjut.
                    </p>
                </footer>
            </div>
        </div>
    @endauth
    @include('components.notifications')
</body>

</html>