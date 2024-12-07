<?php

namespace App\Livewire\Backend\Admin\Configuration;

use Livewire\Component;

class ConfigurationComponent extends Component
{
    public $title = "Configuration";
    public $logo;
    public function render()
    {
        return view('livewire.backend.admin.configuration.index')
            ->layout('layouts.admin', ['title' => $this->title]);
        ;
    }
}
