@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pembayaran</h1>
    </div>  

    <div class="col-lg-8">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
        </div>
        @endif

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