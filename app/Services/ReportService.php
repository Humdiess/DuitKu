<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;

class ReportService
{
    protected TransactionService $transactionService;
    protected CategoryService $categoryService;

    public function __construct(
        TransactionService $transactionService,
        CategoryService $categoryService
    ) {
        $this->transactionService = $transactionService;
        $this->categoryService = $categoryService;
    }

    /**
     * Get complete report data for a user.
     */
    public function getReportData(int $userId, int $year, int $month): array
    {
        return [
            'stats' => $this->getMonthlyStats($userId, $year, $month),
            'category_breakdown' => $this->getCategoryBreakdown($userId, $year, $month),
            'daily_trend' => $this->getDailyTrend($userId, $year, $month),
            'income_vs_expense' => $this->getIncomeVsExpense($userId, $year, $month),
        ];
    }

    /**
     * Get monthly statistics.
     */
    public function getMonthlyStats(int $userId, int $year, int $month): array
    {
        $income = Transaction::forUser($userId)
            ->income()
            ->forMonth($year, $month)
            ->sum('amount');

        $expense = Transaction::forUser($userId)
            ->expense()
            ->forMonth($year, $month)
            ->sum('amount');

        $count = Transaction::forUser($userId)
            ->forMonth($year, $month)
            ->count();

        // Previous month comparison
        $prevMonth = Carbon::create($year, $month, 1)->subMonth();
        $prevIncome = Transaction::forUser($userId)
            ->income()
            ->forMonth($prevMonth->year, $prevMonth->month)
            ->sum('amount');
        
        $prevExpense = Transaction::forUser($userId)
            ->expense()
            ->forMonth($prevMonth->year, $prevMonth->month)
            ->sum('amount');

        return [
            'income' => $income,
            'expense' => $expense,
            'balance' => $income - $expense,
            'count' => $count,
            'income_change' => $this->calculateChange($prevIncome, $income),
            'expense_change' => $this->calculateChange($prevExpense, $expense),
        ];
    }

    /**
     * Get category breakdown for the month.
     */
    public function getCategoryBreakdown(int $userId, int $year, int $month): array
    {
        $categories = Category::forUser($userId)->expense()->get();
        
        $breakdown = [];
        $totalExpense = 0;

        foreach ($categories as $category) {
            $spent = Transaction::forUser($userId)
                ->where('category_id', $category->id)
                ->expense()
                ->forMonth($year, $month)
                ->sum('amount');

            if ($spent > 0) {
                $breakdown[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'icon' => $category->icon,
                    'color' => $category->color,
                    'spent' => $spent,
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

        usort($breakdown, fn($a, $b) => $b['spent'] <=> $a['spent']);

        return [
            'items' => $breakdown,
            'total' => $totalExpense,
        ];
    }

    /**
     * Get daily spending trend for the month.
     */
    public function getDailyTrend(int $userId, int $year, int $month): array
    {
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $today = Carbon::now();

        $data = [];
        $current = $startDate->copy();

        while ($current <= $endDate && $current <= $today) {
            $dayIncome = Transaction::forUser($userId)
                ->income()
                ->whereDate('date', $current->toDateString())
                ->sum('amount');

            $dayExpense = Transaction::forUser($userId)
                ->expense()
                ->whereDate('date', $current->toDateString())
                ->sum('amount');

            $data[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'income' => $dayIncome,
                'expense' => $dayExpense,
                'net' => $dayIncome - $dayExpense,
            ];

            $current->addDay();
        }

        return $data;
    }

    /**
     * Get income vs expense comparison.
     */
    public function getIncomeVsExpense(int $userId, int $year, int $month): array
    {
        // Last 6 months data
        $data = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::create($year, $month, 1)->subMonths($i);
            
            $income = Transaction::forUser($userId)
                ->income()
                ->forMonth($date->year, $date->month)
                ->sum('amount');

            $expense = Transaction::forUser($userId)
                ->expense()
                ->forMonth($date->year, $date->month)
                ->sum('amount');

            $data[] = [
                'month' => $date->format('M'),
                'year' => $date->year,
                'income' => $income,
                'expense' => $expense,
            ];
        }

        return $data;
    }

    /**
     * Calculate percentage change.
     */
    private function calculateChange(float $previous, float $current): float
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Get available months for reports.
     */
    public function getAvailableMonths(int $userId): array
    {
        $months = Transaction::forUser($userId)
            ->selectRaw('YEAR(date) as year, MONTH(date) as month')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        if ($months->isEmpty()) {
            // Return current month if no transactions
            $now = Carbon::now();
            return [[
                'year' => $now->year,
                'month' => $now->month,
                'label' => $now->format('F Y'),
            ]];
        }

        return $months->map(function ($item) {
            $date = Carbon::create($item->year, $item->month, 1);
            return [
                'year' => $item->year,
                'month' => $item->month,
                'label' => $date->translatedFormat('F Y'),
            ];
        })->toArray();
    }
}
