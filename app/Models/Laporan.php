<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Laporan extends Model implements HasMedia
{
    use InteractsWithMedia;


    protected $guarded = ['id'];



    public function kejadians()
    {
        return $this->belongsToMany(Kejadian::class);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('fotoLaporan')->useDisk('public');
    }

    public function getLocationAttribute(): array
    {
        return [
            'lat' => $this->latitude !== null ? (float) $this->latitude : -6.914744,
            'lng' => $this->longitude !== null ? (float) $this->longitude : 107.609810,
        ];
    }

    


}
