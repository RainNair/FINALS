<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('transactions.index'));
    Route::resource('transactions', TransactionController::class);
});

require __DIR__.'/auth.php';
