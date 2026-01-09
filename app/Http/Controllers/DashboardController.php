<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Base query for loans (filtered by petugas for non-admin)
        $loansQuery = Loan::query();
        if ($user->isPetugas()) {
            $loansQuery->where('petugas_id', $user->id);
        }

        // Statistics
        $totalBooks = Book::count();
        $totalMembers = Member::where('status', 'active')->count();
        $activeLoans = (clone $loansQuery)->where('status', 'active')->count();
        $overdueLoans = (clone $loansQuery)
            ->where('status', 'active')
            ->where('due_date', '<', now())
            ->count();

        // Recent loans (filtered by role)
        $recentLoans = (clone $loansQuery)
            ->with(['member', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Books with low stock
        $lowStockBooks = Book::where('stock', '<=', 2)
            ->where('stock', '>', 0)
            ->get();

        // Out of stock books
        $outOfStockBooks = Book::where('stock', 0)->count();

        // CHART DATA 1: Loans Last 7 Days (filtered by role)
        $loanChartData = [];
        $loanChartLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $query = Loan::whereDate('loan_date', $date->format('Y-m-d'));
            if ($user->isPetugas()) {
                $query->where('petugas_id', $user->id);
            }
            $count = $query->count();
            $loanChartLabels[] = $date->format('D, d M'); // Mon, 01 Jan
            $loanChartData[] = $count;
        }

        // CHART DATA 2: Books per Category
        $categoryChartLabels = [];
        $categoryChartData = [];
        $categories = Category::withCount('books')->orderBy('books_count', 'desc')->take(5)->get();
        foreach ($categories as $cat) {
            $categoryChartLabels[] = $cat->name;
            $categoryChartData[] = $cat->books_count;
        }

        // NEW: Active Members with Borrowed Books (filtered by role)
        $activeMembersWithLoans = Member::whereHas('activeLoans', function ($query) use ($user) {
            if ($user->isPetugas()) {
                $query->where('petugas_id', $user->id);
            }
        })
            ->with([
                'activeLoans' => function ($query) use ($user) {
                    $query->with('book');
                    if ($user->isPetugas()) {
                        $query->where('petugas_id', $user->id);
                    }
                }
            ])
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'activeLoans',
            'overdueLoans',
            'recentLoans',
            'lowStockBooks',
            'outOfStockBooks',
            'loanChartLabels',
            'loanChartData',
            'categoryChartLabels',
            'categoryChartData',
            'activeMembersWithLoans'
        ));
    }
}
