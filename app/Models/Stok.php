<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'nama_produk',
    //     'unit',
    //     'initial_stok',
    //     'current_stok',
    // ];

    protected $guarded = ['id'];
}
