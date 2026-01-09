@extends('layouts.app')

@section('title', 'Daftar Anggota')
@section('page-title', 'Data Anggota')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
            <div>
                <h1 class="heading" style="font-size: 1.875rem;">Daftar Anggota</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Kelola data anggota perpustakaan</p>
            </div>
            <a href="{{ route('members.create') }}" class="btn-primary w-full sm:w-auto inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Anggota
            </a>
        </div>

        <!-- Search & Filter -->
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('members.index') }}" class="space-y-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2 sm:py-3 border-2 rounded-lg leading-5 placeholder-gray-500 focus:outline-none focus:border-sky-400 focus:ring-1 focus:ring-sky-400 sm:text-sm transition duration-150 ease-in-out"
                            style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                            placeholder="Cari berdasarkan nama, nomor anggota, atau profesi/institusi...">
                    </div>

                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <!-- Status Select -->
                        <div>
                            <label class="block text-xs font-medium mb-1" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Status</label>
                            <select name="status" class="block w-full pl-3 pr-10 py-2 text-base focus:outline-none focus:ring-sky-500 focus:border-sky-500 sm:text-sm rounded-md shadow-sm"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-end gap-3">
                            @if(request()->anyFilled(['search', 'status']))
                                <a href="{{ route('members.index') }}" class="btn-secondary flex-1 inline-flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Reset
                                </a>
                            @endif
                            <button type="submit" class="btn-primary flex-1 inline-flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Members Table -->
        <div class="card overflow-hidden">
            <div class="overflow-x-auto -mx-4 sm:mx-0">
                <table class="min-w-full divide-y" style="border-color: var(--border-color);">
                    <thead style="background-color: var(--bg-secondary);">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Anggota</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">No. Anggota</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Profesi/Institusi</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y" style="background-color: var(--bg-primary); border-color: var(--border-color);">
                        @forelse($members as $member)
                            <tr class="hover:bg-opacity-50 transition-colors" style="hover:background-color: var(--bg-secondary);">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-indigo-500 dark:bg-indigo-600">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->name }}</div>
                                            <div class="text-xs" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">{{ $member->phone ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->member_id_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">{{ $member->occupation_institution }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($member->status === 'active')
                                        <span class="badge bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">Aktif</span>
                                    @else
                                        <span class="badge bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-400">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('members.show', $member) }}" class="btn-primary btn-sm inline-flex items-center justify-center" style="width: 105px;">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('members.edit', $member) }}" class="btn-secondary btn-sm inline-flex items-center justify-center" style="width: 105px;">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        @if(auth()->user()->isAdmin())
                                            <form action="{{ route('members.toggle-status', $member) }}" method="POST" class="inline-block">
                                                @csrf
                                            <button type="submit" class="btn-sm {{ $member->status === 'active' ? 'btn-danger' : 'btn-primary' }} inline-flex items-center justify-center" style="width: 105px;">
                                                @if($member->status === 'active')
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @endif
                                                {{ $member->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center" style="color: var(--text-secondary);">
                                    <svg class="mx-auto h-12 w-12" style="color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="mt-2 text-base font-medium" style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Tidak ada anggota ditemukan</p>
                                    <p class="mt-1 text-sm" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Coba ubah filter pencarian atau tambahkan anggota baru.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('members.create') }}" class="btn-primary inline-flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Anggota Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($members->hasPages())
                <div class="px-6 py-4 border-t" style="background-color: var(--bg-secondary); border-color: var(--border-color);">
                    {{ $members->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
