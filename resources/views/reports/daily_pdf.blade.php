@extends('layouts.pdf')

@section('title', 'Laporan Harian')

@section('content')
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-2">Laporan Peminjaman Harian</h2>
        <p class="text-slate-600">Tanggal: <span
                class="font-semibold text-slate-900">{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</span></p>
    </div>

    <!-- Summary Cards (Simplified for Print) -->
    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="bg-slate-50 p-4 rounded border border-slate-200">
            <p class="text-sm text-slate-500 uppercase font-semibold text-xs tracking-wider">Total Peminjaman</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">{{ $totalLoans }}</p>
        </div>
        <div class="bg-slate-50 p-4 rounded border border-slate-200">
            <p class="text-sm text-slate-500 uppercase font-semibold text-xs tracking-wider">Total Denda</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">Rp{{ number_format($totalFines, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Table -->
    <table class="w-full text-sm text-left border-collapse">
        <thead>
            <tr class="border-b-2 border-slate-800">
                <th class="py-2 font-bold text-slate-900 uppercase text-xs">No</th>
                <th class="py-2 font-bold text-slate-900 uppercase text-xs">Peminjam</th>
                <th class="py-2 font-bold text-slate-900 uppercase text-xs">Buku</th>
                <th class="py-2 font-bold text-slate-900 uppercase text-xs">Jatuh Tempo</th>
                <th class="py-2 font-bold text-slate-900 uppercase text-xs text-right">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($loans as $index => $loan)
                <tr>
                    <td class="py-3 text-slate-500">{{ $index + 1 }}</td>
                    <td class="py-3">
                        <div class="font-semibold text-slate-900">{{ $loan->member->name }}</div>
                        <div class="text-xs text-slate-500">{{ $loan->member->phone }}</div>
                    </td>
                    <td class="py-3">
                        <div class="font-medium text-slate-900">{{ $loan->book->title }}</div>
                        <div class="text-xs text-slate-500">{{ $loan->book->author }}</div>
                    </td>
                    <td class="py-3 text-slate-600">
                        {{ $loan->due_date->format('d M Y') }}
                    </td>
                    <td class="py-3 text-right">
                        <span
                            class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider {{ $loan->status === 'active' ? 'bg-teal-100 text-teal-800' : 'bg-slate-100 text-slate-800' }}">
                            {{ $loan->status === 'active' ? 'Aktif' : 'Dikembalikan' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-slate-500 italic">
                        Tidak ada data peminjaman untuk tanggal ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection