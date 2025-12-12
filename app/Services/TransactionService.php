<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class TransactionService
{
    /**
     * Get filtered transactions for a user.
     */
    public function getFilteredTransactions(
        int $userId,
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        $query = Transaction::with('category')
            ->forUser($userId)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['type'])) {
            $query->ofType($filters['type']);
        }

        if (!empty($filters['category_id'])) {
            $query->ofCategory($filters['category_id']);
        }

        if (!empty($filters['period'])) {
            $query->byPeriod($filters['period']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('date', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get all transactions for a user (no pagination).
     */
    public function getAllForUser(int $userId): Collection
    {
        return Transaction::with('category')
            ->forUser($userId)
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * Create a new transaction.
     */
    public function create(array $data): Transaction
    {
        return Transaction::create($data);
    }

    /**
     * Update a transaction.
     */
    public function update(Transaction $transaction, array $data): Transaction
    {
        $transaction->update($data);
        return $transaction->fresh();
    }

    /**
     * Delete a transaction.
     */
    public function delete(Transaction $transaction): bool
    {
        return $transaction->delete();
    }

    /**
     * Get recent transactions for a user.
     */
    public function getRecentTransactions(int $userId, int $limit = 5): Collection
    {
        return Transaction::with('category')
            ->forUser($userId)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get transaction statistics for a user.
     */
    public function getStatistics(int $userId, string $period = 'month'): array
    {
        $query = Transaction::forUser($userId)->byPeriod($period);

        $income = (clone $query)->income()->sum('amount');
        $expense = (clone $query)->expense()->sum('amount');
        $count = (clone $query)->count();

        // Get previous period stats for comparison
        $previousPeriodStats = $this->getPreviousPeriodStats($userId, $period);

        return [
            'income' => $income,
            'expense' => $expense,
            'balance' => $income - $expense,
            'count' => $count,
            'income_change' => $this->calculatePercentageChange($previousPeriodStats['income'], $income),
            'expense_change' => $this->calculatePercentageChange($previousPeriodStats['expense'], $expense),
        ];
    }

    /**
     * Get previous period statistics for comparison.
     */
    private function getPreviousPeriodStats(int $userId, string $period): array
    {
        $now = Carbon::now();
        
        $query = Transaction::forUser($userId);

        switch ($period) {
            case 'month':
                $prevMonth = $now->copy()->subMonth();
                $query->whereYear('date', $prevMonth->year)
                      ->whereMonth('date', $prevMonth->month);
                break;
            case 'week':
                $prevWeek = $now->copy()->subWeek();
                $query->whereBetween('date', [
                    $prevWeek->startOfWeek()->toDateString(),
                    $prevWeek->endOfWeek()->toDateString()
                ]);
                break;
            default:
                return ['income' => 0, 'expense' => 0];
        }

        return [
            'income' => (clone $query)->income()->sum('amount'),
            'expense' => (clone $query)->expense()->sum('amount'),
        ];
    }

    /**
     * Calculate percentage change between two values.
     */
    private function calculatePercentageChange(float $previous, float $current): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Get chart data for transactions.
     */
    public function getChartData(int $userId, int $days = 7): array
    {
        $data = [];
        $labels = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('D');
            
            $dayIncome = Transaction::forUser($userId)
                ->income()
                ->whereDate('date', $date->toDateString())
                ->sum('amount');
            
            $dayExpense = Transaction::forUser($userId)
                ->expense()
                ->whereDate('date', $date->toDateString())
                ->sum('amount');

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('D'),
                'income' => $dayIncome,
                'expense' => $dayExpense,
                'net' => $dayIncome - $dayExpense,
            ];
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
