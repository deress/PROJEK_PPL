@extends('dashboard_admin_cafe/layouts/main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Data Stok</h1>
</div>    

<div class="col-lg-8">
    <form method="post" action="/dashboard/admin_cafe/stok" class="mb-5">
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

        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>



@endsection