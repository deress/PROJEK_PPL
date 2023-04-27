@extends('/dashboard_admin_cafe/layouts/main')


@section('container')

<div class="container"style="height:600px">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Profile</h1>
    </div> 

    <div class="col-lg-8" >
        <form method="post" action="/dashboard/admin_cafe/profile/{{ $user->email }}" enctype="multipart/form-data" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nohp" class="form-label">Nomor Handphone</label>
                <input type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" required value="{{ old('nohp', $user->nohp) }}">
                @error('nohp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <small>(Isi jika ingin mengganti password)</small>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password">
            </div>

            <div class="mb-3">
                <label for="nama_cafe" class="form-label">Nama Cafe</label>
                <input type="text" class="form-control @error('nama_cafe') is-invalid @enderror" name="nama_cafe" id="nama_cafe" required value="{{ old('nama_cafe', $user->cafe->nama_cafe) }}">
                @error('nama_cafe')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat_cafe" class="form-label">Alamat Cafe</label>
                <input type="text" class="form-control @error('alamat_cafe') is-invalid @enderror" name="alamat_cafe" id="alamat_cafe" required value="{{ old('alamat_cafe', $user->cafe->alamat_cafe) }}">
                @error('alamat_cafe')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" required value="{{ old('kecamatan', $user->cafe->kecamatan) }}">
                @error('kecamatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" id="kota" required value="{{ old('kota', $user->cafe->kota) }}">
                @error('kota')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gambar_cafe" class="form-label">Gambar Cafe</label>
                <img src="{{ asset('storage/' . $user->cafe->gambar_cafe) }}" class="img-fluid mb-3 col-sm-5 d-block" id="frame">
                <input type="file" class="form-control @error('gambar_cafe') is-invalid @enderror" name="gambar_cafe" id="gambar_cafe" onchange="previewImage()">
                @error('gambar_cafe')
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
                <input id="deskripsi_cafe" type="hidden" name="deskripsi_cafe" value="{{ old('deskripsi_cafe', $user->cafe->deskripsi_cafe) }}">
                <trix-editor input="deskripsi_cafe"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            
        </form>
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