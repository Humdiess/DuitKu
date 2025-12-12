<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Services\BudgetService;
use App\Services\CategoryService;
use App\Http\Requests\StoreBudgetRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BudgetController extends Controller
{
    protected BudgetService $budgetService;
    protected CategoryService $categoryService;

    public function __construct(
        BudgetService $budgetService,
        CategoryService $categoryService
    ) {
        $this->budgetService = $budgetService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the budgets.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        
        $budgets = $this->budgetService->getBudgetsWithSpending($userId);
        $summary = $this->budgetService->getSummary($userId);
        $availableCategories = $this->budgetService->getAvailableCategories($userId);
        $allCategories = $this->categoryService->getByUser($userId, 'expense');

        return view('dashboard.budget', compact('budgets', 'summary', 'availableCategories', 'allCategories'));
    }

    /**
     * Store a newly created budget.
     */
    public function store(StoreBudgetRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Check if budget already exists for this category
        if ($this->budgetService->existsForCategory($data['user_id'], $data['category_id'], $data['period'])) {
            return redirect()
                ->route('budget.index')
                ->with('error', 'Budget untuk kategori ini sudah ada.');
        }
        
        $this->budgetService->create($data);

        return redirect()
            ->route('budget.index')
            ->with('success', 'Budget berhasil dibuat.');
    }

    /**
     * Update the specified budget.
     */
    public function update(Request $request, Budget $budget): RedirectResponse
    {
        // Ensure user owns this budget
        if ($budget->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:1000',
            'alert_threshold' => 'sometimes|integer|min:50|max:100',
        ]);

        $this->budgetService->update($budget, $validated);

        return redirect()
            ->route('budget.index')
            ->with('success', 'Budget berhasil diperbarui.');
    }

    /**
     * Remove the specified budget.
     */
    public function destroy(Budget $budget): RedirectResponse
    {
        // Ensure user owns this budget
        if ($budget->user_id !== auth()->id()) {
            abort(403);
        }

        $this->budgetService->delete($budget);

        return redirect()
            ->route('budget.index')
            ->with('success', 'Budget berhasil dihapus.');
    }
}
