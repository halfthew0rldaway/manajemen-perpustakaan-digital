@extends('layouts.app')

@section('title', 'Manajemen Petugas')
@section('page-title', 'Manajemen Petugas')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="heading" style="font-size: 1.875rem;">Manajemen Petugas</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Kelola akun petugas perpustakaan</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn-primary w-full sm:w-auto inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Petugas
            </a>
        </div>

        <!-- Users Table -->
        <div class="card overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y" style="border-color: var(--border-color);">
                    <thead style="background-color: var(--bg-secondary);">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Petugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Email</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Transaksi</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="background-color: var(--bg-primary); border-color: var(--border-color);">
                        @forelse($users as $user)
                            <tr class="hover:bg-opacity-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-indigo-500 dark:bg-indigo-600">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $user->name }}</div>
                                            <div class="text-xs" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Petugas</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($user->is_active)
                                        <span class="badge bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">Aktif</span>
                                    @else
                                        <span class="badge bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $user->loansProcessed->count() }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('users.edit', $user) }}" class="btn-secondary btn-sm" style="width: 105px; text-align: center;">Edit</a>
                                        <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-primary' }}" style="width: 105px; text-align: center;">
                                                {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center" style="color: var(--text-secondary);">
                                    <svg class="mx-auto h-12 w-12" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="mt-2 text-base font-medium" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Tidak ada petugas</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($users->hasPages())
                <div class="px-6 py-4 border-t" style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
