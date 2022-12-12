<?php

namespace Sorethea\Hieat\Filament\Resources\Settings;

use Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages;
use Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\RelationManagers;
use App\Tables\Columns\ActivityLog;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Activitylog\Models\Activity;


class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-switch-vertical';

    protected static function getNavigationGroup(): ?string
    {
        return \trans("lang.setting");
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("log_name"),
                Forms\Components\TextInput::make("description"),
                Forms\Components\TextInput::make("subject_id"),
                Forms\Components\TextInput::make("subject_type"),
                Forms\Components\TextInput::make("causer_id"),
                Forms\Components\TextInput::make("causer_type"),
                Forms\Components\KeyValue::make("properties.old")->visibleOn('view'),
                Forms\Components\KeyValue::make("properties.attributes")->visibleOn('view'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("log_name")->searchable(),
                Tables\Columns\TextColumn::make("description")->searchable(),
                Tables\Columns\TextColumn::make("subject_type")->searchable(),
                Tables\Columns\TextColumn::make("subject_id")->searchable(),
                Tables\Columns\TextColumn::make("causer.phone")->searchable(),
                ActivityLog::make("properties")->label(\trans("lang.modified")),
                Tables\Columns\TextColumn::make("created_at")->dateTime('M d, Y H:i:s'),
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
            'index' => \Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages\ListActivities::route('/'),
            'create' => \Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages\CreateActivity::route('/create'),
            'view' => \Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages\ViewActivity::route('/{record}'),
            'edit' => \Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages\EditActivity::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy("created_at","desc");
    }
}
