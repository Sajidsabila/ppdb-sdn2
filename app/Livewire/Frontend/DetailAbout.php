<?php

namespace App\Livewire\Frontend;

use App\Models\AboutUs;
use Livewire\Component;

class DetailAbout extends Component
{
    public function render()
    {
        $about = AboutUs::first();
        return view(
            'livewire.frontend.detail-about',
            compact('about')
        )
            ->layout('layouts.app');
    }
}
