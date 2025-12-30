<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{

    /** @use HasFactory<\Database\Factories\JabatanFactory> */
    use HasFactory;

    protected $fillable = [
        'namaJabatan',
    ];

    public function petugas(): HasMany
    {
        return $this->hasMany(User::class, 'idJabatan');
    }
}
