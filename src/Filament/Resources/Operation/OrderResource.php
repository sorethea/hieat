<?php

namespace Sorethea\Hieat\Filament\Resources\Operation;
use App\Filament\Resources\Operation\OrderResource\Pages;
use App\Filament\Resources\Operation\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static function getNavigationGroup(): ?string
    {
        return \trans("lang.operation");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\Group::make([
                        Forms\Components\TextInput::make("id")->label(\trans("lang.order_id"))->disabled(true),
                        Forms\Components\BelongsToSelect::make("orderStatus")->relationship("orderStatus","status"),
                        ])->columns(2),
                    Forms\Components\BelongsToSelect::make("delivery_address")->relationship("deliveryAddress","formatted_address"),
                    Forms\Components\MarkdownEditor::make("hint"),
                    Forms\Components\Fieldset::make("Client")
                        ->relationship("user")
                        ->schema([
                            Forms\Components\TextInput::make("name"),
                            Forms\Components\TextInput::make("phone"),
                        ])->visibleOn("view"),
                    Forms\Components\Fieldset::make("Driver")
                        ->relationship("driver")
                        ->schema([
                            Forms\Components\TextInput::make("name"),
                            Forms\Components\TextInput::make("phone"),
                        ])->visibleOn("view"),
                    Forms\Components\Fieldset::make("Restaurant")
                        ->relationship("restaurant")
                        ->schema([
                            Forms\Components\TextInput::make("name"),
                            Forms\Components\TextInput::make("phone"),
                            Forms\Components\TextInput::make("address")->columnSpan(2),
                        ])->visibleOn("view"),
                ])->columnSpan(2),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Card::make([
                        Forms\Components\TextInput::make("total")->prefix("$")->label(\trans('lang.order_total')),
                        Forms\Components\TextInput::make("delivery_fee")->prefix("$"),
                        Forms\Components\Toggle::make("active"),
                        Forms\Components\DateTimePicker::make("created_at"),
                        Forms\Components\DateTimePicker::make("updated_at"),

                    ]),
                ])->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")->label(\trans("lang.order_id"))->prefix("#")->searchable(),
                Tables\Columns\BadgeColumn::make("orderStatus.status")->colors([
                    "danger"=>"Order Placed",
                    "warning"=>"Accepted",
                    "primary"=>"Now Ready",
                    "secondary"=>"On the way",
                    "success"=>"Delivered",
                ])->searchable(),
                Tables\Columns\TextColumn::make("user.phone")->label(\trans('lang.order_client_phone'))->searchable(),
                Tables\Columns\TextColumn::make("driver.phone")->label(\trans('lang.order_driver_phone'))->searchable(),
                Tables\Columns\TextColumn::make("properties.contact_number")->label(\trans('lang.order_contact_number')),
                Tables\Columns\TextColumn::make("restaurant.name")->searchable(),
                Tables\Columns\TextColumn::make("total")->money("usd",true)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("delivery_fee")->money("usd",true)->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("created_at")->dateTime("M d, Y H:i:s")->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BooleanColumn::make("active"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers\FoodOrdersRelationManager::class,
            \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers\PaymentsRelationManager::class,
            \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\RelationManagers\ActivitiesRelationManager::class,
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with("user")
            ->with("restaurant")
            ->with("driver")
            ->with("deliveryAddress")
            ->orderBy("id","desc");
    }

    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\Pages\ListOrders::route('/'),
            //'create' => Pages\CreateOrder::route('/create'),
            'view' => \Sorethea\Hieat\Filament\Resources\Operation\OrderResource\Pages\ViewOrder::route('/{record}'),
            //'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::where('order_status_id', 1)->where("active",true)->count();
    }
}
