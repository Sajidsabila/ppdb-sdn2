<?php

namespace App\Livewire\Frontend;

use App\Models\Teacher;
use Livewire\Component;

class DetailTeacher extends Component
{
    public function render()
    {
        $teachers = Teacher::get();
        return view('livewire.frontend.detail-teacher', compact('teachers'))
            ->layout('layouts.app');
    }
}
