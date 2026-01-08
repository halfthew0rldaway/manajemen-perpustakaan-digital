@extends('layouts.app')

@section('title', 'Edit Peminjaman - Perpustakaan Digital')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Peminjaman</h1>
                <p class="text-gray-600 dark:text-gray-400">Perbarui informasi tanggal jatuh tempo peminjaman.</p>
            </div>

            <!-- Info Box -->
            <div class="bg-sky-50 dark:bg-sky-900/20 border-l-4 border-sky-500 p-5 mb-6 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-sky-600 dark:text-sky-400 mr-3 mt-0.5 flex-shrink-0" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-bold text-sky-800 dark:text-sky-300 mb-2">Detail Peminjaman</h3>
                        <div class="text-sm text-sky-700 dark:text-sky-200 space-y-1">
                            <p><span class="font-semibold">Peminjam:</span> {{ $loan->user->name }}</p>
                            <p><span class="font-semibold">Buku:</span> {{ $loan->book->title }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('loans.update', $loan) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Loan Date (Read Only) -->
                            <div>
                                <label for="loan_date"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Pinjam
                                </label>
                                <input type="date" id="loan_date" value="{{ $loan->loan_date->format('Y-m-d') }}" disabled
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-gray-400 cursor-not-allowed">
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Tidak dapat diubah
                                </p>
                            </div>

                            <!-- Due Date -->
                            <div>
                                <label for="due_date"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Jatuh Tempo <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="due_date" id="due_date"
                                    value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}"
                                    min="{{ $loan->loan_date->format('Y-m-d') }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all">
                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Denda keterlambatan: Rp2.000/hari
                                </p>
                            </div>
                        </div>

                        <!-- Current Status Info -->
                        <div
                            class="bg-gray-50 dark:bg-slate-900/50 rounded-lg p-5 border border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Status Saat Ini</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div
                                    class="flex justify-between items-center p-3 bg-white dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                                    <span
                                        class="font-bold {{ $loan->status === 'active' ? 'text-teal-600 dark:text-teal-400' : 'text-gray-600 dark:text-gray-400' }}">
                                        {{ $loan->status === 'active' ? 'Aktif' : 'Dikembalikan' }}
                                    </span>
                                </div>
                                @if($loan->isOverdue())
                                    <div
                                        class="flex justify-between items-center p-3 bg-red-50 dark:bg-red-900/10 rounded-lg border border-red-200 dark:border-red-800/30">
                                        <span class="text-sm text-red-800 dark:text-red-300 font-medium">Keterlambatan</span>
                                        <span class="font-bold text-red-600 dark:text-red-400">{{ $loan->getDaysOverdue() }}
                                            hari</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div
                            class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('loans.show', $loan) }}"
                                class="w-full sm:w-auto px-6 py-3 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-slate-600 transition-all text-center">
                                Batal
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto px-6 py-3 bg-sky-500 text-white rounded-lg font-semibold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Update Tanggal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection