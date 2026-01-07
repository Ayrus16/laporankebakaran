<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Korban extends Model
{

    protected $guarded = ['id'];

    public function kejadian(): BelongsTo
    {
        return $this->belongsTo(Kejadian::class, 'kejadian_id');
    }
}
