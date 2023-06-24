<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;


class MasukKeluarEstimatorChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $barangMasuk = (int) DB::table('barang_masuk')
            ->sum('kuantitas_barang');
        
        $barangKeluar = (int) DB::table('barang_keluar')
            ->sum('kuantitas_barang');

        return $this->chart->donutChart()
            ->setTitle('Total Barang Masuk dan Keluar')
            ->setSubtitle('Barang Masuk dan Keluar Seluruh Gudang')
            ->addData([$barangMasuk, $barangKeluar])
            ->setLabels(['Barang Masuk', 'Barang Keluar']);
    }
}
