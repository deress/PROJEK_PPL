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
            'gambar_qris' => 'image|file|max:1024',
            'jam_buka' => 'required',
            'jam_tutup' => 'required'
        ];

        if ($request->email != $profile->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->nohp != $profile->nohp) {
            $rules['nohp'] = 'required|regex:/^(\+62)8[1-9][0-9]{6,9}$/|min:10|max:15|unique:users';
        }

        if ($request->password) {
            $rules['password'] = 'min:5|required|confirmed';
        }

        $validatedData = $request->validate($rules, [
            'image' => 'File yang diinputkan harus gambar',
            'file' => 'File yang diinputkan harus file',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Email tidak valid',
            'nohp.regex' => 'Nomor Handphone harus menggunakan kode Indonesia',
            'password.confirmed' => 'Konfirmasi tidak sesuai'
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->file('gambar_cafe')) {
            if ($profile->cafe->gambar_cafe != null) {
                Storage::delete($profile->cafe->gambar_cafe);
            }

            $validatedData['gambar_cafe'] = $request->file('gambar_cafe')->store('cafe-images');
        }

        if ($request->file('gambar_qris')) {
            if ($profile->cafe->gambar_cafe != null) {
                Storage::delete($profile->cafe->gambar_cafe);
            }

            $validatedData['gambar_qris'] = $request->file('gambar_qris')->store('qris-images');
        }


        $user_id = auth()->user()->id;

        $updated_user = User::find($user_id);

        $updated_user->update($validatedData);

        $updated_user->cafe->update($validatedData);

        // Cafe::where('admin_id', $user_id)->first()
        //     ->update($validatedData);

        return redirect()->route('admin_cafe.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
