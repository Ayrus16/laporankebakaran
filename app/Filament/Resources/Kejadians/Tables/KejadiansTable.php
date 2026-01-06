<?php

namespace App\Filament\Resources\Kejadians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KejadiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('idKelurahan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('idKecamatan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('idLaporan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('idKorban')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('idRegu')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('LokasiKejadian')
                    ->searchable(),
                TextColumn::make('luasTerbakar')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tanggalKejadian')
                    ->date()
                    ->sortable(),
                TextColumn::make('waktuPenanganan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('waktuSelesai')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('tafsiranKerugian')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fotoKejadian')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
