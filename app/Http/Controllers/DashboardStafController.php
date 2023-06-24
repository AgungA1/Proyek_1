<?php

namespace App\Http\Controllers;

use App\Charts\MasukKeluarStafChart;
use App\Charts\StafChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardStafController extends Controller
{
    public function index(StafChart $stafChart, MasukKeluarStafChart $masukKeluarStafChart){
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;

        return view('staf.dashboard', [
            'stafChart'=>$stafChart->build(),
            'masukKeluarStafChart'=>$masukKeluarStafChart->build()
        ]);

    }
}
