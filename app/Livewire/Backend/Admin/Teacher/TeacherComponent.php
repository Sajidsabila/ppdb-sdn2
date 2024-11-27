<?php

namespace App\Livewire\Backend\Admin\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TeacherComponent extends Component
{
    public $title = "Halaman Guru";
    use WithFileUploads;
    public $photo, $name, $position, $description;
    public $teacher_id;
    public $isModalOpen = false;

    protected $listeners = [
        'createTeacher',
        'updateTeacher',
        'deleteTeacher'
    ];

    public function resetFields()
    {
        $this->teacher_id = null;
        $this->photo = '';
        $this->name = '';
        $this->position = '';
        $this->description = '';
    }

    public function createTeacher()
    {
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function editGallery($teacher_id)
    {
        $teacher = Teacher::find($teacher_id);
        if ($teacher) {
            $this->teacher_id = $teacher->id;
            $this->foto = $teacher->foto;
            $this->name = $teacher->name;
            $this->isModalOpen = true;
        }
        session()->flash('error', 'gallery tidak diteukan');
    }

    public function save()
    {
        $this->validate([
            'photo' => $this->teacher_id ? 'nullable|mimes:jpg,png,jpeg|max:1024' : 'required|mimes:jpg,png,jpeg|max:1024',
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute melebihi batas :max KB',
            'mimes' => ':attribute hanya mendukung file dengan format: :values'
        ], [
            'photo' => 'Foto',
            'name' => 'Nama Kegiatan',
            'position' => 'Posisi',
            'description' => 'keterangan',
        ]);

        try {
            $teacher = Teacher::find($this->teacher_id);

            if ($this->foto && $teacher && $teacher->foto) {
                Storage::disk('public')->delete($teacher->photo);
            }

            if ($this->foto) {
                $photoPath = $this->foto->store('teacher', 'public');
            } else {
                $photoPath = $teacher ? $teacher->photo : null;
            }

            Teacher::updateOrCreate(
                ['id' => $this->teacher_id],
                [
                    'name' => $this->name,
                    'photo' => $photoPath,
                    'position' => $this->position,
                    'description' => $this->description,
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            session()->flash("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }


    public function deleteGallery($teacher_id)
    {
        try {
            if ($teacher_id) {
                $teacher = Teacher::find($teacher_id);
                if ($teacher) {
                    if ($teacher->foto) {
                        Storage::disk('public')->delete($teacher->foto);

                    }
                    $teacher->delete();
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
        $teachers = Teacher::paginate(10);
        return view('livewire.backend.admin.teacher.index', compact('teachers'))
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
