<?php

namespace Modules\Front\app\Filament\Pages; // العنوان الجديد عشان يطابق مكان الفولدر

use Filament\Pages\Page;
use Modules\Catalog\app\Models\Product; // استدعاء موديل المنتجات من موديول الكاتالوج

// class Shop extends Page
// {
//     // الأيقونة اللي هتظهر في السايد بار
//     protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

//     // العنوان اللي هيظهر في اللوحة من فوق
//     protected static ?string $title = 'المتجر الإلكتروني';

//     // السطر ده هو اللي بيربط الكود بملف الـ Blade اللي في الصورة عندك
//     protected static string $view = 'front::filament.pages.shop';

//     // الدالة دي هي اللي بتجيب المنتجات وتبعته للـ Blade عشان يتعرضوا
//     protected function getViewData(): array
//     {
//         return [
//             'products' => Product::all(),
//         ];
//     }
// }
// ...
class Shop extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    // الاسم اللي هيظهر في القائمة الجانبية (Sidebar)
    protected static ?string $navigationLabel = 'Shop'; 

    // العنوان اللي هيظهر فوق في الصفحة
    protected static ?string $title = 'Shop'; 
    
    protected static string $view = 'front::filament.pages.shop';
    // ...
    protected function getViewData(): array
    {
        return [
            'products' => Product::all(),
        ];
    }
}