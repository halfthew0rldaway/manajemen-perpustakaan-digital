@extends('layouts.app')

@section('title', 'Edit Buku - Perpustakaan Digital')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Edit Buku</h1>
            <p class="mt-2 text-gray-600">Perbarui informasi buku</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <form method="POST" action="{{ route('books.update', $book) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Buku <span class="text-pink-600">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('title') border-pink-400 @enderror"
                        placeholder="Masukkan judul buku">
                    @error('title')
                        <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                        Penulis <span class="text-pink-600">*</span>
                    </label>
                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('author') border-pink-400 @enderror"
                        placeholder="Masukkan nama penulis">
                    @error('author')
                        <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Publisher -->
                    <div>
                        <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">
                            Penerbit
                        </label>
                        <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $book->publisher) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('publisher') border-pink-400 @enderror"
                            placeholder="Masukkan penerbit">
                        @error('publisher')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publication Year -->
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun Terbit
                        </label>
                        <input type="number" name="publication_year" id="publication_year"
                            value="{{ old('publication_year', $book->publication_year) }}" min="1900" max="{{ date('Y') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('publication_year') border-pink-400 @enderror"
                            placeholder="{{ date('Y') }}">
                        @error('publication_year')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- ISBN -->
                    <div>
                        <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
                            ISBN
                        </label>
                        <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('isbn') border-pink-400 @enderror"
                            placeholder="978-xxx-xxx-xxx-x">
                        @error('isbn')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori
                        </label>
                        <input type="text" name="category" id="category" value="{{ old('category', $book->category) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('category') border-pink-400 @enderror"
                            placeholder="Novel, Sejarah, dll">
                        @error('category')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stock -->
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                        Stok <span class="text-pink-600">*</span>
                    </label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $book->stock) }}" min="0" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('stock') border-pink-400 @enderror"
                        placeholder="Stok saat ini">
                    <p class="mt-1 text-sm text-gray-500">Untuk update, stok boleh 0 atau lebih</p>
                    @error('stock')
                        <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-transparent @error('description') border-pink-400 @enderror"
                        placeholder="Masukkan deskripsi buku (opsional)">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('books.index') }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-sky-500 text-white rounded-lg font-medium hover:bg-sky-500 transition">
                        Update Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection