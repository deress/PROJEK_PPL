@extends('/dashboard_admin/layouts/main')


@section('container')

<div class="container"style="height:600px">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Profile</h1>
    </div> 

    <div class="col-lg-8" >
        <form method="post" action="/dashboard/admin/profile/{{ $user->email }}" class="mb-5">
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            
        </form>
    </div>
</div>




@endsection