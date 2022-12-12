<?php

namespace Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\Pages;

use Sorethea\Hieat\Filament\Resources\Settings\PermissionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
