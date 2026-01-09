@extends('layouts.app')

@section('title', 'Edit Petugas')
@section('page-title', 'Edit Petugas')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="heading" style="font-size: 1.875rem;">Edit Data Petugas</h1>
                <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Perbarui informasi akun petugas.
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Nama Lengkap <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                value="{{ old('name', $user->name) }}" required>
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
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="p-4 rounded-lg"
                            style="background-color: var(--bg-secondary); border: 1px solid var(--border-color);">
                            <p class="text-sm font-medium mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">Ubah Password
                                (Opsional)</p>
                            <p class="text-xs mb-4" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">
                                Kosongkan jika tidak ingin mengubah password</p>

                            <div class="space-y-4">
                                <div>
                                    <label for="password" class="block text-sm font-semibold mb-2"
                                        style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                        Password Baru
                                    </label>
                                    <input type="password" name="password" id="password"
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                        style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);">
                                    @error('password')
                                        <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold mb-2"
                                        style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                        Konfirmasi Password Baru
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                        style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t"
                            style="border-color: var(--border-color);">
                            <a href="{{ route('users.index') }}"
                                class="btn-secondary w-full sm:w-auto text-center">Batal</a>
                            <button type="submit" class="btn-primary w-full sm:w-auto">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection