<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Regu extends Model
{
    /** @use HasFactory<\Database\Factories\ReguFactory> */
    use HasFactory;

        public $timestamps = false;


    protected $guarded = ['id'];
    
    public function petugas(): HasMany
    {
        return $this->hasMany(User::class, 'idRegu');
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class, 'idKantor');
    }

    public function kejadians(): BelongsToMany
    {
        return $this->belongsToMany(Kejadian::class, 'kejadian_regu')
            ->withTimestamps();
    }

}
