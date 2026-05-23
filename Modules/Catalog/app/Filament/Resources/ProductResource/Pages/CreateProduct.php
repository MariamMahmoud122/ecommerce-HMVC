<?php

namespace Modules\Catalog\app\Filament\Resources\ProductResource\Pages;

use Modules\Catalog\app\Filament\Resources\ProductResource;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
