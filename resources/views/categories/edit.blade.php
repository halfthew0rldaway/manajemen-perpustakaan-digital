@extends('layouts.app')

@section('content')
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Kategori</h1>
                <p class="mt-1 sm:mt-2 text-sm sm:text-base text-gray-600">Perbarui informasi kategori</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white sm:rounded-xl shadow-sm border-0 sm:border border-gray-100 p-6 sm:p-8">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all"
                            value="{{ old('name', $category->name) }}">
                        @error('name')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                            (Opsional)</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 sm:py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-400 focus:border-sky-400 transition-all">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-pink-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-sky-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                            style="border-bottom: 4px solid #0284c7;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Kategori
                        </button>

                        <a href="{{ route('categories.index') }}"
                            class="w-full sm:w-auto bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-bold hover:bg-gray-300 transition-all shadow-md hover:shadow-lg border-2 border-gray-300 hover:border-gray-400 transform hover:-translate-y-0.5 inline-flex items-center justify-center"
                            style="border-bottom: 3px solid #9ca3af;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection