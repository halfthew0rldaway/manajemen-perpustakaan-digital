@extends('layouts.app')

@section('title', 'Detail Anggota')
@section('page-title', 'Detail Anggota')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="heading" style="font-size: 1.875rem;">Detail Anggota</h1>
                    <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Informasi lengkap anggota perpustakaan</p>
                </div>
                <a href="{{ route('members.index') }}" class="btn-secondary inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Member Info Card -->
                <div class="lg:col-span-1">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-4" style="background-color: var(--accent);">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h2 class="heading" style="font-size: 1.25rem;">{{ $member->name }}</h2>
                            <p class="text-sm mb-4" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">{{ $member->member_id_number }}</p>
                            
                            @if($member->status === 'active')
                                <span class="badge bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">Aktif</span>
                            @else
                                <span class="badge bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400">Nonaktif</span>
                            @endif

                            <div class="mt-6 pt-6 border-t" style="border-color: var(--border-color);">
                                <a href="{{ route('members.edit', $member) }}" class="btn-primary w-full mb-2">Edit Data</a>
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('members.toggle-status', $member) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-secondary w-full">
                                            {{ $member->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details & Loans -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Contact Information -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading" style="font-size: 1.125rem;">Informasi Kontak</h3>
                        </div>
                        <div class="card-body">
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Profesi/Institusi</dt>
                                    <dd class="mt-1 text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->occupation_institution }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Telepon</dt>
                                    <dd class="mt-1 text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->phone ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Email</dt>
                                    <dd class="mt-1 text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->email ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Alamat</dt>
                                    <dd class="mt-1 text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->address ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Active Loans -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading" style="font-size: 1.125rem;">Peminjaman Aktif ({{ $member->activeLoans->count() }}/4)</h3>
                        </div>
                        <div class="card-body">
                            @if($member->activeLoans->count() > 0)
                                <div class="space-y-3">
                                    @foreach($member->activeLoans as $loan)
                                        <div class="flex items-center justify-between p-4 rounded-lg" style="background-color: var(--bg-secondary); border: 1px solid var(--border-color);">
                                            <div class="flex-1">
                                                <p class="font-semibold text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $loan->book->title }}</p>
                                                <p class="text-xs mt-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">
                                                    Pinjam: {{ $loan->loan_date->format('d M Y') }} • 
                                                    Kembali: {{ $loan->due_date->format('d M Y') }}
                                                </p>
                                            </div>
                                            @if($loan->isOverdue())
                                                <span class="badge bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400">Terlambat</span>
                                            @else
                                                <span class="badge bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">Aktif</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 mb-3" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Tidak ada peminjaman aktif</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Loan History -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="heading" style="font-size: 1.125rem;">Riwayat Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            @if($member->loans->where('status', 'returned')->count() > 0)
                                <div class="space-y-2">
                                    @foreach($member->loans->where('status', 'returned')->take(5) as $loan)
                                        <div class="flex items-center justify-between p-3 rounded" style="background-color: var(--bg-secondary);">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $loan->book->title }}</p>
                                                <p class="text-xs" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">{{ $loan->loan_date->format('d M Y') }} - {{ $loan->return_date->format('d M Y') }}</p>
                                            </div>
                                            @if($loan->fine_amount > 0)
                                                <span class="text-xs badge bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400">
                                                    Denda: Rp{{ number_format($loan->fine_amount, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Belum ada riwayat peminjaman</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
