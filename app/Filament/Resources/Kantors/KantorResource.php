<?php

namespace App\Filament\Resources\Kantors;

use App\Filament\Resources\Kantors\Pages\CreateKantor;
use App\Filament\Resources\Kantors\Pages\EditKantor;
use App\Filament\Resources\Kantors\Pages\ListKantors;
use App\Filament\Resources\Kantors\Schemas\KantorForm;
use App\Filament\Resources\Kantors\Tables\KantorsTable;
use App\Models\Kantor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KantorResource extends Resource
{
    protected static ?string $model = Kantor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static string | UnitEnum | null $navigationGroup = 'Petugas';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return KantorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KantorsTable::configure($table);
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
            'index' => ListKantors::route('/'),
            'create' => CreateKantor::route('/create'),
            'edit' => EditKantor::route('/{record}/edit'),
        ];
    }
}
