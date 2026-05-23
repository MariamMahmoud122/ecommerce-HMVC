<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Modules\Front\app\Livewire\Register;
use Modules\Front\app\Livewire\Login;
use Modules\Front\app\Livewire\CartPage;
use Modules\Front\app\Livewire\ShopPage;
use Modules\Catalog\app\Models\Product;
use Modules\Front\app\Http\Controllers\ShopController;



 Route::get('/', [ShopController::class/* وبكدا لازم نكتب النيم اسبس فوق*/, 'index'])->name('home');

Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/cart', CartPage::class)->name('cart');

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

Route::post('/logout-manual', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout.manual');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('fronts', ShopController::class)->names('front');
});
