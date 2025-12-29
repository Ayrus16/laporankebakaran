<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Laporan extends Model implements HasMedia
{
    protected $guarded = ['id'];

    public function kejadian(){
        return $this->belongsTo(Kejadian::class);
    }

public function getLocationAttribute(): array
{
    return [
        'lat' => $this->latitude !== null ? (float) $this->latitude : -6.914744,
        'lng' => $this->longitude !== null ? (float) $this->longitude : 107.609810,
    ];
}

    use InteractsWithMedia;


}
