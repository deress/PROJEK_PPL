@extends('layouts/main_landing')

@section('container')
<div class="container">
    <div class="row justify-content-center my-5">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="col-md-5">
            <div class="card" style="border-radius:20px;background-color:#F1DEC9">
                <div class="card-body">
                    <h3 class="card-title mb-3 text-center">Login</h3>
                    <div class="card-text">
                        <form action="/login" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email address" autofocus required value="{{ old('email') }}">
                                <label for="email">Alamat Email</label>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <button class="w-100 btn btn-md btn-dark" type="submit" style="background-color: #A85C49">Login</button>
                        </form>
                        <small class="d-block text-center mt-3">Belum memiliki akun? <a href="/register">Register Sekarang!</a></small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    
@endsection