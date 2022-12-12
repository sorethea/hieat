<?php

namespace Sorethea\Hieat\Filament\Resources\Settings\RoleResource\Pages;

use Sorethea\Hieat\Filament\Resources\Settings\RoleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
