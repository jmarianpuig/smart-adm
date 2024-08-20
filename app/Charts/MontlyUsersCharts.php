<?php

namespace App\Charts;

use App\Models\Actor;
use App\Models\Xtra;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MontlyUsersCharts extends LarapexChart
{

    public function build()
    {
        $period = now()->subMonth(6)->monthsUntil(now());
        $dataExtras = [];
        $dataActors = [];

        foreach ($period as $date) {
            $extrasInMonth = Xtra::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $dataExtras[] = [
                'month' => ucwords($date->monthName),
                'year'  => $date->year,
                'users' => $extrasInMonth,
                // 'monthYear' => ucfirst($date->shortMonthName) . '-' . $date->format('y')
            ];
        }

        foreach ($period as $date) {
            $actorsInMonth = Actor::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $dataActors[] = [
                'month' => ucwords($date->monthName),
                'year'  => $date->year,
                'users' => $actorsInMonth,
                // 'monthYear' => ucfirst($date->shortMonthName) . '-' . $date->format('y')
            ];
        }

        return $this->areaChart()
            ->setTitle('FIGURANTES vs ACTORES/ACTRICES (Últimos 6 meses)')
            ->setDataset([
                [
                    "name" => "Figurantes",
                    "data" => array_column($dataExtras, 'users')
                ],
                [
                    "name" => "Actores/Actrices",
                    "data" => array_column($dataActors, 'users')
                ]
            ])
            ->setDataLabels(true)
            ->setColors(['#FF5733', '#303F9F'])
            ->setFontFamily('figtree')
            ->setXAxis(array_column($dataExtras, 'month'));
    }
}
