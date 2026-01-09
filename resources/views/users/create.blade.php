@extends('layouts.app')

@section('title', 'Tambah Petugas')
@section('page-title', 'Tambah Petugas')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="heading" style="font-size: 1.875rem;">Tambah Petugas Baru</h1>
                <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Buat akun petugas perpustakaan
                    baru.</p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Nama Lengkap <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Email <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="email" name="email" id="email"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Password <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                required>
                            @error('password')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Konfirmasi Password <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                required>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t"
                            style="border-color: var(--border-color);">
                            <a href="{{ route('users.index') }}"
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
                                Simpan Petugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection