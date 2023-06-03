@extends('dashboard_admin_cafe/layouts/main')

@section('container')
<div class="container">
    <a href="{{ route('admin_cafe.reservation.index') }}" class="btn btn-outline-primary mt-4">
        <i class="bi bi-arrow-return-left"></i>
        Kembali
    </a>
    <div class="card my-3" style="min-width: 60%; border-radius:20px;">
        <div class="card-body">
            <div class="row border-bottom mb-3 pb-2">
                <h2 class="mb-0">{{ $reservation->item->cafe->nama_cafe }}</h2>
                <p class="mb-1">{{ $reservation->item->cafe->alamat_cafe }}, {{ $reservation->item->cafe->kecamatan }}, {{ $reservation->item->cafe->kota }}</p>
            </div>

            <div class="row">
                <div class="col-md-4" >
                    <img src="{{ asset('storage/' . $reservation->item->gambar_fasilitas)  }}" class="img-fluid" style="width:25rem; height: 20rem;">
                </div>
                <div class="col-md-8">
                    <small class="my-0" style="font-size: 12px">{{ $reservation->item->created_at }}</small>
                    <p style="font-size: 20px"><b>{{ $reservation->item->nama_fasilitas }}</b></p>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <p class="my-0">Nama Pelanggan</p>
                            <p class="my-0">Tanggal Reservasi </p>
                            <p class="my-0">Waktu Kehadiran Reservasi</p>
                            <p class="my-0">Waktu Batas Reservasi</p>
                            <p class="my-0">Total Harga</p>
                            <p class="my-0">Status Reservasi</p>
                            @if ($reservation->status == 'belum bayar')
                                <p class="mt-0 mb-3">Tenggat Pembayaran</p>
                            @endif

                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                            <p class="my-0">{{ $reservation->pelanggan->name }}</p>
                            <p class="my-0">{{ $reservation->tanggal_reservasi }}</p>
                            <p class="my-0">{{ $reservation->jam_awal}}</p>
                            <p class="my-0">{{ $reservation->jam_akhir}}</p>
                            <p class="my-0"><b>Rp {{ $reservation->harga_total }}</b></p>
                            @if ($reservation->status == 'sudah bayar')
                            <form action="{{ route('admin_cafe.reservation.update', $reservation->id) }}" method="post" class="d-inline">
                            @method('put')
                            @csrf
                                <button class="btn btn-light " style="font-size: 12px;background-color:#FFCF88;border-color:#A85C49" onclick="return confirm('Apakah anda yakin? Uang Pembayaran telah masuk?')">
                                    <span data-feather="edit"></span>
                                    Konfirmasi Reservasi Diterima
                                </button>
                                </form>
                            @else
                                <p class="mt-0 mb-3"><b>{{ $reservation->status }}</b></p>
                            @endif
                            @if ($reservation->status == 'belum bayar')
                                <p class="mt-0 mb-3">{{ $reservation->tenggat_pembayaran }} </p>
                            @endif
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>

    @if ($reservation->review_id != null)
    <div class="card mb-4" style="min-width: 60%; border-radius:20px;">
        <div class="card-body">
            <div class="row border-bottom mb-3 pb-2">
                <h3 class="mb-0">Ulasan</h3>
            </div>
            <div class="row">
                <small>
                    {{ $reservation->pelanggan->name }}
                </small>
                <span><b>Bintang: {{ $reservation->review->rating->name }}</b></span>
                <small class="pb-1">
                    {{ $reservation->review->rating->created_at }}
                </small>
                {!! $reservation->review->ulasan !!}
            </div>
        </div>
    </div>
    @endif


</div>
@endsection