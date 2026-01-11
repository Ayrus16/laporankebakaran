<?php

namespace App\Filament\Resources\Kejadians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class KejadiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kantor.namaKantor')
                    ->label('Kantor Terdekat')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('LokasiKejadian')
                    ->searchable(),
                TextColumn::make('luasTerbakar')
                    ->numeric()
                    ->suffix(' m²')
                    ->sortable(),
                TextColumn::make('tanggalKejadian')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'penanganan' => 'warning',
                        'selesai'    => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('kantor_id') 
                    ->label('Kantor Terdekat')
                    ->relationship('kantor', 'namaKantor')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'penanganan' => 'Penanganan',
                        'selesai'    => 'Selesai',
                    ])
                    ->native(false),
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
