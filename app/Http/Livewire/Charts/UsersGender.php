<?php

namespace App\Http\Livewire\Charts;

use App\Charts\UsersByGenderCharts;
use Livewire\Component;

class UsersGender extends Component
{
    protected $usersByGender;

    public function mount()
    {
        $this->usersByGender = new UsersByGenderCharts();
    }
    public function render()
    {
        return view('livewire.charts.users-gender', ['usersByGender' => $this->usersByGender->build()]);
    }
}
