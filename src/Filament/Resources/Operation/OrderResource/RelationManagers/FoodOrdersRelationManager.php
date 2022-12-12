<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function App\Filament\Resources\Operation\OrderResource\RelationManagers\\trans;

class FoodOrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'foodOrders';

    protected static ?string $recordTitleAttribute = 'food';

    public static function getTitle(): string
    {
        return \trans("lang.food_plural");
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('food.name')->searchable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make("price")->money("usd",true),
                Tables\Columns\TextColumn::make("subtotal")->money("usd",true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
