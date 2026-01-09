<?php

namespace App\Filament\Resources\Kantors\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegusRelationManager extends RelationManager
{
    protected static string $relationship = 'regus'; // harus sama dengan method di Kantor model

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('namaRegu')
                ->required()
                ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('namaRegu')
                    ->label('Regu')
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
