@extends('layouts.app')

@section('title', 'Pinjam Buku - Perpustakaan Digital')
@section('page-title', 'Pinjam Buku')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Pinjam Buku</h1>
                <p class="text-gray-600 dark:text-gray-400">Catat peminjaman buku baru untuk anggota perpustakaan.</p>
            </div>

            <!-- Info Box -->
            <div class="bg-sky-50 dark:bg-sky-900/20 border-l-4 border-sky-500 p-5 mb-6 rounded-r-lg">
                <div class="flex items-start">
                    <svg class="h-6 w-6 text-sky-600 dark:text-sky-400 mr-3 mt-0.5 flex-shrink-0" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-bold text-sky-800 dark:text-sky-300 mb-1">Ketentuan Peminjaman</h3>
                        <p class="text-sm text-sky-700 dark:text-sky-200">
                            Maksimal peminjaman <strong>4 buku aktif</strong> per anggota. Denda keterlambatan sebesar
                            <strong>Rp2.000/hari</strong>. Pastikan buku dikembalikan tepat waktu.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('loans.store') }}" class="space-y-6">
                        @csrf

                        <!-- Anggota (Full Width) -->
                        <!-- Anggota (Full Width) -->
                        <div>
                            <label for="member_id"
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Anggota <span class="text-red-500">*</span>
                            </label>

                            <div x-data="{
                                    open: false,
                                    search: '',
                                    selectedId: '{{ old('member_id') }}',
                                    selectedName: '',
                                    options: {{ $members->map(function ($m) {
        return [
            'id' => $m->id,
            'name' => $m->name . ' (' . $m->nim_nis . ') • ' . $m->activeLoans()->count() . '/4 buku aktif',
            'disabled' => false
        ];
    })->values()->toJson() }},
                                    init() {
                                        if (this.selectedId) {
                                            const found = this.options.find(o => o.id == this.selectedId);
                                            if (found) this.selectedName = found.name;
                                        }
                                    },
                                    get filteredOptions() {
                                        if (this.search === '') return this.options;
                                        return this.options.filter(option => 
                                            option.name.toLowerCase().includes(this.search.toLowerCase())
                                        );
                                    },
                                    select(option) {
                                        if(option.disabled) return;
                                        this.selectedId = option.id;
                                        this.selectedName = option.name;
                                        this.open = false;
                                        this.search = '';
                                    }
                                }" class="relative" @click.outside="open = false">

                                <!-- Hidden Input -->
                                <input type="hidden" name="member_id" :value="selectedId">

                                <!-- Trigger Button -->
                                <button type="button" @click="open = !open; $nextTick(() => $refs.searchInput.focus())"
                                    class="w-full px-4 py-3 text-left border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all flex justify-between items-center"
                                    :class="{'border-red-500': {{ $errors->has('member_id') ? 'true' : 'false' }}}">
                                    <span x-text="selectedName || '-- Pilih Anggota --'"
                                        :class="{'text-gray-500 dark:text-gray-400': !selectedName}"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': open}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition.opacity.duration.200ms
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl overflow-hidden">

                                    <!-- Search Input -->
                                    <div class="p-2 border-b border-gray-200 dark:border-gray-700">
                                        <input x-ref="searchInput" x-model="search" type="text"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white text-sm"
                                            placeholder="Cari anggota...">
                                    </div>

                                    <!-- Options -->
                                    <ul class="max-h-60 overflow-y-auto">
                                        <template x-for="option in filteredOptions" :key="option.id">
                                            <li @click="select(option)"
                                                class="px-4 py-2 text-gray-700 dark:text-gray-300 transition-colors" :class="{
                                                        'bg-sky-50 dark:bg-slate-700 font-medium text-sky-600 dark:text-sky-400': selectedId == option.id,
                                                        'opacity-50 cursor-not-allowed bg-gray-100 dark:bg-slate-800': option.disabled,
                                                        'cursor-pointer hover:bg-sky-50 dark:hover:bg-slate-700': !option.disabled
                                                    }">
                                                <span x-text="option.name"></span>
                                            </li>
                                        </template>
                                        <li x-show="filteredOptions.length === 0"
                                            class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                                            Tidak ada anggota ditemukan.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @error('member_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buku (Full Width) -->
                        <!-- Buku (Full Width) -->
                        <div>
                            <label for="book_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Buku <span class="text-red-500">*</span>
                            </label>

                            <div x-data="{
                                    open: false,
                                    search: '',
                                    selectedId: '{{ old('book_id') }}',
                                    selectedName: '',
                                    options: {{ $books->map(function ($b) {
        return [
            'id' => $b->id,
            'name' => $b->title . ' - ' . $b->author . ' (Stok: ' . $b->stock . ')' . ($b->stock == 0 ? ' - HABIS' : ''),
            'disabled' => $b->stock == 0
        ];
    })->values()->toJson() }},
                                    init() {
                                        if (this.selectedId) {
                                            const found = this.options.find(o => o.id == this.selectedId);
                                            if (found) this.selectedName = found.name;
                                        }
                                    },
                                    get filteredOptions() {
                                        if (this.search === '') return this.options;
                                        return this.options.filter(option => 
                                            option.name.toLowerCase().includes(this.search.toLowerCase())
                                        );
                                    },
                                    select(option) {
                                        if(option.disabled) return;
                                        this.selectedId = option.id;
                                        this.selectedName = option.name;
                                        this.open = false;
                                        this.search = '';
                                    }
                                }" class="relative" @click.outside="open = false">

                                <!-- Hidden Input -->
                                <input type="hidden" name="book_id" :value="selectedId">

                                <!-- Trigger Button -->
                                <button type="button" @click="open = !open; $nextTick(() => $refs.searchInput.focus())"
                                    class="w-full px-4 py-3 text-left border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all flex justify-between items-center"
                                    :class="{'border-red-500': {{ $errors->has('book_id') ? 'true' : 'false' }}}">
                                    <span x-text="selectedName || '-- Pilih Buku --'"
                                        :class="{'text-gray-500 dark:text-gray-400': !selectedName}"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                        :class="{'transform rotate-180': open}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition.opacity.duration.200ms
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-slate-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl overflow-hidden">

                                    <!-- Search Input -->
                                    <div class="p-2 border-b border-gray-200 dark:border-gray-700">
                                        <input x-ref="searchInput" x-model="search" type="text"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500 bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-white text-sm"
                                            placeholder="Cari buku...">
                                    </div>

                                    <!-- Options -->
                                    <ul class="max-h-60 overflow-y-auto">
                                        <template x-for="option in filteredOptions" :key="option.id">
                                            <li @click="select(option)"
                                                class="px-4 py-2 text-gray-700 dark:text-gray-300 transition-colors" :class="{
                                                        'bg-sky-50 dark:bg-slate-700 font-medium text-sky-600 dark:text-sky-400': selectedId == option.id,
                                                        'opacity-50 cursor-not-allowed bg-gray-100 dark:bg-slate-800': option.disabled,
                                                        'cursor-pointer hover:bg-sky-50 dark:hover:bg-slate-700': !option.disabled
                                                    }">
                                                <span x-text="option.name"></span>
                                            </li>
                                        </template>
                                        <li x-show="filteredOptions.length === 0"
                                            class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                                            Tidak ada buku ditemukan.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @error('book_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dates (2 Columns) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="loan_date"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Pinjam <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="loan_date" id="loan_date"
                                    value="{{ old('loan_date', date('Y-m-d')) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all">
                                @error('loan_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="due_date"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Jatuh Tempo <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="due_date" id="due_date"
                                    value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                                    class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white dark:bg-slate-700 text-gray-900 dark:text-white transition-all">
                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div
                            class="flex flex-col-reverse sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('loans.index') }}"
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
                                Simpan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection