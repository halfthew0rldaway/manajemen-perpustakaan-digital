@extends('layouts.app')

@section('title', 'Daftar Buku - Perpustakaan Digital')
@section('page-title', 'Daftar Buku')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Daftar Buku</h1>
                <p class="text-gray-600">Kelola koleksi buku perpustakaan</p>
            </div>
            <a href="{{ route('books.create') }}" class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center" style="border-bottom: 4px solid #0284c7;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Buku
            </a>
        </div>

        <!-- Search Card -->
        <div class="bg-white rounded-lg shadow-md border-2 border-gray-100 p-6">
            <form method="GET" action="{{ route('books.index') }}" class="flex gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan judul, penulis, ISBN, atau kategori..."
                        class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all">
                </div>
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </span>
                </button>
                @if(request('search'))
                    <a href="{{ route('books.index') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reset
                        </span>
                    </a>
                @endif
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg shadow-md border-2 border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b-2 border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">
                    @if(request('search'))
                        Hasil Pencarian: "{{ request('search') }}"
                    @else
                        Semua Buku ({{ $books->total() }})
                    @endif
                </h2>
            </div>

            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Buku</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                                Penulis</th>
                            <th
                                class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">
                                Kategori</th>
                            <th
                                class="px-4 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">
                                ISBN</th>
                            <th class="px-4 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Stok</th>
                            <th class="px-4 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">{{ $book->title }}</p>
                                        @if($book->publisher)
                                            <p class="text-xs text-gray-500">{{ $book->publisher }}</p>
                                        @endif
                                        <!-- Show author on mobile -->
                                        <p class="text-xs text-gray-600 md:hidden mt-1">{{ $book->author }}</p>
                                        <!-- Show category on mobile/tablet -->
                                        @if($book->category)
                                            <div class="mt-1 lg:hidden">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-sky-100 text-sky-700">
                                                    {{ $book->category }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <p class="text-sm font-medium text-gray-900">{{ $book->author }}</p>
                                </td>
                                <td class="px-4 py-4 hidden lg:table-cell text-center">
                                    @if($book->category)
                                        <span
                                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-700 whitespace-nowrap min-w-[80px] text-center">
                                            {{ $book->category }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 hidden xl:table-cell">
                                    <p class="text-xs text-gray-600 font-mono">{{ $book->isbn ?? '-' }}</p>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span
                                        class="inline-block px-2.5 py-1 rounded-full text-xs font-bold whitespace-nowrap
                                                                {{ $book->stock == 0 ? 'bg-pink-100 text-pink-700' : ($book->stock <= 2 ? 'bg-amber-100 text-amber-700' : 'bg-teal-100 text-teal-700') }}">
                                        {{ $book->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('books.show', $book) }}"
                                            class="inline-flex items-center px-3 py-2 bg-sky-500 text-white text-sm font-bold rounded-lg hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                            style="border-bottom: 3px solid #0284c7;">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('books.edit', $book) }}"
                                            class="inline-flex items-center px-3 py-2 bg-teal-500 text-white text-sm font-bold rounded-lg hover:bg-teal-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                            style="border-bottom: 3px solid #0d9488;">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 bg-pink-500 text-white text-sm font-bold rounded-lg hover:bg-pink-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                                style="border-bottom: 3px solid #db2777;">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                        @if(request('search'))
                                            <p class="text-gray-600 font-medium mb-2">Tidak ada buku yang ditemukan</p>
                                            <p class="text-gray-500 text-sm">dengan kata kunci "{{ request('search') }}"</p>
                                        @else
                                            <p class="text-gray-600 font-medium mb-4">Belum ada buku</p>
                                            <a href="{{ route('books.create') }}" class="btn-primary btn-sm">
                                                Tambah Buku Pertama
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="px-6 py-4 border-t-2 border-gray-100 bg-gray-50">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection