@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 px-3 my-3" style="background-color: #EFD9D0; border-radius:20px">
        <h1 class="h2">Keuangan</h1>
    </div>

    <div class="col-lg-11">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show dol-lg-8" role="alert">
            {{ session('success') }}
            
        </div>
        @endif
    </div>


    <div class="mb-3">
        <form action="/admin_cafe/keuangan" method="get" class="row">
            
            <div class="col-3 mb-3">
                
                <select id="bulan" name="bulan" class="form-select" required>
                    <option selected>Pilih Bulan...</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-3 mb-3">
                <input type="numeric" class="form-control" id="tahun" name="tahun" placeholder="Tahun..." required>
            </div>
            
            <div class="col-3 mb-3">
                <button class="btn btn-dark btn-md" type="submit" style="background-color: #A85C49">Search</button>
            </div>

        </form>
    </div>

    <div class="table-responsive col-lg-11">
        


        <a href="{{ route('admin_cafe.keuangan.create') }}" class="btn btn-sm btn-white mb-3" style="background-color: #EB8C64">Buat data keuangan baru</a>
        <a href="/admin_cafe/keuangan/graph" class="btn btn-sm btn-white mb-3" style="background-color: #FDB13E">Lihat Laporan Grafik Bulanan</a>
        
        <div class="card">
            <div class="card-header">
                @switch($bulan)
                    @case('01')
                        <h5 class='my-1'>Laporan Bulan Januari {{ $tahun }}</h5>
                        @break
                    @case('02')
                        <h5 class='my-1'>Laporan Bulan Februari {{ $tahun }}</h5>
                        @break
                    @case('03')
                        <h5 class='my-1'>Laporan Bulan Maret {{ $tahun }}</h5>
                        @break
                    @case('04')
                        <h5 class='my-1'>Laporan Bulan April {{ $tahun }}</h5>
                        @break
                    @case('05')
                        <h5 class='my-1'>Laporan Bulan Mei {{ $tahun }}</h5>
                        @break
                    @case('06')
                        <h5 class='my-1'>Laporan Bulan Juni {{ $tahun }}</h5>
                        @break
                    @case('07')
                        <h5 class='my-1'>Laporan Bulan Juli {{ $tahun }}</h5>
                        @break
                    @case('08')
                        <h5 class='my-1'>Laporan Bulan Agustus {{ $tahun }}</h5>
                        @break
                    @case('09')
                        <h5 class='my-1'>Laporan Bulan September {{ $tahun }}</h5>
                        @break
                    @case('10')
                        <h5 class='my-1'>Laporan Bulan Oktober {{ $tahun }}</h5>
                        @break
                    @case('11')
                        <h5 class='my-1'>Laporan Bulan November {{ $tahun }}</h5>
                        @break
                    @case('12')
                        <h5 class='my-1'>Laporan Bulan Desember {{ $tahun }}</h5>
                        @break
                    @default
                        <h5 class='my-1'>Semua Laporan Keuangan</h5>
                @endswitch
            </div>
            <div class="card-body">
                <p class="mt-2 mb-3"><b>Total Pendapatan : Rp {{ $total_pendapatan }}</b> </p>

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jenis Transaksi</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar_keuangan as $keuangan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $keuangan->tanggal }}</td>
                                @if ($keuangan->jenis_data == 'pemasukkan')
                                <td style="color:green">{{ $keuangan->jenis_data }}</td>
                                <td style="color:green">Rp {{ $keuangan->nominal }}</td>
                                @else
                                <td style="color:red">{{ $keuangan->jenis_data }}</td>
                                <td style="color:red">Rp {{ $keuangan->nominal }}</td>
                                @endif
                                <td>{{ $keuangan->jumlah }}</td>
                                <td>{{ $keuangan->keterangan}}</td>
                                @if ($keuangan->jenis_data == 'pemasukkan')
                                <td style="color:green">Rp {{ $keuangan->jumlah_pemasukkan }}</td>
                                @else
                                <td style="color:red">Rp {{ $keuangan->jumlah_pengeluaran }}</td>
                                @endif
                                <td>
                                    <a href="{{ route('admin_cafe.keuangan.edit', $keuangan->id) }}" class="badge text-dark" style="background-color: #FDB13E">
                                        <span data-feather="edit"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>  
        </div>
    </div>

@endsection
