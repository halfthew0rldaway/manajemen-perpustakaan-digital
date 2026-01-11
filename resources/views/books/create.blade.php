@extends('layouts.app')

@section('title', 'Tambah Buku - Perpustakaan Digital')
@section('page-title', 'Tambah Buku')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Tambah Buku Baru</h1>
                <p class="text-gray-600 dark:text-gray-400">Lengkapi formulir di bawah ini untuk menambahkan koleksi buku
                    baru ke perpustakaan.</p>
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
                                <label for="author"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
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
                                    ISBN <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="isbn" id="isbn"
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('isbn') }}" required maxlength="13" placeholder="Contoh: 9786020303883">
                                @error('isbn')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Penerbit & Tahun Terbit -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="publisher"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Penerbit <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="publisher" id="publisher"
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('publisher') }}" required placeholder="Nama penerbit buku">
                                @error('publisher')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="publication_year"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tahun Terbit <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="publication_year" id="publication_year"
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('publication_year') }}" required placeholder="Contoh: 2024" min="1900"
                                    max="{{ date('Y') }}">
                                @error('publication_year')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Kategori & Stok -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>

                                <div x-data="{
                                        open: false,
                                        search: '',
                                        selectedId: '{{ old('category_id') }}',
                                        selectedName: '',
                                        options: {{ $categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toJson() }},
                                        init() {
                                            if (this.selectedId) {
                                                const found = this.options.find(o => o.id == this.selectedId);
                                                if (found) this.selectedName = found.name;
                                            }
                                        },
                                        get filteredOptions() {
                                            if (this.search === '') return this.options;
                                            return this.options.filter(option => 
                                                option.name.toLowerCase().includes(this.search.toLowerCase())
                                            );
                                        },
                                        select(option) {
                                            this.selectedId = option.id;
                                            this.selectedName = option.name;
                                            this.open = false;
                                            this.search = '';
                                        }
                                    }" class="relative" @click.outside="open = false">

                                    <!-- Hidden Input -->
                                    <input type="hidden" name="category_id" :value="selectedId">

                                    <!-- Trigger Button -->
                                    <button type="button" @click="open = !open; $nextTick(() => $refs.searchInput.focus())"
                                        class="w-full px-4 py-3 text-left border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all flex justify-between items-center"
                                        :class="{'border-red-500': {{ $errors->has('category_id') ? 'true' : 'false' }}}">
                                        <span x-text="selectedName || 'Pilih Kategori'"
                                            :class="{'text-gray-500 dark:text-gray-400': !selectedName}"></span>
                                        <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                            :class="{'transform rotate-180': open}" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" x-transition.opacity.duration.200ms
                                        class="absolute z-50 w-full mt-1 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl overflow-hidden">

                                        <!-- Search Input -->
                                        <div class="p-2 border-b border-gray-200 dark:border-gray-700">
                                            <input x-ref="searchInput" x-model="search" type="text"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white text-sm"
                                                placeholder="Cari kategori...">
                                        </div>

                                        <!-- Options -->
                                        <ul class="max-h-60 overflow-y-auto">
                                            <template x-for="option in filteredOptions" :key="option.id">
                                                <li @click="select(option)"
                                                    class="px-4 py-2 cursor-pointer hover:bg-sky-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-300 transition-colors"
                                                    :class="{'bg-sky-50 dark:bg-slate-700 font-medium text-sky-600 dark:text-sky-400': selectedId == option.id}">
                                                    <span x-text="option.name"></span>
                                                </li>
                                            </template>
                                            <li x-show="filteredOptions.length === 0"
                                                class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                                                Tidak ada kategori ditemukan.
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="stock"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Jumlah Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stock" id="stock"
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all"
                                    value="{{ old('stock', 2) }}" required min="2" placeholder="2">
                                @error('stock')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi (Full Width) -->
                        <div>
                            <label for="description"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
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
                        <div
                            class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('books.index') }}"
                                class="btn-secondary w-full sm:w-auto inline-flex items-center justify-center text-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                class="btn-primary w-full sm:w-auto inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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