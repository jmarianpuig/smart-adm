<?php

namespace App\Http\Livewire;

use App\Models\Imageable;
use Livewire\Component;

class PhotoModal extends Component
{
    public $data;

    public function mount($data)
    {
        $this->data = $data;

    }

    public function render()
    {
        return view('livewire.photo-modal');
    }
}
