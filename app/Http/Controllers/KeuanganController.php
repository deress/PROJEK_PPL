<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function graph()
    {
        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        // $total_pendapatan = collect();
        // $daftar_keuangan = Keuangan::where('cafe_id', $cafe->id)
        //     ->orderBy('tanggal', 'desc')
        //     ->filter(request(['bulan', 'tahun']))
        //     ->get();

        $total_pemasukkan = Keuangan::where('cafe_id', $cafe->id)
            ->select(DB::raw("CAST(SUM(jumlah_pemasukkan) as int) as total_pemasukkan"))
            ->filter(request(['tahun']))
            ->groupBy(DB::raw("MONTHNAME(tanggal)"))
            ->pluck('total_pemasukkan');

        $total_pengeluaran = Keuangan::where('cafe_id', $cafe->id)
            ->select(DB::raw("CAST(SUM(jumlah_pengeluaran) as int) as total_pengeluaran"))
            ->filter(request(['tahun']))
            ->groupBy(DB::raw("MONTHNAME(tanggal)"))
            ->pluck('total_pengeluaran');

        $bulan = Keuangan::where('cafe_id', $cafe->id)
            ->select(DB::raw("MONTHNAME(tanggal) as bulan"))
            ->filter(request(['tahun']))
            ->groupBy(DB::raw("MONTHNAME(tanggal)"))
            ->pluck('bulan');

        $total_pendapatan = Keuangan::where('cafe_id', $cafe->id)
            ->select(
                DB::raw("CAST(SUM(jumlah_pemasukkan) as int) - CAST(SUM(jumlah_pengeluaran) as int) as total_pendapatan")
            )
            ->filter(request(['tahun']))
            ->groupBy(DB::raw("MONTHNAME(tanggal)"))
            ->pluck('total_pendapatan');

        return view('dashboard_admin_cafe.keuangan.grafik', [
            'total_pendapatan' => $total_pendapatan,
            'total_pemasukkan' => $total_pemasukkan,
            'total_pengeluaran' => $total_pengeluaran,
            'bulan' => $bulan,
            'tahun' => request('tahun'),
        ]);
    }


    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();
        $daftar_keuangan = Keuangan::where('cafe_id', $cafe->id)
            ->orderBy('tanggal', 'desc')
            ->filter(request(['bulan', 'tahun']))
            ->get();

        $total_pendapatan = 0;
        foreach ($daftar_keuangan as $keuangan) {
            if ($keuangan->jenis_data == 'pemasukkan') {
                $total_pendapatan += $keuangan->total;
            } else {
                $total_pendapatan -= $keuangan->total;
            }
        }

        // dd($daftar_keuangan);
        return view('dashboard_admin_cafe.keuangan.index', [
            'daftar_keuangan' => $daftar_keuangan,
            'total_pendapatan' => $total_pendapatan,
            'bulan' => request('bulan'),
            'tahun' => request('tahun'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_admin_cafe.keuangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'jenis_data' => 'required',
            'nominal' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'numeric' => 'Hanya boleh angka',

        ]);

        if ($request->jenis_data == 'pemasukkan') {
            $validatedData['jumlah_pemasukkan'] = $request->total;
        } else {
            $validatedData['jumlah_pengeluaran'] = $request->total;
        }

        $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        $validatedData['cafe_id'] = $cafe['id'];

        Keuangan::create($validatedData);

        return redirect()->route('admin_cafe.keuangan.index')->with('success', 'Data transaksi baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        return view('dashboard_admin_cafe.keuangan.edit', [
            'keuangan' => $keuangan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'jenis_data' => 'required',
            'nominal' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
            'total' => '',

        ],  [
            'numeric' => 'Hanya boleh angka',

        ]);

        // $cafe = Cafe::where('admin_id', auth()->user()->id)->first();

        // $validatedData['cafe_id'] = $cafe['id'];

        Keuangan::where('id', $keuangan->id)
            ->update($validatedData);

        return redirect()->route('admin_cafe.keuangan.index')->with('success', 'Data transaksi telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }
}
