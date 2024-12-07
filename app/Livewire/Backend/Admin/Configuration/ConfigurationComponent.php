<?php

namespace App\Livewire\Backend\Admin\Configuration;

use App\Models\Configuration;
use Livewire\Component;
use Livewire\WithFileUploads;

class ConfigurationComponent extends Component
{
    use WithFileUploads;
    public $title = "Configuration";
    public $logo, $email, $phone, $website, $name;

    public function mount()
    {
        $connfiguration = Configuration::first();
        $this->name = $connfiguration->name ?? '';
        $this->email = $connfiguration->email ?? '';
        $this->phone = $connfiguration->phone ?? '';
        $this->website = $connfiguration->website ?? '';
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'logo' => 'required|max:1120|mies:jpg,png,jpeg,webp',
            'email' => 'required|email',
            'phone' => 'required',
            'website' => 'required'
        ]);
    }
    public function render()
    {
        return view('livewire.backend.admin.configuration.index')
            ->layout('layouts.admin', ['title' => $this->title]);
        ;
    }
}
