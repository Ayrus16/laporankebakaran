<?php

namespace App\Filament\Resources\Kejadians;

use App\Filament\Resources\Kejadians\Pages\CreateKejadian;
use App\Filament\Resources\Kejadians\Pages\EditKejadian;
use App\Filament\Resources\Kejadians\Pages\ListKejadians;
use App\Filament\Resources\Kejadians\Pages\ViewKejadian;
use App\Filament\Resources\Kejadians\Schemas\KejadianForm;
use App\Filament\Resources\Kejadians\Schemas\KejadianInfolist;
use App\Filament\Resources\Kejadians\Tables\KejadiansTable;
use App\Models\Kejadian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KejadianResource extends Resource
{
    protected static ?string $model = Kejadian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;

    protected static string | UnitEnum | null $navigationGroup = 'Kebakaran';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return KejadianForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KejadianInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KejadiansTable::configure($table);
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
            'index' => ListKejadians::route('/'),
            'create' => CreateKejadian::route('/create'),
            'view' => ViewKejadian::route('/{record}'),
            'edit' => EditKejadian::route('/{record}/edit'),
        ];
    }
}
