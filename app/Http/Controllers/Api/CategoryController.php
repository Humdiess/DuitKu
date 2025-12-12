<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Get all categories
     * 
     * @authenticated
     * @queryParam type string Filter by type: income or expense. Example: expense
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Makanan",
     *       "type": "expense",
     *       "icon": "🍔",
     *       "color": "from-orange-500 to-red-500",
     *       "transaction_count": 15,
     *       "total_amount": 750000
     *     }
     *   ]
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $type = $request->get('type');
        
        $categories = $this->categoryService->getWithCounts($userId, $type);

        return response()->json([
            'status' => 'success',
            'data' => $categories->map(fn($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'type' => $cat->type,
                'type_label' => $cat->type_label,
                'icon' => $cat->icon,
                'color' => $cat->color,
                'transaction_count' => $cat->transactions_count ?? 0,
                'total_amount' => (float) ($cat->transactions_sum_amount ?? 0),
            ]),
        ]);
    }

    /**
     * Create a new category
     * 
     * @authenticated
     * @bodyParam name string required Category name. Example: Makanan
     * @bodyParam type string required Type: income or expense. Example: expense
     * @bodyParam icon string required Emoji icon. Example: 🍔
     * @bodyParam color string required Tailwind gradient classes. Example: from-orange-500 to-red-500
     * 
     * @response 201 {
     *   "status": "success",
     *   "message": "Category created",
     *   "data": {...}
     * }
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        
        $category = $this->categoryService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil ditambahkan',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'type' => $category->type,
                'icon' => $category->icon,
                'color' => $category->color,
            ],
        ], 201);
    }

    /**
     * Get a single category
     * 
     * @authenticated
     * @urlParam id integer required Category ID. Example: 1
     */
    public function show(Request $request, Category $category): JsonResponse
    {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'type' => $category->type,
                'type_label' => $category->type_label,
                'icon' => $category->icon,
                'color' => $category->color,
                'transaction_count' => $category->transaction_count,
                'total_amount' => (float) $category->total_amount,
            ],
        ]);
    }

    /**
     * Update a category
     * 
     * @authenticated
     * @urlParam id integer required Category ID. Example: 1
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'type' => 'sometimes|in:income,expense',
            'icon' => 'sometimes|string|max:10',
            'color' => 'sometimes|string|max:100',
        ]);

        $this->categoryService->update($category, $validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil diperbarui',
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'type' => $category->type,
                'icon' => $category->icon,
                'color' => $category->color,
            ],
        ]);
    }

    /**
     * Delete a category
     * 
     * @authenticated
     * @urlParam id integer required Category ID. Example: 1
     */
    public function destroy(Request $request, Category $category): JsonResponse
    {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        $this->categoryService->delete($category);

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus',
        ]);
    }

    /**
     * Get spending/income breakdown by category
     * 
     * @authenticated
     * @queryParam type string Type: income or expense (default expense). Example: expense
     * @queryParam year integer Year. Example: 2025
     * @queryParam month integer Month (1-12). Example: 12
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {
     *     "total": 5000000,
     *     "items": [
     *       {"id": 1, "name": "Makanan", "icon": "🍔", "spent": 750000, "percentage": 15}
     *     ]
     *   }
     * }
     */
    public function breakdown(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $type = $request->get('type', 'expense');
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        
        $breakdown = $this->categoryService->getSpendingBreakdown($userId, $year, $month);

        return response()->json([
            'status' => 'success',
            'data' => $breakdown,
        ]);
    }
}
