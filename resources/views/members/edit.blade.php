@extends('layouts.app')

@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="heading" style="font-size: 1.875rem;">Edit Data Anggota</h1>
                <p style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Perbarui informasi anggota
                    perpustakaan.</p>
            </div>

            <!-- Form Card -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('members.update', $member) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap (Full Width) -->
                        <div>
                            <label for="name" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Nama Lengkap <span style="color: var(--destructive);">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                value="{{ old('name', $member->name) }}" required>
                            @error('name')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Row: No. Anggota & Profesi/Institusi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="member_id_number" class="block text-sm font-semibold mb-2"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    Nomor Anggota <span style="color: var(--destructive);">*</span>
                                </label>
                                <input type="text" name="member_id_number" id="member_id_number"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                    style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                    value="{{ old('member_id_number', $member->member_id_number) }}" required>
                                @error('member_id_number')
                                    <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="occupation_institution" class="block text-sm font-semibold mb-2"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    Profesi/Institusi <span style="color: var(--destructive);">*</span>
                                </label>
                                <input type="text" name="occupation_institution" id="occupation_institution"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                    style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                    value="{{ old('occupation_institution', $member->occupation_institution) }}" required>
                                @error('occupation_institution')
                                    <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Row: Telepon & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-semibold mb-2"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    Nomor Telepon
                                </label>
                                <input type="text" name="phone" id="phone"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                    style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                    value="{{ old('phone', $member->phone) }}">
                                @error('phone')
                                    <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold mb-2"
                                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                    Email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all"
                                    style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);"
                                    value="{{ old('email', $member->email) }}">
                                @error('email')
                                    <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Alamat (Full Width) -->
                        <div>
                            <label for="address" class="block text-sm font-semibold mb-2"
                                style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                                Alamat
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all resize-none"
                                style="border-color: var(--border-color); background-color: var(--bg-primary); color: var(--text-primary);">{{ old('address', $member->address) }}</textarea>
                            @error('address')
                                <p class="mt-2 text-sm" style="color: var(--destructive);">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t"
                            style="border-color: var(--border-color);">
                            <a href="{{ route('members.index') }}"
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
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection