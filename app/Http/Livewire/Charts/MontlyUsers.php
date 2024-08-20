<?php

namespace App\Http\Livewire\Charts;

use App\Charts\MontlyUsersCharts;
use Livewire\Component;

class MontlyUsers extends Component
{
    protected $usersByMonth;


    public function mount()
    {
        $this->usersByMonth = new MontlyUsersCharts();
    }

    public function render()
    {
        return view('livewire.charts.montly-users', ['usersByMonth' => $this->usersByMonth->build()]);
    }
}
