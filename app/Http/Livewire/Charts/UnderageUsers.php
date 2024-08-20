<?php

namespace App\Http\Livewire\Charts;

use App\Models\Actor;
use App\Models\Xtra;
use Livewire\Component;

class UnderageUsers extends Component
{
    public $underageActors;
    public $underageExtras;
    public $totalActors;
    public $totalExtras;

    public function mount()
    {
        $this->underageActors = Actor::whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 16")->get();
        $this->underageExtras = Xtra::whereRaw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) < 16")->get();

        // Consulta para obtener registros más recientes de los últimos 7 días de ModeloA
        $this->totalActors = Actor::where('created_at', '>=', now()->subDays(7))->get();

        // Consulta para obtener registros más recientes de los últimos 7 días de ModeloB
        $this->totalExtras = Xtra::where('created_at', '>=', now()->subDays(7))->get();
    }

    public function render()
    {
        return view('livewire.charts.underage-users');
    }
}
