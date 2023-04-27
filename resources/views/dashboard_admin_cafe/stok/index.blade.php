@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
        
        <a href="/dashboard/admin_cafe/stok/create" class="btn btn-sm btn-primary mb-3">Create new data stok</a>

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
                        <a href="/dashboard/admin_cafe/stok/{{ $stok->id }}/edit" class="badge bg-success">
                            <span data-feather="edit"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
