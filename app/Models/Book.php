<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'category_id', // Changed from category string to relation
        'description',
        'stock',
    ];

    public function categoryData(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get all loans for this book
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get active loans for this book
     */
    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'active');
    }

    /**
     * Check if book is available for loan
     */
    public function isAvailable()
    {
        return $this->stock > 0;
    }

    /**
     * Get number of books currently on loan
     */
    public function getBooksOnLoanAttribute()
    {
        return $this->activeLoans()->count();
    }
}
