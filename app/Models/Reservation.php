<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['item', 'pelanggan'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('status', 'like', '%' . $search . '%');
        });
    }

    public function item()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function keuangan()
    {
        return $this->hasOne(Keungan::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
