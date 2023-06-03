<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Cafe;
use App\Models\Katalog;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
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

        $reservations = Reservation::whereIn('katalog_id', $id_katalog)
            ->orderBy('tanggal_reservasi', 'desc')
            ->orderBy('jam_awal', 'asc')
            ->filter(request(['search']))
            ->get();

        return view('dashboard_admin_cafe.reservation.index', [
            'reservations' => $reservations,
            'tanggal_sekarang' => date("Y-m-d"),
            'jam_sekarang' => date("H:i"),
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
        return view('dashboard_admin_cafe.reservation.show', [
            'reservation' => $reservation,

        ]);
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
        $validatedData['reservation_id'] = $reservation->id;
        $validatedData['tanggal'] = date('Y-m-d');
        $validatedData['jenis_data'] = 'pemasukkan';
        $validatedData['nominal'] = $reservation->harga_total / $reservation->jumlah_reservasi;
        $validatedData['jumlah'] = $reservation->jumlah_reservasi;
        $validatedData['jumlah_pemasukkan'] = $reservation->harga_total;
        $validatedData['keterangan'] = $reservation->item->nama_fasilitas;


        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        $validatedData['cafe_id'] = $cafe['id'];

        $new_keuangan = Keuangan::create($validatedData);

        $validatedDataReservation['status'] = 'reservasi aktif';
        // dd($new_keuangan, $validatedDataReservation);
        Reservation::where('id', $reservation->id)
            ->update($validatedDataReservation);

        return redirect()->route('admin_cafe.reservation.index')->with('success', 'Reservasi telah diterima!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function cancel(Request $request, Reservation $reservation)
    {
        $validatedData['status'] = 'belum bayar admin';

        Reservation::where('id', $reservation->id)
            ->update($validatedData);

        return redirect()->route('admin_cafe.reservation.index')->with('success', 'Reservasi telah dibatalkan!');
    }
}
