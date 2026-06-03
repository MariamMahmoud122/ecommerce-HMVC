<?php

namespace Modules\Catalog\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
// 1️⃣ استدعاء الـ Provider بتاع Socialite
use Laravel\Socialite\SocialiteServiceProvider; 

abstract class CatalogTestCase extends BaseTestCase
{
    /**
     * شحن الـ Providers الخدمية للمعمل الوهمي
     */
    protected function getPackageProviders($app)
    {
        // 2️⃣ نضع سوسيالايت هنا عشان الـ Controller يشوفها وميضربش
        return [
            SocialiteServiceProvider::class,
        ];
    }

    /**
     * إعداد بيئة العمل الوهمية بالكامل
     */
    protected function defineEnvironment($app)
    {
        $app['config']->set('app.key', 'base64:UTBlYm9vazIwMjZfTWFyaWFtX0htdmNfVGVzdF9LZXk=');

        // إعداد الداتابيز الوهمية في الرام
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        // حقن ملف الـ Routes بتاع الكاتالوج
        $pathToRoutes = __DIR__ . '/../routes/web.php';
        
        if (!file_exists($pathToRoutes)) {
            $pathToRoutes = __DIR__ . '/../Routes/web.php';
        }

        if (file_exists($pathToRoutes)) {
            $app['router']->middleware('web')->group($pathToRoutes);
        }

        // 3️⃣ إعدادات وهمية لجوجل سوسيالايت عشان الحزمة متشتكيش من غياب الـ Credentials
        $app['config']->set('services.google', [
            'client_id'     => 'mock-id',
            'client_secret' => 'mock-secret',
            'redirect'      => '/auth/google/callback',
        ]);
    }
}