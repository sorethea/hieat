<?php

namespace Sorethea\Hieat\Filament\Resources\Settings;

use Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\Pages;
use Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Permission;


class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-open';

    protected static function getNavigationGroup(): ?string
    {
        return \trans("lang.setting");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->unique("permissions","name",ignorable: fn($record)=>$record, ignoreRecord: true)
                    ->required(),
                Forms\Components\BelongsToManyCheckboxList::make("roles")
                    ->relationship("roles","name"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("roles_count")
                    ->counts('roles'),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime("M d, Y H:i:s")
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
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
    
    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\Pages\ListPermissions::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\Pages\CreatePermission::route('/create'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Settings\PermissionResource\Pages\EditPermission::route('/{record}/edit'),
        ];
    }    
}
