<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regu extends Model
{
    /** @use HasFactory<\Database\Factories\ReguFactory> */
    use HasFactory;

    protected $fillable = [
        'namaRegu',
    ];

    public function petugas(): HasMany
    {
        return $this->hasMany(User::class, 'idRegu');
    }

    public function kejadian(): HasMany
    {
        return $this->hasMany(Kejadian::class, 'idRegu');
    }
}
