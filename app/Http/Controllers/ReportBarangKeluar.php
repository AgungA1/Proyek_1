<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\BarangKeluar;


class ReportBarangKeluar extends Controller
{
    public function index(){
        $barangKeluar = BarangKeluar::paginate(5);
        return view('admin.report.reportBarangKeluar', ['barangKeluar'=>$barangKeluar]);
    }

    public function cetak($id){
        $barangKeluar = BarangKeluar::find($id);
        $pdf = PDF::loadView('admin.report.reportBarangKeluar_pdf',['barangKeluar'=>$barangKeluar]);
        return $pdf->stream();
    }
}
