@extends('dashboard_admin_cafe/layouts/main')

@section('container')
<div class="container">
    <div class="row my-4">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $katalog->nama_fasilitas }}</h1>
                <a href="/dashboard/admin_cafe/katalog" class="btn btn-sm btn-success"> <span data-feather="arrow-left"></span> Back to all my posts</a>
                <a href="/dashboard/admin_cafe/katalog/{{ $katalog->id }}/edit" class="btn btn-sm btn-warning"> <span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/admin_cafe/katalog/{{ $katalog->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin?')">
                        <span data-feather="x-circle"></span>Delete
                    </button>
                </form>

                <img src="{{ asset('storage/' . $katalog->gambar_fasilitas)  }}" class="card-img-top img-fluid mt-3" style="height:600px">


                <article class="my-2 fs-5">
                    {!! $katalog->deskripsi_fasilitas  !!}
                </article>
        </div>
    </div>
</div>
@endsection
