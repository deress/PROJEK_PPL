<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['cafe'];



    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
