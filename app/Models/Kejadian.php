<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kejadian extends Model
{
    protected $guarded = ['id'];

    public function laporan(){
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

    public function korban(): BelongsTo
    {
        return $this->belongsTo(Korban::class, 'idKorban');
    }

    public function regu(): BelongsTo
    {
        return $this->belongsTo(Regu::class, 'idRegu');
    }
}
