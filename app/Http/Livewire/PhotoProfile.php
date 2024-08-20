<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PhotoProfile extends Component
{
    public $info;
    public $url;

    public function mount($info = null, $url = null)
    {
        $this->info = $info ?? '';
        $this->url = $url ?? '';
    }

    public function render()
    {
        return view('livewire.photo-profile');
    }
}
