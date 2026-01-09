@extends('layouts.pdf')

@section('title', 'Laporan Keterlambatan')

@section('content')
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-2">Laporan Keterlambatan Pengembalian</h2>
        <p class="text-slate-600">Status per: <span class="font-semibold text-slate-900">{{ now()->format('d F Y') }}</span>
        </p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-slate-50 p-4 rounded border border-slate-200">
            <p class="text-sm text-slate-500 uppercase font-semibold text-xs tracking-wider">Total Terlambat</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ $overdueLoans->count() }}</p>
        </div>
        <div class="bg-slate-50 p-4 rounded border border-slate-200">
            <p class="text-sm text-slate-500 uppercase font-semibold text-xs tracking-wider">Total Estimasi Denda</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                Rp{{ number_format($overdueLoans->sum(function ($loan) {
        return $loan->getDaysOverdue() * 2000; }), 0, ',', '.') }}
            </p>
        </div>
        <div class="bg-slate-50 p-4 rounded border border-slate-200">
            <p class="text-sm text-slate-500 uppercase font-semibold text-xs tracking-wider">Rata-rata Terlambat</p>
            <p class="text-2xl font-bold text-slate-900 mt-1">
                {{ $overdueLoans->count() > 0 ? round($overdueLoans->avg(function ($loan) {
        return $loan->getDaysOverdue(); })) : 0 }}
                hari
            </p>
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
                <th class="py-2 font-bold text-slate-900 uppercase text-xs">Terlambat</th>
                <th class="py-2 font-bold text-slate-900 uppercase text-xs text-right">Denda</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($overdueLoans as $index => $loan)
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
                    <td class="py-3 text-red-600 font-medium">
                        {{ $loan->due_date->format('d M Y') }}
                    </td>
                    <td class="py-3">
                        <span class="bg-red-50 text-red-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $loan->getDaysOverdue() }} hari
                        </span>
                    </td>
                    <td class="py-3 text-right font-bold text-slate-900">
                        Rp{{ number_format($loan->getDaysOverdue() * 2000, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-slate-500 italic">
                        Tidak ada peminjaman yang terlambat hari ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection