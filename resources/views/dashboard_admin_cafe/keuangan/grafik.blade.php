@extends('dashboard_admin_cafe/layouts/main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
        <form action="/admin_cafe/keuangan/graph" method="get" class="row">
            <div class="col-3 mb-3">
                <input type="numeric" class="form-control" id="tahun" name="tahun" placeholder="Tahun...">
            </div>
            
            <div class="col-3 mb-3">
                <button class="btn btn-dark btn-md" type="submit" style="background-color: #A85C49">Search</button>
            </div>
        </form>
    </div>

    <div class="col-lg-11 mb-3">
        <a href="{{ route('admin_cafe.keuangan.index') }}" class="btn btn-sm btn-primary mb-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        

        <div class="card">
            <div class="card-header">
                <h5 class="my-1">Grafik Penjualan {{ $tahun }}</h5>
            </div>
            <div class="card-body">
                <div id="grafik">
                    
                </div>    
            </div>  
        </div>
    </div>




    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var total_pemasukkan = <?php echo json_encode($total_pemasukkan) ?>;
        var total_pengeluaran = <?php echo json_encode($total_pengeluaran) ?>;
        var total_pendapatan = <?php echo json_encode($total_pendapatan) ?>;
        var bulan = <?php echo json_encode($bulan) ?>;
        var colors = ["#198754", "#dc3545", "#0d6efd"];

        Highcharts.chart('grafik', {
            title: {
                text: 'Grafik Laporan Bulanan'
            },
            xAxis: {
                categories: bulan
            },
            yAxis: {
                title: {
                    text: 'Pemasukkan, Pengeluaran, dan Pendapatan Bulanan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect : true
                }
            },
            series: [
                {
                    name: 'Total Pemasukkan',
                    data: total_pemasukkan,
                    color: colors[0],
                },
                {
                    name: 'Total Pengeluaran',
                    data: total_pengeluaran,
                    color: colors[1],
                },
                {
                    name: 'Total Pendapatan',
                    data: total_pendapatan,
                    color: colors[2],
                },
            ]
        });
    </script>


@endsection
