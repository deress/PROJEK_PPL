@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Daftar Reservasi</h1>
    </div>

    <div class="col-lg-11">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>

    
    <div class="col-lg-11 mb-3 d-flex justify-content-center align-items-center">
        <a href="{{ route('admin_cafe.reservation.index') }}" class="btn btn-outline-dark my-2 me-1" style="border-color:#A85C49">
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

    <div class="table-responsive col-lg-11">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Fasilitas</th>
                <th scope="col">Tgl Reservasi</th>
                <th scope="col">Id Pelanggan</th>
                <th scope="col">Jam Kehadiran</th>
                <th scope="col">Jam Batas</th>
                <th scope="col">Jumlah Reservasi</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->item->nama_fasilitas }}</td>
                    <td>{{ $reservation->tanggal_reservasi }}</td>
                    <td>{{ $reservation->user_id }}</td>
                    <td>{{ $reservation->jam_awal }}</td>
                    <td>{{ $reservation->jam_akhir }}</td>
                    <td>{{ $reservation->jumlah_reservasi }}</td>
                    <td>{{ $reservation->harga_total }}</td>
                    <td>
                        @if ($reservation->status == 'sudah bayar')
                        <form action="{{ route('admin_cafe.reservation.update', $reservation->id) }}" method="post" class="d-inline" onsubmit="return popUpKonfirmasi(this)">
                            @method('put')
                            @csrf
                            <button class="btn btn-light mb-1 w-75" style="font-size: 12px;background-color:#FFCF88;border-color:#A85C49" id="btn-konfirmasi">
                                <span data-feather="edit"></span>
                                Konfirmasi Reservasi
                            </button>
                        </form>
                        <form action="/admin_cafe/reservation/cancel/{{$reservation->id}}" method="post" class="d-inline" onsubmit="return popUpBatalkan(this)">
                            @method('put')
                            @csrf
                            <button class="btn btn-light w-75" style="font-size: 12px;background-color:#d33;border-color:#A85C49" id="btn-konfirmasi">
                                <span data-feather="edit"></span>
                                Batalkan Reservasi
                            </button>
                        </form>
                        @else
                            <p>{{ $reservation->status }}</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin_cafe.reservation.show', $reservation->id) }}" class="btn btn-sm btn-outline-dark" style="border-color:#A85C49">
                            Lihat Detail
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript" defer>
        const swals = Swal.mixin({
            // cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
        });

        function popUpBatalkan(form) {
            swals.fire({
                title: "Harap cek uang pembayaran pada e-wallet Anda, jika uang tidak masuk anda bisa membatalkan Reservasi!",
                text: "",
                icon: "warning",
                showCancelButton: true,
                // showDenyButton: true,
                confirmButtonText: 'Reservasi Dibatalkan',
                // denyButtonText: 'Belum Masuk',
                cancelButtonText: 'Batal Konfirmasi',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Reservasi Dibatalkan",
                        text: "Status Reservasi telah diubah, reservasi dibatalkan",
                        icon: "success",
                    }).then(function() {
                        form.submit();
                    });
                } else {
                }
            });
            return false;
        }

        function popUpKonfirmasi(form) {
            swals.fire({
                title: "Harap cek uang pembayaran pada e-wallet Anda, jika uang telah masuk anda bisa menerima Reservasi !",
                text: "",
                icon: "warning",
                showCancelButton: true,
                // showDenyButton: true,
                confirmButtonText: 'Reservasi Diterima',
                // denyButtonText: 'Belum Masuk',
                cancelButtonText: 'Batal Konfirmasi',
            }).then((result) => {
                if (result.isConfirmed) {
                    swals.fire({
                        title: "Reservasi Diterima",
                        text: "Status Reservasi telah diubah, reservasi diterima",
                        icon: "success",
                    }).then(function() {
                        form.submit();
                    });
                } else {
                }
            });
            return false;
        }

//         function popUpKonfirmasi(form) {
//             swals.fire({
//                 title: "Harap cek uang pembayaran pada e-wallet Anda!",
//                 text: "",
//                 icon: "warning",
//                 showCancelButton: true,
//                 showDenyButton: true,
//                 confirmButtonText: 'Reservasi diterima',
//                 denyButtonText: 'Reservasi ditolak',
//                 cancelButtonText: 'Batal Konfirmasi',
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     swals.fire({
//                         title: "Reservasi Diterima",
//                         text: "Status Reservasi telah diubah, reservasi diterima",
//                         icon: "success",
//                     }).then(function() {
//                         // form.submit();
//                     });
//                 } else if (result.isDenied) {
//                     const { value: alasan } = swals.fire({    
//                         input: 'textarea',
//                         inputLabel: 'Alasan',
//                         inputPlaceholder: 'Tuliskan alasanmu disini...',
//                         showCancelButton: true,
//                         cancelButtonText: 'Batal Konfirmasi',
//                     })

//                     if (alasan) {
//                         swals.fire({
//                             title: "Reservasi belum dibayar",
//                             text: `Status Reservasi diubah menjadi belum bayar, alasan anda ${alasan} akan dikirimkan ke user`,
//                             icon: "error",
//                         })
//                     };
                    
//                 } else {
//                 }
//             });
            
//             return false;
//         }



                    
                    
    </script>
    
@endsection
