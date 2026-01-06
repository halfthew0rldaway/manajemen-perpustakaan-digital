@extends('layouts.app')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Daftar Buku</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Kelola koleksi buku perpustakaan</p>
            </div>
            <a href="{{ route('books.create') }}"
                class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                style="border-bottom: 4px solid #0284c7;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Buku
            </a>
        </div>

        <!-- Advanced Search & Filter -->
        <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 p-4 mb-6">
            <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 sm:py-3 border-2 border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-sky-400 focus:ring-1 focus:ring-sky-400 sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Cari berdasarkan judul, penulis, ISBN, atau penerbit...">
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    <!-- Category Select -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_id"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year Select -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <select name="year"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability Select -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Ketersediaan</label>
                        <select name="available"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="true" {{ request('available') === 'true' ? 'selected' : '' }}>Tersedia</option>
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Urutkan</label>
                        <div class="flex gap-2">
                            <select name="sort"
                                class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm">
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul</option>
                                <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Penulis</option>
                                <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Stok</option>
                            </select>
                            <select name="order"
                                class="block w-24 pl-3 pr-8 py-2 text-base border-gray-300 focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm">
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Z-A</option>
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>A-Z</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-2">
                    @if(request()->anyFilled(['search', 'category_id', 'year', 'available', 'sort']))
                        <a href="{{ route('books.index') }}"
                            class="w-full sm:w-auto bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors inline-flex items-center justify-center border border-gray-300">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset Filter
                        </a>
                    @endif
                    <button type="submit"
                        class="w-full sm:w-auto bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-900 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        style="border-bottom: 3px solid #1f2937;">
                        <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Books Grid/Table -->
        <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penulis</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stok</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-12 w-10 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors">
                                                {{ $book->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $book->isbn ?? 'No ISBN' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $book->author }}</div>
                                    <div class="text-xs text-gray-500">{{ $book->publication_year }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $book->categoryData->name ?? ($book->category ?? 'Umum') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($book->stock > 0)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $book->stock }} Tersedia
                                        </span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('books.show', $book) }}"
                                            class="text-sky-600 hover:text-sky-900 bg-sky-50 hover:bg-sky-100 px-3 py-1 rounded transition-colors">Detail</a>
                                        <a href="{{ route('books.edit', $book) }}"
                                            class="text-teal-600 hover:text-teal-900 bg-teal-50 hover:bg-teal-100 px-3 py-1 rounded transition-colors">Edit</a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-pink-600 hover:text-pink-900 bg-pink-50 hover:bg-pink-100 px-3 py-1 rounded transition-colors">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="mt-2 text-base font-medium text-gray-900">Tidak ada buku ditemukan</p>
                                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter pencarian Anda atau tambahkan buku
                                        baru.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('books.create') }}"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Tambah Buku Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($books->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection