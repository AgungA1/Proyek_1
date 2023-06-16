<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\BarangGudang;
use Illuminate\Support\Facades\DB;

class BarangGudang2Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {

        $data1 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 1)
            ->where('id_gudang', 2)
            ->sum('kuantitas_barang');

        $data2 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 2)
            ->where('id_gudang', 2)
            ->sum('kuantitas_barang');

        $data3 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 3)
            ->where('id_gudang', 2)
            ->sum('kuantitas_barang');

        $label = [
            'Kaca',
            'Lampu',
            'Paku'
        ];
        
        
        return $this->chart->donutChart()
            ->setTitle('Total Barang Di Gudang 2')
            ->setSubtitle('Jumlah Barang di Gudang 2')
            ->addData([$data1, $data2, $data3])
            ->setLabels($label);
    }
}
