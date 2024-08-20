<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DataProfile extends Component
{
    public $info;

    public function mount($info = null){
        if ($info){
            $this->info = $info;
        }
    }

    public function render()
    {
        return view('livewire.data-profile', compact('this'));
    }
}
