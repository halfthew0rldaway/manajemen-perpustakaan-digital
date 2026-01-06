<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Daily Report
     */
    public function daily(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book'])
            ->whereDate('loan_date', $date)
            ->latest()
            ->paginate(10); // Added pagination

        $totalLoans = Loan::whereDate('loan_date', $date)->count();
        $totalFines = Loan::whereDate('return_date', $date)
            ->sum('fine_amount');

        return view('reports.daily', compact('loans', 'date', 'totalLoans', 'totalFines'));
    }

    /**
     * Overdue Report
     */
    public function overdue()
    {
        $overdueLoans = Loan::with(['user', 'book'])
            ->where('status', 'active')
            ->where('due_date', '<', now())
            ->latest()
            ->paginate(10); // Added pagination

        return view('reports.overdue', compact('overdueLoans'));
    }

    /**
     * Export Daily Report to CSV
     */
    public function exportDaily(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $loans = Loan::with(['user', 'book'])
            ->whereDate('loan_date', $date)
            ->get();

        return $this->streamCsv('laporan-harian-' . $date . '.csv', ['ID', 'Peminjam', 'Buku', 'Tanggal Pinjam', 'Tenggat', 'Status'], function ($handle) use ($loans) {
            foreach ($loans as $loan) {
                fputcsv($handle, [
                    $loan->id,
                    $loan->user->name,
                    $loan->book->title,
                    $loan->loan_date,
                    $loan->due_date,
                    ucfirst($loan->status)
                ]);
            }
        });
    }

    /**
     * Export Overdue Report to CSV
     */
    public function exportOverdue()
    {
        $loans = Loan::with(['user', 'book'])
            ->where('status', 'active')
            ->where('due_date', '<', now())
            ->get();

        return $this->streamCsv('laporan-keterlambatan-' . date('Y-m-d') . '.csv', ['ID', 'Peminjam', 'Buku', 'Tanggal Pinjam', 'Tenggat', 'Hari Terlambat', 'Denda Estimasi'], function ($handle) use ($loans) {
            foreach ($loans as $loan) {
                $daysOverdue = now()->diffInDays($loan->due_date);
                $fine = $daysOverdue * 2000; // Denda 2000/hari sesuai ketentuan

                fputcsv($handle, [
                    $loan->id,
                    $loan->user->name,
                    $loan->book->title,
                    $loan->loan_date,
                    $loan->due_date,
                    $daysOverdue . ' hari',
                    'Rp ' . number_format($fine, 0, ',', '.')
                ]);
            }
        });
    }

    /**
     * Helper to stream CSV
     */
    private function streamCsv($filename, $csvHeaders, $callback)
    {
        $httpHeaders = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($csvHeaders, $callback) {
            $handle = fopen('php://output', 'w');

            // Add BOM for Excel compatibility with UTF-8
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Write CSV Column Headers
            fputcsv($handle, $csvHeaders);

            // Execute callback to write rows
            $callback($handle);

            fclose($handle);
        }, 200, $httpHeaders);
    }
}
