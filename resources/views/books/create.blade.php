@extends('layouts.app')

@section('title', 'Tambah Buku - Perpustakaan Digital')
@section('page-title', 'Tambah Buku')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Buku Baru</h1>
                <p class="text-gray-600">Tambahkan buku baru ke koleksi perpustakaan</p>
            </div>
            <a href="{{ route('books.index') }}" class="btn-secondary">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </span>
            </a>
        </div>
    </div>
    
    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-md border-2 border-gray-100">
        <div class="px-8 py-6 border-b-2 border-gray-100">
            <h2 class="text-xl font-bold text-gray-900">Informasi Buku</h2>
        </div>
        
        <form method="POST" action="{{ route('books.store') }}" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Row 1: Judul Buku (Full Width) -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Buku <span class="text-pink-600">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('title') border-pink-400 @enderror"
                        placeholder="Masukkan judul buku"
                    >
                    @error('title')
                    <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Row 2: Penulis (Full Width) -->
                <div>
                    <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">
                        Penulis <span class="text-pink-600">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="author" 
                        id="author" 
                        value="{{ old('author') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('author') border-pink-400 @enderror"
                        placeholder="Masukkan nama penulis"
                    >
                    @error('author')
                    <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Row 3: Penerbit & Tahun Terbit (2 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="publisher" class="block text-sm font-semibold text-gray-700 mb-2">
                            Penerbit
                        </label>
                        <input 
                            type="text" 
                            name="publisher" 
                            id="publisher" 
                            value="{{ old('publisher') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('publisher') border-pink-400 @enderror"
                            placeholder="Masukkan penerbit"
                        >
                        @error('publisher')
                        <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="publication_year" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tahun Terbit
                        </label>
                        <input 
                            type="number" 
                            name="publication_year" 
                            id="publication_year" 
                            value="{{ old('publication_year', date('Y')) }}"
                            min="1900"
                            max="{{ date('Y') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('publication_year') border-pink-400 @enderror"
                            placeholder="{{ date('Y') }}"
                        >
                        @error('publication_year')
                        <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Row 4: ISBN & Kategori (2 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="isbn" class="block text-sm font-semibold text-gray-700 mb-2">
                            ISBN
                        </label>
                        <input 
                            type="text" 
                            name="isbn" 
                            id="isbn" 
                            value="{{ old('isbn') }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('isbn') border-pink-400 @enderror"
                            placeholder="978-xxx-xxx-xxx-x"
                        >
                        @error('isbn')
                        <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select 
                            name="category" 
                            id="category" 
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all bg-white @error('category') border-pink-400 @enderror"
                        >
                            <option value="">Pilih Kategori</option>
                            <option value="Novel" {{ old('category') == 'Novel' ? 'selected' : '' }}>Novel</option>
                            <option value="Novel Sejarah" {{ old('category') == 'Novel Sejarah' ? 'selected' : '' }}>Novel Sejarah</option>
                            <option value="Fiksi" {{ old('category') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                            <option value="Non-Fiksi" {{ old('category') == 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                            <option value="Biografi" {{ old('category') == 'Biografi' ? 'selected' : '' }}>Biografi</option>
                            <option value="Sejarah" {{ old('category') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Sains" {{ old('category') == 'Sains' ? 'selected' : '' }}>Sains</option>
                            <option value="Teknologi" {{ old('category') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                            <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                        <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Row 5: Stok (Smaller Width) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok <span class="text-pink-600">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="stock" 
                            id="stock" 
                            value="{{ old('stock', 2) }}"
                            min="2"
                            required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all @error('stock') border-pink-400 @enderror"
                            placeholder="Minimal 2"
                        >
                        @error('stock')
                        <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                        @else
                        <p class="mt-2 text-sm text-sky-600">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Stok minimal untuk buku baru adalah 2
                        </p>
                        @enderror
                    </div>
                </div>
                
                <!-- Row 6: Deskripsi (Full Width) -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="5"
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all resize-none @error('description') border-pink-400 @enderror"
                        placeholder="Masukkan deskripsi buku (opsional)"
                    >{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-pink-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-100">
                <a href="{{ route('books.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Buku
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection