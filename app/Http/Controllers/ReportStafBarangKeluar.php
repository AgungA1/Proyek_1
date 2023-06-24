<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportStafBarangKeluar extends Controller
{
    public function index(){
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $barangKeluar = BarangKeluar::where('id_gudang', $gudang)->get();
        return view('staf.report.reportBarangKeluar', [
            'barangKeluar' => $barangKeluar
        ]);
    }

    public function cetak($id){
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $barangKeluar = BarangKeluar::where('id_gudang', $gudang)->find($id);
        $pdf = PDF::loadView('staf.report.reportBarangKeluar_pdf', ['barangKeluar' => $barangKeluar]);
        return $pdf->stream();
    }
}
