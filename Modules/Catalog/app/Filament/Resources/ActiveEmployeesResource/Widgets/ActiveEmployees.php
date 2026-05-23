<?php

namespace Modules\Catalog\app\Filament\Resources\ActiveEmployeesResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

// لا تنسي استيراد الـ Carbon لو حبيتي تستخدميه في تواريخ متقدمة
use Illuminate\Support\Carbon;

class ActiveEmployees extends BaseWidget
{
     protected int | string | array $columnSpan = 3;
    
   
}
     
   