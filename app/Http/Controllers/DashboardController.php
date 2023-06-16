<?php

namespace App\Http\Controllers;

use App\Charts\BarangChart;
use App\Charts\BarangGudang1Chart;
use App\Charts\BarangGudang2Chart;
use App\Charts\BarangGudang3Chart;
use App\Models\Barang;
use App\Models\BarangGudang;
use App\Models\Estimator;
use App\Models\Gudang;
use App\Models\StafGudang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getCount(BarangChart $barangChart, BarangGudang1Chart $barangGudang1Chart, BarangGudang2Chart $barangGudang2Chart, BarangGudang3Chart $barangGudang3Chart){
        $gudangs = Gudang::count();
        $stafs = StafGudang::count();
        $estimators = Estimator::count();
        $suppliers = Supplier::count();
        // $data = DB::table('BarangGudang')
        // ->join('Barang', 'BarangGudang.kode_barang', '=', 'Barang.id')
        // ->where('Barang.id_kategori', 1)
        // ->where('id_gudang', 1)
        // ->sum('kuantitas_barang');

        return view('admin.dashboard', [
            'gudangs' => $gudangs,
            'stafs' => $stafs,
            'estimators' => $estimators,
            'suppliers' => $suppliers,
            'barangChart' => $barangChart->build(),
            'barangGudang1Chart' => $barangGudang1Chart->build(),
            'barangGudang2Chart' => $barangGudang2Chart->build(),
            'barangGudang3Chart' => $barangGudang3Chart->build()
        ]);
    }

    public function getData(Request $request){

    }

    public function getCountBarang(){
        $barangs = BarangGudang::all();
    }

    
}
