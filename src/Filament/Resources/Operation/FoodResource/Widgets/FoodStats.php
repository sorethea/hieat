<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Widgets;

use App\Models\Food;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Symfony\Component\Console\Input\Input;


class FoodStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected function getColumns(): int
    {
        return 3;
    }

    protected function  getCards(): array{

        return [
            Card::make(\trans("lang.food_plural"), Food::count())
                ->description(\trans("lang.inactive")." ".\trans("lang.food_plural").": ".Food::where("active",false)->count())
                ->descriptionIcon("heroicon-s-ban")
                ->color("danger"),
        ];

    }
}
