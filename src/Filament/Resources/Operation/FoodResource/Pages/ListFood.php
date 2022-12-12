<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\FoodResource;
use Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Widgets\FoodStats;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFood extends ListRecords
{
    protected static string $resource = FoodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Widgets\FoodStats::class,
        ];
    }
}
