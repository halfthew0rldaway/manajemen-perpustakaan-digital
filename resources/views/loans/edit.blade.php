@extends('layouts.app')

@section('title', 'Edit Peminjaman - Perpustakaan Digital')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Peminjaman</h1>
            <p class="mt-2 text-gray-600">Perbarui tanggal jatuh tempo</p>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-sky-500 p-4 mb-6 rounded">
            <div class="flex">
                <svg class="h-5 w-5 text-sky-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-sky-700">
                        <strong>Peminjam:</strong> {{ $loan->user->name }} |
                        <strong>Buku:</strong> {{ $loan->book->title }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('loans.update', $loan) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Loan Date (Read Only) -->
                <div>
                    <label for="loan_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Pinjam
                    </label>
                    <input type="date" id="loan_date" value="{{ $loan->loan_date->format('Y-m-d') }}" disabled
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed">
                    <p class="mt-1 text-sm text-gray-500">Tanggal pinjam tidak dapat diubah</p>
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Jatuh Tempo <span class="text-pink-600">*</span>
                    </label>
                    <input type="date" name="due_date" id="due_date"
                        value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}"
                        min="{{ $loan->loan_date->format('Y-m-d') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('due_date') border-pink-400 @enderror">
                    @error('due_date')
                        <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Denda keterlambatan: Rp2.000/hari</p>
                </div>

                <!-- Current Status Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Informasi Saat Ini</h3>
                    <dl class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <dt class="text-gray-600">Status:</dt>
                            <dd class="font-medium {{ $loan->status === 'active' ? 'text-teal-600' : 'text-gray-600' }}">
                                {{ $loan->status === 'active' ? 'Aktif' : 'Dikembalikan' }}
                            </dd>
                        </div>
                        @if($loan->isOverdue())
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-600">Keterlambatan:</dt>
                                <dd class="font-medium text-pink-600">{{ $loan->getDaysOverdue() }} hari</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('loans.show', $loan) }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-sky-500 text-white rounded-lg font-medium hover:bg-sky-500 transition">
                        Update Tanggal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection