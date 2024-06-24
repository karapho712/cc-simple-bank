<?php

use App\Http\Controllers\API\TransactionControllerApi;
use App\Http\Middleware\Base64FullNameMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['api', Base64FullNameMiddleware::class])->prefix('v1')->group(function () {
    Route::get('/history', [TransactionControllerApi::class, 'history'])->name('api.history');
    Route::post('/deposit', [TransactionControllerApi::class, 'deposit'])->name('api.deposit');
    Route::post('/withdrawal', [TransactionControllerApi::class, 'withdrawal'])->name('api.withdrawal');

});
