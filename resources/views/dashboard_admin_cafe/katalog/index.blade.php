@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
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
        
        <a href="{{ route('admin_cafe.katalog.create') }}" class="btn btn-sm btn-dark mb-3" style="background-color: #A85C49">Buat katalog baru</a>

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
                    <td>Rp {{ $katalog->harga }}</td>
                    <td>{{ $katalog->persediaan }}</td>
                    <td>
                        <a href="{{ route('admin_cafe.katalog.show', $katalog->id) }}" class="badge text-dark" style="background-color: #B09D7F">
                            <span data-feather="eye"></span>
                        </a>
                        <a href="{{ route('admin_cafe.katalog.edit', $katalog->id) }}" class="badge text-dark" style="background-color: #FDB13E">
                            <span data-feather="edit"></span>
                        </a>
                        {{-- <form action="{{ route('admin_cafe.katalog.destroy', $katalog->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">
                                <span data-feather="x-circle"></span>
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

@endsection
