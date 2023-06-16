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

    public function cetak(){

    }
}
