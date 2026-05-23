<?php

namespace Modules\Catalog\app\Filament\Resources\NoneResource\Widgets;
use Filament\Widgets\ChartWidget;
use Modules\Catalog\app\Models\Category;
use Filament\Resources\Concerns\Translatable;

class ProductStats extends ChartWidget
{
      use Translatable; 
    protected static ?string $heading = 'توزيع المنتجات على الأقسام';
    
    // اختياري: لو عايزة التشارت مياخدش الصفحة كلها، ممكن تحددي عرضه
    protected static ?string $maxHeight = '300px'; 

    protected function getData(): array
    {
      
    
        $categories = Category::withCount('products')->get();


    

        return [
            'datasets' => [
                [
                    'label' => 'المنتجات حسب القسم',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => [
                        '#36A2EB', '#FF6384', '#4BC0C0', '#FFCE56', '#9966FF'
                    ],
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}