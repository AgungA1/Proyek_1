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

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $barang = Barang::groupBy('id_kategori')->get();
        $data = [
            $barang->where('id_kategori',1)->count(),
            $barang->where('id_kategori',2)->count(),
        ];
        $label = [
            'Kategori 1',
            'Kategori 2',
            'Kategori 3',
        ];
        return $this->chart->PieChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData($data)
            ->setLabels($label);
    }
}
