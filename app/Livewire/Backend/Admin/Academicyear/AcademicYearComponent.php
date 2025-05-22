<?php

namespace App\Livewire\Backend\Admin\Academicyear;

use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\WithPagination;

class AcademicYearComponent extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title = "Tahun Pelajaran";
    public $start_year, $end_year, $is_active, $start_registration, $end_registration;
    public $academic_id;
    public $search;
    public $isModalOpen = false;

    protected $listeners = [
        'creatAcademic',
        'updateAcademic',
        'deleteAcademic'
    ];
    public function resetFields()
    {
        $this->start_year = '';
        $this->end_year = '';
        $this->start_registration = '';
        $this->end_registration = '';

    }

    public function toggleIsActive(AcademicYear $academic)
    {

        $academic->is_active = !$academic->is_active;
        $academic->save();
    }

    public function updatedStartYear($value)
    {
        $this->end_year = $value ? $value + 1 : null;

    }
    public function createAcademic()
    {
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function updateAcademic($academic_id)
    {
        $academic = AcademicYear::find($academic_id);
        if ($academic) {
            $this->academic_id = $academic->id;
            $this->start_year = $academic->start_year;
            $this->end_year = $academic->end_year;
            $this->start_registration = $academic->start_registration;
            $this->end_registration = $academic->end_registration;
            $this->isModalOpen = true;
        } else {
            session()->flash('error', 'user tidak ditemukan');
        }

    }

    public function save()
    {
        $this->validate([
            'start_year' => 'required|numeric|digits:4|unique:academic_years,start_year',
            'end_year' => 'required|numeric|digits:4|unique:academic_years,end_year',
            'start_registration' => 'required',
            'end_registration' => 'required',
        ], [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus berupa angka',
            'digits' => ':attribute harus terdiri dari 4 digit',
            'unique' => ':attribute sudah ada',
        ], [
            'start_year' => 'tahun awal',
            'end_year' => 'tahun akhir',
            'start_registration' => 'mulai pendaftaran',
            'end_registration' => 'akhir pendaftaran',
        ]);

        try {

            AcademicYear::updateOrCreate(
                ['id' => $this->academic_id],
                [
                    'start_year' => $this->start_year,
                    'end_year' => $this->end_year,
                    'start_registration' => $this->start_registration,
                    'end_registration' => $this->end_registration
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }


    public function deleteUser($academic_id)
    {
        try {
            if ($academic_id) {
                $academic = AcademicYear::find($academic_id);
                if ($academic) {
                    $academic->delete();
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
        $academics = AcademicYear::when($this->search, function ($query) {
            $query->where('start_year', 'like', '%' . $this->search . '%');
            $query->where('end_year', 'like', '%' . $this->search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.backend.admin.academicyear.index', compact('academics'))
            ->layout('layouts.admin', ['title' => $this->title]);
        ;
    }
}
