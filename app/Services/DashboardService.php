<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardService
{
    protected TransactionService $transactionService;
    protected BudgetService $budgetService;
    protected CategoryService $categoryService;

    public function __construct(
        TransactionService $transactionService,
        BudgetService $budgetService,
        CategoryService $categoryService
    ) {
        $this->transactionService = $transactionService;
        $this->budgetService = $budgetService;
        $this->categoryService = $categoryService;
    }

    /**
     * Get all dashboard data for a user.
     */
    public function getDashboardData(int $userId): array
    {
        return [
            'stats' => $this->getStats($userId),
            'recent_transactions' => $this->getRecentTransactions($userId),
            'budget_overview' => $this->getBudgetOverview($userId),
            'chart_data' => $this->getChartData($userId),
        ];
    }

    /**
     * Get statistics for the dashboard.
     */
    public function getStats(int $userId): array
    {
        return $this->transactionService->getStatistics($userId, 'month');
    }

    /**
     * Get recent transactions for dashboard.
     */
    public function getRecentTransactions(int $userId, int $limit = 4): array
    {
        $transactions = $this->transactionService->getRecentTransactions($userId, $limit);

        return $transactions->map(function ($tx) {
            return [
                'id' => $tx->id,
                'icon' => $tx->category->icon ?? '💰',
                'name' => $tx->description,
                'date' => $tx->relative_date,
                'amount' => $tx->amount,
                'formatted_amount' => $tx->formatted_amount,
                'type' => $tx->type,
            ];
        })->toArray();
    }

    /**
     * Get budget overview for dashboard.
     */
    public function getBudgetOverview(int $userId): array
    {
        return $this->budgetService->getBudgetOverview($userId, 3);
    }

    /**
     * Get chart data for dashboard.
     */
    public function getChartData(int $userId, int $days = 7): array
    {
        return $this->transactionService->getChartData($userId, $days);
    }
}
