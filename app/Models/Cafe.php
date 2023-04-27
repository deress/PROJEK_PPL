<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function katalog()
    {
        return $this->hasMany(Katalog::class);
    }
}
