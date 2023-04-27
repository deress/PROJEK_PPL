@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')
    <div class="container">

        <h2 class="mb-3 pt-3 pb-2 border-bottom">{{ $katalog->nama_fasilitas }}</h2>
        <div class="row">
            <div class="col-lg-8">

                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $katalog->gambar_fasilitas)  }}" class="card-img-top img-fluid mt-3">
                    </div>
                    <h5 class="mt-2">Rp {{ $katalog->harga }}/jam</h5>

                    <article class="pt-2 pb-3" style="font-size:16px;">
                        <p>Deskripi Fasilitas :</p> 
                        {!! $katalog->deskripsi_fasilitas  !!}
                    </article>

                    <div class="mb-4">
                        <a href="{{ route('cust.home.show', $katalog->cafe_id) }}" class="text-decoration-none btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('cust.katalog.edit', $katalog->id) }}" class="btn btn-primary">
                            <i class="bi bi-clipboard2"></i> Reservasi
                        </a>
                    </div>
                    
            </div>
        </div>
    
    </div>
@endsection