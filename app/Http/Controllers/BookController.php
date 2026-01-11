<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('categoryData'); // Eager load category

        // Search functionality (Advanced)
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%");
            });
        }

        // Category Filter
        if ($categoryId = $request->get('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Year Filter
        if ($year = $request->get('year')) {
            $query->where('publication_year', $year);
        }

        // Availability Filter
        if ($request->get('available') === 'true') {
            $query->where('stock', '>', 0);
        }

        // Sorting
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        // Validate sort columns to prevent SQL injection
        $allowedSorts = ['title', 'author', 'publication_year', 'stock', 'created_at'];
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $order);
        } else {
            $query->latest();
        }

        $books = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        // Get unique years for filter
        $years = Book::select('publication_year')
            ->whereNotNull('publication_year')
            ->distinct()
            ->orderBy('publication_year', 'desc')
            ->pluck('publication_year');

        return view('books.index', compact('books', 'categories', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:2',
        ], [
            'title.unique' => 'Judul buku ini sudah ada dalam sistem.',
            'isbn.unique' => 'ISBN ini sudah terdaftar dalam sistem.',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load([
            'categoryData',
            'loans' => function ($query) {
                $query->latest()->take(10);
            }
        ]);

        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $book->id,
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:2',
        ], [
            'title.unique' => 'Judul buku ini sudah ada dalam sistem.',
            'isbn.unique' => 'ISBN ini sudah terdaftar dalam sistem.',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Check if book has active loans
        if ($book->activeLoans()->count() > 0) {
            return redirect()->route('books.index')
                ->with('error', 'Tidak dapat menghapus buku yang sedang dipinjam!');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
