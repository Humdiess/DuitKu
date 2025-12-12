<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $type = $request->get('type');
        
        $categories = $this->categoryService->getWithCounts($userId, $type);

        return view('dashboard.kategori', compact('categories', 'type'));
    }

    /**
     * Filter categories via AJAX.
     */
    public function filter(Request $request): JsonResponse
    {
        $userId = auth()->id();
        $type = $request->get('type');
        
        $categories = $this->categoryService->getWithCounts($userId, $type);

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        $this->categoryService->create($data);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $kategori): JsonResponse
    {
        // Ensure user owns this category
        if ($kategori->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori,
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $kategori): RedirectResponse
    {
        // Ensure user owns this category
        if ($kategori->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'type' => 'sometimes|in:income,expense',
            'icon' => 'sometimes|string|max:10',
            'color' => 'sometimes|string|max:100',
        ]);

        $this->categoryService->update($kategori, $validated);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $kategori): RedirectResponse
    {
        // Ensure user owns this category
        if ($kategori->user_id !== auth()->id()) {
            abort(403);
        }

        $this->categoryService->delete($kategori);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
