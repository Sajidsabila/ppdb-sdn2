<?php

namespace App\Livewire\Backend\Admin\Aboutus;

use App\Models\AboutUs;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutComponent extends Component
{
    use WithFileUploads;
    public $title = "Halaman About Us";
    public $image, $description;

    public function mount()
    {
        $about = AboutUs::first();
        $this->image = $about->image ?? null;
        $this->description = $about->description ?? '';
    }

    public function save()
    {
        $this->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:1024',
            'description' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'image' => 'Foto',
            'description' => 'keterangan',
        ]);

        try {
            $about = AboutUs::first();
            if ($about) {
                dd('ada');
            }
            dd('kosong');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi Kesalahan   : ' . $th->getMessage());
        }

    }
    public function render()
    {
        return view('livewire.backend.admin.aboutus.index')
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
