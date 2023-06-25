<?php

namespace App\Http\Controllers;

use App\Charts\MasukKeluarEstimatorChart;
use Illuminate\Http\Request;

class DashboardEstimatorController extends Controller
{
    public function index(MasukKeluarEstimatorChart $masukKeluarEstimatorChart){

        return view('estimator.dashboard', [
            'masukKeluarEstimatorChart' => $masukKeluarEstimatorChart->build()
        ]);
    }
}
