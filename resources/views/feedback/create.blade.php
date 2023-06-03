@extends('layouts/main_landing')



@section('container')

<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Beri Umpan Balik</h1>
    </div> 

    <div class="col-lg-8" >
        <form method="post" action="{{ route('feedback.store') }}" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="umpan_balik" class="form-label">Umpan Balik</label>
                @error('umpan_balik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input id="umpan_balik" type="hidden" name="umpan_balik" value="{{ old('umpan_balik') }}">
                <trix-editor input="umpan_balik"></trix-editor>
            </div>
            <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Kirim</button>
            
        </form>
    </div>
</div>


<script>
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault()
    })
    
    function previewImage() {
        frame.src=URL.createObjectURL(event.target.files[0]);
    }

</script>

@endsection