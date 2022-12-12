<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers;

use App\Tables\Columns\ActivityLog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use function App\Filament\Resources\Operation\OrderResource\RelationManagers\trans;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'Activities';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\KeyValue::make("properties.old"),
                Forms\Components\KeyValue::make("properties.attributes"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('causer.phone'),
                Tables\Columns\TagsColumn::make('causer.roles.name')
                    ->label(trans("lang.role")),
                ActivityLog::make("properties")->label(trans("lang.modified")),
                Tables\Columns\TextColumn::make('updated_at')->date("d M, Y H:i:s"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort("id","desc")
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

}
