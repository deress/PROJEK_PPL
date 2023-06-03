@extends('/dashboard_customer/layouts/main_pelanggan')


@section('container')


<div class="container">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Reservasi</h1>
    </div>  

    <div class="col-lg-8">
        <p>Sisa : {{ $sisa }}</p>
        <form method="post" action="{{ route('cust.katalog.update', $katalog->id) }}" class="mb-5">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="jumlah_reservasi" class="form-label">Jumlah</label>
                <input type="number" class="form-control @error('jumlah_reservasi') is-invalid @enderror" name="jumlah_reservasi" id="jumlah_reservasi" required autofocus value="{{ old('jumlah_reservasi') }}">
                @error('jumlah_reservasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
                <input type="date" class="form-control @error('tanggal_reservasi') is-invalid @enderror" name="tanggal_reservasi" id="tanggal_reservasi" required value="{{ old('tanggal_reservasi') }}">
                @error('tanggal_reservasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_awal" class="form-label">Jam Kehadiran Reservasi</label>
                <input type="time" class="form-control @error('jam_awal') is-invalid @enderror" name="jam_awal" id="jam_awal" required value="{{ old('jam_awal') }}">
                @error('jam_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jam_akhir" class="form-label">Jam Selesai Reservasi</label>
                <input type="time" class="form-control @error('jam_akhir') is-invalid @enderror" name="jam_akhir" id="jam_akhir" required value="{{ old('jam_akhir') }}">
                @error('jam_akhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <a href="{{ route('cust.katalog.show', $katalog->cafe_id) }}" class="text-decoration-none btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Submit</button>
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