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

        // CHART DATA 1: Loans Last 7 Days
        $loanChartData = [];
        $loanChartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = \App\Models\Loan::whereDate('loan_date', $date->format('Y-m-d'))->count();
            $loanChartLabels[] = $date->format('D, d M'); // Mon, 01 Jan
            $loanChartData[] = $count;
        }

        // CHART DATA 2: Books per Category
        $categoryChartLabels = [];
        $categoryChartData = [];
        $categories = \App\Models\Category::withCount('books')->orderBy('books_count', 'desc')->take(5)->get();
        foreach ($categories as $cat) {
            $categoryChartLabels[] = $cat->name;
            $categoryChartData[] = $cat->books_count;
        }

        return view('dashboard', compact(
            'totalBooks',
            'totalUsers',
            'activeLoans',
            'overdueLoans',
            'recentLoans',
            'lowStockBooks',
            'outOfStockBooks',
            'loanChartLabels',
            'loanChartData',
            'categoryChartLabels',
            'categoryChartData'
        ));
    }

}
