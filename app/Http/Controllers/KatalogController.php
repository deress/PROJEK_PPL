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
        return view('dashboard_admin_cafe.katalog.index', [
            'katalogs' => Katalog::all()
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
            'harga' => 'required',
            'gambar_fasilitas' => 'image|file|max:1024|required',
            'deskripsi_fasilitas' => 'required',
            'persediaan' => 'required',

        ]);

        if ($request->file('gambar_fasilitas')) {
            $validatedData['gambar_fasilitas'] = $request->file('gambar_fasilitas')->store('katalog-images');
        }

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        $validatedData['cafe_id'] = $cafe['id'];


        Katalog::create($validatedData);

        return redirect('/dashboard/admin_cafe/katalog')->with('success', 'Katalog baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Katalog $katalog)
    {
        return view('dashboard_admin_cafe.katalog.show', [
            'katalog' => $katalog
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
            'harga' => 'required',
            'gambar_fasilitas' => 'image|file|max:1024',
            'deskripsi_fasilitas' => 'required',
            'nama_fasilitas' => 'required|max:255'
        ];

        $validatedData = $request->validate($rules);

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        $validatedData['cafe_id'] = $cafe['id'];

        if ($request->file('gambar_fasilitas')) {
            if ($katalog->gambar_fasilitas != null) {
                Storage::delete($katalog->gambar_fasilitas);
            }

            $validatedData['gambar_fasilitas'] = $request->file('gambar_fasilitas')->store('katalog-images');
        }


        Katalog::where('id', $katalog->id)
            ->update($validatedData);

        return redirect('/dashboard/admin_cafe/katalog')->with('success', 'Katalog telah diperbarui!');
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
        return redirect('/dashboard/admin_cafe/katalog')->with('success', 'Katalog telah dihapus!');
    }
}
