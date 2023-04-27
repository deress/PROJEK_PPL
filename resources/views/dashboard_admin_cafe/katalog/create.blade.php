@extends('dashboard_admin_cafe/layouts/main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Katalog Baru</h1>
</div>    

<div class="col-lg-8">
    <form method="post" action="/dashboard/admin_cafe/katalog" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
            <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" name="nama_fasilitas" id="nama_fasilitas" required autofocus value="{{ old('nama_fasilitas') }}">
            @error('nama_fasilitas')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" required value="{{ old('harga') }}">
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar_fasilitas" class="form-label">Gambar Fasilitas</label>
            <img class="img-fluid mb-3 col-sm-5 d-block" id="frame">
            <input type="file" class="form-control @error('gambar_fasilitas') is-invalid @enderror" name="gambar_fasilitas" id="gambar_fasilitas" onchange="previewImage()">
            @error('gambar_fasilitas')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi_fasilitas" class="form-label">Deskripsi Fasilitas</label>
            @error('deskripsi_fasilitas')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input id="deskripsi_fasilitas" type="hidden" name="deskripsi_fasilitas" value="{{ old('deskripsi_fasilitas') }}">
            <trix-editor input="deskripsi_fasilitas"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="persediaan" class="form-label">Jumlah Persediaan</label>
            <input type="text" class="form-control @error('persediaan') is-invalid @enderror" name="persediaan" id="persediaan" required value="{{ old('persediaan') }}">
            @error('persediaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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