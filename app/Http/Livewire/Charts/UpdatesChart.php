<?php

namespace App\Http\Livewire\Charts;

use Carbon\Carbon;
use Livewire\Component;

class UpdatesChart extends Component
{
    public $model;
    public $countLastSevenDays;
    public $type;

    public function mount($model, $type = null)
    {
        if ($model instanceOf('App\Models\Xtra')){
            $this->model = 'Xtra';
        };

        if ($model instanceOf('App\Models\Actor')){
            $this->model = 'Actor';
        };

        $this->type = $type;

        // Calcula la fecha de inicio de los últimos siete días
        $startDate = Carbon::now()->subDays(7);

        // Realiza el conteo de registros apuntados en los últimos siete días
        $this->countLastSevenDays = $this->model
            ->where('created_at', '>=', $startDate)
            ->count();
    }

    public function render()
    {
        return view('livewire.charts.updates-chart');
    }
}
