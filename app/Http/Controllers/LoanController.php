<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Book;
use App\Models\User;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loan::with(['member', 'petugas', 'book']);

        // For petugas: only show their own loans
        if (auth()->user()->isPetugas()) {
            $query->where('petugas_id', auth()->id());
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by petugas (admin only)
        if ($request->has('petugas_id') && auth()->user()->isAdmin()) {
            $query->where('petugas_id', $request->petugas_id);
        }

        // Filter by member
        if ($request->has('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        $loans = $query->latest()->paginate(15);

        // For admin: show all petugas for filter
        $petugas = auth()->user()->isAdmin() ? User::where('role', 'petugas')->get() : collect();
        $members = Member::active()->get();

        return view('loans.index', compact('loans', 'petugas', 'members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::active()->get();

        return view('loans.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
        ]);

        $member = Member::findOrFail($validated['member_id']);
        $book = Book::findOrFail($validated['book_id']);

        // Check if member is active
        if ($member->status !== 'active') {
            return redirect()->back()
                ->with('error', 'Anggota tidak aktif!')
                ->withInput();
        }

        // Check if member can borrow more books (max 4)
        if (!$member->canBorrowMore()) {
            return redirect()->back()
                ->with('error', 'Anggota sudah mencapai batas maksimal peminjaman (4 buku aktif)!')
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
            // Create loan with petugas_id from authenticated user
            Loan::create([
                'member_id' => $validated['member_id'],
                'petugas_id' => auth()->id(), // Auto-set from logged in user
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
    public function show(Loan $loan)
    {
        $loan->load(['member', 'petugas', 'book']);

        // Petugas can only view their own loans
        if (auth()->user()->isPetugas() && $loan->petugas_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('loans.show', compact('loan'));
    }

    /**
     * Process book return
     */
    public function return(Loan $loan)
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
    public function edit(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat mengedit peminjaman yang sudah dikembalikan!');
        }

        // Petugas can only edit their own loans
        if (auth()->user()->isPetugas() && $loan->petugas_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $books = Book::all();
        $members = Member::active()->get();

        return view('loans.edit', compact('loan', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
        if ($loan->status === 'returned') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat mengedit peminjaman yang sudah dikembalikan!');
        }

        // Petugas can only edit their own loans
        if (auth()->user()->isPetugas() && $loan->petugas_id !== auth()->id()) {
            abort(403, 'Unauthorized');
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
    public function destroy(Loan $loan)
    {
        if ($loan->status === 'active') {
            return redirect()->route('loans.index')
                ->with('error', 'Tidak dapat menghapus peminjaman yang masih aktif!');
        }

        // Petugas can only delete their own loans
        if (auth()->user()->isPetugas() && $loan->petugas_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Data peminjaman berhasil dihapus!');
    }
}
