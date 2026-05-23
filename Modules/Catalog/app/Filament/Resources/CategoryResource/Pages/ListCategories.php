<?php

namespace Modules\Catalog\app\Filament\Resources\CategoryResource\Pages;

use Modules\Catalog\app\Filament\Resources\CategoryResource;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;
class ListCategories extends ListRecords
{
    use Translatable;
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
