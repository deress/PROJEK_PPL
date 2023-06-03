@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Detail Reservasi</h1>
    </div>  


    <div class="card mb-4" style="min-width: 60%; border-radius:20px;">
        <div class="card-body">

            <div class="row border-bottom mb-3 pb-2">
                <h2 class="mb-0">{{ $cafe->nama_cafe }}</h2>
                <p class="mb-1">{{ $cafe->alamat_cafe }}, {{ $cafe->kecamatan }}, {{ $cafe->kota }}</p>
            </div>

            <div class="row">
                <div class="col-md-4" >
                    <img src="{{ asset('storage/' . $katalog->gambar_fasilitas)  }}" class="img-fluid" style="width:25rem; height: 20rem;">
                </div>
                <div class="col-md-8">
                    <small class="my-0" style="font-size: 12px">{{ $katalog->created_at }}</small>
                    <p style="font-size: 20px"><b>{{ $katalog->nama_fasilitas }}</b></p>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <p class="my-0">Tanggal Reservasi </p>
                            <p class="my-0">Waktu Kehadiran Reservasi</p>
                            <p class="my-0">Waktu Batas Reservasi</p>
                            <p class="my-0">Total Harga</p>
                            <p class="my-0">Status Reservasi</p>
                            <p class="mt-0 mb-3">Tenggat Pembayaran</p>

                            
                        </div>
                        
                        <div class="col-md-4 col-sm-6">
                            <p class="my-0">{{ $reservation->tanggal_reservasi }}</p>
                            <p class="my-0">{{ $reservation->jam_awal}}</p>
                            <p class="my-0">{{ $reservation->jam_akhir}}</p>
                            <p class="my-0"><b>Rp {{ $reservation->harga_total }}</b></p>
                            <p class="my-0"><b>{{ $reservation->status }}</b></p>
                            @if ($reservation->status == 'belum bayar')
                                <p class="mt-0 mb-3">{{ $reservation->tenggat_pembayaran }} </p>
                            @endif
                        </div>
                    </div>
                    
                    <a href="{{ route('cust.reservation.index') }}" class="btn btn-outline-primary my-2">
                        <i class="bi bi-arrow-return-left"></i>
                        Kembali
                    </a>
                    @if ($reservation->status == 'belum bayar')
                        <form id="sudah_bayar" action="/customer/reservation/paid/{{$reservation->id}}" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <button class="btn btn-outline-success my-2" onclick="return confirm('Apakah anda benar sudah membayar? Admin akan mengecek pembayaran Anda untuk menerima reservasi Anda')">
                                <i class="bi bi-x-circle"></i>
                                Sudah Bayar
                            </button>
                        </form>
                        <form id="batalkan_1" action="/customer/reservation/cancel/{{$reservation->id}}" method="post" class="d-inline">
                        @method('put')
                        @csrf
                        <button class="btn btn-outline-danger my-2" onclick="return confirm('Apakah anda yakin membatalkan reservasi? Uang pembayaran reservasi tidak dapat kembali')">
                            <i class="bi bi-x-circle"></i>
                            Batalkan Reservasi
                        </button>
                        </form>
                    @elseif ($reservation->status == 'reservasi selesai' and $reservation->review_id == null)
                        <a href="{{ route('cust.reservation.edit', $reservation->id) }}" class="btn btn-outline-success my-2" >
                            Ulas Reservasi
                        </a>
                    @elseif ($reservation->status == 'reservasi selesai' and $reservation->review_id != null)
                    @elseif ($reservation->status == 'reservasi dibatalkan')
                    @else
                        <form id="batalkan_2" action="/customer/reservation/cancel/{{$reservation->id}}" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <button class="btn btn-outline-danger my-2">
                                <i class="bi bi-x-circle"></i>
                                Batalkan Reservasi
                            </button>
                        </form>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    
    
    
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault()
        })
        
        function previewImage() {
            frame.src=URL.createObjectURL(event.target.files[0]);
        }

        const swals = Swal.mixin({
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
        });

        const sudah_bayar = document.querySelector('#sudah_bayar');
        const batalkan1 = document.querySelector('#batalkan_1');
        const batalkan2 = document.querySelector('#batalkan_2');

        sudah_bayar.addEventListener('submit', function(e) {
            var sudahBayar_form = this;

            e.preventDefault();

            swals.fire({
                title: "Apakah anda benar sudah membayar?",
                text: "Admin akan mengecek pembayaran Anda untuk menerima reservasi Anda",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Sudah',
                cancelButtonText: 'Belum',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Berhasil",
                        text: "Status Reservasi telah diubah, silahkan menunggu konfirmasi admin",
                        icon: "success",
                    }).then(function() {
                        sudahBayar_form.submit();
                    });
                } else {
                }
            });
        });

        batalkan1.addEventListener('submit', function(e) {
            var batalkan1_form = this;

            e.preventDefault();

            swals.fire({
                title: "Apakah anda yakin membatalkan reservasi?",
                text: "Uang pembayaran reservasi tidak dapat kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Tidak Yakin',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Berhasil",
                        text: "Status Reservasi telah dibatalkan",
                        icon: "success",
                    }).then(function() {
                        batalkan1_form.submit();
                    });
                } else {
                }  
            });
        });

        batalkan2.addEventListener('submit', function(e) {
            var batalkan2_form = this;

            e.preventDefault();

            swals.fire({
                title: "Apakah anda yakin membatalkan reservasi?",
                text: "Uang pembayaran reservasi tidak dapat kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Tidak Yakin',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Berhasil",
                        text: "Status Reservasi telah dibatalkan",
                        icon: "success",
                    }).then(function() {
                        batalkan2_form.submit();
                    });
                } else {
                }  
            });
        });

</script>



@endsection