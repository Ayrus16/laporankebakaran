<?php

namespace App\Filament\Resources\Laporans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaporansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('namaPelapor')
                    ->label('Nama Pelapor')
                    ->searchable(),
                TextColumn::make('tlpPelapor')
                    ->label('Nomor Pelapor')
                    ->searchable(),
                TextColumn::make('alamat')
                    ->placeholder('Alamat Kejadian')
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('fotoLaporan'),
                TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'gray',
                        'penanganan' => 'warning',
                        'selesai' => 'success',
                        'ditolak' => 'danger',
                    })                    
                ->searchable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
