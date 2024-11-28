<?php

namespace App\Livewire\Backend\Admin\Aboutus;

use App\Models\AboutUs;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutComponent extends Component
{
    use WithFileUploads;
    public $title = "Halaman About Us";
    public $foto, $description;

    public function mount()
    {
        $about = AboutUs::first();
        $this->foto = $about ? asset('storage/' . $about->foto) : null;
        $this->description = $about->description ?? '';
    }
    public function initializeCKEditor()
    {
        return 'CKEditor Initialized';
    }
    public function save()
    {
        $this->validate([
            'foto' => 'required|mimes:jpg,png,jpeg|max:1024',
            'description' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'foto' => 'Foto',
            'description' => 'keterangan',
        ]);

        try {
            $about = AboutUs::first();
            $filePath = $about ? $about->foto : null;
            if ($this->foto) {
                $filePath = $this->foto->store('about-us', 'public');
            }
            if ($about) {
                $about->update([
                    'foto' => $filePath,
                    'description' => $this->description
                ]);
                $this->foto = $filePath ? asset('storage/' . $filePath) : null;

                return back()->with('success', "data Berhasil Diupdate");
            } else {
                AboutUs::create([
                    'foto' => $filePath,
                    'description' => $this->description
                ]);

            }
            $this->foto = $filePath ? asset('storage/' . $filePath) : null;

            return back()->with('success', "data Berhasil Diupdate");
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan   : ' . $th->getMessage());
        }

    }
    public function render()
    {
        return view('livewire.backend.admin.aboutus.index')
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
