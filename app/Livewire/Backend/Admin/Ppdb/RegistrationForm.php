<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\File;
use App\Models\Parents;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public $currentPage = 1;
    public $totalPages = 3;

    public $name, $gender, $religion, $number_of_siblings, $email, $address;
    public $place_of_birth, $date_of_birth, $nik, $child_order, $phone;
    public $father_name, $father_education, $father_occupation;
    public $mother_name, $mother_education, $mother_occupation;
    public $pas_foto, $akte_kelahiran, $kartu_keluarga;

    public $title = "Form Pendaftaran";

    private $validationRules = [
        1 => [
            'name' => 'required|min:6',
            'gender' => 'required',
            'religion' => 'required',
            'number_of_siblings' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required|date',
            'nik' => 'required|numeric|digits:16',
            'child_order' => 'required|numeric',
            'phone' => 'required|numeric',
        ],
        2 => [
            'father_name' => 'required',
            'father_education' => 'required',
            'father_occupation' => 'required',
            'mother_name' => 'required',
            'mother_education' => 'required',
            'mother_occupation' => 'required',
        ],
        3 => [
            'pas_foto' => 'required|image|max:1024',
            'akte_kelahiran' => 'required|file|max:1024',
            'kartu_keluarga' => 'required|file|max:1024',
        ],
    ];

    public function render()
    {
        return view('livewire.backend.admin.ppdb.registration-form')
            ->layout('layouts.admin', ['title' => $this->title]);
    }

    public function nextPage()
    {
        // $this->validate($this->validationRules[$this->currentPage]);

        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function save()
    {
        $this->validate($this->validationRules[$this->currentPage]);

        try {
            DB::beginTransaction();

            $student = Student::create([
                'name' => $this->name,
                'gender' => $this->gender,
                'religion' => $this->religion,
                'number_of_siblings' => $this->number_of_siblings,
                'email' => $this->email,
                'address' => $this->address,
                'place_of_birth' => $this->place_of_birth,
                'date_of_birth' => $this->date_of_birth,
                'nik' => $this->nik,
                'child_order' => $this->child_order,
                'phone' => $this->phone,
            ]);

            Parents::create([
                'student_id' => $student->id,
                'father_name' => $this->father_name,
                'father_education' => $this->father_education,
                'father_occupation' => $this->father_occupation,
                'mother_name' => $this->mother_name,
                'mother_education' => $this->mother_education,
                'mother_occupation' => $this->mother_occupation,
            ]);

            File::create([

            ]);

            DB::commit();

            session()->flash('message', 'Form berhasil disubmit!');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}
