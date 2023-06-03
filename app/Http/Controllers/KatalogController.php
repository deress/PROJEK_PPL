<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\Cafe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        return view('dashboard_admin_cafe.katalog.index', [
            'katalogs' => Katalog::where('cafe_id', $cafe->id)->get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_admin_cafe.katalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_fasilitas' => 'required|max:255',
            'harga' => 'required|numeric',
            'gambar_fasilitas' => 'image|file|max:1024|required',
            'deskripsi_fasilitas' => 'required',
            'persediaan' => 'required',

        ], [
            'numeric' => 'Hanya boleh angka',
            'image' => 'File yang diinputkan harus gambar',
            'file' => 'File yang diinputkan harus file',
            'gambar_fasilitas.max' => 'File tidak boleh lebih dari 1mb',

        ]);

        if ($request->file('gambar_fasilitas')) {
            $validatedData['gambar_fasilitas'] = $request->file('gambar_fasilitas')->store('katalog-images');
        }

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        $validatedData['cafe_id'] = $cafe['id'];

        $validatedData['fasilitas'] = json_encode($request->daftar_fasilitas);

        Katalog::create($validatedData);

        return redirect()->route('admin_cafe.katalog.index')->with('success', 'Katalog baru telah ditambahkan!');
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

        return view('dashboard_admin_cafe.katalog.show', [
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
        return view('dashboard_admin_cafe.katalog.edit', [
            'katalog' => $katalog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Katalog $katalog)
    {
        $rules = [
            'harga' => 'required|numeric',
            'gambar_fasilitas' => 'image|file|max:1024',
            'deskripsi_fasilitas' => 'required',
            'nama_fasilitas' => 'required|max:255',

        ];

        $validatedData = $request->validate($rules, [
            'numeric' => 'Hanya boleh angka',
            'image' => 'File yang diinputkan harus gambar',
            'file' => 'File yang diinputkan harus file',
            'gambar_fasilitas.max' => 'File tidak boleh lebih dari 1 mb',
        ]);

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        $validatedData['cafe_id'] = $cafe['id'];

        if ($request->file('gambar_fasilitas')) {
            if ($katalog->gambar_fasilitas != null) {
                Storage::delete($katalog->gambar_fasilitas);
            }

            $validatedData['gambar_fasilitas'] = $request->file('gambar_fasilitas')->store('katalog-images');
        }

        if ($request->daftar_fasilitas) {
            $validatedData['fasilitas'] = json_encode($request->daftar_fasilitas);
        }


        Katalog::where('id', $katalog->id)
            ->update($validatedData);

        return redirect()->route('admin_cafe.katalog.index')->with('success', 'Katalog telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katalog $katalog)
    {
        if ($katalog->gambar_fasilitas) {
            Storage::delete($katalog->gambar_fasilitas);
        }

        Katalog::destroy($katalog->id);
        return redirect()->route('admin_cafe.katalog.index')->with('success', 'Katalog telah dihapus!');
    }
}
