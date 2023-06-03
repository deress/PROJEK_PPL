<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'nohp' => 'required|regex:/^(\+62)8[1-9][0-9]{6,9}$/|min:10|max:15|unique:users',
            'password' => 'min:5|required|confirmed',
        ], [
            'email:dns' => 'Email tidak valid',
            'regex:/^(\+62)8[1-9][0-9]{6,9}$/' => 'Nomor Handphone harus menggunakan kode Indonesia',
            'confirmed' => 'Konfirmasi password tidak sesuai'
        ]);


        $validatedData['password'] = Hash::make($validatedData['password']);


        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan login');
    }
}
