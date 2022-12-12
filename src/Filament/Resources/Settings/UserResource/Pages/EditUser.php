<?php

namespace Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages;

use Sorethea\Hieat\Filament\Resources\Settings\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
