<?php

namespace Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages;

use Sorethea\Hieat\Filament\Resources\Settings\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
