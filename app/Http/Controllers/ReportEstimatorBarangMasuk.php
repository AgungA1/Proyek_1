<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class ReportEstimatorBarangMasuk extends Controller
{
    public function index(){
        $barangMasuk = BarangMasuk::paginate(5);
        return view('estimator.report.reportBarangMasuk', ['barangMasuk'=>$barangMasuk]);
    }

    public function cetak($id){
        $barangMasuk = BarangMasuk::find($id);
        $pdf = PDF::loadView('estimator.report.reportBarangMasuk_pdf',['barangMasuk'=>$barangMasuk]);
        return $pdf->stream();
    }
}
