@extends('layouts.app')

@section('title', $book->title . ' - Perpustakaan Digital')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $book->title }}</h1>
                    <p class="mt-2 text-lg text-gray-600">oleh {{ $book->author }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('books.edit', $book) }}"
                        class="inline-flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        style="border-bottom: 3px solid #0284c7;">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('books.index') }}"
                        class="inline-flex items-center px-4 py-2 border-2 border-gray-400 text-gray-700 rounded-lg font-bold hover:bg-gray-50 hover:border-gray-500 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                        style="border-bottom: 3px solid #9ca3af;">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Book Details Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Informasi Buku</h2>

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $book->author }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $book->publisher ?? '-' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                            <dd class="mt-1 text-base text-gray-900">{{ $book->publication_year ?? '-' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                            <dd class="mt-1 text-base text-gray-900 font-mono">{{ $book->isbn ?? '-' }}</dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                            <dd class="mt-1">
                                @if($book->category)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-sky-100 text-sky-700">
                                        {{ $book->category }}
                                    </span>
                                @else
                                    <span class="text-gray-900">-</span>
                                @endif
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Stok Tersedia</dt>
                            <dd class="mt-1">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            {{ $book->stock == 0 ? 'bg-pink-100 text-pink-700' : ($book->stock <= 2 ? 'bg-amber-100 text-amber-700' : 'bg-teal-100 text-teal-700') }}">
                                    {{ $book->stock }} buku
                                </span>
                            </dd>
                        </div>
                    </dl>

                    @if($book->description)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <dt class="text-sm font-medium text-gray-500 mb-2">Deskripsi</dt>
                            <dd class="text-base text-gray-900 leading-relaxed">{{ $book->description }}</dd>
                        </div>
                    @endif
                </div>

                <!-- Recent Loans -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Riwayat Peminjaman</h2>

                    @if($book->loans->count() > 0)
                        <div class="space-y-4">
                            @foreach($book->loans->take(10) as $loan)
                                <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $loan->user->name }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ $loan->loan_date->format('d M Y') }} -
                                            @if($loan->return_date)
                                                {{ $loan->return_date->format('d M Y') }}
                                            @else
                                                <span class="text-orange-600">Belum dikembalikan</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                    {{ $loan->status === 'active' ? 'bg-teal-100 text-teal-700' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $loan->status === 'active' ? 'Aktif' : 'Dikembalikan' }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Belum ada riwayat peminjaman</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar Stats -->
            <div class="space-y-6">
                <!-- Stock Status -->
                <div class="bg-violet-400 rounded-xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Status Stok</h3>
                    <div class="text-center">
                        <p class="text-5xl font-bold mb-2">{{ $book->stock }}</p>
                        <p class="text-white/90">Buku Tersedia</p>
                    </div>

                    @if($book->activeLoans()->count() > 0)
                        <div class="mt-6 pt-6 border-t border-white/30">
                            <div class="flex items-center justify-between">
                                <span class="text-white/90">Sedang Dipinjam</span>
                                <span class="text-2xl font-bold">{{ $book->activeLoans()->count() }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Total Peminjaman</span>
                            <span class="text-xl font-bold text-gray-900">{{ $book->loans->count() }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Peminjaman Aktif</span>
                            <span class="text-xl font-bold text-teal-600">{{ $book->activeLoans()->count() }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Sudah Dikembalikan</span>
                            <span
                                class="text-xl font-bold text-gray-600">{{ $book->loans->where('status', 'returned')->count() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>

                    <div class="space-y-3">
                        @if($book->stock > 0)
                            <a href="{{ route('loans.create', ['book_id' => $book->id]) }}"
                                class="block w-full text-center px-4 py-3 bg-teal-500 text-white rounded-lg font-bold hover:bg-teal-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                style="border-bottom: 4px solid #0d9488;">
                                <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>Pinjam Buku Ini
                            </a>
                        @else
                            <div class="block w-full text-center px-4 py-3 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed font-bold shadow-md"
                                style="border-bottom: 4px solid #9ca3af;">
                                <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>Stok Habis
                            </div>
                        @endif

                        <form action="{{ route('books.destroy', $book) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="block w-full text-center px-4 py-3 bg-pink-500 text-white rounded-lg font-bold hover:bg-pink-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                style="border-bottom: 4px solid #db2777;">
                                <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>Hapus Buku
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection