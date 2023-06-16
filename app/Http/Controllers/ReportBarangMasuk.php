<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;


class ReportBarangMasuk extends Controller
{
    public function index(){
        $barangMasuk = BarangMasuk::paginate(5);
        return view('admin.report.reportBarangMasuk', ['barangMasuk'=>$barangMasuk]);
    }

    public function cetak(){

    }
}
