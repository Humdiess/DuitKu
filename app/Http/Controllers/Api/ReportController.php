<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Get complete report data
     * 
     * @authenticated
     * @queryParam year integer Year. Example: 2025
     * @queryParam month integer Month (1-12). Example: 12
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "stats": {...},
     *     "category_breakdown": {...},
     *     "daily_trend": [...],
     *     "income_vs_expense": [...],
     *     "available_months": [...]
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $reportData = $this->reportService->getReportData($userId, $year, $month);
        $availableMonths = $this->reportService->getAvailableMonths($userId);

        return response()->json([
            'status' => 'success',
            'data' => array_merge($reportData, [
                'available_months' => $availableMonths,
            ]),
        ]);
    }

    /**
     * Get monthly statistics
     * 
     * @authenticated
     * @queryParam year integer Year. Example: 2025
     * @queryParam month integer Month (1-12). Example: 12
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "income": 10000000,
     *     "expense": 5000000,
     *     "balance": 5000000,
     *     "count": 25,
     *     "income_change": 15.5,
     *     "expense_change": -10.2
     *   }
     * }
     */
    public function monthly(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $stats = $this->reportService->getMonthlyStats($userId, $year, $month);

        return response()->json([
            'status' => 'success',
            'data' => $stats,
        ]);
    }

    /**
     * Get category breakdown for expenses
     * 
     * @authenticated
     * @queryParam year integer Year. Example: 2025
     * @queryParam month integer Month (1-12). Example: 12
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "total": 5000000,
     *     "items": [
     *       {"id": 1, "name": "Makanan", "icon": "🍔", "color": "...", "spent": 750000, "percentage": 15}
     *     ]
     *   }
     * }
     */
    public function categoryBreakdown(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $breakdown = $this->reportService->getCategoryBreakdown($userId, $year, $month);

        return response()->json([
            'status' => 'success',
            'data' => $breakdown,
        ]);
    }

    /**
     * Get daily spending trend for a month
     * 
     * @authenticated
     * @queryParam year integer Year. Example: 2025
     * @queryParam month integer Month (1-12). Example: 12
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": [
     *     {"day": 1, "income": 0, "expense": 150000},
     *     {"day": 2, "income": 10000000, "expense": 50000}
     *   ]
     * }
     */
    public function dailyTrend(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $trend = $this->reportService->getDailyTrend($userId, $year, $month);

        return response()->json([
            'status' => 'success',
            'data' => $trend,
        ]);
    }
}
