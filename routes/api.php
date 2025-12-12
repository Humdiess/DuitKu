<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BudgetController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| All API routes are prefixed with /api
| Authentication uses Laravel Sanctum Bearer tokens
|
*/

// Public routes (no authentication required)
Route::prefix('v1')->group(function () {
    // Auth routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
});

// Protected routes (authentication required)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'user']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);

    // Transactions
    Route::apiResource('transactions', TransactionController::class);
    Route::get('/transactions-stats', [TransactionController::class, 'stats']);

    // Categories
    Route::apiResource('categories', CategoryController::class);
    Route::get('/categories-breakdown', [CategoryController::class, 'breakdown']);

    // Budgets
    Route::apiResource('budgets', BudgetController::class);
    Route::get('/budgets-summary', [BudgetController::class, 'summary']);

    // Reports
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/monthly', [ReportController::class, 'monthly']);
    Route::get('/reports/category-breakdown', [ReportController::class, 'categoryBreakdown']);
    Route::get('/reports/daily-trend', [ReportController::class, 'dailyTrend']);
});
