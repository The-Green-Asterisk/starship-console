<?php

namespace App\Http\Livewire;

use App\Models\System;
use Livewire\Component;

class Hp extends Component
{
    protected $listeners = ['updateHp'];

    public System $system;
    public int $hp;

    public function mount(System $system)
    {
        $this->hp = $system->getHpPercentage();
    }

    public function updateHp()
    {
        $this->hp = $this->system->getHpPercentage();
}

    public function render()
    {
        return view('livewire.hp');
    }
}
