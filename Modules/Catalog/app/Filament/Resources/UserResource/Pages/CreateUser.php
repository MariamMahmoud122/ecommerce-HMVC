<?php

namespace Modules\Catalog\app\Filament\Resources\UserResource\Pages;

use Modules\Catalog\app\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
