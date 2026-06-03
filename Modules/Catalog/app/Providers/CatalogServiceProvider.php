<?php

namespace Modules\Catalog\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class CatalogServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Catalog';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'catalog';

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

    public function boot(): void
    {
        // تشغيل الـ boot الأصلي بتاع الحزمة
        parent::boot();

        // لو إحنا جوه الـ Testbench (بيئة الـ Testing)، نلقم الملفات يدويًا
        if ($this->app->runningInConsole() && app()->environment('testing')) {
            // شحن الـ Routes (تأكدي من حالة الأحرف للفولدر Routes أو routes)
            if (file_exists(__DIR__ . '/../routes/web.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            } elseif (file_exists(__DIR__ . '/../Routes/web.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
            }

            // شحن الـ Migrations
            if (is_dir(__DIR__ . '/../database/migrations')) {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            }
        }
    }
    /**
     * Define module schedules.
     * 
     * @param $schedule
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}
