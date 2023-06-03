<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Cafe;
use App\Models\Katalog;
use Illuminate\Http\Request;

class DashboardadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        $katalog = Katalog::where('cafe_id', $cafe->id)->pluck('id');

        $id_katalog = [];
        foreach ($katalog as $x) {
            $id_katalog[] = $x;
        }

        $reservations = Reservation::whereIn('katalog_id', $id_katalog)->get();

        $jumlah_konfirmasi = 0;
        $jumlah_diterima = 0;
        $jumlah_dibatalkan = 0;
        foreach ($reservations as $x) {
            if ($x->status == 'sudah bayar') {
                $jumlah_konfirmasi += 1;
            } elseif ($x->status == 'reservasi aktif' or $x->status == 'reservasi selesai') {
                $jumlah_diterima += 1;
            } elseif ($x->status == 'reservasi dibatalkan') {
                $jumlah_dibatalkan += 1;
            }
        }

        return view('dashboard_admin_cafe.index', [
            'jumlah_reservasi' => count($reservations),
            'jumlah_konfirmasi' => $jumlah_konfirmasi,
            'jumlah_diterima' => $jumlah_diterima,
            'jumlah_dibatalkan' => $jumlah_dibatalkan,
            'reservations' => $reservations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
