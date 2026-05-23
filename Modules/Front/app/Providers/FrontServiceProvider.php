<?php

namespace Modules\Front\app\Providers;

use Livewire\Livewire;
use Modules\Front\app\Providers\EventServiceProvider; 
use Modules\Front\app\Providers\RouteServiceProvider;
use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class FrontServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'Front';
    protected string $nameLower = 'front';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function boot(): void
    {
        
        parent::boot();
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'front');
        Livewire::component('shop-page', \Modules\Front\app\Livewire\ShopPage::class);  
        Livewire::component('add-to-cart', \Modules\Front\App\Livewire\AddToCart::class);
        Livewire::component('cart-counter', \Modules\Front\App\Livewire\CartCounter::class);
        Livewire::component('front-register', \Modules\Front\app\Livewire\Register::class);
       
        Livewire::component('front-cart-page', \Modules\Front\app\Livewire\CartPage::class);
       
        Livewire::component('login', \Modules\Front\app\Livewire\Login::class);
    }

    public function register(): void
    {
        parent::register();
    }
}