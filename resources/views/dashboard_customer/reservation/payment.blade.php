@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pembayaran</h1>
    </div>  
    <div class="row justify-content-center align-items-center my-3">
        <div class="col-5" >
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <img src="{{ asset('storage/' . $cafe->gambar_qris) }}" class="img-fluid d-block" id="frame">
            <p>Silahkan lakukan pembayaran anda sebesar <b>Rp {{ $reservation->harga_total }}</b> 
                sebelum tenggat pembayaran yaitu {{ $reservation->tenggat_pembayaran }} melalui QRIS diatas. 
                Agar cafe dapat memproses reservasi Anda. Cek reservasi Anda secara berkala pada menu riwayat reservasi.</p>

            <a href="{{ route('cust.home.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-return-right"></i>
                Lanjutkan
            </a>
        </div>

    </div>
    
</div>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault()
    })
    
    function previewImage() {
        frame.src=URL.createObjectURL(event.target.files[0]);
    }

</script>


@endsection