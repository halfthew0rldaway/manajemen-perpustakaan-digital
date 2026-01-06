<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kadaluarsa - Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-300 rounded-full mb-4 shadow-lg">
                <span class="text-3xl">⏱️</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Halaman Kadaluarsa</h1>
            <p class="text-gray-600">Sesi Anda telah berakhir</p>
        </div>

        <!-- Error Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-purple-200">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-yellow-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Sesi Telah Berakhir</h2>
                <p class="text-gray-600 text-sm mb-6">
                    Halaman ini telah kadaluarsa karena Anda tidak aktif terlalu lama atau token keamanan telah
                    berakhir. Silakan refresh halaman dan coba lagi.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <button onclick="window.location.reload()"
                    class="w-full bg-sky-400 text-white py-3 px-4 rounded-lg font-bold shadow-xl hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-sky-300 transition-all duration-200 transform hover:-translate-y-1 active:translate-y-0"
                    style="border-bottom: 5px solid #0284c7;">
                    <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>Refresh Halaman
                </button>

                <a href="{{ route('dashboard') }}"
                    class="block w-full text-center bg-white border-2 border-purple-300 text-gray-700 py-3 px-4 rounded-lg font-bold shadow-lg hover:shadow-xl hover:bg-purple-50 hover:border-purple-400 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-200 transform hover:-translate-y-1 active:translate-y-0"
                    style="border-bottom: 5px solid #c084fc;">
                    <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>Kembali ke Dashboard
                </a>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-sky-50 rounded-lg border border-sky-200">
                <p class="text-xs font-semibold text-gray-700 mb-2">💡 Tips:</p>
                <ul class="text-xs text-gray-600 space-y-1 list-disc list-inside">
                    <li>Sesi akan kadaluarsa setelah 2 jam tidak aktif</li>
                    <li>Centang "Ingat saya" saat login untuk sesi lebih lama</li>
                    <li>Simpan pekerjaan Anda secara berkala</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-600 mt-6">
            UAS Pemrograman Web Lanjut &copy; {{ date('Y') }}
        </p>
    </div>

    <script>
        // Auto-redirect to previous page after 5 seconds if coming from same domain
        setTimeout(function () {
            if (document.referrer && document.referrer.indexOf(window.location.hostname) !== -1) {
                window.location.href = document.referrer;
            }
        }, 5000);
    </script>
</body>

</html>