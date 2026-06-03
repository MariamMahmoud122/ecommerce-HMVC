<?php

use Illuminate\Support\Facades\Route;
use Modules\Catalog\Http\Controllers\CatalogController;
use Modules\Catalog\app\Models\Category; 

use Modules\Catalog\app\Http\Controllers\Auth\SocialiteController;
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('catalogs', CatalogController::class)->names('catalog');
});

Route::get('/category/{slug}', function ($slug) {
    // بنقول للسيستم روح دور في جدول الـ categories على السجل اللي الـ slug بتاعه بيساوي الكلمة اللي في الرابط
    $category = Category::where('slug', $slug)->firstOrFail();
    
    return "<h3>🚀 مبروك يا مريم! الرابط شغال 100% والـ Slug مقروء صح.</h3>
            <p>إنتي واقفة دلوقتي في صفحة قسم: <b>" . $category->getTranslation('name', 'ar') . "</b></p>";
})->name('catalog.categories.show');

// مسار بيوجّه المستخدم لصفحة جوجل
Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');

// مسار جوجل بترجع لنا عليه بعد ما المستخدم يوافق
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);