<?php

namespace App\Livewire\School;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class EcoleCreate extends Component
{
    public $is_active = false;

    public function saveEcole(): void
    {
        dd($this->is_active);
    }

    public function toggleIsActive(): void
    {
        $this->is_active = !$this->is_active;
    }

    public function render()
    {
        return view('livewire.school.ecole-create');
    }
}
