<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $table = 'transactions';
    
    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'amount',
        'description',
        'notes',
        'date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    // ============== RELATIONSHIPS ==============

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the transaction.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ============== SCOPES ==============

    /**
     * Scope a query to only include income transactions.
     */
    public function scopeIncome(Builder $query): Builder
    {
        return $query->where('type', 'income');
    }

    /**
     * Scope a query to only include expense transactions.
     */
    public function scopeExpense(Builder $query): Builder
    {
        return $query->where('type', 'expense');
    }

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
     * Scope a query to filter by category.
     */
    public function scopeOfCategory(Builder $query, ?int $categoryId): Builder
    {
        if ($categoryId) {
            return $query->where('category_id', $categoryId);
        }
        return $query;
    }

    /**
     * Scope a query to filter by period.
     */
    public function scopeByPeriod(Builder $query, string $period): Builder
    {
        $now = Carbon::now();

        return match ($period) {
            'today' => $query->whereDate('date', $now->toDateString()),
            'week' => $query->whereBetween('date', [
                $now->startOfWeek()->toDateString(),
                $now->endOfWeek()->toDateString()
            ]),
            'month' => $query->whereMonth('date', $now->month)
                             ->whereYear('date', $now->year),
            '30days' => $query->where('date', '>=', $now->subDays(30)->toDateString()),
            'year' => $query->whereYear('date', $now->year),
            default => $query,
        };
    }

    /**
     * Scope a query to filter by specific month and year.
     */
    public function scopeForMonth(Builder $query, int $year, int $month): Builder
    {
        return $query->whereYear('date', $year)->whereMonth('date', $month);
    }

    /**
     * Scope a query to search by description.
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('description', 'like', "%{$search}%");
        }
        return $query;
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
     * Get the formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        $prefix = $this->type === 'income' ? '+' : '-';
        return $prefix . 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('d M Y');
    }

    /**
     * Get relative date description.
     */
    public function getRelativeDateAttribute(): string
    {
        $date = $this->date;
        $now = Carbon::now();

        if ($date->isToday()) {
            return 'Hari ini';
        } elseif ($date->isYesterday()) {
            return 'Kemarin';
        } elseif ($date->greaterThan($now->subDays(7))) {
            return $date->diffForHumans();
        } else {
            return $date->format('d M Y');
        }
    }
}
