<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;
    public function render()
    {
        return view('livewire.auth.forgot-password')
            ->layout('layouts.app');
    }

    public function sendToken()
    {
        $this->validate([
            'email' => 'required|exists:users,email'
        ]);
    }
}
