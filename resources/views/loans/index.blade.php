@extends('layouts.app')

@section('title', 'Daftar Peminjaman - Perpustakaan Digital')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Daftar Peminjaman</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Kelola peminjaman buku perpustakaan</p>
            </div>
            <a href="{{ route('loans.create') }}"
                class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                style="border-bottom: 4px solid #0284c7;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Pinjam Buku
            </a>
        </div>

        <!-- Filters -->
        <div class="mb-6 bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 p-4">
            <form method="GET" action="{{ route('loans.index') }}" class="flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:gap-4">
                <div class="flex-1 min-w-[200px]">
                    <select name="status"
                        class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Dikembalikan
                        </option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <select name="user_id"
                        class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400">
                        <option value="">Semua Pengguna</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-900 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                    style="border-bottom: 3px solid #1f2937;">
                    <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Filter
                </button>
                @if(request('status') || request('user_id'))
                    <a href="{{ route('loans.index') }}"
                        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-300 transition-all shadow-md hover:shadow-lg border-2 border-gray-300 hover:border-gray-400 transform hover:-translate-y-0.5"
                        style="border-bottom: 3px solid #9ca3af;">
                        <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Loans Table -->
        <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl
                                Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh
                                Tempo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $loan->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $loan->user->email }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900">{{ $loan->book->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $loan->book->author }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $loan->loan_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="{{ $loan->isOverdue() ? 'text-pink-600 font-medium' : 'text-gray-900' }}">
                                        {{ $loan->due_date->format('d M Y') }}
                                    </span>
                                    @if($loan->isOverdue())
                                        <p class="text-xs text-pink-600">Terlambat {{ $loan->getDaysOverdue() }} hari</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($loan->status === 'active')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($loan->fine_amount > 0)
                                        <span
                                            class="text-pink-600 font-medium">Rp{{ number_format($loan->fine_amount, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                                    @if($loan->status === 'active')
                                        <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Proses pengembalian buku ini?')">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-teal-500 text-white text-sm font-bold rounded-lg hover:bg-teal-600 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                                style="border-bottom: 2px solid #0d9488;">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Kembalikan
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('loans.show', $loan) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-sky-500 text-white text-sm font-bold rounded-lg hover:bg-sky-600 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                                        style="border-bottom: 2px solid #0284c7;">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada data peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($loans->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $loans->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection