<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Loan::with(['user', 'book']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by user
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $loans = $query->latest()->paginate(15);
        $users = \App\Models\User::all();

        return view('loans.index', compact('loans', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = \App\Models\Book::where('stock', '>', 0)->get();
        $users = \App\Models\User::all();

        return view('loans.create', compact('books', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
        ]);

        $user = \App\Models\User::findOrFail($validated['user_id']);
        $book = \App\Models\Book::findOrFail($validated['book_id']);

        // Check if user can borrow more books (max 4)
        if (!$user->canBorrowMore()) {
            return redirect()->back()
                ->with('error', 'User sudah mencapai batas maksimal peminjaman (4 buku aktif)!')
                ->withInput();
        }

        // Check if book is available
        if (!$book->isAvailable()) {
            return redirect()->back()
                ->with('error', 'Buku tidak tersedia!')
                ->withInput();
        }

        // Use transaction for data integrity
        \DB::transaction(function () use ($validated, $book) {
            // Create loan
            \App\Models\Loan::create([
                'user_id' => $validated['user_id'],
                'book_id' => $validated['book_id'],
                'loan_date' => $validated['loan_date'],
                'due_date' => $validated['due_date'],
                'status' => 'active',
            ]);

            // Decrease book stock
            $book->decrement('stock');
        });

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Loan $loan)
    {
        $loan->load(['user', 'book']);
        return view('loans.show', compact('loan'));
    }

    /**
     * Process book return
     */
    public function return(\App\Models\Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->back()
                ->with('error', 'Buku sudah dikembalikan!');
        }

        $returnDate = now();

        // Use transaction for data integrity
        \DB::transaction(function () use ($loan, $returnDate) {
            // Calculate fine if late
            $loan->return_date = $returnDate;
            $fine = $loan->calculateFine();

            $loan->fine_amount = $fine;
            $loan->status = 'returned';
            $loan->save();

            // Increase book stock
            $loan->book->increment('stock');
        });

        $message = 'Buku berhasil dikembalikan!';
        if ($loan->fine_amount > 0) {
            $message .= ' Denda keterlambatan: Rp' . number_format((float) $loan->fine_amount, 0, ',', '.');
        }

        return redirect()->route('loans.index')
            ->with('success', $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat mengedit peminjaman yang sudah dikembalikan!');
        }

        $books = \App\Models\Book::all();
        $users = \App\Models\User::all();

        return view('loans.edit', compact('loan', 'books', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat mengedit peminjaman yang sudah dikembalikan!');
        }

        $validated = $request->validate([
            'due_date' => 'required|date|after:loan_date',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Loan $loan)
    {
        if ($loan->status === 'active') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat menghapus peminjaman yang masih aktif!');
        }

        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
