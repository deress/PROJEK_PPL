@extends('/dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
            <h1 class="h2">Selamat datang, {{ auth()->user()->name }}</h1>
        </div>
    </div>

    <div class="container">
        
        <div class="card mb-4 mt-4" style="min-width: 60%; border-radius:20px;">
            <div class="card-body text-white" 
            style="padding: 1.5rem 2rem;
            gap: 1rem;
            border-radius: 2rem;
            background: linear-gradient( hsl(35, 100%, 68%), hsl(29, 68%, 34%));">
                <div class="row border-bottom mb-3 pb-2">
                    <h2 class="mb-0 " style="font-weight:700;color:hsl(44, 11%, 20%);">Reservasi Cafe</h2>
                </div>
    
                <div class="row">
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <h5 class="mb-3" style="font-weight:700; color:hsl(39, 100%, 89%);">Perlu Konfirmasi</h5>

                        <div class="d-flex flex-column align-items-center justify-content-center mb-1" 
                        style="width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        background: linear-gradient( hsla(31, 100%, 75%, 1), hsla(15, 81%, 52%, 0));
                        color:hsl(44, 11%, 20%);">
                            <h3 class="mt-3 mb-0" style="font-size: 40px;font-weight:700;">{{ $jumlah_konfirmasi }}</h3>
                            <p style="font-size:20px;">dari {{ $jumlah_reservasi }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <h5 class="mb-3" style="font-weight:700; color:hsl(39, 100%, 89%);">Reservasi Diterima</h5>

                        <div class="d-flex flex-column align-items-center justify-content-center mb-1" 
                        style="width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        background: linear-gradient( hsla(31, 100%, 75%, 1), hsla(15, 81%, 52%, 0));
                        color:hsl(44, 11%, 20%);">
                            <h3 class="mt-3 mb-0" style="font-size: 40px; font-weight:700;">{{ $jumlah_diterima }}</h3>
                            <p style="font-size:20px;">dari {{ $jumlah_reservasi }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <h5 class="mb-3" style="font-weight:700; color:hsl(39, 100%, 89%);">Reservasi Dibatalkan</h5>

                        <div class="d-flex flex-column align-items-center justify-content-center mb-1" 
                        style="width: 150px;
                        height: 150px;
                        border-radius: 50%;
                        background: linear-gradient( hsla(31, 100%, 75%, 1), hsla(15, 81%, 52%, 0));
                        color:hsl(44, 11%, 20%);">
                            <h3 class="mt-3 mb-0" style="font-size: 40px; font-weight:700;">{{ $jumlah_dibatalkan }}</h3>
                            <p style="font-size:20px;">dari {{ $jumlah_reservasi }}</p>
                        </div>
                    </div>
                    
                </div>
    
                
            </div>
        </div>
    </div>
    
    

@endsection