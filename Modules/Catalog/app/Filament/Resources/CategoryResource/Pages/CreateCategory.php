<?php

namespace Modules\Catalog\app\Filament\Resources\CategoryResource\Pages;

use Modules\Catalog\app\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

 
    public static function getResource(): string
    {
        return CategoryResource::class;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}