<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class CategoryService
{
    /**
     * Get all categories for a user.
     */
    public function getByUser(int $userId, ?string $type = null): Collection
    {
        $query = Category::forUser($userId)->orderBy('name');

        if ($type) {
            $query->ofType($type);
        }

        return $query->get();
    }

    /**
     * Get categories with transaction counts.
     */
    public function getWithCounts(int $userId, ?string $type = null): Collection
    {
        $query = Category::forUser($userId)
            ->withCount('transactions')
            ->orderBy('name');

        if ($type) {
            $query->ofType($type);
        }

        return $query->get();
    }

    /**
     * Create a new category.
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update a category.
     */
    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category->fresh();
    }

    /**
     * Delete a category.
     */
    public function delete(Category $category): bool
    {
        // Soft delete
        return $category->delete();
    }

    /**
     * Get category spending for a specific period.
     */
    public function getCategorySpending(int $categoryId, string $period = 'month'): float
    {
        return Transaction::where('category_id', $categoryId)
            ->expense()
            ->byPeriod($period)
            ->sum('amount');
    }

    /**
     * Get spending breakdown by category for a user.
     */
    public function getSpendingBreakdown(int $userId, string $period = 'month'): array
    {
        $categories = Category::forUser($userId)
            ->expense()
            ->get();

        $breakdown = [];
        $totalExpense = 0;

        foreach ($categories as $category) {
            $spent = Transaction::forUser($userId)
                ->where('category_id', $category->id)
                ->expense()
                ->byPeriod($period)
                ->sum('amount');

            if ($spent > 0) {
                $breakdown[] = [
                    'category' => $category,
                    'spent' => $spent,
                    'icon' => $category->icon,
                    'name' => $category->name,
                    'color' => $category->color,
                ];
                $totalExpense += $spent;
            }
        }

        // Calculate percentages
        foreach ($breakdown as &$item) {
            $item['percentage'] = $totalExpense > 0 
                ? round(($item['spent'] / $totalExpense) * 100, 1) 
                : 0;
        }

        // Sort by spent descending
        usort($breakdown, fn($a, $b) => $b['spent'] <=> $a['spent']);

        return [
            'breakdown' => $breakdown,
            'total' => $totalExpense,
        ];
    }

    /**
     * Get income breakdown by category for a user.
     */
    public function getIncomeBreakdown(int $userId, string $period = 'month'): array
    {
        $categories = Category::forUser($userId)
            ->income()
            ->get();

        $breakdown = [];
        $totalIncome = 0;

        foreach ($categories as $category) {
            $earned = Transaction::forUser($userId)
                ->where('category_id', $category->id)
                ->income()
                ->byPeriod($period)
                ->sum('amount');

            if ($earned > 0) {
                $breakdown[] = [
                    'category' => $category,
                    'amount' => $earned,
                    'icon' => $category->icon,
                    'name' => $category->name,
                    'color' => $category->color,
                ];
                $totalIncome += $earned;
            }
        }

        // Calculate percentages
        foreach ($breakdown as &$item) {
            $item['percentage'] = $totalIncome > 0 
                ? round(($item['amount'] / $totalIncome) * 100, 1) 
                : 0;
        }

        // Sort by amount descending
        usort($breakdown, fn($a, $b) => $b['amount'] <=> $a['amount']);

        return [
            'breakdown' => $breakdown,
            'total' => $totalIncome,
        ];
    }
}
