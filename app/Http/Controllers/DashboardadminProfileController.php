<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardadminProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('dashboard_admin_cafe.profile.index', [
            'user' => User::where('id', auth()->user()->id)->first()
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile)
    {
        return view('dashboard_admin_cafe.profile.edit', [
            'user' => $profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $rules = [
            'name' => 'required|max:255',
            'nama_cafe' => 'required|max:50',
            'alamat_cafe' => 'required|max:50',
            'kecamatan' => 'required|max:50',
            'kota' => 'required|max:50',
            'gambar_cafe' => 'image|file|max:1024',
            'deskripsi_cafe' => 'required',
        ];

        if ($request->email != $profile->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->nohp != $profile->nohp) {
            $rules['nohp'] = 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15|unique:users';
        }

        if ($request->password) {
            $rules['password'] = 'min:5|required|confirmed';
        }

        $validatedData = $request->validate($rules);
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->file('gambar_cafe')) {
            if ($profile->cafe->gambar_cafe != null) {
                Storage::delete($profile->cafe->gambar_cafe);
            }

            $validatedData['gambar_cafe'] = $request->file('gambar_cafe')->store('cafe-images');
        }

        $user_id = auth()->user()->id;

        $updated_user = User::find($user_id);

        $updated_user->update($validatedData);

        $updated_user->cafe->update($validatedData);

        // Cafe::where('admin_id', $user_id)->first()
        //     ->update($validatedData);

        return redirect('/dashboard/admin_cafe/profile')->with('success', 'New user has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
