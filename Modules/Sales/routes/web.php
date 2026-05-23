<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\app\Livewire\Sales\Checkout;

use Modules\Sales\Http\Controllers\SalesController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sales', SalesController::class)->names('sales');
});



    Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/lang/{locale}', function ($locale) {

    if (in_array($locale, ['ar', 'en'])) {

        session()->put('locale', $locale);
    }

    return back();
});