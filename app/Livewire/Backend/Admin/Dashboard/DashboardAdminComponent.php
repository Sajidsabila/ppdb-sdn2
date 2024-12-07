<?php

namespace App\Livewire\Backend\Admin\Dashboard;

use Livewire\Component;

class DashboardAdminComponent extends Component
{
    public $title = "Dashboard";
    public function render()
    {

        return view('livewire.backend.admin.dashboard.index')
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
