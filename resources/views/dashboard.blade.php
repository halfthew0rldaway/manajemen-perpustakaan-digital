@extends('layouts.app')

@section('title', 'Dashboard - Perpustakaan Digital')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Statistics Cards - 60% white background, 30% slate, 10% accent colors -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Books -->
            <div
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-sky-400 transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-sky-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Buku</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $totalBooks }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Koleksi perpustakaan</p>
            </div>

            <!-- Total Users -->
            <div
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-sky-400 transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-sky-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $totalUsers }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Anggota terdaftar</p>
            </div>

            <!-- Active Loans -->
            <div
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-teal-400 transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $activeLoans }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Sedang dipinjam</p>
            </div>

            <!-- Overdue Loans -->
            <div
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-pink-400 transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-pink-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Terlambat</p>
                <p class="text-3xl font-bold text-pink-600 mb-2">{{ $overdueLoans }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Melewati jatuh tempo</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tren Peminjaman (7 Hari Terakhir)</h3>
                <div class="relative h-64">
                    <canvas id="loanChart"></canvas>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Populasi Buku per Kategori</h3>
                <div class="relative h-64">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Loans -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700">
                <div class="px-6 py-4 border-b-2 border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Peminjaman Terbaru</h2>
                    <a href="{{ route('loans.index') }}" class="text-sm text-sky-600 hover:text-sky-600 font-semibold">
                        Lihat Semua →
                    </a>
                </div>
                <div class="p-6">
                    @if($recentLoans->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentLoans as $loan)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-sky-400 transition-colors duration-200">
                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                        <div class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate text-sm">
                                                {{ $loan->book->title }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $loan->user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4 flex-shrink-0">
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $loan->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-gray-200 text-gray-700' }}">
                                            {{ $loan->status === 'active' ? 'Aktif' : 'Selesai' }}
                                        </span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $loan->loan_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada peminjaman</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Low Stock Books -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700">
                <div class="px-6 py-4 border-b-2 border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Buku Stok Rendah</h2>
                    <a href="{{ route('books.index') }}" class="text-sm text-sky-600 hover:text-sky-600 font-semibold">
                        Lihat Semua →
                    </a>
                </div>
                <div class="p-6">
                    @if($lowStockBooks->count() > 0)
                        <div class="space-y-3">
                            @foreach($lowStockBooks as $book)
                                <div
                                    class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-amber-400 transition-colors duration-200">
                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                        <div
                                            class="w-10 h-10 {{ $book->stock <= 1 ? 'bg-pink-500' : 'bg-amber-400' }} rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate text-sm">
                                                {{ $book->title }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ $book->author }}</p>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-bold {{ $book->stock <= 1 ? 'bg-pink-100 text-pink-700' : 'bg-amber-100 text-amber-700' }}">
                                            Stok: {{ $book->stock }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($outOfStockBooks > 0)
                            <div class="mt-4 p-3 bg-red-50 border-l-4 border-pink-400 rounded">
                                <p class="text-sm font-semibold text-pink-600">
                                    {{ $outOfStockBooks }} buku habis stok
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 font-medium">Semua buku stok aman</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('books.create') }}"
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-sky-500 hover:shadow-lg transition-all duration-200 group">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-sky-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">Tambah Buku</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tambah buku baru</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('loans.create') }}"
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-teal-500 hover:shadow-lg transition-all duration-200 group">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">Pinjam Buku</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Catat peminjaman</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.daily') }}"
                class="bg-white dark:bg-slate-800 rounded-lg shadow-md border-2 border-gray-100 dark:border-gray-700 p-6 hover:border-orange-400 hover:shadow-lg transition-all duration-200 group">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-12 h-12 bg-orange-400 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-white">Laporan Harian</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Lihat laporan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data from Controller
            const loanLabels = {!! json_encode($loanChartLabels) !!};
            const loanData = {!! json_encode($loanChartData) !!};

            const categoryLabels = {!! json_encode($categoryChartLabels) !!};
            const categoryData = {!! json_encode($categoryChartData) !!};

            // Helper to get color based on mode
            const getTextColor = () => document.documentElement.classList.contains('dark') ? '#cbd5e1' : '#64748b';
            const getGridColor = () => document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB';

            // 1. Loan Trend Chart
            const ctxLoan = document.getElementById('loanChart').getContext('2d');
            new Chart(ctxLoan, {
                type: 'line',
                data: {
                    labels: loanLabels,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: loanData,
                        borderColor: '#0ea5e9', // Sky-500
                        backgroundColor: 'rgba(14, 165, 233, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: document.documentElement.classList.contains('dark') ? '#0f172a' : '#fff',
                        pointBorderColor: '#0ea5e9',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: document.documentElement.classList.contains('dark') ? '#334155' : '#e2e8f0',
                                borderDash: [2, 2]
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // 2. Category Distribution Chart
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        data: categoryData,
                        backgroundColor: [
                            '#0ea5e9', // Sky
                            '#14b8a6', // Teal
                            '#f43f5e', // Rose
                            '#f59e0b', // Amber
                            '#8b5cf6', // Violet
                            '#64748b'  // Slate
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 6
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
@endsection