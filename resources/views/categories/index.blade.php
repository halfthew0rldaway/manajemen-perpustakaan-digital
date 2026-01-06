@extends('layouts.app')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Kategori Buku</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Kelola kategori untuk pengelompokan buku</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                style="border-bottom: 4px solid #0284c7;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        <!-- Categories Table -->
        <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Kategori</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Buku</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('books.index', ['category_id' => $category->id]) }}"
                                        class="group block cursor-pointer">
                                        <div
                                            class="text-sm font-medium text-gray-900 group-hover:text-sky-600 transition-colors">
                                            {{ $category->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $category->slug }}</div>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 truncate max-w-xs">{{ $category->description ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('books.index', ['category_id' => $category->id]) }}"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-100 text-sky-800 hover:bg-sky-200 transition-colors cursor-pointer">
                                        {{ $category->books_count }} Buku
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-teal-600 hover:text-teal-900">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-pink-600 hover:text-pink-900 ml-2">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada kategori. Silakan tambahkan kategori baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection