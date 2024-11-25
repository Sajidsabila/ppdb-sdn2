<?php

namespace App\Livewire\Backend\Admin\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;

class GalleryComponent extends Component
{
    use WithFileUploads;
    public $title = 'Halaman Gallery';
    public $foto, $name;
    public $gallery_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createGallery',
        'updateGallery',
        'deleteGallery'
    ];

    public function resetFields()
    {
        $this->gallery_id = null;
        $this->foto = '';
        $this->name = '';
    }

    public function createGallery()
    {
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function editGallery($gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        if ($gallery) {
            $this->gallery_id = $gallery->id;
            $this->foto = $gallery->foto;
            $this->name = $gallery->name;
            $this->isModalOpen = true;
        }
        session()->flash('error', 'gallery tidak diteukan');
    }

    public function render()
    {

        $gallery = Gallery::paginate(10);
        return view('livewire.backend.admin.gallery.index', compact('gallery'))
            ->layout('layouts.app', ['title' => $this->title]);
        ;
    }

}
