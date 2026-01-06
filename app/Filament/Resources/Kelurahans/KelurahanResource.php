<?php

namespace App\Filament\Resources\Kelurahans;

use App\Filament\Resources\Kelurahans\Pages\CreateKelurahan;
use App\Filament\Resources\Kelurahans\Pages\EditKelurahan;
use App\Filament\Resources\Kelurahans\Pages\ListKelurahans;
use App\Filament\Resources\Kelurahans\Schemas\KelurahanForm;
use App\Filament\Resources\Kelurahans\Tables\KelurahansTable;
use App\Models\Kelurahan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KelurahanResource extends Resource
{
    protected static ?string $model = Kelurahan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Service';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return KelurahanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelurahansTable::configure($table);
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
            'index' => ListKelurahans::route('/'),
            'create' => CreateKelurahan::route('/create'),
            'edit' => EditKelurahan::route('/{record}/edit'),
        ];
    }
}
