@extends('dashboard_admin_sistem/layouts/main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Katalog Baru</h1>
</div>    

<div class="col-lg-8">
    <form method="post" action="/dashboard/admin_sistem/register" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nohp" class="form-label">No Telepon</label>
            <small>(Isi dengan kode No Hp Indonesia, +62)</small>
            <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" required value="{{ old('nohp') }}">
            @error('nohp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required value="password" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_cafe" class="form-label">Nama Cafe</label>
            <input type="text" class="form-control @error('nama_cafe') is-invalid @enderror" name="nama_cafe" id="nama_cafe" required autofocus value="{{ old('nama_cafe') }}">
            @error('nama_cafe')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="alamat_cafe" class="form-label">Alamat Cafe</label>
            <input type="text" class="form-control @error('alamat_cafe') is-invalid @enderror" name="alamat_cafe" id="alamat_cafe" required autofocus value="{{ old('alamat_cafe') }}">
            @error('alamat_cafe')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required autofocus value="{{ old('kecamatan') }}">
            @error('kecamatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kota" class="form-label">Kota</label>
            <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" required autofocus value="{{ old('kota') }}">
            @error('kota')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar_cafe" class="form-label">Gambar Cafe</label>
            <img class="img-fluid mb-3 col-sm-5 d-block" id="frame">
            <input type="file" class="form-control @error('gambar_cafe') is-invalid @enderror" name="gambar_cafe" id="gambar_cafe" onchange="previewImage()">
            @error('gambar_cafe')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_buka" class="form-label">Jam Buka</label>
            <input type="time" class="form-control @error('jam_buka') is-invalid @enderror" name="jam_buka" id="jam_buka" required autofocus value="{{ old('jam_buka') }}">
            @error('jam_buka')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jam_tutup" class="form-label">Jam Tututp</label>
            <input type="time" class="form-control @error('jam_tutup') is-invalid @enderror" name="jam_tutup" id="jam_tutup" required autofocus value="{{ old('jam_tutup') }}">
            @error('jam_tutup')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi_cafe" class="form-label">Deskripsi Cafe</label>
            @error('deskripsi_cafe')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <input id="deskripsi_cafe" type="hidden" name="deskripsi_cafe" value="{{ old('deskripsi_cafe') }}">
            <trix-editor input="deskripsi_cafe"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="gambar_qris" class="form-label">Gambar QRIS</label>
            <img class="img-fluid mb-3 col-sm-5 d-block" id="frame">
            <input type="file" class="form-control @error('gambar_qris') is-invalid @enderror" name="gambar_qris" id="gambar_qris" onchange="previewImage()">
            @error('gambar_qris')
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