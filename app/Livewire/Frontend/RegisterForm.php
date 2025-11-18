<?php

namespace App\Livewire\Frontend;

use App\Models\File;
use App\Models\Parents;
use App\Models\Student;
use Intervention\Image\ImageManager;
use Livewire\Component;
use App\Models\AcademicYear;
use App\Models\Configuration;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\NotificationPendaftaranPpdb;
use Intervention\Image\Drivers\Gd\Driver;

class RegisterForm extends Component
{
    use WithFileUploads;

    public $studentId;
    public $currentPage = 1;
    public $totalPages = 3;
    protected $listeners = ['setLocation', 'editStudent'];

    // Data pribadi
    public $name, $gender, $religion, $number_of_siblings, $email, $address;
    public $place_of_birth, $date_of_birth, $nik, $child_status, $phone;

    // Data orang tua
    public $father_name, $father_education, $father_occupation;
    public $mother_name, $mother_education, $mother_occupation;

    // Dokumen
    public $pas_foto, $akte_kelahiran, $kartu_keluarga, $dokumen_pendukung;

    // Lainnya
    public $title = "Form Pendaftaran";
    public $isEdit = false;
    public $latitude;
    public $longitude;

    // Validasi per halaman
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
            'child_status' => 'required',
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

    public function render()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $student = Student::where('user_id', $user->id)->first();

        if ($user->role === 'user' && !$student) {
            return view('livewire.frontend.registration-form')->layout('layouts.app');
        }

        if ($student) {
            return view('livewire.frontend.detail-registration', compact('student'))
                ->layout('layouts.app');
        }
    }

    public function mount($studentId = null)
    {
        $this->studentId = $studentId;

        if ($studentId) {
            $this->isEdit = true;
            $this->loadStudentData();
        }
    }

    public function setLocation($latitude = null, $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        logger("✅ Lokasi diterima:", [
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
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
            $this->child_status = $student->child_status;
            $this->religion = $student->religion;
            $this->number_of_siblings = $student->number_of_siblings;

            $this->father_name = $student->parents->father_name ?? null;
            $this->mother_name = $student->parents->mother_name ?? null;
            $this->father_education = $student->parents->father_education ?? null;
            $this->mother_education = $student->parents->mother_education ?? null;
            $this->father_occupation = $student->parents->father_occupation ?? null;
            $this->mother_occupation = $student->parents->mother_occupation ?? null;

            $this->pas_foto = $student->files->pas_foto ?? null;
            $this->akte_kelahiran = $student->files->akte_kelahiran ?? null;
            $this->kartu_keluarga = $student->files->kartu_keluarga ?? null;
            $this->dokumen_pendukung = $student->files->dokumen_pendukung ?? null;
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
        $student = $isUpdate ? Student::with(['parents', 'files'])->find($this->studentId) : null;

        // Validasi dokumen
        $this->validate([
            'pas_foto' => $isUpdate ? 'nullable|image|mimes:jpg,jpeg,png|max:2048' : 'required|image|mimes:jpg,jpeg,png|max:2048',
            'akte_kelahiran' => $isUpdate ? 'nullable|file|max:2048' : 'required|file|max:2048',
            'kartu_keluarga' => $isUpdate ? 'nullable|file|max:2048' : 'required|file|max:2048',
            'dokumen_pendukung' => 'nullable|file|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $academicYear = AcademicYear::where('is_active', 1)->latest()->value('id');
            $user_id = auth()->user()->id;

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
                    'child_status' => $this->child_status,
                    'phone' => $this->phone,
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
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

            // ImageManager untuk pas foto
            $photoPath = $student?->files->pas_foto ?? null;
            if ($this->pas_foto instanceof \Illuminate\Http\UploadedFile) {
                $manager = new ImageManager(new Driver());
                $image = $manager->read($this->pas_foto->getRealPath());
                $image->resize(472, 709); // 4x6 cm

                $filename = uniqid('foto_') . '.' . $this->pas_foto->getClientOriginalExtension();
                $photoPath = 'dokumen/' . $filename;
                Storage::disk('public')->put($photoPath, (string) $image->encode());
            }

            // Dokumen lain
            $aktePath = $this->akte_kelahiran instanceof \Illuminate\Http\UploadedFile
                ? $this->akte_kelahiran->store('dokumen', 'public')
                : ($student?->files->akte_kelahiran ?? null);

            $kkPath = $this->kartu_keluarga instanceof \Illuminate\Http\UploadedFile
                ? $this->kartu_keluarga->store('dokumen', 'public')
                : ($student?->files->kartu_keluarga ?? null);

            $dokumenPendukungPath = $this->dokumen_pendukung instanceof \Illuminate\Http\UploadedFile
                ? $this->dokumen_pendukung->store('dokumen', 'public')
                : ($student?->files->dokumen_pendukung ?? null);

            File::updateOrCreate(
                ['student_id' => $student->id],
                [
                    'pas_foto' => $photoPath,
                    'kartu_keluarga' => $kkPath,
                    'akte_kelahiran' => $aktePath,
                    'dokumen_pendukung' => $dokumenPendukungPath,
                ]
            );

            // Kirim email bukti pendaftaran
            Mail::to($student->email)->send(new NotificationPendaftaranPpdb($student->id));

            DB::commit();

            return back()->with('success', 'Form berhasil disubmit!');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }

    public function generatePdf($id)
    {
        try {
            $configuration = Configuration::first();
            $student = Student::with('files', 'parents', 'year')->findOrFail($id);

            $pdf = Pdf::loadView('livewire.pdf.buktipendactaran', [
                'student' => $student,
                'configuration' => $configuration
            ]);

            $fileName = 'Bukti_Pendaftaran_' . ($student->name ?? $student->id) . '.pdf';

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $fileName);
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat generate PDF: ' . $th->getMessage());
        }
    }
}
