@extends('/dashboard_admin_cafe/layouts/main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
    <h1 class="h2">Perbarui Data Keuangan</h1>
</div> 

<div class="col-lg-8" >
    <form method="post" action="{{ route('admin_cafe.keuangan.update', $keuangan->id) }}" class="mb-5">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" required value="{{ old('tanggal', $keuangan->tanggal) }}">
            @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jenis_data" class="form-label">Jenis Transaksi</label>
            <select id="jenis_data" name="jenis_data" class="form-select">
                @for ($i = 0; $i < 1; $i++)
                    @if (old('jenis_data', $keuangan->jenis_data) == 'pemasukkan')
                        <option value="pemasukkan" selected>Pemasukkan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    @else
                        <option value="pemasukkan">Pemasukkan</option>
                        <option value="pengeluaran" selected>Pengeluaran</option>
                    @endif    
                @endfor
            </select>
            @error('nama_produk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" id="nominal" required value="{{ old('nominal', $keuangan->nominal) }}">
            @error('nominal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" required value="{{ old('jumlah', $keuangan->jumlah) }}">
            @error('jumlah')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" required  value="{{ old('keterangan', $keuangan->keterangan) }}">
            @error('keterangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control @error('total') is-invalid @enderror" name="total" id="total" required value="{{ $keuangan->total }}" readonly>
            @error('total')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-dark" style="background-color: #A85C49">Kirim</button>
    </form>
</div>

<script>
    const total = document.querySelector('#total')
    const nominal = document.querySelector('#nominal')
    const jumlah = document.querySelector('#jumlah')

    nominal.addEventListener('change', function() {
        total.value = nominal.value * jumlah.value
    })

    jumlah.addEventListener('change', function() {
        total.value = nominal.value * jumlah.value
    })


</script>


@endsection