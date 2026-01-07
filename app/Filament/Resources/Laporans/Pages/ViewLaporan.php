<?php

namespace App\Filament\Resources\Laporans\Pages;

use App\Filament\Resources\Laporans\LaporanResource;
use App\Models\Kejadian;
use App\Services\NearestKantorService;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\DB;

class ViewLaporan extends ViewRecord
{
    protected static string $resource = LaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('terima')
                ->label('Terima')
                ->color('success')
                ->visible(fn () => $this->record->status === 'diterima')
                ->form([
                    Radio::make('ada_kejadian_terkait')
                        ->label('Apakah ada kejadian terkait?')
                        ->options([
                            'ya' => 'Ya',
                            'tidak' => 'Tidak',
                        ])
                        ->required()
                        ->live(),

                    // Kalau "YA" -> pilih kejadian existing
                    Select::make('kejadian_id')
                        ->label('Pilih Kejadian Kebakaran')
                        ->searchable()
                        ->getSearchResultsUsing(function (string $search) {
                            return Kejadian::query()
                                ->where('LokasiKejadian', 'like', "%{$search}%")
                                ->orderByDesc('created_at')
                                ->limit(25)
                                ->pluck('LokasiKejadian', 'id')
                                ->toArray();
                        })
                        ->getOptionLabelUsing(fn ($value): ?string => Kejadian::query()->find($value)?->LokasiKejadian)
                        ->visible(fn ($get) => $get('ada_kejadian_terkait') === 'ya')
                        ->required(fn ($get) => $get('ada_kejadian_terkait') === 'ya'),
                ])
                ->action(function (array $data) {
                    DB::transaction(function () use ($data) {
                        $this->record->refresh();

                        if ($this->record->status !== 'diterima') {
                            return;
                        }

                        // === YA: attach ke kejadian existing ===
                        if ($data['ada_kejadian_terkait'] === 'ya') {
                            $kejadian = Kejadian::query()->findOrFail($data['kejadian_id']);

                            // attach tanpa duplikat
                            $this->record->kejadians()->syncWithoutDetaching([$kejadian->id]);

                            $this->record->update(['status' => 'penanganan']);
                            return;
                        }

                        // === TIDAK: create kejadian baru dari data laporan + kantor terdekat otomatis ===
                        $lat = $this->record->latitude !== null ? (float) $this->record->latitude : null;
                        $lng = $this->record->longitude !== null ? (float) $this->record->longitude : null;

                        $kantorId = app(NearestKantorService::class)->findNearestKantorId($lat, $lng);

                        $kejadian = Kejadian::query()->create([
                            'idKecamatan'    => null,
                            'idKelurahan'    => null,
                            'kantor_id'      => $kantorId, // ✅ otomatis
                            'LokasiKejadian' => (string) $this->record->alamat,
                            'tanggalKejadian'=> now()->toDateString(),
                        ]);

                        $this->record->kejadians()->attach($kejadian->id);
                        $this->record->update(['status' => 'penanganan']);
                    });

                    Notification::make()
                        ->title('Laporan berhasil diproses')
                        ->success()
                        ->send();
                }),

            // === TOLAK ===
            Action::make('tolak')
                ->label('Tolak')
                ->color('danger')
                ->visible(fn () => $this->record->status === 'diterima')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update(['status' => 'ditolak']);

                    Notification::make()
                        ->title('Laporan ditolak')
                        ->danger()
                        ->send();
                }),
        ];
    }
}
