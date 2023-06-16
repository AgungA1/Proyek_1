<?php

namespace App\Http\Controllers;

use App\Charts\BarangChart;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(BarangChart $barang)
    {
        return view('admin.report', ['BarangChart' => $barang->build()]);
    }
}
