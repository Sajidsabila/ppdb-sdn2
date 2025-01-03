<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\File;
use App\Models\Parents;
use App\Models\Student;
use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\WithFileUploads;
use App\Services\StudentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegistrationForm extends Component
{
    use WithFileUploads;
    public $studentId;
    public $currentPage = 1;
    public $totalPages = 3;
    public $listeners = ['editStudent'];
    public $name, $gender, $religion, $number_of_siblings, $email, $address;
    public $place_of_birth, $date_of_birth, $nik, $child_order, $phone;
    public $father_name, $father_education, $father_occupation;
    public $mother_name, $mother_education, $mother_occupation;
    public $pas_foto, $akte_kelahiran, $kartu_keluarga;
    public $serviceData = [];
    public $title = "Form Pendaftaran";
    public $isEdit = false;
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
        ]
    ];


    public function mount($studentId = null)
    {
        if ($studentId) {
            $this->isEdit = true;
            $this->studentId = $studentId;
            $this->loadStudentData();
        }
    }

    public function loadStudentData()
    {
        $student = Student::with(['parents', 'files'])->find($this->studentId);
        if ($student) {
            $this->name = $student->name;
            $this->gender = $student->gender;
            $this->email = $student->email;
            $this->address = $student->address;
            $this->place_of_birth = $student->place_of_birth;
            $this->date_of_birth = $student->date_of_birth;
            $this->nik = $student->nik;
            $this->phone = $student->phone;
            $this->child_order = $student->child_order;
            $this->religion = $student->religion;
            $this->number_of_siblings = $student->number_of_siblings;

            $this->father_name = $student->parents->father_name;
            $this->mother_name = $student->parents->mother_name;
            $this->father_education = $student->parents->father_education;
            $this->mother_education = $student->parents->mother_education;
            $this->father_occupation = $student->parents->mother_occupation;
            $this->mother_occupation = $student->parents->mother_occupation;

            $this->pas_foto = $student->files && $student->files->pas_foto ? asset('storage/' . $student->files->pas_foto) : null;
            $this->akte_kelahiran = $student->files && $student->files->akte_kelahiran ? asset('storage/' . $student->files->akte_kelahiran) : null;
            $this->kartu_keluarga = $student->files && $student->files->akte_kelahiran ? asset('storage/' . $student->files->akte_kelahiran) : null;

        }
    }




    public function nextPage()
    {
        $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;
        if ($this->currentPage > $this->totalPages) {
            $this->currentPage = $this->totalPages;
        }
    }

    public function previousPage()
    {
        $this->currentPage--;
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        }
    }

    public function save()
    {
        $isUpdate = $this->studentId !== null;
        $student = Student::with(['parents', 'files'])->find($this->studentId);
        $this->validate([
            'pas_foto' => $isUpdate ? 'nullable' : 'required|image|max:1024',
            'akte_kelahiran' => $isUpdate ? 'nullable' : 'required|file|max:1024',
            'kartu_keluarga' => $isUpdate ? 'nullable' : 'required|file|max:1024',
        ]);
        try {
            $academicYear = AcademicYear::where('is_active', 1)->latest()->value('id');
            $user_id = auth()->user()->id;

            DB::beginTransaction();
            $student = Student::updateOrCreate(
                ['id' => $this->studentId],
                [
                    'user_id' => $user_id,
                    'academic_year_id' => $academicYear,
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
                ]
            );
            Parents::updateOrCreate(
                ['student_id' => $student->id],
                [
                    'father_name' => $this->father_name,
                    'father_education' => $this->father_education,
                    'father_occupation' => $this->father_occupation,
                    'mother_name' => $this->mother_name,
                    'mother_education' => $this->mother_education,
                    'mother_occupation' => $this->mother_occupation,
                ]
            );

            // Cek dan hapus pas foto lama jika ada file baru
            if ($this->pas_foto instanceof \Illuminate\Http\UploadedFile) {
                if ($student->files && $student->files->pas_foto) {
                    Storage::disk('public')->delete($student->files->pas_foto);
                }

                $photoPath = $this->pas_foto->store('dokumen', 'public');
            } else {
                $photoPath = $student->files->pas_foto ?? null;
            }

            // Cek dan hapus kartu keluarga lama jika ada file baru
            if ($this->kartu_keluarga instanceof \Illuminate\Http\UploadedFile) {
                if ($student->files && $student->files->kartu_keluarga) {
                    Storage::disk('public')->delete($student->files->kartu_keluarga);
                }
                $kartu_keluarga = $this->kartu_keluarga->store('dokumen', 'public');
            } else {

                $kartu_keluarga = $student->files->kartu_keluarga ?? null;
            }


            if ($this->akte_kelahiran instanceof \Illuminate\Http\UploadedFile) {
                if ($student->files && $student->files->akte_kelahiran) {
                    Storage::disk('public')->delete($student->files->akte_kelahiran);
                }
                $akte_kelahiran = $this->akte_kelahiran->store('dokumen', 'public');
            } else {
                $akte_kelahiran = $student->files->akte_kelahiran ?? null;
            }



            File::updateOrCreate(
                ['student_id' => $student->id],
                [
                    'pas_foto' => $photoPath,
                    'kartu_keluarga' => $kartu_keluarga,
                    'akte_kelahiran' => $akte_kelahiran,
                ]
            );
            DB::commit();

            return redirect()->route('admin.ppdb')->with('success', 'Form berhasil disubmit!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.backend.admin.ppdb.registration-form')
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
