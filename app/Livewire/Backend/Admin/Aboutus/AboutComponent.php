<?php

namespace App\Livewire\Backend\Admin\Aboutus;

use App\Models\AboutUs;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AboutComponent extends Component
{
    use WithFileUploads;

    public $title = "Halaman About Us";
    public $foto; // Input file baru
    public $description; // Deskripsi baru
    public $image;

    public function mount()
    {
        $about = AboutUs::first();
        $this->image = $about ? asset('storage/' . $about->foto) : null;
        $this->description = $about->description ?? '';
    }

    public function save()
    {
        $about = AboutUs::first();

        $fotoValidationRule = $about ? 'nullable|mimes:jpg,png,jpeg|max:1024' : 'required|mimes:jpg,png,jpeg|max:1024';
        $this->validate([
            'foto' => $fotoValidationRule,
            'description' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values',
        ], [
            'foto' => 'Foto',
            'description' => 'Keterangan',
        ]);

        try {
            $filePath = $about ? $about->foto : null;
            if ($this->foto && $about && $about->foto) {
                Storage::disk('public')->delete($about->foto);
            }
            if (is_object($this->foto)) {
                $filePath = $this->foto->store('about-us', 'public');
            }
            if ($about) {
                $about->update([
                    'foto' => $filePath,
                    'description' => $this->description,
                ]);
            } else {
                AboutUs::create([
                    'foto' => $filePath,
                    'description' => $this->description,
                ]);
            }

            $this->image = $filePath ? asset('storage/' . $filePath) : null;
            $this->foto = null;
            session()->flash('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.aboutus.index')
            ->layout('layouts.admin', ['title' => $this->title]);
    }

    public function initializeCKEditor()
    {
        return 'CKEditor Initialized';
    }
}
