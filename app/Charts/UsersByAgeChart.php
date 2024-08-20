<?php

namespace App\Charts;

use App\Models\Actor;
use App\Models\Xtra;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersByAgeChart extends LarapexChart
{

    public function build()
    {

        $rangos = [
            '0-15' => [0, 15],
            '16-20' => [16, 20],
            '21-30' => [21, 30],
            '31-40' => [31, 40],
            '41-50' => [41, 50],
            '51-60' => [51, 60],
            '61-70' => [61, 70],
            '71-80' => [71, 80],
            '81-90' => [81, 90],
            '+90' => [91, 120],
        ];

        $extraRecuento = array_fill_keys(array_keys($rangos), 0);
        $dataExtras = []; // Agrega un array para almacenar los datos de actores y figurantes.

        // Realizo la consulta para obtener el recuento de actores en cada rango
        foreach ($rangos as $rango => $limites) {
            list($min, $max) = $limites;

            $countActores = Actor::whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN $min AND $max")->count();
            $countFigurantes = Xtra::whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN $min AND $max")->count();

            $extraRecuento[$rango] = $countFigurantes;

            $dataExtras[] = [
                'rangos' => $rango,
                'figurantes' => $countFigurantes,
                'actores' => $countActores
            ];
        }

        return $this->horizontalBarChart()
            ->setTitle('FIGURANTES vs ACTORES/ACTRICES (Edades)')
            ->setDataset([
                [
                    "name" => "Figurantes",
                    "data" => array_column($dataExtras, 'figurantes')
                ],
                [
                    "name" => "Actores/Actrices",
                    "data" => array_column($dataExtras, 'actores')
                ]
            ])
            ->setDataLabels(true)
            ->setColors(['#FF5733', '#303F9F'])
            ->setFontFamily('figtree')
            ->setXAxis(array_column($dataExtras, 'rangos'));
    }
}
