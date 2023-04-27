@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Katalog Fasilitas</h1>
    </div>

    <div class="col-lg-11">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>

    


    <div class="table-responsive col-lg-11">
        
        <a href="/dashboard/admin_cafe/katalog/create" class="btn btn-sm btn-primary mb-3">Buat katalog baru</a>

        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Fasilitas</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah Persediaan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($katalogs as $katalog)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $katalog->nama_fasilitas }}</td>
                    <td>Rp.{{ $katalog->harga }}</td>
                    <td>{{ $katalog->persediaan }}</td>
                    <td>
                        <a href="/dashboard/admin_cafe/katalog/{{ $katalog->id }}" class="badge bg-info">
                            <span data-feather="eye"></span>
                        </a>
                        <a href="/dashboard/admin_cafe/katalog/{{ $katalog->id }}/edit" class="badge bg-success">
                            <span data-feather="edit"></span>
                        </a>
                        <form action="/dashboard/admin_cafe/katalog/{{ $katalog->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">
                                <span data-feather="x-circle"></span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
