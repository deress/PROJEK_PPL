@extends('dashboard_admin_cafe/layouts/main')

@section('container')
<div class="container">
    <div class="row my-4">
        <div class="col-lg-12">
            <h1 class="mb-3">{{ $katalog->nama_fasilitas }}</h1>
            <a href="{{ route('admin_cafe.katalog.index') }}" class="btn btn-sm btn-primary"> <span data-feather="arrow-left"></span> Back to all my posts</a>
            <a href="{{ route('admin_cafe.katalog.edit', $katalog->id) }}" class="btn btn-sm btn-light" style="background-color: #FDB13E"> <span data-feather="edit"></span> Edit</a>
                {{-- <form action="{{ route('admin_cafe.katalog.destroy', $katalog->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">
                        <span data-feather="x-circle"></span>Delete
                    </button>
                </form> --}}
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('storage/' . $katalog->gambar_fasilitas)  }}" class="card-img-top img-fluid mt-3">
        </div>

        <div class="col-lg-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <span>Mulai dari</span>
                    <h5 class="card-title pb-1">Rp {{ $katalog->harga }}/jam</h5>
                </div>
            </div>
            <div class="card my-3">
                <h5 class="card-header">Deskripsi</h5>
                <div class="card-body">
                    <p class="card-text">{!! $katalog->deskripsi_fasilitas  !!}</p>
                </div>
            </div>

            <div class="card mb-3">
                <h5 class="card-header">Fasilitas</h5>
                <div class="card-body">
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
                            @elseif ($x == 'live music')
                                <div class="col-md-4" style="font-size:18px">
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fa-solid fa-music"></i>
                                        </div>
                                        <div class="col-10">
                                            Live Music
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom pb-2 mb-1">
                        <h3 class="mb-0">Ulasan</h3>
                    </div>
                    <div class="d-flex my-3">
                        <div class="me-3">
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
@endsection
