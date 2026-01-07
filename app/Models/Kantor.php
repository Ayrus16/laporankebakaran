<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kantor extends Model
{
    /** @use HasFactory<\Database\Factories\KantorFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function petugas(): HasMany
    {
        return $this->hasMany(User::class, 'idKantor');
    }

    public function kejadians()
    {
        return $this->hasMany(Kejadian::class);
    }

}
