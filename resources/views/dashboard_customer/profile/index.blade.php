@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')
    <div class="d-flex flex-column justify-content-center align-items-center h-100" 
    style="background-image:url('../image/bg-profil.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-5 mb-2" role="alert">
            {{ session('success') }}
                
        </div>
        @endif
        <div class="card mb-5 mt-2 mx-3 px-5 py-3" 
        style="min-width:auto; max-width: auto; width:600px; max-height:auto; 
        background-color:#F5EBE6;border-style: solid; border-width: 2px; border-color: #794028">
            <div class="card-body">
                <h3>Profile</h3>
                <div class="row">
                    <div class="col-4">
                        <p>Nama</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <p>Email</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-4">
                        <p>No Handphone</p>
                    </div>
                    <div class="col-6">
                        <p>{{ $user->nohp }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('cust.profile.edit', $user->email) }}" class="btn btn-dark btn-sm" style="background-color: #A85C49">Edit Profil</a>
                </div>
            </div>
            
        </div>
    </div>




@endsection