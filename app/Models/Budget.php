<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Budget extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'amount',
        'period',
        'start_date',
        'alert_threshold',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'alert_threshold' => 'integer',
    ];

    // ============== RELATIONSHIPS ==============

    /**
     * Get the user that owns the budget.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of the budget.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ============== SCOPES ==============

    /**
     * Scope a query to filter by user.
     */
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to filter by period type.
     */
    public function scopeOfPeriod(Builder $query, string $period): Builder
    {
        return $query->where('period', $period);
    }

    /**
     * Scope a query to get active budgets (started and not expired).
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('start_date', '<=', now()->toDateString());
    }

    // ============== ACCESSORS ==============

    /**
     * Get the spent amount for this budget period.
     */
    public function getSpentAttribute(): float
    {
        $query = Transaction::where('category_id', $this->category_id)
            ->where('user_id', $this->user_id)
            ->where('type', 'expense');

        // Filter by period
        $now = Carbon::now();
        
        switch ($this->period) {
            case 'weekly':
                $query->whereBetween('date', [
                    $now->startOfWeek()->toDateString(),
                    $now->endOfWeek()->toDateString()
                ]);
                break;
            case 'monthly':
                $query->whereYear('date', $now->year)
                      ->whereMonth('date', $now->month);
                break;
            case 'yearly':
                $query->whereYear('date', $now->year);
                break;
        }

        return $query->sum('amount');
    }

    /**
     * Get the percentage of budget used.
     */
    public function getPercentageAttribute(): float
    {
        if ($this->amount <= 0) {
            return 0;
        }
        return min(($this->spent / $this->amount) * 100, 100);
    }

    /**
     * Get the remaining budget amount.
     */
    public function getRemainingAttribute(): float
    {
        return max($this->amount - $this->spent, 0);
    }

    /**
     * Check if budget is over threshold.
     */
    public function getIsOverThresholdAttribute(): bool
    {
        return $this->percentage >= $this->alert_threshold;
    }

    /**
     * Check if budget is exceeded.
     */
    public function getIsExceededAttribute(): bool
    {
        return $this->spent > $this->amount;
    }

    /**
     * Get formatted budget amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    /**
     * Get formatted spent amount.
     */
    public function getFormattedSpentAttribute(): string
    {
        return 'Rp ' . number_format($this->spent, 0, ',', '.');
    }

    /**
     * Get formatted remaining amount.
     */
    public function getFormattedRemainingAttribute(): string
    {
        return 'Rp ' . number_format($this->remaining, 0, ',', '.');
    }

    /**
     * Get period label in Indonesian.
     */
    public function getPeriodLabelAttribute(): string
    {
        return match ($this->period) {
            'weekly' => 'Mingguan',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
            default => $this->period,
        };
    }
}
