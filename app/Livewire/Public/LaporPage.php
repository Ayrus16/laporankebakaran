<?php

namespace App\Livewire\Public;

use App\Models\Laporan;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;
use Livewire\WithFileUploads;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\RateLimiter;




class LaporPage extends Component implements HasSchemas
{
    use InteractsWithSchemas,WithFileUploads;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'location' => ['lat' => -6.914744, 'lng' => 107.609810], // Default Bandung
            'started_at' => now()->timestamp, // set sekali
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                    Section::make('')->schema([
                    // Honeypot
                    Hidden::make('started_at')
                        ->dehydrated(),

                    TextInput::make('hp_field')
                        ->label('') 
                        ->hidden()
                        ->dehydrated()
                        ->nullable(),


                        TextInput::make('namaPelapor')
                            ->label('Nama Pelapor')
                            ->minLength(3)
                            ->required(),
                        TextInput::make('tlpPelapor')
                            ->label('Nomor Pelapor')
                            ->minLength(9)
                            ->prefix(+62)
                            ->numeric()
                            ->required(),
                        TextInput::make('alamat')
                            ->label('Alamat Kejadian'),
                        
                        
                        SpatieMediaLibraryFileUpload::make('fotoLaporan')
                            ->collection('fotoLaporan')
                            ->disk('public')
                            ->image()
                            ->multiple()
                            ->maxFiles(3)
                            ->maxSize(2048), // KB -> 2MB

                        Map::make('location')
                            ->label('Location')
                            ->columnSpanFull()


                            ->liveLocation(true, true, 10000)
                            ->showMyLocationButton(true)

                            ->draggable(false)
                            ->clickable(false)
                            ->defaultLocation(latitude: -6.914744, longitude: 107.609810)
                            ->dehydrated(false)

                            // Update Map saat lokasi di dapat
                            ->afterStateUpdated(function (Set $set, ?array $state): void {
                                $set('latitude', $state['lat'] ?? null);
                                $set('longitude', $state['lng'] ?? null);
                            })

                            ->afterStateHydrated(function ($state, $record, Set $set): void {
                                if (! $record) return;

                                $set('location', [
                                    'lat' => $record->latitude,
                                    'lng' => $record->longitude,
                                ]);
                            }),

                        TextInput::make('latitude')
                        ->required()->readOnly()->dehydrated(),
                        TextInput::make('longitude')
                        ->required()->readOnly()->dehydrated(),


                        ]),

                        
                    ])
                    ->statePath('data')
                    ->model(Laporan::class);
            }

    public function submit(): mixed
    {
        $state = $this->form->getState();


        $key = 'lapor-submit:' . sha1(request()->ip().'|'.substr((string) request()->userAgent(), 0, 120));

        // if (RateLimiter::tooManyAttempts($key, 5)) { // max 5x
        //     $seconds = RateLimiter::availableIn($key);

        //     Notification::make()
        //         ->danger()
        //         ->title('Terlalu banyak percobaan')
        //         ->body("Coba lagi dalam {$seconds} detik.")
        //         ->send();

        //     return null;
        // }

        // RateLimiter::hit($key, 180);





        // validasi Honeypot harus kosong
        if (!empty($state['hp_field'] ?? null)) {
            abort(422, 'Invalid submission.');
        }

        // Minimal waktu isi form (misal 3 detik)
        $startedAt = (int) ($state['started_at'] ?? 0);


        if ($startedAt > 0 && now()->timestamp - $startedAt < 3) {
            Notification::make()
                ->danger()
                ->title('Terlalu cepat')
                ->body('Mohon tunggu 3 detik lalu tekan Kirim lagi.')
                ->send();

            return null;
        }


        // Cek Laporan Berulang
        $nama  = trim(mb_strtolower($state['namaPelapor'] ?? ''));
        $tlp   = preg_replace('/\D+/', '', (string) ($state['tlpPelapor'] ?? ''));
        $alamat= trim(mb_strtolower($state['alamat'] ?? ''));

        // radius toleran gps
        $lat = isset($state['latitude']) ? round((float) $state['latitude'], 4) : null;
        $lng = isset($state['longitude']) ? round((float) $state['longitude'], 4) : null;

        $bucket = now()->format('Y-m-d H:i'); 
        $spamHash = hash('sha256', implode('|', [$tlp, $alamat, $lat, $lng, $bucket]));

        $recentDuplicate = Laporan::query()
            ->where('spam_hash', $spamHash)
            ->where('created_at', '>=', now()->subMinutes(10))
            ->exists();

        if ($recentDuplicate) {
            Notification::make()
                ->warning()
                ->title('Laporan serupa terdeteksi')
                ->body('Laporan serupa baru saja dikirim. Jika darurat, hubungi 113.')
                ->send();

            return null;
        }




        $laporan = Laporan::create([
            'namaPelapor' => $state['namaPelapor'],
            'tlpPelapor'  => $state['tlpPelapor'],
            'alamat'      => $state['alamat'],
            'latitude'    => $state['latitude'] ?? null,
            'longitude'   => $state['longitude'] ?? null,
            'status'      => 'diterima',
            'spam_hash'   => $spamHash,
            'submitted_at'=> now(),
        ]);

        $files = $state['fotoLaporan'] ?? [];

        foreach ((array) $files as $file) {
            $laporan
                ->addMedia($file) 
                ->toMediaCollection('fotoLaporan', 'public');
        }

        $this->form->model($laporan)->saveRelationships();

        session()->flash('success', 'Laporan berhasil dikirim. Silakan cek laporanmu.');

        
        return redirect()->to('/cek-laporan');
    }

    public function render()
    {
        return view('livewire.public.lapor-page')
        ->layout('components.layouts.public', ['title' => 'lapor Kejadian']);
    }

    public function refresh(): void
    {
        
    }
}
