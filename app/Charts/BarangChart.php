<?php

namespace App\Charts;

use App\Models\Barang;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $barang = Barang::get();
        $data = [
            $barang->where('id_kategori',1)->count(),
            $barang->where('id_kategori',2)->count(),
            $barang->where('id_kategori',3)->count(),
        ];
        $label = [
            'Kaca',
            'Lampu',
            'Paku',
        ];
        return $this->chart->donutChart()
            ->setTitle('Kategori Barang Seluruh Gudang')
            ->setSubtitle('Jumlah Barang per Kategori')
            ->addData($data)
            ->setLabels($label);
    }
}