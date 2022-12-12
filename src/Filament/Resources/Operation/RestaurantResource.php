<?php

namespace Sorethea\Hieat\Filament\Resources\Operation;

use App\Filament\Resources\Operation\RestaurantResource\Pages;
use App\Filament\Resources\Operation\RestaurantResource\RelationManagers;
use App\Models\Restaurant;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function App\Filament\Resources\Operation\trans;

class RestaurantResource extends Resource
{
    protected static ?string $model = Restaurant::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static function getNavigationGroup(): ?string
    {
        return trans("lang.operation");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make("name")
                            ->unique("restaurant","name",ignorable: fn($record)=>$record,ignoreRecord: true)
                            ->required(),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\BelongsToManyMultiSelect::make("cuisines")
                                ->relationship("cuisines","name")
                                ->required(),
                            Forms\Components\BelongsToManyMultiSelect::make("users")
                                ->label(trans("lang.restaurant_users"))
                                ->relationship("users","name")
                                ->required(),
                        ])->columns(2),

                        Forms\Components\Group::make()->schema([
                            Forms\Components\TextInput::make("phone")
                                ->required(),
                            Forms\Components\TextInput::make("mobile"),
                        ])->columns(2),
                        Forms\Components\TextInput::make("address")
                            ->required(),
                        Forms\Components\Group::make()->schema([
                            Forms\Components\TextInput::make("latitude")
                                ->required(),
                            Forms\Components\TextInput::make("longitude")
                                ->required(),
                        ])->columns(2),
                        Forms\Components\SpatieMediaLibraryFileUpload::make("logo")
                            ->collection("logo")
                            ->required(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make("image")
                            ->collection("image"),
                        Forms\Components\MarkdownEditor::make("description"),
                        Forms\Components\MarkdownEditor::make("information"),
                    ])
                    ->columnSpan(['lg' => 2]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(trans("lang.admin_area"))
                            ->schema([
                                Forms\Components\TextInput::make("default_tax")->default(0),
                                Forms\Components\TextInput::make("service_charge")->default(0),
                                Forms\Components\TextInput::make("packaging_fee")->default(0),
                                Forms\Components\TextInput::make("admin_commission")->default(0),
                                Forms\Components\TextInput::make("admin_commission_tax")->default(0),
                                Forms\Components\Toggle::make("available_for_delivery")->default(true),
                                Forms\Components\Toggle::make("closed")->default(false),
                                Forms\Components\Toggle::make("active")->default(true),
                                Forms\Components\TimePicker::make("open_at")->default("10:00 AM")->displayFormat("H:i")->format("H:i"),
                                Forms\Components\TimePicker::make("close_at")->default("10:00 PM")->displayFormat("H:i")->format("H:i"),
                            ])->collapsible(false),
                    ])
                    ->columnSpan(['lg'=>1]),
            ])->columns(3);
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
                Tables\Columns\BooleanColumn::make("available_for_delivery")->label(trans('lang.food_deliverable')),
                Tables\Columns\BooleanColumn::make("closed"),
                Tables\Columns\BooleanColumn::make("active"),
                Tables\Columns\TextColumn::make("created_at")->dateTime("M d, Y H:i:s"),
            ])
            ->filters([
                //
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy("created_at","desc");
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource\Pages\ListRestaurants::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource\Pages\CreateRestaurant::route('/create'),
            'view' => \Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource\Pages\ViewRestaurant::route('/{record}'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource\Pages\EditRestaurant::route('/{record}/edit'),
        ];
    }    
}
