@extends('/dashboard_customer/layouts/main_pelanggan')

@section('container')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
            <h2>{{ $katalog->nama_fasilitas }}</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('cust.home.show', $katalog->cafe_id) }}" class="text-decoration-none btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="row pb-5 mb-1">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $katalog->gambar_fasilitas)  }}" class="card-img-top img-fluid mt-3">
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <span>Mulai dari</span>
                                <h5 class="card-title pb-1">Rp {{ $katalog->harga }}/jam</h5>
                                <a href="{{ route('cust.katalog.edit', $katalog->id) }}" class="btn btn-dark" style="background-color: #A85C49">
                                    <i class="bi bi-clipboard2"></i> Reservasi
                                </a>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title pb-1 border-bottom">Deskripsi</h5>
                                <p class="card-text">{!! $katalog->deskripsi_fasilitas  !!}</p>
                            </div>
                        </div>

                        <div class="card mt-2 mb-3">
                            <div class="card-body">
                                <h5 class="card-title pb-1 border-bottom">Fasilitas</h5>

                                <div class="row">
                                    @foreach(json_decode($katalog->fasilitas)  as $x)
                                        @if ($x == 'musholla')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-mosque" ></i>
                                                    </div>
                                                    <div class="col-10">
                                                        Musholla
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        @elseif ($x == 'toilet')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-toilet"></i> 
                                                    </div>
                                                    <div class="col-10">
                                                        Toilet
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'wifi')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-wifi"></i> 
                                                    </div>
                                                    <div class="col-10">
                                                        Wifi
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'ruangan ac')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-temperature-low"></i> 
                                                    </div>
                                                    <div class="col-10">
                                                        Ruangan AC
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'ruangan merokok')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-smoking"></i> 
                                                    </div>
                                                    <div class="col-10">
                                                        Ruangan Merokok
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'stop kontak')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-plug"></i>
                                                    </div>
                                                    <div class="col-10">
                                                        Stop Kontak
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'kursi bayi')
                                            <div class="col-md-4" style="font-size:18px">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <i class="fa-solid fa-baby"></i>> 
                                                    </div>
                                                    <div class="col-10">
                                                        Kursi Bayi
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($x == 'live music')
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row border-bottom pb-2 mb-1">
                                    <h3 class="mb-0">Ulasan</h3>
                                </div>
                                <div class="d-flex my-3">
                                    <div class="me-3" style="color: #ffc300">
                                        <span style="font-weight:700;font-size:35px">{{ $total_rating }}</span><span style="font-weight:700;">/5</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span>{{ $golongan }}</span><br><span>Dari {{ $total_ulasan }} ulasan</span>
                                    </div>
                                    
                                </div>
                                @foreach ($reservations as $reservation)
                                @if ($reservation->review_id != null)
                                <div class="row border-bottom py-2">
                                    <small>
                                        {{ $reservation->pelanggan->name }}
                                    </small>
                                    <span><b>Bintang: {{ $reservation->review->rating->name }}</b></span>
                                    <small class="pb-1">
                                        {{ $reservation->review->rating->created_at }}
                                    </small>

                                    {!! $reservation->review->ulasan !!}
                                </div>
                                @endif   
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    
            </div>
        </div>
    
    </div>
@endsection