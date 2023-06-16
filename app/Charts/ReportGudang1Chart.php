<?php

namespace App\Charts;

use App\Models\BarangKeluar;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ReportGudang1Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {

        $barang = BarangKeluar::where('id_gudang', 1)
            ->pluck('kuantitas_barang');

        // $data = DB::table('barang_keluar')
        //         ->select('kuantitas_barang')
        //         ->where('id_gudang', 1);
        

        return $this->chart->lineChart()
            ->setTitle('Barang Keluar Dari Gudang 1')
            ->setSubtitle('Data Barang Keluar')
            ->addData('data1', [$barang]);
    }
}
