<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasukKeluarStafChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $barangMasuk = (int) DB::table('barang_masuk')
            ->where('id_gudang', $gudang)
            ->sum('kuantitas_barang');
        
        $barangKeluar = (int) DB::table('barang_keluar')
            ->where('id_gudang', $gudang)
            ->sum('kuantitas_barang');
        
            $label = [
                'Barang Masuk',
                'Barang Keluar'
            ];

        return $this->chart->donutChart()
            ->setTitle('Statistik Barang Masuk dan Keluar')
            ->setSubtitle('Barang Masuk dan Keluar Pada Gudang '. $gudang)
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData([$barangMasuk, $barangKeluar])
            ->setLabels($label);

        
    }
}
