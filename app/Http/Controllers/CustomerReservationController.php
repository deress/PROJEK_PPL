<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Cafe;
use App\Models\Katalog;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Carbon;

class CustomerReservationController extends Controller
{

    public function payment(Reservation $reservation)
    {
        $katalog = Katalog::find($reservation->katalog_id);
        $cafe = Cafe::where('id', $katalog->cafe_id)->first();

        return view('dashboard_customer.reservation.payment', [
            'reservation' => $reservation,
            'katalog' => $katalog,
            'cafe' => $cafe

        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $reservations = Reservation::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->filter(request(['search']))
            ->get();

        // dd($reservations[1]->status == 'belum bayar' and $reservations[1]->tenggat_pembayaran < Carbon::now());


        $katalogs = collect();
        $cafes = collect();
        foreach ($reservations as $reservation) {
            $katalog = Katalog::find($reservation->katalog_id);
            $katalogs->push($katalog);
        };

        foreach ($katalogs as $katalog) {
            $cafe = Cafe::find($katalog->cafe_id);
            $cafes->push($cafe);
        };

        // dd($reservations, $katalogs);

        // $cafe = Cafe::where('id', $katalog->cafe_id)->first();

        return view('dashboard_customer.reservation.index', [
            'count' => count($reservations),
            'reservations' => $reservations,
            'katalogs' => $katalogs,
            'cafes' => $cafes,

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
        $katalog = Katalog::find($reservation->katalog_id);
        $cafe = Cafe::find($katalog->cafe_id);

        return view('dashboard_customer.reservation.show', [
            'reservation' => $reservation,
            'katalog' => $katalog,
            'cafe' => $cafe,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('dashboard_customer.ulasan.edit', [
            'ratings' => Rating::all(),
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'ulasan' => 'required',
            'rating_id' => 'required'
        ]);

        // dd($validatedData);

        $review = Review::create($validatedData);

        // dd($review->id);

        Reservation::where('id', $reservation->id)
            ->update(['review_id' => $review->id]);

        return redirect()->route('cust.reservation.index')->with('success', 'Review anda telah berhasil!');
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
        $validatedData['status'] = 'reservasi dibatalkan';


        Reservation::where('id', $reservation->id)
            ->update($validatedData);

        return redirect()->route('cust.reservation.index')->with('success', 'Reservasi telah dibatalkan!');
    }

    public function paid(Request $request, Reservation $reservation)
    {
        $validatedData['status'] = 'sudah bayar';


        Reservation::where('id', $reservation->id)
            ->update($validatedData);

        return redirect()->route('cust.reservation.index')->with('success', 'Reservasi telah dibayar!');
    }

    public function done(Request $request, Reservation $reservation)
    {
        $validatedData['status'] = 'reservasi selesai';


        Reservation::where('id', $reservation->id)
            ->update($validatedData);

        return redirect()->route('cust.reservation.index')->with('success', 'Reservasi telah selesai!');
    }
}
