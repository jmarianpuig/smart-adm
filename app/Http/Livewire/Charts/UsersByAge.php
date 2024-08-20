<?php

namespace App\Http\Livewire\Charts;

use App\Charts\UsersByAgeChart;
use Livewire\Component;

class UsersByAge extends Component
{
    protected $usersByAge;

    public function mount()
    {
        $this->usersByAge = new UsersByAgeChart();
    }

    public function render()
    {
        return view('livewire.charts.users-by-age', ['usersByAge' => $this->usersByAge->build()]);
    }
}
