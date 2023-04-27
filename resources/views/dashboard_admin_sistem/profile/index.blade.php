@extends('dashboard_admin/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Profile</h1>
    </div>

    <div class="col-lg-8">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>

    


    <div class="col-lg-8">
        
        @foreach ($users as $user)
            <div class="row">
                <div class="col-md-3">
                    <p>Nama</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $user->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <p>Email</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $user->email }}</p>
                </div>
            </div>
            <div class="row">
                <div class=" col-3">
                    <p>No Handphone</p>
                </div>
                <div class="col-md-6">
                    <p>{{ $user->nohp }}</p>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="/dashboard/admin/profile/{{ $user->email}}/edit" class="btn btn-primary btn-sm  my-2">Edit Profil</a>
            </div>
        @endforeach

        
    </div>
@endsection
