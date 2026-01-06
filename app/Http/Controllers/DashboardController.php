<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalBooks = \App\Models\Book::count();
        $totalUsers = \App\Models\User::count();
        $activeLoans = \App\Models\Loan::where('status', 'active')->count();
        $overdueLoans = \App\Models\Loan::where('status', 'active')
            ->where('due_date', '<', now())
            ->count();

        // Recent loans
        $recentLoans = \App\Models\Loan::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Books with low stock
        $lowStockBooks = \App\Models\Book::where('stock', '<=', 2)
            ->where('stock', '>', 0)
            ->get();

        // Out of stock books
        $outOfStockBooks = \App\Models\Book::where('stock', 0)->count();

        return view('dashboard', compact(
            'totalBooks',
            'totalUsers',
            'activeLoans',
            'overdueLoans',
            'recentLoans',
            'lowStockBooks',
            'outOfStockBooks'
        ));
    }

    /**
     * Daily loan report
     */
    public function dailyReport(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));

        $loans = \App\Models\Loan::with(['user', 'book'])
            ->whereDate('loan_date', $date)
            ->get();

        $totalLoans = $loans->count();
        $totalFines = \App\Models\Loan::whereDate('return_date', $date)
            ->sum('fine_amount');

        return view('reports.daily', compact('loans', 'date', 'totalLoans', 'totalFines'));
    }

    /**
     * Overdue loans report
     */
    public function overdueReport()
    {
        $overdueLoans = \App\Models\Loan::with(['user', 'book'])
            ->where('status', 'active')
            ->where('due_date', '<', now())
            ->get();

        return view('reports.overdue', compact('overdueLoans'));
    }
}
