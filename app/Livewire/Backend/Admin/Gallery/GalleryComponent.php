<?php

namespace App\Livewire\Backend\Admin\Gallery;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


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

    public function save()
    {
        $this->validate([
            'foto' => $this->gallery_id ? 'nullable|mimes:jpg,png,jpeg|max:1024' : 'required|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'foto' => 'Foto',
            'name' => 'Nama Kegiatan',
        ]);

        try {
            $gallery = Gallery::find($this->gallery_id);

            if ($this->foto && $gallery && $gallery->foto) {
                Storage::disk('public')->delete($gallery->photo);
            }

            if ($this->foto) {
                $photoPath = $this->foto->store('gallery', 'public');
            } else {
                $photoPath = $gallery ? $gallery->foto : null;
            }

            Gallery::updateOrCreate(
                ['id' => $this->gallery_id],
                [
                    'name' => $this->name,
                    'foto' => $photoPath,
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            session()->flash("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }


    public function deleteGallery($gallery_id)
    {
        try {
            if ($gallery_id) {
                $gallery = Gallery::find($gallery_id);
                if ($gallery) {
                    if ($gallery->foto) {
                        Storage::disk('public')->delete($gallery->foto);

                    }
                    $gallery->delete();
                    session()->flash('success', 'Data Berhasil Dihapus');

                } else {
                    session()->flash('error', "Data Tidak Ditemukan");
                }

            }

        } catch (\Throwable $th) {
            session()->flash('error', "TErjadi Kesalahan : " . $th->getMessage());
        }
    }

    public function render()
    {

        $gallery = Gallery::paginate(10);
        return view('livewire.backend.admin.gallery.index', compact('gallery'))
            ->layout('layouts.admin', ['title' => $this->title]);
        ;
    }

}
