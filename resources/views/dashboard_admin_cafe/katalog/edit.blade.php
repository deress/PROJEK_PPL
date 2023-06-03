@extends('/dashboard_admin_cafe/layouts/main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
    <h1 class="h2">Edit Data Stok</h1>
</div> 

<div class="col-lg-8" >
    <form method="post" action="{{ route('admin_cafe.katalog.update', $katalog->id) }}" class="mb-5" enctype="multipart/form-data"  onsubmit="return popUpUpdate(this)">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
            <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" name="nama_fasilitas" id="nama_fasilitas" required autofocus value="{{ old('nama_fasilitas', $katalog->nama_fasilitas) }}">
            @error('nama_fasilitas')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" required value="{{ old('harga', $katalog->harga) }}">
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar_fasilitas" class="form-label">Gambar Fasilitas</label>
            <img src="{{ asset('storage/' . $katalog->gambar_fasilitas) }}"  class="img-fluid mb-3 col-sm-5 d-block" id="frame">
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
            <input id="deskripsi_fasilitas" type="hidden" name="deskripsi_fasilitas" value="{{ old('deskripsi_fasilitas', $katalog->deskripsi_fasilitas) }}">
            <trix-editor input="deskripsi_fasilitas"></trix-editor>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Fasilitas yang Diterima</label><br>
            <small>* Gunakan ctrl untuk memilih beberapa fasilitas </small><br>
            <small>** Lewati jika fasilitas tidak diubah</small>
            <select name="daftar_fasilitas[]" class="form-select" multiple>
                <option value="ruangan ac">Ruangan AC</option>
                <option value="ruangan merokok">Ruangan Merokok</option>
                <option value="stop kontak">Stop Kontak</option>
                <option value="kursi bayi">Kursi Bayi</option>
                <option value="musholla">Musholla</option>
                <option value="toilet">Toilet</option>
                <option value="wifi">Wifi</option>
                <option value="live music">Live Music</option>
            </select>
            @error('nama_produk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="persediaan" class="form-label">Jumlah Persediaan</label>
            <input type="numeric" class="form-control @error('persediaan') is-invalid @enderror" name="persediaan" id="persediaan" required value="{{ old('persediaan', $katalog->persediaan) }}">
            @error('persediaan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Simpan</button>
    </form>
    

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.20/dist/sweetalert2.all.min.js"></script>

<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault()
    })
    
    function previewImage() {
        frame.src=URL.createObjectURL(event.target.files[0]);
    }

    const swals = Swal.mixin({
        // cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
    });

    function popUpUpdate(form) {
        swals.fire({
            title: "Apakah Anda yakin melakukan perubahan ini?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal ',
        }).then((result) => {
            if (result.isConfirmed) {
                swals.fire({
                    title: "Perubahan berhasil disimpan",
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