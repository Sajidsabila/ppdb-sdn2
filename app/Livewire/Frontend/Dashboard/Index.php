<?php

namespace App\Livewire\Frontend\Dashboard;

use App\Models\AboutUs;
use App\Models\Gallery;
use App\Models\Teacher;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $about = AboutUs::first();
        $teacher = Teacher::limit(4)->get();
        $gallery = Gallery::limit(8)->get();
        return view(
            'livewire.frontend.dashboard.index',
            compact('about', 'teacher', 'gallery')
        )
            ->layout('layouts.app');
    }
}
