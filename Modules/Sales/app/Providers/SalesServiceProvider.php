<?php

namespace Modules\Sales\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

use Modules\Sales\app\Livewire\Sales\Checkout;
class SalesServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Sales';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'sales';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    // protected array $commands = [];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Define module schedules.
     * 
     * @param $schedule
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }


    public function boot(): void
    {
        parent::boot();

        // تسجيل الكومبوننت باسم مختصر عشان لايف واير يلاقيه وقت الـ Update
        \Livewire\Livewire::component('sales::checkout', Checkout::class);
    }
}
