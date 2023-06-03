@extends('layouts/main_landing')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Daftar Umpan Balik</h1>
    </div>  

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="row justify-content-center align-items-center my-3">
        <div class="col-6">
            <a href="{{ route('feedback.create') }}" class="btn btn-sm btn-dark mb-2" style="background-color: #A85C49">Beri umpan balik</a>

        </div>
    </div>
    @foreach ($feedbacks as $feedback)
    <div class="row justify-content-center align-items-center my-3">
        <div class="col-6" >
            <div class="card mb-4 mx-0" style="min-width: 60%; border-radius:20px;background-color:rgba(227, 181, 110, 0.1);">
                <div class="card-body">
                    <div class="row border-bottom pb-2">
                        <span><b>Umpan Balik</b></span>
                    </div>
                    <div class="row pt-2">
                        <span style="font-size: 16px"><b style="font-size: 16px">{{ $feedback->name }}</b> · {{ $feedback->email }}</span>
                        <small class="pb-1">
                            {{ $feedback->created_at }}
                        </small>
                        {{-- <p class="mb-1">Website sangat berguna sudah bagus</p> --}}
                        {!! $feedback->umpan_balik !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endforeach
    
    
    
    
    
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