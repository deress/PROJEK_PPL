@extends('dashboard_admin_sistem/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Katalog Fasilitas</h1>
    </div>

    <div class="col-lg-11">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>

    


    <div class="table-responsive col-lg-11">
        
        <a href="/dashboard/admin_sistem/register/create" class="btn btn-sm btn-primary mb-3">Buat akun admin sistem</a>

        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">No Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->nohp }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
