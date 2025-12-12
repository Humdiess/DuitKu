<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use App\Services\TransactionService;
use App\Services\CategoryService;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
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
     * Display a listing of the transactions.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        
        $filters = [
            'search' => $request->get('search'),
            'type' => $request->get('type'),
            'category_id' => $request->get('category'),
            'period' => $request->get('period', 'all'),
        ];

        $transactions = $this->transactionService->getFilteredTransactions($userId, $filters);
        $categories = $this->categoryService->getByUser($userId);
        $stats = $this->transactionService->getStatistics($userId, 'month');

        return view('dashboard.transaksi', compact('transactions', 'categories', 'stats', 'filters'));
    }

    /**
     * Filter transactions via AJAX.
     */
    public function filter(Request $request): JsonResponse
    {
        $userId = auth()->id();
        
        $filters = [
            'search' => $request->get('search'),
            'type' => $request->get('type'),
            'category_id' => $request->get('category'),
            'period' => $request->get('period', 'all'),
        ];

        $transactions = $this->transactionService->getFilteredTransactions($userId, $filters);

        return response()->json([
            'success' => true,
            'data' => $transactions->items(),
            'pagination' => [
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
                'per_page' => $transactions->perPage(),
                'total' => $transactions->total(),
            ],
        ]);
    }

    /**
     * Store a newly created transaction.
     */
    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        $this->transactionService->create($data);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaksi): JsonResponse
    {
        // Ensure user owns this transaction
        if ($transaksi->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'success' => true,
            'data' => $transaksi->load('category'),
        ]);
    }

    /**
     * Update the specified transaction.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaksi): RedirectResponse
    {
        $this->transactionService->update($transaksi, $request->validated());

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(Transaction $transaksi): RedirectResponse
    {
        // Ensure user owns this transaction
        if ($transaksi->user_id !== auth()->id()) {
            abort(403);
        }

        $this->transactionService->delete($transaksi);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
