<?php

namespace App\Filament\Resources\Regus;

use App\Filament\Resources\Regus\Pages\CreateRegu;
use App\Filament\Resources\Regus\Pages\EditRegu;
use App\Filament\Resources\Regus\Pages\ListRegus;
use App\Filament\Resources\Regus\Schemas\ReguForm;
use App\Filament\Resources\Regus\Tables\RegusTable;
use App\Models\Regu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ReguResource extends Resource
{
    protected static ?string $model = Regu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string | UnitEnum | null $navigationGroup = 'Petugas';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ReguForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Regu';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegus::route('/'),
            'create' => CreateRegu::route('/create'),
            'edit' => EditRegu::route('/{record}/edit'),
        ];
    }
}
