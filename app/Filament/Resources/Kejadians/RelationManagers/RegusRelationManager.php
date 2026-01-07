<?php

namespace App\Filament\Resources\Kejadians\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RegusRelationManager extends RelationManager
{
    protected static string $relationship = 'regus';
    protected static ?string $title = 'Regu';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('namaRegu')
            ->columns([
                TextColumn::make('namaRegu')->label('Nama Regu')->searchable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Tambah Regu')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['namaRegu']),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                DetachBulkAction::make(),
                ]),
            ]);
    }
}
