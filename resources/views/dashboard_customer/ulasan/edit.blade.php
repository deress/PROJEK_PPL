@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ulasan</h1>
    </div>  

    <div class="col-lg-8">
        <form method="post" action="{{ route('cust.reservation.update', $reservation->id) }}" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="ulasan" class="form-label">Ulasan</label>
                @error('ulasan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <input id="ulasan" type="hidden" name="ulasan" value="{{ old('ulasan') }}">
                <trix-editor input="ulasan"></trix-editor>
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="rating_id" class="form-label">Rating</label>
                    <select id="rating_id" name="rating_id" class="form-select">
                        @foreach ($ratings as $rating)
                        @if (old('rating_id') == $rating->id)
                            <option value="{{ $rating->id }}" selected>{{ $rating->name }}</option>
                        @else
                            <option value="{{ $rating->id }}">{{ $rating->name }}</option>
                        @endif    
                    @endforeach
                    </select>
                    @error('rating_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
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