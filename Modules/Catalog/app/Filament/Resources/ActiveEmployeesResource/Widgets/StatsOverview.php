<?php

namespace Modules\Catalog\app\Filament\Resources\NoResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Modules\Catalog\app\Models\Product;
use Modules\Sales\app\Models\Order;

class StatsOverview extends BaseWidget
{


   protected int | string | array $columnSpan = 3;
    protected function getStats(): array
{
    $chartData = collect(range(0, 15))
            ->map(fn ($days) => User::whereDate('created_at', now()->subDays($days))->count())
            ->reverse()
            ->values()
            ->toArray();

      


$ordersChart = collect(range(0, 15))
            ->map(fn ($days) => Order::whereDate('created_at', now()->subDays($days))->count())
            ->reverse()
            ->values()
            ->toArray();
    return [
        Stat::make('Total products', product::count())
            ->description('Total products in store')
            ->descriptionIcon('heroicon-m-shopping-bag')
            ->color('success'),

        Stat::make('New Orders', Order::count())
                ->description('all orders ')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart($ordersChart)
                ->color('warning')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-shadow duration-300 rounded-xl border-t-4 border-yellow-500',
                ]),
         Stat::make('Active User', User::whereNotNull('email_verified_at')->count())
                ->description('Verified Active Users')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($chartData)
                ->color('success')
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:shadow-lg transition-shadow duration-300 rounded-xl border-t-4 border-maroon-800',
                ]),
    ];
}
}
