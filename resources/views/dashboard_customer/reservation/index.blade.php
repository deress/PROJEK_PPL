@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Riwayat Reservasi</h1>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="col d-flex justify-content-center align-items-center my-3">
        <a href="{{ route('cust.reservation.index') }}" class="btn btn-outline-dark my-2 me-1" style="border-color:#A85C49">
            Semua
        </a>
            <form action="reservation" method="get">
                <input class="btn btn-outline-dark" type="submit" name="search" value="belum bayar" style="border-color:#A85C49" />
                <input class="btn btn-outline-dark" type="submit" name="search" value="sudah bayar" style="border-color:#A85C49" />
                <input class="btn btn-outline-dark" type="submit" name="search" value="reservasi aktif" style="border-color:#A85C49" />
                <input class="btn btn-outline-dark" type="submit" name="search" value="reservasi dibatalkan" style="border-color:#A85C49" />
                <input class="btn btn-outline-dark" type="submit" name="search" value="reservasi selesai" style="border-color:#A85C49" />
            </form>
        </div>

    @for ($i = 0; $i < $count; $i++)
    
    <div class="row justify-content-center align-items-center my-3">
        <div class="col-6" >
            @if ($reservations[$i]->status == 'belum bayar admin')
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Harap Cek Pembayaran Reservasi Anda!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>Uang Pembayaran tidak masuk ke E-Wallet Cafe, sehingga status reservasi diubah oleh Admin</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
            <div class="card mb-4 mx-0" style="min-width: 60%; border-radius:20px;">
                <div class="card-body">
                    <div class="row mx-0 border-bottom mb-3">
                        <div class="col-md-8">
                            <p class="mb-0">Reservasi</p>
                            @if ($reservations[$i]->status == 'belum bayar')
                                <p style="font-size: 12px;">Tenggat Pembayaran : {{ $reservations[$i]->tenggat_pembayaran }} </p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <p class="btn btn-sm btn-secondary px-1 py-0 mb- mt-1 text-dark border-0" style="font-size: 12px;background-color:#C8B6A6">{{ $reservations[$i]->status }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $katalogs[$i]->gambar_fasilitas)  }}" class="img-fluid" style="width:14rem;height: 11rem">
                        </div>
                        <div class="col-md-7">
                            <small class="my-0" style="font-size: 12px">{{ $reservations[$i]->created_at }}</small>
                            <p class="my-0" style="font-size: 18px"><b>{{ $cafes[$i]->nama_cafe }}</b></p>
                            <p class="my-0" style="font-size: 14px"><b>{{ $katalogs[$i]->nama_fasilitas }}</b></p>

                            <p class="mt-1 mb-0" style="font-size: 14px">Total Harga</p>
                            <p class="my-0">Rp <b>{{ $reservations[$i]->harga_total }}</b></p>

                            <a href="{{ route('cust.reservation.show', $reservations[$i]->id) }}" class="btn btn-sm btn-primary my-1" >
                                <i class="bi bi-arrow-return-right"></i>
                                Lihat detail
                            </a>

                            @if ($reservations[$i]->status == 'belum bayar' or $reservations[$i]->status == 'belum bayar admin')
                                <form action="/customer/reservation/paid/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpPaid(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-success my-1">
                                        <i class="bi bi-currency-dollar"></i>
                                        Sudah Bayar
                                    </button>
                                </form>
                                <form action="/customer/reservation/cancel/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpBatal(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger my-1">
                                        <i class="bi bi-x-circle"></i>
                                        Batalkan Reservasi
                                    </button>
                                </form>
                            @elseif ($reservations[$i]->status == 'reservasi selesai' and $reservations[$i]->review_id == null)
                                <a href="{{ route('cust.reservation.edit', $reservations[$i]->id) }}" class="btn btn-sm btn-outline-success my-2" >
                                    Ulas Reservasi
                                </a>
                            @elseif ($reservations[$i]->status == 'reservasi selesai'and $reservations[$i]->review_id != null)
                            @elseif ($reservations[$i]->status == 'reservasi dibatalkan')
                            @elseif ($reservations[$i]->status == 'sudah bayar')
                                <form action="/customer/reservation/cancel/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpBatal(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger my-1">
                                        <i class="bi bi-x-circle"></i>
                                        Batalkan Reservasi
                                    </button>
                                </form>
                            @else
                                <form action="/customer/reservation/cancel/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpBatal(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger my-1">
                                        <i class="bi bi-x-circle"></i>
                                        Batalkan Reservasi
                                    </button>
                                </form>
                            @endif

                            @if ($reservations[$i]->status == 'reservasi aktif' and $reservations[$i]->tanggal_reservasi == date("Y-m-d") and $reservations[$i]->jam_akhir <= date("H:i:00"))
                                <form id="selesai_form" action="/customer/reservation/done/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpSelesai(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success my-1">
                                        <i class="bi bi-check-circle"></i>
                                        Reservasi Selesai
                                    </button>
                                </form>
                            @elseif ($reservations[$i]->status == 'reservasi aktif' and $reservations[$i]->tanggal_reservasi < date("Y-m-d"))
                                <form id="selesai_form" action="/customer/reservation/done/{{$reservations[$i]->id}}" method="post" class="d-inline" onsubmit="return popUpSelesai(this)">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success my-1">
                                        <i class="bi bi-check-circle"></i>
                                        Reservasi Selesai
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    @endfor


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" defer>
        

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault()
        })

        function previewImage() {
            frame.src=URL.createObjectURL(event.target.files[0]);
        }

        $(document).ready(function(){
		    $("#myModal").modal('show');
	    });

        const swals = Swal.mixin({
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
        });

        function popUpBatal(form) {
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
                        text: "Reservasi telah dibatalkan",
                        icon: "success",
                    }).then(function() {
                        form.submit();
                    });
                } else {
                }
            });
            return false;
        }

        function popUpPaid(form) {
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
                        form.submit();
                    });
                } else {
                }
            });
            return false;
        }

        function popUpSelesai(form) {
            swals.fire({
                title: "Apakah anda yakin menyelesaikan reservasi?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Sudah',
                cancelButtonText: 'Belum',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Berhasil",
                        text: "Reservasi telah selesai",
                        icon: "success",
                    }).then(function() {
                        form.submit();
                    });
                } else {
                }
            });
            return false;
        }

</script>

@endsection