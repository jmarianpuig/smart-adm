<?php

namespace App\Charts;

use App\Models\Actor;
use App\Models\Xtra;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class UsersByGenderCharts extends LarapexChart
{

    public function build()
    {
        $extrasHombres = Xtra::where('gender', 'Hombre')->count();
        $extrasMujeres = Xtra::where('gender', 'Mujer')->count();
        $actorsHombres = Actor::where('gender', 'Hombre')->count();
        $actorsMujeres = Actor::where('gender', 'Mujer')->count();
        // $actorsHombres = 50;
        // $actorsMujeres = 80;

        return $this->pieChart()
            ->setTitle('HOMBRES vs MUJERES')
            ->setColors(['#FF5733', '#C70039'])
            ->setDataset([$extrasHombres, $actorsHombres, $extrasMujeres, $actorsMujeres])
            ->setColors(['#FF5733', '#FFC300', '#303F9F', '#39D3F9'])
            ->setDataLabels(true)
            ->setFontFamily('figtree')
            ->setLabels(['Fig. Hombres', 'Actores', 'Fig. Mujeres', 'Actrices']);
    }
}
