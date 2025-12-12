<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Services\BudgetService;
use App\Services\CategoryService;
use App\Http\Requests\StoreBudgetRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BudgetController extends Controller
{
    protected BudgetService $budgetService;
    protected CategoryService $categoryService;

    public function __construct(BudgetService $budgetService, CategoryService $categoryService)
    {
        $this->budgetService = $budgetService;
        $this->categoryService = $categoryService;
    }

    /**
     * Get all budgets with spending info
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "category": {"id": 1, "name": "Makanan", "icon": "🍔"},
     *       "amount": 2000000,
     *       "spent": 750000,
     *       "remaining": 1250000,
     *       "percentage": 37.5,
     *       "period": "monthly",
     *       "is_exceeded": false,
     *       "is_over_threshold": false
     *     }
     *   ]
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        $budgets = $this->budgetService->getBudgetsWithSpending($userId);

        return response()->json([
            'status' => 'success',
            'data' => $budgets->map(fn($b) => [
                'id' => $b->id,
                'category' => $b->category ? [
                    'id' => $b->category->id,
                    'name' => $b->category->name,
                    'icon' => $b->category->icon,
                    'color' => $b->category->color,
                ] : null,
                'amount' => (float) $b->amount,
                'formatted_amount' => $b->formatted_amount,
                'spent' => (float) $b->spent,
                'formatted_spent' => $b->formatted_spent,
                'remaining' => (float) $b->remaining,
                'formatted_remaining' => $b->formatted_remaining,
                'percentage' => round($b->percentage, 1),
                'period' => $b->period,
                'period_label' => $b->period_label,
                'start_date' => $b->start_date->format('Y-m-d'),
                'alert_threshold' => $b->alert_threshold,
                'is_exceeded' => $b->is_exceeded,
                'is_over_threshold' => $b->is_over_threshold,
            ]),
        ]);
    }

    /**
     * Create a new budget
     * 
     * @authenticated
     * @bodyParam category_id integer required Category ID. Example: 1
     * @bodyParam amount number required Budget amount. Example: 2000000
     * @bodyParam period string required Period: weekly, monthly, yearly. Example: monthly
     * @bodyParam start_date string required Start date Y-m-d. Example: 2025-12-01
     * @bodyParam alert_threshold integer required Alert threshold % (50-100). Example: 80
     * 
     * @response 201 {
     *   "status": "success",
     *   "message": "Budget created",
     *   "data": {...}
     * }
     */
    public function store(StoreBudgetRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        // Check if budget already exists
        if ($this->budgetService->existsForCategory($data['user_id'], $data['category_id'], $data['period'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Budget untuk kategori ini sudah ada',
            ], 422);
        }
        
        $budget = $this->budgetService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Budget berhasil dibuat',
            'data' => [
                'id' => $budget->id,
                'category_id' => $budget->category_id,
                'amount' => (float) $budget->amount,
                'period' => $budget->period,
            ],
        ], 201);
    }

    /**
     * Get a single budget
     * 
     * @authenticated
     * @urlParam id integer required Budget ID. Example: 1
     */
    public function show(Request $request, Budget $budget): JsonResponse
    {
        if ($budget->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $budget->id,
                'category' => $budget->category ? [
                    'id' => $budget->category->id,
                    'name' => $budget->category->name,
                    'icon' => $budget->category->icon,
                ] : null,
                'amount' => (float) $budget->amount,
                'spent' => (float) $budget->spent,
                'remaining' => (float) $budget->remaining,
                'percentage' => round($budget->percentage, 1),
                'period' => $budget->period,
                'start_date' => $budget->start_date->format('Y-m-d'),
                'alert_threshold' => $budget->alert_threshold,
            ],
        ]);
    }

    /**
     * Update a budget
     * 
     * @authenticated
     * @urlParam id integer required Budget ID. Example: 1
     * @bodyParam amount number Budget amount. Example: 2500000
     * @bodyParam alert_threshold integer Alert threshold %. Example: 75
     */
    public function update(Request $request, Budget $budget): JsonResponse
    {
        if ($budget->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:1000',
            'alert_threshold' => 'sometimes|integer|min:50|max:100',
        ]);

        $this->budgetService->update($budget, $validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Budget berhasil diperbarui',
            'data' => [
                'id' => $budget->id,
                'amount' => (float) $budget->amount,
                'alert_threshold' => $budget->alert_threshold,
            ],
        ]);
    }

    /**
     * Delete a budget
     * 
     * @authenticated
     * @urlParam id integer required Budget ID. Example: 1
     */
    public function destroy(Request $request, Budget $budget): JsonResponse
    {
        if ($budget->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        $this->budgetService->delete($budget);

        return response()->json([
            'status' => 'success',
            'message' => 'Budget berhasil dihapus',
        ]);
    }

    /**
     * Get budget summary
     * 
     * @authenticated
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "total_budget": 5000000,
     *     "total_spent": 2500000,
     *     "total_remaining": 2500000,
     *     "budget_count": 4,
     *     "exceeded_count": 1,
     *     "available_categories": [...]
     *   }
     * }
     */
    public function summary(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        $summary = $this->budgetService->getSummary($userId);
        $availableCategories = $this->budgetService->getAvailableCategories($userId);

        return response()->json([
            'status' => 'success',
            'data' => array_merge($summary, [
                'available_categories' => $availableCategories->map(fn($c) => [
                    'id' => $c->id,
                    'name' => $c->name,
                    'icon' => $c->icon,
                ]),
            ]),
        ]);
    }
}
