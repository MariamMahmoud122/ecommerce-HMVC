<?php

namespace Modules\Catalog\app\Filament\Resources\CategoryResource\Pages;

use Modules\Catalog\app\Filament\Resources\CategoryResource;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
class EditCategory extends EditRecord
{
     use Translatable;
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
    
}
