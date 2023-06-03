@extends('layouts/main_landing')

@section('container')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-5">
            <div class="card" style="border-radius:20px;background-color:#F1DEC9">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">Register</h3>
                    <form action="/register" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" id="name" placeholder="Name"  required value="{{ old('name') }}">
                            <label for="name">Nama</label>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" iid="email" placeholder="Email address"  required value="{{ old('email') }}">
                            <label for="email">Alamat Email</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" id="nohp" placeholder="No Handphone"  required value="{{ old('nohp') }}">
                            <label for="nohp">No Handphone</label>
                            @error('nohp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control @error('nohp') is-invalid @enderror" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Confirm Password" required>
                            <label for="password">Konfirmasi Password</label>
                            
                        </div>
                        <button class="w-100 btn btn-md btn-dark" type="submit" style="background-color: #A85C49">Register</button>
                    </form>
                    <div class="card-text">
                        <small class="d-block text-center mt-3">Sudah memiliki akun? <a href="/login">Login</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection