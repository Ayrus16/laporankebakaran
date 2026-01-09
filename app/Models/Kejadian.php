<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Kejadian extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = ['id'];

    public function laporans(){
        return $this->belongsToMany(Laporan::class);
    }

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'idKelurahan');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'idKecamatan');
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function regus(): BelongsToMany
    {
        return $this->belongsToMany(Regu::class, 'kejadian_regu');
    }

    public function korbans(): HasMany
    {
        return $this->hasMany(Korban::class, 'kejadian_id');
    }
}
