<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'authenticate']);
});
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.data-table');
    })->name('dashboard');

    Route::get('/deposit', [TransactionController::class, 'deposit_index'])->name('deposit.index');
    Route::get('/withdraw', [TransactionController::class, 'withdraw_index'])->name('withdraw.index');

});
