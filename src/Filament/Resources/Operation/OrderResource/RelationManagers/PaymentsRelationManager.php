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

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')->label(\trans("lang.payment")),
                Tables\Columns\TextColumn::make("method"),
                Tables\Columns\TextColumn::make("status"),
                Tables\Columns\TextColumn::make("price")
                    ->money('usd',true)
                    ->label(\trans("lang.payment_amount")),

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
