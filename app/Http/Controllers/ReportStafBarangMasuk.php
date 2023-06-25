<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportStafBarangMasuk extends Controller
{
    public function index(){
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $barangMasuk = BarangMasuk::where('id_gudang', $gudang)->get();
        return view('staf.report.reportBarangMasuk', [
            'barangMasuk' => $barangMasuk
        ]);
    }

    public function cetak($id){
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $barangMasuk = BarangMasuk::where('id_gudang', $gudang)->find($id);
        $pdf = PDF::loadView('staf.report.reportBarangMasuk_pdf', ['barangMasuk' => $barangMasuk]);
        return $pdf->stream();
    }
}
