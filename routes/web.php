<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;

// Root route - redirect based on auth status
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reports
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/reports/daily/export', [ReportController::class, 'exportDaily'])->name('reports.daily.export');
    Route::get('/reports/daily/pdf', [ReportController::class, 'dailyPdf'])->name('reports.daily.pdf');

    Route::get('/reports/overdue', [ReportController::class, 'overdue'])->name('reports.overdue');
    Route::get('/reports/overdue/export', [ReportController::class, 'exportOverdue'])->name('reports.overdue.export');
    Route::get('/reports/overdue/pdf', [ReportController::class, 'overduePdf'])->name('reports.overdue.pdf');

    // Categories
    Route::resource('categories', CategoryController::class);

    // Books
    Route::resource('books', BookController::class);

    // Members (admin & petugas can view/create, admin can delete/toggle)
    Route::resource('members', MemberController::class);
    Route::post('/members/{member}/toggle-status', [MemberController::class, 'toggleStatus'])
        ->name('members.toggle-status')
        ->middleware('admin');

    // Loans
    Route::resource('loans', LoanController::class);
    Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');

    // User Management (admin only)
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
        Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });
});