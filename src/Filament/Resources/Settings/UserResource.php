<?php

namespace Sorethea\Hieat\Filament\Resources\Settings;

use Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages;
use Sorethea\Hieat\Filament\Resources\Settings\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use function Sorethea\Hieat\Filament\Resources\Settings\trans;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static function getNavigationGroup(): ?string
    {
        return trans("lang.setting");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("name")
                    ->required(),
                Forms\Components\TextInput::make("phone")
                    ->required()
                    ->unique("users","phone",ignorable: fn($record)=>$record)
                    ->rule("digits_between:9,10")
                    ->mask(fn(Forms\Components\TextInput\Mask $mask)=>$mask->pattern('{0}00 000-0000')),
                Forms\Components\TextInput::make("password")
                    ->password()
                    ->required()
                    ->visibleOn("create")
                    ->same("password_confirmation"),
                Forms\Components\TextInput::make("password_confirmation")
                    ->password()
                    ->visibleOn("create")
                    ->required(),
                Forms\Components\BelongsToManyCheckboxList::make("roles")
                    ->relationship("roles","name")
                    ->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make("avatar")
                    ->collection('avatar')
                    ->image(),
                Forms\Components\Toggle::make("active"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("avatar")
                    ->collection("avatar")
                    ->rounded(),
                Tables\Columns\TextColumn::make("phone")->searchable(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("roles.name")->searchable(),
                Tables\Columns\BooleanColumn::make("active"),
                Tables\Columns\TextColumn::make("created_at")->dateTime('M d, Y H:i:s')->toggleable(),

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
    
    public static function getPages(): array
    {
        return [
            'index' => \Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages\ListUsers::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages\CreateUser::route('/create'),
            'view' => \Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages\ViewUser::route('/{record}'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Settings\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope("active")->orderBy("created_at","desc");
    }
}
