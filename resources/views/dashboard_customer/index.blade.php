@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')

    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Welcome back, {{ auth()->user()->name }}</h1>
        </div>

        <div class="row">
            @foreach($cafes as $cafe)
                <div class="col-md-4 mb-3">
                    <div class="card" style="width:20rem;">
                        <img src="{{ asset('storage/' . $cafe->gambar_cafe)  }}" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><a href="" 
                                class="text-decoration-none text-dark">{{ $cafe->nama_cafe }}</a>
                            </h5>
                            <p>
                                <small class="text-body-secondary">
                                        {{ $cafe->alamat_cafe }}
                                </small>
                            </p>
                            <a href="{{ route('cust.home.show', $cafe->id) }}" class="btn btn-sm btn-primary">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach()
        </div>
    </div>

@endsection