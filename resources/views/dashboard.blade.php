@extends('layouts.app')

@section('title', 'Dashboard - Perpustakaan Digital')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Books -->
            <div class="card" style="padding: 1.5rem;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: var(--accent);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Total Buku</p>
                <p class="text-3xl font-bold mb-2" style="color: var(--text-primary); font-family: 'Source Serif 4', Georgia, serif;">{{ $totalBooks }}</p>
                <p class="text-xs" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">Koleksi perpustakaan</p>
            </div>

            <!-- Total Users -->
            <div class="card" style="padding: 1.5rem;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-blue-500 dark:bg-blue-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Anggota Aktif</p>
                <p class="text-3xl font-bold mb-2" style="color: var(--text-primary); font-family: 'Source Serif 4', Georgia, serif;">{{ $totalMembers }}</p>
                <p class="text-xs" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">Anggota terdaftar</p>
            </div>

            <!-- Active Loans -->
            <div class="card" style="padding: 1.5rem;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-emerald-500 dark:bg-emerald-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Peminjaman Aktif</p>
                <p class="text-3xl font-bold mb-2" style="color: var(--text-primary); font-family: 'Source Serif 4', Georgia, serif;">{{ $activeLoans }}</p>
                <p class="text-xs" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">Sedang dipinjam</p>
            </div>

            <!-- Overdue Loans -->
            <div class="card" style="padding: 1.5rem;">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: var(--destructive);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm font-medium mb-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Terlambat</p>
                <p class="text-3xl font-bold mb-2" style="color: var(--destructive); font-family: 'Source Serif 4', Georgia, serif;">{{ $overdueLoans }}</p>
                <p class="text-xs" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">Melewati jatuh tempo</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="card" style="padding: 1.5rem;">
                <h3 class="heading" style="font-size: 1.125rem; margin-bottom: 1rem;">Tren Peminjaman (7 Hari Terakhir)</h3>
                <div class="relative h-64">
                    <canvas id="loanChart"></canvas>
                </div>
            </div>
            <div class="card" style="padding: 1.5rem;">
                <h3 class="heading" style="font-size: 1.125rem; margin-bottom: 1rem;">Populasi Buku per Kategori</h3>
                <div class="relative h-64">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Loans -->
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h2 class="heading" style="font-size: 1.125rem;">Peminjaman Terbaru</h2>
                    <a href="{{ route('loans.index') }}" class="text-sm font-semibold" style="color: var(--accent); font-family: 'Inter', sans-serif;">
                        Lihat Semua →
                    </a>
                </div>
                <div class="card-body">
                    @if($recentLoans->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentLoans as $loan)
                                <div class="flex items-center justify-between p-4 rounded-lg" style="background-color: var(--bg-primary); border: 1px solid var(--border-color);">
                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: var(--accent);">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold truncate text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                                {{ $loan->book->title }}</p>
                                            <p class="text-xs truncate" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">{{ $loan->member?->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4 flex-shrink-0">
                                        <span class="badge">
                                            {{ $loan->status === 'active' ? 'Aktif' : 'Selesai' }}
                                        </span>
                                        <p class="text-xs mt-1" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">
                                            {{ $loan->loan_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background-color: var(--bg-primary);">
                                <svg class="w-8 h-8" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p style="color: var(--text-muted); font-family: 'Inter', sans-serif;" class="font-medium">Belum ada peminjaman</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Low Stock Books -->
            <div class="card">
                <div class="card-header flex items-center justify-between">
                    <h2 class="heading" style="font-size: 1.125rem;">Buku Stok Rendah</h2>
                    <a href="{{ route('books.index') }}" class="text-sm font-semibold" style="color: var(--accent); font-family: 'Inter', sans-serif;">
                        Lihat Semua →
                    </a>
                </div>
                <div class="card-body">
                    @if($lowStockBooks->count() > 0)
                        <div class="space-y-3">
                            @foreach($lowStockBooks as $book)
                                <div class="flex items-center justify-between p-4 rounded-lg" style="background-color: var(--bg-primary); border: 1px solid var(--border-color);">
                                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                                        <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0 {{ $book->stock <= 1 ? 'bg-rose-500 dark:bg-rose-600' : 'bg-amber-500 dark:bg-amber-600' }}">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold truncate text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                                {{ $book->title }}</p>
                                            <p class="text-xs truncate" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">{{ $book->author }}</p>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="badge {{ $book->stock <= 1 ? 'bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' }}">
                                            Stok: {{ $book->stock }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($outOfStockBooks > 0)
                            <div class="mt-4 p-3 rounded bg-rose-50 dark:bg-rose-900/20 border-l-3" style="border-left: 3px solid #f43f5e;">
                                <p class="text-sm font-semibold text-rose-700 dark:text-rose-400" style="font-family: 'Inter', sans-serif;">
                                    {{ $outOfStockBooks }} buku habis stok
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 bg-emerald-500 dark:bg-emerald-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p style="color: var(--text-muted); font-family: 'Inter', sans-serif;" class="font-medium">Semua buku stok aman</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('books.create') }}"
                class="card p-6 transition-all duration-200 group hover:border-teal-500 dark:hover:border-teal-600" style="cursor: pointer;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-110" style="background-color: var(--accent);">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Tambah Buku</p>
                        <p class="text-sm" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Tambah buku baru</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('loans.create') }}"
                class="card p-6 transition-all duration-200 group hover:border-blue-500 dark:hover:border-blue-600" style="cursor: pointer;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-110 bg-blue-500 dark:bg-blue-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Pinjam Buku</p>
                        <p class="text-sm" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Catat peminjaman</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reports.daily') }}"
                class="card p-6 transition-all duration-200 group hover:border-violet-500 dark:hover:border-violet-600" style="cursor: pointer;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-110 bg-violet-500 dark:bg-violet-600">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Laporan Harian</p>
                        <p class="text-sm" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Lihat laporan</p>
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

            // Get CSS variable colors
            const accentColor = getComputedStyle(document.documentElement).getPropertyValue('--accent').trim();
            const borderColor = getComputedStyle(document.documentElement).getPropertyValue('--border-color').trim();
            const isDark = document.documentElement.classList.contains('dark');

            // 1. Loan Trend Chart
            const ctxLoan = document.getElementById('loanChart').getContext('2d');
            new Chart(ctxLoan, {
                type: 'line',
                data: {
                    labels: loanLabels,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: loanData,
                        borderColor: accentColor,
                        backgroundColor: accentColor + '20',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: accentColor,
                        pointBorderColor: accentColor,
                        pointBorderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 5
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
                                precision: 0,
                                color: isDark ? '#A9B4C2' : '#6B7280'
                            },
                            grid: {
                                color: borderColor,
                                borderDash: [2, 2]
                            }
                        },
                        x: {
                            ticks: {
                                color: isDark ? '#A9B4C2' : '#6B7280'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // 2. Category Distribution Chart - Using varied but calm colors
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            const categoryColors = [
                '#3B8E91', // Teal (accent)
                '#3B82F6', // Blue
                '#10B981', // Emerald
                '#8B5CF6', // Violet
                '#F59E0B', // Amber
                '#6B7280'  // Gray
            ];

            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        data: categoryData,
                        backgroundColor: categoryColors,
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
                                boxWidth: 6,
                                color: isDark ? '#A9B4C2' : '#6B7280',
                                font: {
                                    family: "'Inter', sans-serif"
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
@endsection