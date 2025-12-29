<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kejadian extends Model
{
    protected $guarded = ['id'];

    public function laporan(){
        return $this->belongsToMany(Laporan::class);
    }
}
