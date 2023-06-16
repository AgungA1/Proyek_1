<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class ReportChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {

        $label = [
            'Kaca',
            'Paku'
        ];

        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Paku', [5,12,5,3,4,22])
            ->addData('Kaca', [7,5,3,2,45,2])
            ->setWidth(600)
            ->setHeight(300)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
