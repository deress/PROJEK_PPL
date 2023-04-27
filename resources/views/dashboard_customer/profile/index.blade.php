@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')
<main style="height: 550px">
    
    
    <div class="container border border-2 mt-5 pt-3 px-3" style="max-width: auto; width:600px; max-height:auto;  border-radius: 20px; background-color:#F1DEC9;">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show col-lg-12" role="alert">
                {{ session('success') }}
                
            </div>
        @endif
        <h3>Profile</h3>

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
            <a href="{{ route('cust.profile.edit', $user->email) }}" class="btn btn-primary btn-sm  my-2">Edit Profil</a>
        </div>

        

    </div>
</main>
@endsection