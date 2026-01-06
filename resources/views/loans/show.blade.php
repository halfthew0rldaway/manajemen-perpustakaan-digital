@extends('layouts.app')

@section('title', 'Detail Peminjaman - Perpustakaan Digital')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Peminjaman</h1>
                    <p class="mt-2 text-gray-600">Informasi lengkap peminjaman buku</p>
                </div>
                <a href="{{ route('loans.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Loan Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Peminjaman</h2>

                    <dl class="space-y-4">
                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Peminjam</dt>
                            <dd class="text-base font-medium text-gray-900">{{ $loan->user->name }}</dd>
                        </div>

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="text-base text-gray-900">{{ $loan->user->email }}</dd>
                        </div>

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Buku</dt>
                            <dd class="text-base font-medium text-gray-900">{{ $loan->book->title }}</dd>
                        </div>

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                            <dd class="text-base text-gray-900">{{ $loan->book->author }}</dd>
                        </div>

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Pinjam</dt>
                            <dd class="text-base text-gray-900">{{ $loan->loan_date->format('d F Y') }}</dd>
                        </div>

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Jatuh Tempo</dt>
                            <dd
                                class="text-base {{ $loan->isOverdue() ? 'text-pink-600 font-semibold' : 'text-gray-900' }}">
                                {{ $loan->due_date->format('d F Y') }}
                                @if($loan->isOverdue() && $loan->status === 'active')
                                    <span class="ml-2 text-sm">(Terlambat {{ $loan->getDaysOverdue() }} hari)</span>
                                @endif
                            </dd>
                        </div>

                        @if($loan->return_date)
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <dt class="text-sm font-medium text-gray-500">Tanggal Kembali</dt>
                                <dd class="text-base text-gray-900">{{ $loan->return_date->format('d F Y') }}</dd>
                            </div>
                        @endif

                        <div class="flex justify-between py-3 border-b border-gray-100">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd>
                                @if($loan->status === 'active')
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-teal-100 text-teal-700">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        Dikembalikan
                                    </span>
                                @endif
                            </dd>
                        </div>

                        <div class="flex justify-between py-3">
                            <dt class="text-sm font-medium text-gray-500">Denda</dt>
                            <dd
                                class="text-base {{ $loan->fine_amount > 0 ? 'text-pink-600 font-semibold' : 'text-gray-900' }}">
                                @if($loan->fine_amount > 0)
                                    Rp{{ number_format($loan->fine_amount, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div
                    class="{{ $loan->status === 'active' ? 'bg-teal-500' : 'bg-gray-400' }} rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Status</h3>
                    <p class="text-3xl font-bold">{{ $loan->status === 'active' ? 'Aktif' : 'Selesai' }}</p>

                    @if($loan->status === 'active' && $loan->isOverdue())
                        <div class="mt-4 pt-4 border-t border-teal-400">
                            <p class="text-sm text-teal-600">Keterlambatan</p>
                            <p class="text-2xl font-bold">{{ $loan->getDaysOverdue() }} hari</p>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                @if($loan->status === 'active')
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>

                        <form action="{{ route('loans.return', $loan) }}" method="POST"
                            onsubmit="return confirm('Proses pengembalian buku ini?')">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-3 bg-teal-500 text-white rounded-lg hover:bg-teal-500 transition font-medium">
                                Kembalikan Buku
                            </button>
                        </form>

                        <a href="{{ route('loans.edit', $loan) }}"
                            class="mt-3 block w-full text-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                            Edit Tanggal
                        </a>
                    </div>
                @endif

                <!-- Info -->
                <div class="bg-blue-50 border-l-4 border-sky-500 p-4 rounded">
                    <div class="flex">
                        <svg class="h-5 w-5 text-sky-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm text-sky-700">
                                Denda keterlambatan: <strong>Rp2.000/hari</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection