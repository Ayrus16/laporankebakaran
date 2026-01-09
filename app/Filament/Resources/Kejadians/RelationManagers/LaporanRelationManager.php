<?php

namespace App\Filament\Resources\Kejadians\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Schemas\Schema;
use App\Filament\Resources\Laporans\Schemas\LaporanInfolist;

class LaporanRelationManager extends RelationManager
{
    protected static string $relationship = 'laporans';
    protected static ?string $title = 'Laporan';

    /**
     * Kunci: matikan semua kemampuan mutasi data
     */

    protected function canDetach($record): bool
    {
        return false;
    }

    protected function canDetachAny(): bool
    {
        return false;
    }
    protected function canCreate(): bool 
    {
        return false; 
    }
    protected function canEdit($record): bool 
    { 
        return false; 
    }
    protected function canDelete($record): bool 
    { 
        return false; 
    }
    protected function canAttach(): bool 
    { 
        return false; 
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('namaPelapor')
            ->columns([
                TextColumn::make('namaPelapor')->label('Pelapor')->searchable(),
                TextColumn::make('tlpPelapor')->label('Telepon')->searchable(),
                TextColumn::make('alamat')->label('Alamat')->limit(40),
            ])
            ->headerActions([
                
            ])

            ->actions([
                ViewAction::make()
                    ->label('Detail')
                    ->infolist(fn (Schema $schema): Schema => LaporanInfolist::configure($schema)),
            ])
            ->bulkActions([

            ]);
    }
}
