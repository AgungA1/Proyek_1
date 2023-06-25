<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class ReportEstimatorBarangKeluar extends Controller
{
    public function index(){
        $barangKeluar = BarangKeluar::paginate(5);
        return view('estimator.report.reportBarangKeluar', ['barangKeluar'=>$barangKeluar]);
    }

    public function cetak($id){
        $barangKeluar = BarangKeluar::find($id);
        $pdf = PDF::loadView('estimator.report.reportBarangKeluar_pdf',['barangKeluar'=>$barangKeluar]);
        return $pdf->stream();
    }
}
