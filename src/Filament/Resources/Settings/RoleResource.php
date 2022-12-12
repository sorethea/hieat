<?php

namespace Sorethea\Hieat\Filament\Resources\Settings;

use Sorethea\Hieat\Filament\Resources\RoleResource\RelationManagers\PermissionsRelationManager;
use App\Filament\Resources\Settings\RoleResource\Pages;
use App\Filament\Resources\Settings\RoleResource\RelationManagers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyThroughRelationManager;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
use function App\Filament\Resources\Settings\trans;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static function getNavigationGroup(): ?string
    {
        return trans("lang.setting");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->unique("roles","name",ignorable: fn($record)=>$record, ignoreRecord: true)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make('permissions_count')
                    ->label(trans('lang.permission_plural'))
                    ->counts('permissions'),
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
            PermissionsRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Settings\RoleResource\Pages\ListRoles::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Settings\RoleResource\Pages\CreateRole::route('/create'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Settings\RoleResource\Pages\EditRole::route('/{record}/edit'),
        ];
    }    
}
