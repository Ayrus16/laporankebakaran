<?php

namespace App\Filament\Resources\Kejadians\RelationManagers;

use App\Models\Kantor;
use App\Models\Regu;
use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

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
                TextColumn::make('kantor.namaKantor')->label('Kantor')->searchable(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Tambah Regu')
                    ->form([
                        Select::make('idKantor')
                            ->label('Kantor')
                            ->options(fn () => Kantor::query()
                                ->orderBy('namaKantor')
                                ->pluck('namaKantor', 'id')
                                ->all()
                            )
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('recordId', null))
                            ->dehydrated(false)
                            ->required(),

                        Select::make('recordId')
                            ->label('Regu')
                            ->searchable()
                            ->preload()
                            ->disabled(fn (Get $get) => blank($get('idKantor')))
                            ->options(function (Get $get): array {
                                $idKantor = $get('idKantor');

                                if (blank($idKantor)) {
                                    return [];
                                }

                                $attachedIds = $this->getOwnerRecord()
                                    ->regus()
                                    ->allRelatedIds()
                                    ->toArray();

                                return Regu::query()
                                    ->where('idKantor', $idKantor)
                                    ->whereNotIn('id', $attachedIds) // <- kunci: hide yang sudah attach
                                    ->orderBy('namaRegu')
                                    ->pluck('namaRegu', 'id')
                                    ->all();
                            })
                            ->required(),
                    ]),
            ])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([])
            ->bulkActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
