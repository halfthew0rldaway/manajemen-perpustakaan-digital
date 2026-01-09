<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'member_id_number',
        'occupation_institution',
        'phone',
        'email',
        'address',
        'status',
    ];

    /**
     * Get all loans for this member
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get active loans for this member
     */
    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'active');
    }

    /**
     * Check if member can borrow more books
     * Maximum 4 active loans
     */
    public function canBorrowMore()
    {
        return $this->activeLoans()->count() < 4;
    }

    /**
     * Scope to get only active members
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get number of active loans
     */
    public function getActiveLoanCountAttribute()
    {
        return $this->activeLoans()->count();
    }
}
