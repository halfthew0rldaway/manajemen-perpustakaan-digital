@extends('layouts.app')

@section('title', 'Edit Buku - Perpustakaan Digital')
@section('page-title', 'Edit Buku')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Edit Buku</h1>
                <p class="text-gray-600">Perbarui informasi buku dalam koleksi.</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Buku</label>
                                <input type="text" name="title" id="title" class="form-input"
                                    value="{{ old('title', $book->title) }}" required>
                                @error('title')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penulis -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                                <input type="text" name="author" id="author" class="form-input"
                                    value="{{ old('author', $book->author) }}" required>
                                @error('author')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn" class="form-input"
                                    value="{{ old('isbn', $book->isbn) }}">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div>
                                <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">Penerbit</label>
                                <input type="text" name="publisher" id="publisher" class="form-input"
                                    value="{{ old('publisher', $book->publisher) }}">
                                @error('publisher')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-2">Tahun
                                    Terbit</label>
                                <input type="number" name="publication_year" id="publication_year" class="form-input"
                                    value="{{ old('publication_year', $book->publication_year) }}" min="1900"
                                    max="{{ date('Y') }}">
                                @error('publication_year')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori (Dropdown) -->
                            <div>
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Stok -->
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Stok</label>
                                <input type="number" name="stock" id="stock" class="form-input"
                                    value="{{ old('stock', $book->stock) }}" required min="0">
                                @error('stock')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-textarea">{{ old('description', $book->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-100">
                            <button type="submit"
                                class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                                style="border-bottom: 4px solid #0284c7;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Perbarui Buku
                            </button>

                            <a href="{{ route('books.index') }}"
                                class="w-full sm:w-auto bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-bold hover:bg-gray-300 transition-all shadow-md hover:shadow-lg border-2 border-gray-300 hover:border-gray-400 transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                                style="border-bottom: 3px solid #9ca3af;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection