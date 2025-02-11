<?php

namespace App\Livewire\Frontend;

use App\Models\Gallery;
use Livewire\Component;

class DetailGallery extends Component
{
    public function render()
    {
        $galleries = Gallery::paginate(10);
        return view(
            'livewire.frontend.detail-gallery',
            compact('galleries')
        )
            ->layout('layouts.app');
    }
}
