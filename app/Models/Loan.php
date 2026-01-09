<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'petugas_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'fine_amount',
        'status',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'fine_amount' => 'decimal:2',
    ];

    /**
     * Get the member who borrowed the book
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the petugas who processed this loan
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Get the book that was borrowed
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Calculate fine for late return
     * Rp2.000 per day
     */
    public function calculateFine()
    {
        if ($this->return_date && $this->return_date->gt($this->due_date)) {
            $daysLate = $this->due_date->diffInDays($this->return_date);
            return $daysLate * 2000; // Rp2.000 per hari
        }

        return 0;
    }

    /**
     * Check if loan is overdue
     */
    public function isOverdue()
    {
        if ($this->status === 'returned') {
            return false;
        }

        return now()->gt($this->due_date);
    }

    /**
     * Get days overdue
     */
    public function getDaysOverdue()
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        return (int) abs(now()->startOfDay()->diffInDays($this->due_date->startOfDay()));
    }
}
