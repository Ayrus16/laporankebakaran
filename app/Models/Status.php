<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    /** @use HasFactory<\Database\Factories\StatusFactory> */
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function korban(): HasMany
    {
        return $this->hasMany(Korban::class, 'idStatus');
    }
}
