<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Get complete dashboard data
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "stats": {
     *       "income": 10000000,
     *       "expense": 5000000,
     *       "balance": 5000000,
     *       "count": 25,
     *       "income_change": 15.5,
     *       "expense_change": -10.2
     *     },
     *     "recent_transactions": [...],
     *     "budget_overview": [...],
     *     "chart_data": {...}
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        $data = $this->dashboardService->getDashboardData($userId);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Get dashboard statistics only
     * 
     * @authenticated
     * @queryParam period string Stats period: week, month, year. Example: month
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "income": 10000000,
     *     "expense": 5000000,
     *     "balance": 5000000,
     *     "count": 25
     *   }
     * }
     */
    public function stats(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $period = $request->get('period', 'month');
        
        $stats = $this->dashboardService->getStats($userId, $period);

        return response()->json([
            'status' => 'success',
            'data' => $stats,
        ]);
    }
}
