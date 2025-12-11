<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard/transaksi', function () {
    return view('dashboard.transaksi');
})->name('transaksi');

Route::get('/dashboard/kategori', function () {
    return view('dashboard.kategori');
})->name('kategori');

Route::get('/dashboard/budget', function () {
    return view('dashboard.budget');
})->name('budget');

Route::get('/dashboard/laporan', function () {
    return view('dashboard.laporan');
})->name('laporan');

Route::get('/dashboard/pengaturan', function () {
    return view('dashboard.pengaturan');
})->name('pengaturan');

Route::get('/dashboard/profil', function () {
    return view('dashboard.profil');
})->name('profil');

Route::resource('users', UserController::class);

Route::get('/login', [AuthController::class, 'ShowLogin'])->name('login');
Route::post('/login', [AuthController::class, 'Login'])->name('login.post');
Route::get('/register', [AuthController::class, 'ShowRegister'])->name('register');
Route::post('/register', [AuthController::class, 'Register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');

