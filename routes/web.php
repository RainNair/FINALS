<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('transactions.index')
    : redirect()->route('login'))
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('transactions', TransactionController::class);
});

require __DIR__.'/auth.php';
