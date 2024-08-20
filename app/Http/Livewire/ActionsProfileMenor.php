<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ActionsProfileMenor extends Component
{
    public $info;

    public function mount($info = null)
    {
        $this->info = $info;
    }
    
    public function render()
    {
        return view('livewire.actions-profile-menor');
    }
}

