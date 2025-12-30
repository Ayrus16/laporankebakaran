<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelurahan extends Model
{
    /** @use HasFactory<\Database\Factories\KelurahanFactory> */
    use HasFactory;

    protected $table = 'kelurahan';

    protected $fillable = [
        'namaKelurahan',
    ];

    public function kejadian(): HasMany
    {
        return $this->hasMany(Kejadian::class, 'idKelurahan');
    }
}
