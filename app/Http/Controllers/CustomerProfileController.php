<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard_customer.profile.index', [
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
        return view('dashboard_customer/profile/edit', [
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
        ];

        if ($request->email != $profile->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->nohp != $profile->nohp) {
            $rules['nohp'] = 'required|regex:/^([0-9\s\(\)]*)$/|min:10|max:15|unique:users';
        }

        $validatedData = $request->validate($rules);
        $validatedData['id'] = auth()->user()->id;

        user::where('id', $profile->id)
            ->update($validatedData);

        return redirect()->route('cust.profile.index')->with('success', 'New user has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
