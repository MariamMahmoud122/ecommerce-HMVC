<?php

namespace Modules\Front\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Catalog\app\Models\Product;

class ShopController extends Controller
{
   public function index(Request $request)
{
    $products = Product::query()
        ->when($request->category, function ($query, $category) {
            // بنفلتر عن طريق العلاقة والـ Slug اللي جاي من الـ URL
            return $query->whereHas('category', function($q) use ($category) {
                $q->where('slug', $category);
            });
        })
        ->latest()
        ->paginate(12);

    return view('front::index', compact('products')); 
}

    
}