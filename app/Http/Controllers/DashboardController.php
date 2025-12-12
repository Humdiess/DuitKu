<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use App\Services\CategoryService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;
    protected CategoryService $categoryService;

    public function __construct(
        DashboardService $dashboardService,
        CategoryService $categoryService
    ) {
        $this->dashboardService = $dashboardService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $userId = auth()->id();
        
        $data = $this->dashboardService->getDashboardData($userId);
        $categories = $this->categoryService->getByUser($userId);

        return view('dashboard.index', [
            'stats' => $data['stats'],
            'recentTransactions' => $data['recent_transactions'],
            'budgetOverview' => $data['budget_overview'],
            'chartData' => $data['chart_data'],
            'categories' => $categories,
        ]);
    }
}
