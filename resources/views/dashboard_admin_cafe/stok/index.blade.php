@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Stok</h1>
    </div>

    <div class="col-lg-11">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>

    


    <div class="table-responsive col-lg-11">
        
        <a href="{{ route('admin_cafe.stok.create') }}" class="btn btn-sm btn-dark mb-3" style="background-color: #A85C49">Buat data stok baru</a>

        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Tgl Stok Awal</th>
                <th scope="col">Unit</th>
                <th scope="col">Stok Awal</th>
                <th scope="col">Tgl Update</th>
                <th scope="col">Stok Saat Ini</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stoks as $stok)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $stok->nama_produk }}</td>
                    <td>{{ $stok->created_at }}</td>
                    <td>{{ $stok->unit }}</td>
                    <td>{{ $stok->initial_stok }}</td>
                    <td>{{ $stok->updated_at }}</td>
                    <td>{{ $stok->current_stok }}</td>
                    
                    <td>
                        <a href="{{ route('admin_cafe.stok.edit', $stok->id) }}" class="badge text-dark" style="background-color: #FDB13E">
                            <span data-feather="edit"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
