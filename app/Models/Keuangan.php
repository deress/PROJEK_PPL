<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['bulan'] ?? false, function ($query, $bulan) {
            return $query->whereMonth('tanggal', $bulan);
        });

        $query->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->whereYear('tanggal', $tahun);
        });
    }

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
