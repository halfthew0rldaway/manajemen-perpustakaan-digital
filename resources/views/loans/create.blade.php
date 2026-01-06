@extends('layouts.app')

@section('title', 'Pinjam Buku - Perpustakaan Digital')
@section('page-title', 'Pinjam Buku')

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Pinjam Buku</h1>
                    <p class="text-gray-600">Catat peminjaman buku baru</p>
                </div>
                <a href="{{ route('loans.index') }}" class="btn-secondary">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </span>
                </a>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-sky-500 p-5 mb-6 rounded-lg">
            <div class="flex items-start">
                <svg class="h-6 w-6 text-sky-700 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm font-semibold text-sky-700 mb-1">Informasi Penting</p>
                    <p class="text-sm text-sky-700">
                        Setiap pengguna maksimal dapat meminjam <strong>4 buku aktif</strong> secara bersamaan. Denda
                        keterlambatan <strong>Rp2.000/hari</strong>.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md border-2 border-gray-100">
            <div class="px-8 py-6 border-b-2 border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">Informasi Peminjaman</h2>
            </div>

            <form method="POST" action="{{ route('loans.store') }}" class="p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Row 1: Peminjam (Full Width) -->
                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Peminjam <span class="text-pink-600">*</span>
                        </label>
                        <select name="user_id" id="user_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all bg-white @error('user_id') border-pink-400 @enderror">
                            <option value="">-- Pilih Peminjam --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }}) - {{ $user->activeLoans()->count() }}/4 buku aktif
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Row 2: Buku (Full Width) -->
                    <div>
                        <label for="book_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Buku <span class="text-pink-600">*</span>
                        </label>
                        <select name="book_id" id="book_id" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all bg-white @error('book_id') border-pink-400 @enderror">
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }} {{ $book->stock == 0 ? 'disabled' : '' }}>
                                    {{ $book->title }} - {{ $book->author }} (Stok:
                                    {{ $book->stock }}){{ $book->stock == 0 ? ' - HABIS' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')
                            <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Row 3: Tanggal Pinjam & Jatuh Tempo (2 Columns) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="loan_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Pinjam <span class="text-pink-600">*</span>
                            </label>
                            <input type="date" name="loan_date" id="loan_date" value="{{ old('loan_date', date('Y-m-d')) }}"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('loan_date') border-pink-400 @enderror">
                            @error('loan_date')
                                <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Jatuh Tempo <span class="text-pink-600">*</span>
                            </label>
                            <input type="date" name="due_date" id="due_date"
                                value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('due_date') border-pink-400 @enderror">
                            @error('due_date')
                                <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-100">
                    <a href="{{ route('loans.index') }}" class="btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn-success">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Peminjaman
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection