<?php

namespace App\Filament\Resources\Korbans;

use App\Filament\Resources\Korbans\Pages\CreateKorban;
use App\Filament\Resources\Korbans\Pages\EditKorban;
use App\Filament\Resources\Korbans\Pages\ListKorbans;
use App\Filament\Resources\Korbans\Pages\ViewKorban;
use App\Filament\Resources\Korbans\Schemas\KorbanForm;
use App\Filament\Resources\Korbans\Schemas\KorbanInfolist;
use App\Filament\Resources\Korbans\Tables\KorbansTable;
use App\Models\Korban;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KorbanResource extends Resource
{
    protected static ?string $model = Korban::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static string | UnitEnum | null $navigationGroup = 'Kebakaran';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return KorbanForm::configure($schema);
    }
    public static function getNavigationLabel(): string
    {
        return 'Korban';
    }

    public static function infolist(Schema $schema): Schema
    {
        return KorbanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KorbansTable::configure($table);
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
            'index' => ListKorbans::route('/'),
            'create' => CreateKorban::route('/create'),
            'view' => ViewKorban::route('/{record}'),
            'edit' => EditKorban::route('/{record}/edit'),
        ];
    }
}
