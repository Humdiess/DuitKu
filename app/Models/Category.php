<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'icon',
        'color',
    ];

    // ============== RELATIONSHIPS ==============

    /**
     * Get the user that owns the category.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the category.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the budgets for the category.
     */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }

    // ============== SCOPES ==============

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType(Builder $query, ?string $type): Builder
    {
        if ($type && in_array($type, ['income', 'expense'])) {
            return $query->where('type', $type);
        }
        return $query;
    }

    /**
     * Scope a query to only include income categories.
     */
    public function scopeIncome(Builder $query): Builder
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope a query to only include expense categories.
     */
    public function scopeExpense(Builder $query): Builder
    {
        return $query->where('type', 'expense');
    }

    /**
     * Scope a query to filter by user.
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    // ============== ACCESSORS ==============

    /**
     * Get the transaction count for this category.
     */
    public function getTransactionCountAttribute(): int
    {
        return $this->transactions()->count();
    }

    /**
     * Get the translated type label.
     */
    public function getTypeLabelAttribute(): string
    {
        return $this->attributes['type'] === 'income' ? 'Pemasukan' : 'Pengeluaran';
    }

    /**
     * Get the total amount for this category (for current month).
     */
    public function getTotalAmountAttribute(): float
    {
        return $this->transactions()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');
    }

    /**
     * Get formatted category with icon.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->icon . ' ' . $this->name;
    }
}
