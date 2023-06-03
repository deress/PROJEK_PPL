@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')

    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
            <h1 class="h2">Ayo reservasi cafe dibawah ini!!</h1>
        </div>

        <div class="row mb-5">
            @foreach($cafes as $cafe)
            <div class="col-md-4 mb-3">
                <div class="card" style="width:20rem;height:28rem">
                    <img src="{{ asset('storage/' . $cafe->gambar_cafe)  }}" class="card-img-top" alt="" style="max-height:14rem">
                    <div class="card-body">
                        <h5 class="card-title mb-0">
                            <a href="{{ route('cust.home.show', $cafe->id) }}" class="text-decoration-none text-dark">{{ $cafe->nama_cafe }}</a>
                        </h5>
                        <p class="my-0">
                            <small class="text-body-secondary my-0">
                                {{ $cafe->alamat_cafe }}, {{ $cafe->kota }}
                            </small>
                        </p>
                        <p class="my-0">
                            <small class="text-body-secondary my-0">
                                Jam Buka: {{ $cafe->jam_buka }} - {{ $cafe->jam_tutup}}
                            </small>
                        </p>
                        
                        <p class="my-0 pt-2">
                            <small class="text-body-secondary my-0">
                                Deskripsi: {!! $cafe->deskripsi_cafe !!}
                            </small>
                        </p>
                        <a href="{{ route('cust.home.show', $cafe->id) }}" class="btn btn-sm btn-dark" 
                        style="position: absolute;
                            bottom: 20px;
                            width: 30%;
                            height: 30px;
                            background-color: #A85C49">
                        Lihat Cafe</a>
                    </div>
                </div>
            </div>
        @endforeach()
        </div>
    </div>

@endsection