<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class RestaurantsRelationManager extends RelationManager
{
    protected static string $relationship = 'restaurants';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("image")
                    ->collection("image")
                    ->rounded(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("phone")->searchable(),
                Tables\Columns\BooleanColumn::make("available_for_delivery")->label(\trans('lang.food_deliverable')),
                Tables\Columns\BooleanColumn::make("closed"),
                Tables\Columns\BooleanColumn::make("active"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
