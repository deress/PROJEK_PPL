@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Edit Profile</h1>
    </div> 

    <div class="col-lg-8">
        <form method="post" action="{{ route('cust.profile.update', $user->email) }}" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
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
                <small>(Isi dengan kode No Hp Indonesia yaitu, +62)</small>
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
            <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Simpan</button>
            
        </form>
    </div>
</div>




@endsection