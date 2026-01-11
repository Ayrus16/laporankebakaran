<?php

namespace App\Filament\Resources\Laporans\RelationManagers;

use App\Models\Kejadian;
use Filament\Actions\Action;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KejadiansRelationManager extends RelationManager
{
    protected static string $relationship = 'kejadians';
    protected static ?string $title = 'Kejadian Terkait';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('LokasiKejadian')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('LokasiKejadian')
                    ->label('Lokasi')
                    ->searchable(),

                TextColumn::make('tanggalKejadian')
                    ->label('Tanggal')
                    ->date(),

                TextColumn::make('waktuSelesai')
                    ->label('Selesai')
                    ->dateTime(),
            ])
            ->headerActions([
                //"YA" -> attach kejadian existing
                AttachAction::make()
                    ->label('Ya, pilih kejadian terkait')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['LokasiKejadian', 'keteranganTambahan'])
                    ->recordSelectOptionsQuery(function (Builder $query) {
                        return $query->whereNull('waktuSelesai');
                    })
                    ->after(function () {
                        $this->getOwnerRecord()->update(['status' => 'penanganan']);

                        Notification::make()
                            ->title('Laporan dikaitkan ke kejadian')
                            ->success()
                            ->send();
                    }),

                //"TIDAK" -> buat kejadian baru dari laporan lalu attach
                Action::make('buatKejadianDariLaporan')
                    ->label('Tidak, buat kejadian baru')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function () {
                        $laporan = $this->getOwnerRecord();

                        $kejadian = Kejadian::query()->create([
                            'idKecamatan'    => $laporan->idKecamatan,
                            'idKelurahan'    => $laporan->idKelurahan,
                            'LokasiKejadian' => $laporan->alamat,
                            'tanggalKejadian'=> now()->toDateString(),
                        ]);

                        $laporan->kejadians()->syncWithoutDetaching([$kejadian->id]);
                        $laporan->update(['status' => 'penanganan']);

                        Notification::make()
                            ->title('Kejadian baru dibuat & laporan masuk penanganan')
                            ->success()
                            ->send();
                    }),
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
