<?php

namespace Modules\Sales\app\Filament\Resources\OrderResource\Pages;

use Modules\Sales\app\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
            Actions\CreateAction::make(),
        ];
    }
}