<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Katalog;
use Illuminate\Http\Request;

class CustomerHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard_customer.index', [
            // 'katalogs' => Katalog::all()
            'cafes' => Cafe::all()
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
    public function show(Cafe $home)
    {

        return view('dashboard_customer.show', [
            'cafe' => $home,
            'katalogs' => Katalog::where('cafe_id', $home->id)->get()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cafe $cafe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cafe $cafe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cafe $cafe)
    {
        //
    }
}
