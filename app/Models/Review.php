<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function reservasi()
    {
        return $this->hasOne(Reservation::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, 'rating_id');
    }
}
