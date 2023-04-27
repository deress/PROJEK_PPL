<?php

namespace App\Http\Controllers;

use App\Models\Stok;

use Illuminate\Http\Request;


class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard_admin_cafe.stok.index', [
            'stoks' => Stok::all()
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
            'unit' => 'required|max:50',
            'initial_stok' => 'required',

        ]);

        $validatedData['current_stok'] = $validatedData['initial_stok'];

        Stok::create($validatedData);

        return redirect('/dashboard/admin_cafe/stok')->with('success', 'New data stok has been added!');
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
            'initial_stok' => 'required',
            'current_stok' => 'required',
            'id' => 'required'
        ]);

        Stok::where('id', $stok->id)
            ->update($validatedData);

        return redirect('/dashboard/admin_cafe/stok')->with('success', 'Data stok has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $stok)
    {
        //
    }
}
