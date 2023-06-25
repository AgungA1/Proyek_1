<?php

namespace App\Http\Controllers;

use App\Charts\ReportChart;
use App\Charts\ReportGudang1Chart;
use App\Models\BarangGudang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class ReportController extends Controller
{
    public function index(){
        // return view('admin.report.report', ['report1Chart' => $report1Chart->build()]);
        $barangGudang = BarangGudang::paginate(5);
        return view('admin.report.report', ['barangGudang'=>$barangGudang]);
    }

    public function cetak($id){
        $barangGudang = BarangGudang::find($id);
        $pdf = PDF::loadView('admin.report.report_pdf',['barangGudang'=>$barangGudang]);
        return $pdf->stream();
    }
}
