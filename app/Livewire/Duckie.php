<?php

namespace App\Livewire;

use Livewire\Component;

class Duckie extends Component
{
    public string $apiUrl;
    public string $animal;

    public function mount()
    {
        if ($this->animal === 'duck')
            $this->duck();
        else
            $this->cat();
    }
    public function cat()
    {
        $this->animal = 'cat';
        $this->apiUrl =  "https://source.unsplash.com/random/500x500/?cat,anime";
    }
    public function duck()
    {
        $this->animal = 'duck';
        $this->apiUrl =  "https://source.unsplash.com/random/500x500/?duck";
    }
    public function render()
    {
        return view('livewire.duckie');
    }
}
