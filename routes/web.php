<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('landing');
});

// Guest Routes (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'ShowLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'Login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'ShowRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'Register'])->name('register.post');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');

    // Dashboard
    Route::prefix('dashboard')->group(function () {
        // Main Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Transactions (Transaksi)
        Route::resource('transaksi', TransactionController::class);
        Route::get('transaksi-filter', [TransactionController::class, 'filter'])->name('transaksi.filter');

        // Categories (Kategori)
        Route::resource('kategori', CategoryController::class);
        Route::get('kategori-filter', [CategoryController::class, 'filter'])->name('kategori.filter');

        // Budget
        Route::resource('budget', BudgetController::class);

        // Reports (Laporan)
        Route::get('laporan', [ReportController::class, 'index'])->name('laporan');

        // Settings (Pengaturan)
        Route::get('pengaturan', function () {
            return view('dashboard.pengaturan');
        })->name('pengaturan');

        // Profile (Profil)
        Route::get('profil', function () {
            return view('dashboard.profil');
        })->name('profil');
    });
});
