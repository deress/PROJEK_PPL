<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Cafe;

use Illuminate\Http\Request;


class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        return view('dashboard_admin_cafe.stok.index', [
            'stoks' => Stok::where('cafe_id', $cafe->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_admin_cafe.stok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|max:255',
            'unit' => 'required',
            'initial_stok' => 'required|numeric',
        ], [
            'numeric' => 'Hanya boleh angka',

        ]);

        $validatedData['current_stok'] = $validatedData['initial_stok'];

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        $validatedData['cafe_id'] = $cafe['id'];

        Stok::create($validatedData);

        return redirect()->route('admin_cafe.stok.index')->with('success', 'Data stok baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $stok)
    {
        return view('dashboard_admin_cafe.stok.edit', [
            'stok' => $stok,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stok $stok)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:255',
            'unit' => 'required|max:50',
            'initial_stok' => 'required|numeric',
            'current_stok' => 'required|numeric',
            'id' => 'required'
        ], [
            'numeric' => 'Hanya boleh angka',

        ]);

        Stok::where('id', $stok->id)
            ->update($validatedData);

        return redirect()->route('admin_cafe.stok.index')->with('success', 'Data stok telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        //
    }
}
