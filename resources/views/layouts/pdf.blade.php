<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan') - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'Inter', sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-white text-slate-900 p-8 max-w-[210mm] mx-auto min-h-screen">
    <!-- Letterhead -->
    <div class="border-b-2 border-slate-900 pb-6 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold uppercase tracking-wide">Perpustakaan Digital</h1>
            <p class="text-sm text-slate-600 mt-1">Laporan Resmi Perpustakaan</p>
        </div>
        <div class="text-right text-sm">
            <p class="font-medium">Dicetak pada:</p>
            <p class="text-slate-600">{{ now()->format('d F Y, H:i') }}</p>
        </div>
    </div>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <div class="mt-8 pt-6 border-t border-slate-200 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} Perpustakaan Digital. Dokumen ini dicetak secara otomatis dari sistem.</p>
    </div>

    <!-- Auto-Print Script -->
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>