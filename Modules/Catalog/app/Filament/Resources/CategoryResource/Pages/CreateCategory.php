<?php

namespace Modules\Catalog\app\Filament\Resources\CategoryResource\Pages;

use Modules\Catalog\app\Filament\Resources\CategoryResource;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;
class CreateCategory extends CreateRecord
{
     use Translatable;
    protected static string $resource = CategoryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(), 
            
        ];
    }
}
