<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Exports\StudentExport;
use App\Mail\NotificationEmailAccepted;
use App\Mail\NotificationEmailRejected;
use App\Mail\NotificationEmailVerified;
use App\Models\AcademicYear;
use App\Models\Configuration;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class ListComponent extends Component
{
    use WithPagination;

    public $title = "Data Siswa Terdaftar";
    public $id;

    public $search;
    public $selectedYear;

    public $selectedStatus;
    public $data;
    public $item;
    protected $listeners = ['deleteConfirmed'];


    public function destroy($id)
    {
        try {
            $student = Student::with(['files', 'user'])->findOrFail($id);

            // Hapus file jika ada
            if ($student->files) {

                if ($student->files->kartu_keluarga) {
                    Storage::disk('public')->delete($student->files->kartu_keluarga);
                }

                if ($student->files->pas_foto) {
                    Storage::disk('public')->delete($student->files->pas_foto);
                }

                if ($student->files->akte_kelahiran) {
                    Storage::disk('public')->delete($student->files->akte_kelahiran);
                }

                // Hapus data files
                $student->files->delete();
            }

            // Hapus user jika ada
            if ($student->user) {
                $student->user->delete();
            }

            // Hapus student
            $student->delete();

            return response()->json([
                'success' => 'Data siswa berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 404);
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
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
    public function toggleChangeStatus($itemId, $newStatus)
    {
        $item = Student::find($itemId);
        $id = $item->id;
        if ($item) {
            $item->status = $newStatus;
            $item->save();
        }
        if ($item->status == 'verified') {
            Mail::to($item->email)->send(new NotificationEmailVerified($id));
        } else if ($item->status == 'accepted') {
            Mail::to($item->email)->send(new NotificationEmailAccepted($id));
        } else if ($item->status == 'rejected') {
            Mail::to($item->email)->send(new NotificationEmailRejected($id));
        }

    }

    public function print()
    {
        try {

            $configuration = Configuration::first();

            $year = AcademicYear::find($this->selectedYear);

            // ambil data dari render
            $students = collect($this->data);

            if ($students->isEmpty()) {
                return back()->with('error', 'Tidak ada data siswa.');
            }

            $pdf = Pdf::loadView('livewire.pdf.laporan-pendaftaran-siswa', [
                'students' => $students,
                'configuration' => $configuration,
                'year' => $year
            ]);

            $fileName = 'dataPendaftaran_Siswa_' . now()->format('Ymd_His') . '.pdf';

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $fileName);

        } catch (\Throwable $th) {

            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function exportExcel()
    {
        return Excel::download(
            new StudentExport(
                $this->search,
                $this->selectedYear,
                $this->selectedStatus
            ),
            'data-siswa.xlsx'
        );
    }
    public function render()
    {
        $years = AcademicYear::limit(10)->get();

        $students = Student::with('files', 'parents', 'year')

            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('id', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->selectedYear, function ($query) {
                $query->where('academic_year_id', $this->selectedYear);
            })

            ->when($this->selectedStatus, function ($query) {
                $query->where('status', $this->selectedStatus);
            })

            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // simpan data paginate ke property
        $this->data = $students->items();

        return view('livewire.backend.admin.ppdb.index', compact('students', 'years'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
