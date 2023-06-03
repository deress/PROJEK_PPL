<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        $reservations = $katalog->reservation;
        $total_rating = 0;
        $total_ulasan = 0;

        foreach ($reservations as $reservation) {
            if ($reservation->review_id != null) {
                $total_ulasan += 1;
                $total_rating += $reservation->review->rating->name;
                $total_rating = $total_rating / $total_ulasan;
            }
        }

        if ($total_rating >= 4.5) {
            $golongan = 'Sangat Baik';
        } elseif ($total_rating < 4.5 and $total_rating >= 3.5) {
            $golongan = 'Baik';
        } elseif ($total_rating < 3.5 and $total_rating >= 3) {
            $golongan = 'Cukup';
        } elseif ($total_rating < 3 and $total_rating >= 1) {
            $golongan = 'Buruk';
        } elseif ($total_rating < 1 and $total_rating >= 0) {
            $golongan = 'Sangat Buruk';
        }


        return view('dashboard_customer.katalog.show', [
            'katalog' => $katalog,
            'reservations' => $reservations,
            'total_rating' => $total_rating,
            'total_ulasan' =>  $total_ulasan,
            'golongan' => $golongan

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Katalog $katalog)
    {
        // $reserved = Reservation::where('katalog_id', $katalog->id)->get();
        $reserved = DB::table('reservations')
            ->where('katalog_id', $katalog->id)
            ->where('tanggal_reservasi', '>', date("Y-m-d"))
            ->orWhere('tanggal_reservasi', '=', date("Y-m-d") and 'jam_akhir', '>', date("H:i"))
            ->get();

        $not_reserved = array('reservasi dibatalkan', 'reservasi selesai');

        $jumlah_reservasi = 0;
        foreach ($reserved as $x) {
            if (!in_array($x->status, $not_reserved)) {
                $jumlah_reservasi += $x->jumlah_reservasi;
            }
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
        $tanggal_skrg = date('Y-m-d');
        $jam_skrg = date('H:i');
        $jam_buka = $katalog->cafe->jam_buka;
        $jam_tutup = $katalog->cafe->jam_tutup;


        $rules = [
            'jumlah_reservasi' => "required|numeric|max:$sisa",
            'tanggal_reservasi' => "required|after:$tanggal_skrg",
            'jam_awal' => "required|after:$jam_buka",
            'jam_akhir' => "required|after:jam_awal|before:$jam_tutup",
            // 'harga_total' => 'required|numeric',
        ];

        if ($request->tanggal_reservasi == $tanggal_skrg) {
            $rules['jam_akhir'] = "after:jam_awal";
        }

        $diff = strtotime($request->jam_akhir) - strtotime($request->jam_awal);
        $durasi_jam = floor($diff / (60 * 60));
        $durasi_menit = floor($diff - $durasi_jam * (60 * 60)) / 60;
        if ($durasi_menit != 0 && $durasi_menit < 1.0) {
            $durasi_menit = 1.0;
        }
        $durasi_jam += $durasi_menit;

        $validatedData = $request->validate(
            $rules,
            [
                "jumlah_reservasi.max" => 'Reservasi melebihi jumlah yang tersedia',
                "tanggal_reservasi.after" => 'Reservasi tidak dapat dilakukan di hari yang sama saat pemesanan',
                "jam_awal.after" => "Tidak dapat reservasi sebelum cafe buka yaitu pada jam $jam_buka",
                "jam_akhir.after" => "Tidak dapat reservasi sebelum jam kehadiran",
                "jam_akhir.before" => "Tidak dapat reservasi setelah cafe tutup yaitu pada jam $jam_tutup",
            ]
        );

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['harga_total'] = $validatedData['jumlah_reservasi'] * $katalog->harga * $durasi_jam;
        $validatedData['katalog_id'] = $katalog->id;
        $validatedData['status'] = 'belum bayar';
        $validatedData['tenggat_pembayaran'] = Carbon::now()->addHour();

        $reservation = Reservation::create($validatedData);


        return redirect("/customer/reservation/payment/$reservation->id")->with('success', 'Reservasi berhasil, silahkan lakukan pembayaran!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katalog $katalog)
    {
        //
    }
}
