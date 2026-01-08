@extends('layouts.app')

@section('title', 'Tambah Buku - Perpustakaan Digital')
@section('page-title', 'Tambah Buku')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Tambah Buku Baru</h1>
                <p class="text-gray-600 dark:text-gray-400">Lengkapi formulir di bawah ini untuk menambahkan koleksi buku baru ke perpustakaan.</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Judul Buku (Full Width) -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Judul Buku <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" 
                                class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                value="{{ old('title') }}" required placeholder="Masukkan judul buku lengkap">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Row: Penulis & ISBN -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="author" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Penulis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="author" id="author" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('author') }}" required placeholder="Nama penulis utama">
                                @error('author')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="isbn" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    ISBN
                                </label>
                                <input type="text" name="isbn" id="isbn" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('isbn') }}" placeholder="Contoh: 978-602-03-0388-3">
                                @error('isbn')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Penerbit & Tahun Terbit -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="publisher" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Penerbit
                                </label>
                                <input type="text" name="publisher" id="publisher" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('publisher') }}" placeholder="Nama penerbit buku">
                                @error('publisher')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="publication_year" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tahun Terbit
                                </label>
                                <input type="number" name="publication_year" id="publication_year" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('publication_year') }}" placeholder="Contoh: 2024" min="1900" max="{{ date('Y') }}">
                                @error('publication_year')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Kategori & Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Kategori
                                </label>
                                <select name="category_id" id="category_id" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Jumlah Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stock" id="stock" 
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('stock', 1) }}" required min="0" placeholder="1">
                                @error('stock')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi (Full Width) -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all resize-none"
                                placeholder="Tuliskan ringkasan atau sinopsis buku...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('books.index') }}" 
                                class="w-full sm:w-auto px-6 py-3 bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-slate-600 transition-all text-center">
                                Batal
                            </a>
                            <button type="submit" 
                                class="w-full sm:w-auto px-6 py-3 bg-sky-500 text-white rounded-lg font-semibold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection