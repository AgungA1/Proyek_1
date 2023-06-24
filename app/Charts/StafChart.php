<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StafChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $gudang = Auth::guard('staf_gudang')->user()->id_gudang;
        $data1 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 1)
            ->where('id_gudang', $gudang)
            ->sum('kuantitas_barang');

        $data2 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 2)
            ->where('id_gudang', $gudang)
            ->sum('kuantitas_barang');

        $data3 = (int) DB::table('barang_gudang')
            ->join('barang', 'barang_gudang.kode_barang', '=', 'barang.id')
            ->where('barang.id_kategori', 3)
            ->where('id_gudang', $gudang)
            ->sum('kuantitas_barang');

        $label = [
            'Kaca',
            'Lampu',
            'Paku'
        ];

        return $this->chart->donutChart()
            ->setTitle('Barang Dalam Gudang')
            ->setSubtitle('Kategori')
            ->addData([$data1, $data2, $data3])
            ->setLabels($label);
    }
}
