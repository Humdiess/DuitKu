<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get all transactions with optional filters
     * 
     * @authenticated
     * @queryParam type string Filter by type: income or expense. Example: expense
     * @queryParam category_id integer Filter by category ID. Example: 1
     * @queryParam period string Filter by period: today, week, month, 30days. Example: month
     * @queryParam search string Search in description. Example: gaji
     * @queryParam per_page integer Items per page (default 15). Example: 20
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": [...],
     *   "meta": {"current_page": 1, "last_page": 5, "per_page": 15, "total": 75}
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        $filters = [
            'search' => $request->get('search'),
            'type' => $request->get('type'),
            'category_id' => $request->get('category_id'),
            'period' => $request->get('period', 'all'),
        ];

        $perPage = $request->get('per_page', 15);
        $transactions = $this->transactionService->getFilteredTransactions($userId, $filters, $perPage);

        return response()->json([
            'status' => 'success',
            'data' => $transactions->map(fn($tx) => [
                'id' => $tx->id,
                'type' => $tx->type,
                'amount' => (float) $tx->amount,
                'formatted_amount' => $tx->formatted_amount,
                'description' => $tx->description,
                'notes' => $tx->notes,
                'date' => $tx->date->format('Y-m-d'),
                'formatted_date' => $tx->formatted_date,
                'category' => $tx->category ? [
                    'id' => $tx->category->id,
                    'name' => $tx->category->name,
                    'icon' => $tx->category->icon,
                    'color' => $tx->category->color,
                ] : null,
            ]),
            'meta' => [
                'current_page' => $transactions->currentPage(),
                'last_page' => $transactions->lastPage(),
                'per_page' => $transactions->perPage(),
                'total' => $transactions->total(),
            ],
        ]);
    }

    /**
     * Create a new transaction
     * 
     * @authenticated
     * @bodyParam type string required Type: income or expense. Example: expense
     * @bodyParam amount number required Transaction amount. Example: 150000
     * @bodyParam description string required Transaction description. Example: Makan siang
     * @bodyParam category_id integer required Category ID. Example: 1
     * @bodyParam date string required Date in Y-m-d format. Example: 2025-12-12
     * @bodyParam notes string optional Additional notes. Example: Di restoran favorit
     * 
     * @response 201 {
     *   "status": "success",
     *   "message": "Transaction created",
     *   "data": {...}
     * }
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        
        $transaction = $this->transactionService->create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil ditambahkan',
            'data' => [
                'id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => (float) $transaction->amount,
                'description' => $transaction->description,
                'date' => $transaction->date->format('Y-m-d'),
                'category_id' => $transaction->category_id,
            ],
        ], 201);
    }

    /**
     * Get a single transaction
     * 
     * @authenticated
     * @urlParam id integer required Transaction ID. Example: 1
     * 
     * @response 200 {
     *   "status": "success",
     *   "data": {...}
     * }
     */
    public function show(Request $request, Transaction $transaction): JsonResponse
    {
        if ($transaction->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => (float) $transaction->amount,
                'formatted_amount' => $transaction->formatted_amount,
                'description' => $transaction->description,
                'notes' => $transaction->notes,
                'date' => $transaction->date->format('Y-m-d'),
                'formatted_date' => $transaction->formatted_date,
                'category' => $transaction->category ? [
                    'id' => $transaction->category->id,
                    'name' => $transaction->category->name,
                    'icon' => $transaction->category->icon,
                    'color' => $transaction->category->color,
                ] : null,
            ],
        ]);
    }

    /**
     * Update a transaction
     * 
     * @authenticated
     * @urlParam id integer required Transaction ID. Example: 1
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $this->transactionService->update($transaction, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil diperbarui',
            'data' => [
                'id' => $transaction->id,
                'type' => $transaction->type,
                'amount' => (float) $transaction->amount,
                'description' => $transaction->description,
            ],
        ]);
    }

    /**
     * Delete a transaction
     * 
     * @authenticated
     * @urlParam id integer required Transaction ID. Example: 1
     * 
     * @response 200 {
     *   "status": "success",
     *   "message": "Transaction deleted"
     * }
     */
    public function destroy(Request $request, Transaction $transaction): JsonResponse
    {
        if ($transaction->user_id !== $request->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 403);
        }

        $this->transactionService->delete($transaction);

        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil dihapus',
        ]);
    }

    /**
     * Get transaction statistics
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
        
        $stats = $this->transactionService->getStatistics($userId, $period);

        return response()->json([
            'status' => 'success',
            'data' => $stats,
        ]);
    }
}
