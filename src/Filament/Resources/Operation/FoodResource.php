<?php

namespace Sorethea\Hieat\Filament\Resources\Operation;

use App\Filament\Resources\Operation\FoodResource\Pages;
use App\Filament\Resources\Operation\FoodResource\RelationManagers;
use Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Widgets\FoodStats;
use App\Http\Livewire\Foods\Filter;
use App\Models\Food;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use FontLib\Table\Type\name;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static function getNavigationGroup(): ?string
    {
        return \trans("lang.operation");
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("name")
                        ->required(),
                    Forms\Components\BelongsToSelect::make("restaurant")
                        ->relationship('restaurant','name')
                        ->required(),
                    Forms\Components\BelongsToSelect::make("category")
                        ->relationship('category','name')
                        ->required()
                        ->createOptionForm([
                            Forms\Components\TextInput::make("name")
                                ->unique("categories","name",ignorable: fn($record)=>$record,ignoreRecord: true)
                                ->required(),
                            Forms\Components\MarkdownEditor::make("description")->nullable(),
                            Forms\Components\SpatieMediaLibraryFileUpload::make("image")
                                ->collection("image")->multiple(),
                        ]),
                    Forms\Components\BelongsToManyMultiSelect::make("extraGroups")
                        ->relationship("extraGroups","name"),
                    Forms\Components\MarkdownEditor::make("description"),
                    Forms\Components\SpatieMediaLibraryFileUpload::make("image")
                        ->collection("image"),
                ])->columnSpan(2),
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("price")
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2)),
                    Forms\Components\TextInput::make("discount_price")
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->money('$', ',', 2)),
                    Forms\Components\TextInput::make('unit'),
                    Forms\Components\TextInput::make('package_items_count'),
                    Forms\Components\TextInput::make('weight')->numeric(),
                    Forms\Components\Toggle::make("featured"),
                    Forms\Components\Toggle::make("deliverable")->default(true),
                    Forms\Components\Toggle::make("active")->default(true),
                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("image")
                    ->collection("image")
                    ->rounded(),
                Tables\Columns\TextColumn::make("name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("price")
                    ->money('usd',true),
                Tables\Columns\TextColumn::make("discount_price")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->money('usd',true),
                Tables\Columns\TextColumn::make("category.name")
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make("restaurant.name")
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\BooleanColumn::make("featured")
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make("active"),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime("M d, Y H:i:s")
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("restaurant")
                    ->relationship('restaurant','name'),
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category','name'),
                Tables\Filters\TernaryFilter::make('active')
                    ->placeholder('All')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->queries(
                        true: fn (Builder $query) => $query->where('active',true),
                        false: fn (Builder $query) => $query->where('active',false),
                        blank: fn (Builder $query) => $query,
                    ),
                Tables\Filters\Filter::make("featured")
                    ->query(fn(Builder $query)=>$query->where("featured",true))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            FoodStats::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withTrashed();
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages\ListFood::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages\CreateFood::route('/create'),
            'view' => \Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages\ViewFood::route('/{record}'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages\EditFood::route('/{record}/edit'),
        ];
    }


}
