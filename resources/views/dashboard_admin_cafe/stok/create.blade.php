@extends('dashboard_admin_cafe/layouts/main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
    <h1 class="h2">Buat Data Stok Baru</h1>
</div>    

<div class="col-lg-8">
    <form method="post" action="{{ route('admin_cafe.stok.index') }}" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk" required autofocus value="{{ old('nama_produk') }}">
            @error('nama_produk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">Satuan</label>
            <small>(Isi satuan produk sesuai dengan produk yang diinputkan, misal: kg, liter, pcs, dsb)</small>
            <input type="text" class="form-control @error('unit') is-invalid @enderror" name="unit" id="unit" required value="{{ old('unit') }}">
            @error('unit')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="initial_stok" class="form-label">Stok Awal</label>
            <input type="text" class="form-control @error('initial_stok') is-invalid @enderror" name="initial_stok" id="initial_stok" required  value="{{ old('initial_stok') }}">
            @error('initial_stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Kirim</button>
    </form>
</div>



@endsection