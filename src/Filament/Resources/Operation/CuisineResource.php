<?php

namespace Sorethea\Hieat\Filament\Resources\Operation;

use App\Filament\Resources\Operation\CuisineResource\Pages;
use App\Filament\Resources\Operation\CuisineResource\RelationManagers;
use App\Models\Cuisine;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CuisineResource extends Resource
{
    protected static ?string $model = Cuisine::class;

    protected static ?string $navigationIcon = 'heroicon-o-view-grid';

    protected static function getNavigationGroup(): ?string
    {
        return \trans("lang.operation");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("name")->unique("cuisines",ignorable: fn($record)=>$record,ignoreRecord: true)->required(),
                    Forms\Components\SpatieMediaLibraryFileUpload::make("image")->collection("image"),
                    Forms\Components\MarkdownEditor::make("description"),
                ])->columnSpan(2),
                Forms\Components\Card::make()->schema([
                    Forms\Components\Toggle::make("active")->default(true),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("image")->collection("image")->rounded(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("restaurants_count")->label(\trans("lang.restaurant_plural"))->counts("restaurants"),
                Tables\Columns\BooleanColumn::make("active"),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            \Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\RelationManagers\RestaurantsRelationManager::class,
            \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers\ActivitiesRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages\ListCuisines::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages\CreateCuisine::route('/create'),
            //'view' => \Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages\ViewCuisine::route('/{record}'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages\EditCuisine::route('/{record}/edit'),
        ];
    }    
}
