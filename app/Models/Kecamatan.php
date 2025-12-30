<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
    /** @use HasFactory<\Database\Factories\KecamatanFactory> */
    use HasFactory;

    protected $fillable = [
        'namaKecamatan',
    ];

    public function kejadian(): HasMany
    {
        return $this->hasMany(Kejadian::class, 'idKecamatan');
    }
}
