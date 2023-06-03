@extends('layouts/main_landing')

@section('container')
    <div id="home" class="container-fluid py-4 d-flex  align-items-center" 
    style="min-height:620px;
        background-image: url('image/carousel-4.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;">
        <div class="row justify-content-center text-white">
            <div class="col-md-6 text-center" style="padding:10px 100px;">
                <h2 class="mb-4" style="font-weight: 700;font-size: 40px">Digitalisasi Reservasi Cafe</h2>
                <p style="font-size: 18px;font-weight: 500;">Kini hanya dalam sentuhan tangan melakukan reservasi atau mengatur kegiatan cafemu menjadi semakin mudah dan cepat dengan website reservasi kafe, Reserv.in!</p>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-0" style="background-color: #EFC3A4; ">
        
        <div class="container">
            <div class="row my-4 mx-5 justify-content-center ">
                <div class="col-md-8 text-center mx-5">
                    <p class="mb-4 mt-4 mx-5" style="font-size: 17px; font-weight:500;">Reserv.in menghadirkan berbagai macam jenis kafe dengan 
                        pilihan fasilitas yang beragam. Penuhi kebutuhan dan buat pertemuan 
                        tidak terlupakan dengan orang terdekatmu hanya disini</p>
                </div>
            </div>
            <div class="row mb-5 justify-content-center">
                @foreach($cafes as $cafe)
                <div class="col-lg-4 col-md-6 col-sm-8 mb-3 me-1">
                    <div class="card border border-secondary" style="width:20rem;height:400px;background-color:#F1DEC9;">
                        <img src="{{ asset('storage/' . $cafe->gambar_cafe)  }}" class="card-img-top" alt="" style="height: 180px;border-top-right-radius: 20px;border-top-left-radius: 20px">
                        <div class="card-body">
                            <h5 class="card-title mb-0">
                                <a href="{{ route('cust.home.show', $cafe->id) }}" class="text-decoration-none text-dark">{{ $cafe->nama_cafe }}</a>
                            </h5>
                            <p class="my-0">
                                <small class="text-body-secondary my-0">
                                    {{ $cafe->alamat_cafe }}, {{ $cafe->kota }}
                                </small>
                            </p>
                            
                            <p class="my-0 pt-2">
                                <small class="text-body-secondary my-0">
                                    Deskripsi: {!! $cafe->deskripsi_cafe !!}
                                </small>
                            </p>
                            <a href="{{ route('cust.home.show', $cafe->id) }}" class="btn btn-sm btn-dark" 
                            style="position: absolute;
                                bottom: 20px;
                                width: 20%;
                                height: 30px;background-color: #A85C49">
                            Lanjut</a>
                        </div>
                    </div>
                </div>
            @endforeach()
            </div>
        </div>
        
    </div>

    <div id="about" class="container-fluid mb-4 pb-1" style="background-color:white;">
        <h3 class="my-5 text-center" style="font-weight:700">Layanan Website</h3>
        <div class="container" style="width:70%"> 
            <div class="row text-center">
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <i class="bi bi-bookmark-check-fill" style="font-size: 35px"></i>
                    <h5 class="pt-2" >Reservasi</h5>
                    <p>Lakukan pemesanan kafe hanya dalam beberapa langkah di dalam website!</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <i class="bi bi-cup-hot-fill" style="font-size: 35px"></i>
                    <h5 class="pt-2">Katalog Kafe</h5>
                    <p>Sebelum melakukan reservasi, kamu bisa melihat kafe-akfe yang tersedia beserta fasilitas yang ditawarkan!</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <i class="bi bi-house-fill" style="font-size: 35px"></i>
                    <h5 class="pt-2">Katalog Fasilitas</h5>
                    <p>Buat katalog beserta fasilitas yang disediakan untuk mengenalkan kafemu!</p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                    <i class="bi bi-book-fill" style="font-size: 35px"></i>
                    <h5 class="pt-2">Pencatatan</h5>
                    <p>Permudah kegiatan kafemu dengan layanan pencatatan stok, keuangan, serta daftar reservasi</p>
                </div>
            </div>
        </div>
    </div>

    <div id="faq" class="container-fluid d-flex flex-column align-items-center mb-4" style="width:70%;">
        <h3 class="mb-4 text-center" style="font-weight:700">Pertanyaan Seputar Reservin</h3>
    
        <div class="card mb-4" style="width: 70%; border-radius:20px; background-color:#FDCA92; border-style: solid; border-width: 2px; border-color: #794028">
            <div class="card-body">
                <p class="border-bottom border-secondary pb-2">
                    <a class="btn collapsed" data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                        <i class="fa-solid fa-plus ms-4"></i>
                        Bagaimana cara menggunakan layanan website?
                    </a>
                </p>

                
                <div class="collapse me-2" id="collapse1">
                    <p class="text-justify">Untuk dapat menggunakan layanan website, pertama-tama kamu dapat melakukan login 
                        atau registrasi dahulu (bagi yang belum mempunyai akun). Setelah melakukan login, 
                        kamu baru dapat menggunakan layanan website.</p> 
                </div>
            </div>
        </div>

        <div class="card mb-4" style="width: 70%; border-radius:20px; background-color:#FDCA92; border-style: solid; border-width: 2px; border-color: #794028">
            <div class="card-body">
                <p class="border-bottom border-secondary pb-2">
                    <a class="btn collapsed" data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                        <i class="fa-solid fa-plus ms-4"></i>
                        Bagaimana cara membayar reservasi?
                    </a>
                </p>

                
                <div class="collapse me-2" id="collapse2"style="">
                    <p>Setelah mengisi form reservasi, kamu akan mendapatkan QR Code 
                        untuk melakukan pembayaran melalui aplikasi e-wallet yang tersedia</p> 
                </div>
            </div>
        </div>
    </div>
        

</main>
@endsection
