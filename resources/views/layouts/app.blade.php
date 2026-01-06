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

    <!-- Google Fonts - Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        /* Enhanced Button Styles - 3D Effect with Strong Shadows */
        .btn-primary {
            @apply px-6 py-3 bg-sky-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200;
            border-bottom: 4px solid #0284c7;
            transform: translateY(0);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            border-bottom-width: 6px;
        }

        .btn-primary:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-secondary {
            @apply px-6 py-3 bg-white border-2 border-gray-400 text-gray-700 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all duration-200;
            border-bottom: 4px solid #9ca3af;
            transform: translateY(0);
        }

        .btn-secondary:hover {
            @apply bg-gray-50 border-gray-500;
            transform: translateY(-2px);
            border-bottom-width: 6px;
            border-bottom-color: #6b7280;
        }

        .btn-secondary:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-success {
            @apply px-6 py-3 bg-teal-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200;
            border-bottom: 4px solid #0d9488;
            transform: translateY(0);
        }

        .btn-success:hover {
            @apply bg-teal-600;
            transform: translateY(-2px);
            border-bottom-width: 6px;
        }

        .btn-success:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-danger {
            @apply px-6 py-3 bg-pink-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200;
            border-bottom: 4px solid #db2777;
            transform: translateY(0);
        }

        .btn-danger:hover {
            @apply bg-pink-600;
            transform: translateY(-2px);
            border-bottom-width: 6px;
        }

        .btn-danger:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-warning {
            @apply px-6 py-3 bg-amber-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200;
            border-bottom: 4px solid #d97706;
            transform: translateY(0);
        }

        .btn-warning:hover {
            @apply bg-amber-600;
            transform: translateY(-2px);
            border-bottom-width: 6px;
        }

        .btn-warning:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-info {
            @apply px-6 py-3 bg-purple-500 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200;
            border-bottom: 4px solid #9333ea;
            transform: translateY(0);
        }

        .btn-info:hover {
            @apply bg-purple-600;
            transform: translateY(-2px);
            border-bottom-width: 6px;
        }

        .btn-info:active {
            transform: translateY(1px);
            border-bottom-width: 2px;
        }

        .btn-sm {
            @apply px-4 py-2 text-sm;
            border-bottom-width: 3px !important;
        }

        .btn-sm:hover {
            border-bottom-width: 4px !important;
        }

        .btn-sm:active {
            border-bottom-width: 2px !important;
        }

        /* Enhanced Form Elements */
        .form-input {
            @apply w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400/30 focus:border-sky-400 transition-all duration-200 bg-white shadow-sm;
        }

        .form-input:focus {
            @apply shadow-md;
        }

        .form-select {
            @apply w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400/30 focus:border-sky-400 transition-all duration-200 bg-white cursor-pointer shadow-sm;
        }

        .form-select:focus {
            @apply shadow-md;
        }

        .form-textarea {
            @apply w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400/30 focus:border-sky-400 transition-all duration-200 bg-white resize-none shadow-sm;
        }

        .form-textarea:focus {
            @apply shadow-md;
        }

        .form-label {
            @apply block text-sm font-semibold text-gray-700 mb-2;
        }

        /* Card Styles */
        .card {
            @apply bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden;
        }

        .card-header {
            @apply px-6 py-4 border-b border-gray-200 bg-gray-50;
        }

        .card-body {
            @apply p-6;
        }

        /* Custom scrollbar - Soft Pastel */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #bae6fd;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #7dd3fc;
        }

        /* Table Enhancements */
        .table-hover tbody tr:hover {
            @apply bg-sky-50/50 transition-colors duration-150;
        }

        /* Sidebar Transition */

        /* ========== SMOOTH ANIMATIONS ========== */
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Page Transition Animation */
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

        /* Enhanced Form Input Animations */
        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            transform: translateY(-1px);
        }

        .form-label {
            transition: color 0.2s ease;
        }

        @media print {
            /* Hide UI elements */
            .no-print, 
            aside, 
            nav[class*="fixed"], /* Hide fixed navbar */
            button, 
            a[href*="export"], 
            form,
            .bg-sky-500.text-white /* Hide floating buttons */
            { 
                display: none !important; 
            }

            /* Reset layout */
            body, #app, main { 
                margin: 0 !important; 
                padding: 0 !important; 
                width: 100% !important; 
                overflow: visible !important;
                background: white !important;
            }

            /* Main content area reset */
            .ml-64 { margin-left: 0 !important; }
            
            /* Table Styling for Print */
            table { 
                border-collapse: collapse !important; 
                width: 100% !important; 
                font-size: 12px !important;
            }
            th, td { 
                border: 1px solid #777 !important; 
                padding: 6px !important; 
                color: black !important;
            }
            .shadow-sm, .shadow-md, .shadow-lg { box-shadow: none !important; border: none !important; }
            
            /* Header adjustments */
            h1 { font-size: 20px !important; margin-bottom: 10px !important; color: black !important; }
            p { font-size: 12px !important; color: #444 !important; }
        }
        /* Card Hover Animation */
        .card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Scrollbar Animation */
        ::-webkit-scrollbar-thumb {
            transition: background 0.3s ease;
        }

        /* Table Row Smooth Transition */
        .table-hover tbody tr {
            transition: all 0.2s ease;
        }

        .table-hover tbody tr:hover {
            transform: scale(1.005);
        }

        /* Link Hover Animation */
        a:not(.btn-primary):not(.btn-secondary):not(.btn-success):not(.btn-danger) {
            transition: all 0.2s ease;
        }

        a:not(.btn-primary):not(.btn-secondary):not(.btn-success):not(.btn-danger):hover {
            transform: translateX(2px);
        }

        /* Fade In Up Animation for Content */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Pulse Animation */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.85;
            }
        }

        .animate-pulse-subtle {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Hover Scale */
        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        /* Badge Animation */
        .badge {
            transition: all 0.2s ease;
        }

        .badge:hover {
            transform: scale(1.1);
        }
        .sidebar-transition {
            transition: width 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    <script>
        // Auto-refresh CSRF token every 60 minutes to prevent page expiration
        @auth
        setInterval(function() {
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

<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    @auth
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside @mouseenter="sidebarOpen = true" @mouseleave="sidebarOpen = false" :class="sidebarOpen ? 'w-64' : 'w-20'"
                class="sidebar-transition bg-sky-600 text-white flex flex-col shadow-xl relative z-10">
                <!-- Logo & Toggle -->
                <div class="flex items-center justify-between p-4 border-b border-sky-500">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="flex-shrink-0 w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-2xl">📚</span>
                        </div>
                        <div x-show="sidebarOpen" x-transition class="overflow-hidden">
                            <h1 class="text-lg font-bold whitespace-nowrap">DigiLib</h1>
                            <p class="text-xs text-sky-100 whitespace-nowrap">Perpustakaan Digital</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-sky-500 shadow-md' : 'hover:bg-sky-500' }}"
                        :title="!sidebarOpen ? 'Dashboard' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Dashboard</span>
                    </a>

                    <!-- Buku -->
                    <a href="{{ route('books.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('books.*') ? 'bg-sky-500 shadow-md' : 'hover:bg-sky-500' }}"
                        :title="!sidebarOpen ? 'Buku' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Buku</span>
                    </a>

                    <!-- Kategori -->
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-sky-500 shadow-md' : 'hover:bg-sky-500' }}"
                        :title="!sidebarOpen ? 'Kategori' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Kategori</span>
                    </a>

                    <!-- Peminjaman -->
                    <a href="{{ route('loans.index') }}"
                        class="flex items-center space-x-3 px-3 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('loans.*') ? 'bg-sky-500 shadow-md' : 'hover:bg-sky-500' }}"
                        :title="!sidebarOpen ? 'Peminjaman' : ''">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span x-show="sidebarOpen" x-transition class="font-medium whitespace-nowrap">Peminjaman</span>
                    </a>

                    <!-- Laporan -->
                    <div x-data="{ open: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="w-full flex items-center justify-between px-3 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-sky-500 shadow-md' : 'hover:bg-sky-500' }}"
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
                                class="block px-3 py-2 text-sm rounded-lg hover:bg-sky-500 transition-colors {{ request()->routeIs('reports.daily') ? 'bg-sky-500' : '' }}">
                                Laporan Harian
                            </a>
                            <a href="{{ route('reports.overdue') }}"
                                class="block px-3 py-2 text-sm rounded-lg hover:bg-sky-500 transition-colors {{ request()->routeIs('reports.overdue') ? 'bg-sky-500' : '' }}">
                                Keterlambatan
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- User Info & Logout -->
                <div class="border-t border-sky-500 p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center font-bold shadow-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div x-show="sidebarOpen" x-transition class="flex-1 overflow-hidden">
                            <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-sky-100 truncate">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-red-600 transition-all duration-200"
                            :title="!sidebarOpen ? 'Logout' : ''">
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
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Bar - Responsive -->
                <header class="bg-white shadow-sm border-b border-gray-200 px-4 sm:px-6 py-3 sm:py-4">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:gap-0">
                        <!-- Date & Timezones -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 lg:gap-6">
                            <!-- Date -->
                            <div class="lg:border-r lg:border-gray-200 lg:pr-6">
                                <p class="text-sm font-semibold text-gray-800">
                                    <!-- Full date for desktop -->
                                    <span class="hidden sm:inline">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                                    <!-- Short date for mobile -->
                                    <span class="sm:hidden">{{ now()->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                </p>
                            </div>
                            
                            <!-- Indonesian Timezones -->
                            <div class="flex items-center gap-2 sm:gap-3 lg:gap-4 overflow-x-auto pb-1 sm:pb-0">
                                <!-- WIB -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500">WIB</p>
                                        <p class="text-sm font-bold text-gray-900 tabular-nums" id="time-wib">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <div class="h-7 sm:h-8 w-px bg-gray-200 flex-shrink-0"></div>

                                <!-- WITA -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-teal-100 rounded-lg flex items-center justify-center group-hover:bg-teal-200 transition-colors">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500">WITA</p>
                                        <p class="text-sm font-bold text-gray-900 tabular-nums" id="time-wita">{{ \Carbon\Carbon::now('Asia/Makassar')->format('H:i') }}</p>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <div class="h-7 sm:h-8 w-px bg-gray-200 flex-shrink-0"></div>

                                <!-- WIT -->
                                <div class="flex items-center gap-1.5 sm:gap-2 group flex-shrink-0">
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500">WIT</p>
                                        <p class="text-sm font-bold text-gray-900 tabular-nums" id="time-wit">{{ \Carbon\Carbon::now('Asia/Jayapura')->format('H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="flex items-center gap-2 sm:gap-3 pt-2 lg:pt-0 border-t lg:border-t-0 border-gray-100">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-br from-sky-400 to-sky-600 rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-shadow flex-shrink-0">
                                <span class="text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</p>
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



                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="px-6 pt-4">
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md shadow-sm" x-data="{ show: true }"
                            x-show="show" x-transition>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-medium text-green-700">{{ session('success') }}</p>
                                </div>
                                <button @click="show = false" class="text-green-400 hover:text-green-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="px-6 pt-4">
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md shadow-sm" x-data="{ show: true }"
                            x-show="show" x-transition>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-red-400 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-medium text-red-700">{{ session('error') }}</p>
                                </div>
                                <button @click="show = false" class="text-red-400 hover:text-red-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Main Content Area -->
                <main class="flex-1 overflow-y-auto p-6">
                    @yield('content')
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200 px-6 py-4">
                    <p class="text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} Sistem Perpustakaan Digital. UAS Pemrograman Web Lanjut.
                    </p>
                </footer>
            </div>
        </div>
    @endauth
    @include('components.notifications')
</body>

</html>