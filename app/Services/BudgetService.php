<?php

namespace App\Services;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class BudgetService
{
    /**
     * Get all budgets for a user.
     */
    public function getByUser(int $userId, ?string $period = null): Collection
    {
        $query = Budget::with('category')
            ->forUser($userId)
            ->active()
            ->orderBy('created_at', 'desc');

        if ($period) {
            $query->ofPeriod($period);
        }

        return $query->get();
    }

    /**
     * Get budgets with calculated spending.
     */
    public function getBudgetsWithSpending(int $userId): Collection
    {
        return $this->getByUser($userId, 'monthly');
    }

    /**
     * Create a new budget.
     */
    public function create(array $data): Budget
    {
        return Budget::create($data);
    }

    /**
     * Update a budget.
     */
    public function update(Budget $budget, array $data): Budget
    {
        $budget->update($data);
        return $budget->fresh();
    }

    /**
     * Delete a budget.
     */
    public function delete(Budget $budget): bool
    {
        return $budget->delete();
    }

    /**
     * Get budget summary for a user.
     */
    public function getSummary(int $userId): array
    {
        $budgets = $this->getByUser($userId, 'monthly');

        $totalBudget = $budgets->sum('amount');
        $totalSpent = $budgets->sum(fn($b) => $b->spent);
        $totalRemaining = $totalBudget - $totalSpent;

        return [
            'total_budget' => $totalBudget,
            'total_spent' => $totalSpent,
            'total_remaining' => max($totalRemaining, 0),
            'budgets_count' => $budgets->count(),
            'over_budget_count' => $budgets->filter(fn($b) => $b->is_exceeded)->count(),
        ];
    }

    /**
     * Get budget overview for dashboard.
     */
    public function getBudgetOverview(int $userId, int $limit = 3): array
    {
        $budgets = Budget::with('category')
            ->forUser($userId)
            ->active()
            ->ofPeriod('monthly')
            ->get()
            ->sortByDesc(fn($b) => $b->percentage)
            ->take($limit);

        return $budgets->map(function ($budget) {
            return [
                'id' => $budget->id,
                'name' => $budget->category->name,
                'icon' => $budget->category->icon,
                'color' => $budget->category->color,
                'budget' => $budget->amount,
                'spent' => $budget->spent,
                'remaining' => $budget->remaining,
                'percentage' => $budget->percentage,
                'is_over_threshold' => $budget->is_over_threshold,
                'is_exceeded' => $budget->is_exceeded,
            ];
        })->values()->toArray();
    }

    /**
     * Check if a budget exists for a category.
     */
    public function existsForCategory(int $userId, int $categoryId, string $period = 'monthly'): bool
    {
        return Budget::forUser($userId)
            ->where('category_id', $categoryId)
            ->ofPeriod($period)
            ->exists();
    }

    /**
     * Get available categories for budget (categories without existing budget).
     */
    public function getAvailableCategories(int $userId): Collection
    {
        $existingCategoryIds = Budget::forUser($userId)
            ->ofPeriod('monthly')
            ->pluck('category_id');

        return Category::forUser($userId)
            ->expense()
            ->whereNotIn('id', $existingCategoryIds)
            ->get();
    }
}
