<?php

namespace App\Livewire\Partials\Dashboard;

use Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.partials.dashboard.navbar');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
