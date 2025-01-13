<?php

namespace App\Livewire\Partials\Frontend;

use Livewire\Component;
use App\Models\Configuration;

class Footer extends Component
{
    public function render()
    {
        $configuration = Configuration::first();
        return view('livewire.partials.frontend.footer', compact('configuration'));
    }
}
