<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSistemRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard_admin_sistem.register.index', [
            'users' => User::where('is_admin', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_admin_sistem.register.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'nohp' => 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15|unique:users',
            'password' => 'min:5|required',
            'nama_cafe' => 'required|max:50',
            'alamat_cafe' => 'required|max:50',
            'kecamatan' => 'required|max:50',
            'kota' => 'required|max:50',
            'gambar_cafe' => 'image|file|max:1024|required',
            'deskripsi_cafe' => 'required',

        ]);

        if ($request->file('gambar_cafe')) {
            $validatedData['gambar_cafe'] = $request->file('gambar_cafe')->store('cafe-images');
        }

        $validatedData['is_admin'] = 1;
        $validatedData['password'] = Hash::make($validatedData['password']);


        $new_user = User::create($validatedData);
        $validatedData['admin_id'] = $new_user->id;
        Cafe::create($validatedData);

        return redirect()->route('register.index')->with('success', 'Registrasi admin cafe berhasil!');

        // return redirect('/dashboard/admin_sistem/register')->with('success', 'Registrasi admin cafe berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
