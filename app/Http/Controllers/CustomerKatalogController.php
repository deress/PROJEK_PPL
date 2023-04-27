<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CustomerKatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
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
    public function show(Katalog $katalog)
    {
        return view('dashboard_customer.katalog.show', [
            'katalog' => $katalog

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Katalog $katalog)
    {
        $reserved = Reservation::where('katalog_id', $katalog->id)->get();
        $jumlah_reservasi = 0;
        foreach ($reserved as $x) {
            $jumlah_reservasi += $x['jumlah_reservasi'];
        }

        $sisa = $katalog->persediaan - $jumlah_reservasi;

        return view('dashboard_customer.katalog.edit', [
            'katalog' => $katalog,
            'sisa' => $sisa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Katalog $katalog)
    {
        $reserved = Reservation::where('katalog_id', $katalog->id)->get();
        $jumlah_reservasi = 0;
        foreach ($reserved as $x) {
            $jumlah_reservasi += $x['jumlah_reservasi'];
        }
        $sisa = $katalog->persediaan - $jumlah_reservasi;

        $validatedData = $request->validate([
            'jumlah_reservasi' => "required|numeric|max:$sisa",
            'tanggal_reservasi' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',

        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['katalog_id'] = $katalog->id;
        $validatedData['status'] = 'proses kondirmasi';

        Reservation::create($validatedData);

        return redirect("/customer/katalog/payment/$katalog->id")->with('success', 'Reservasi berhasil, silahkan lakukan pembayaran!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katalog $katalog)
    {
        //
    }

    public function payment(Katalog $katalog)
    {
        return view('dashboard_customer.katalog.payment');
    }
}
