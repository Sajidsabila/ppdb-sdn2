<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\Configuration;
use Storage;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class ListComponent extends Component
{
    use WithPagination;

    public $title = "Data Siswa Terdaftar";
    public $id;

    public $search;
    public $data;
    public $item;
    protected $listeners = ['deleteConfirmed'];

    public function destroy($id)
    {
        try {
            $student = Student::with('files')->findOrFail($id);
            if ($student->files->kartu_keluarga) {
                Storage::disk('public')->delete($student->files->kartu_keluarga);
            }
            if ($student->files->pas_foto) {
                Storage::disk('public')->delete($student->files->pas_foto);
            }
            if ($student->files->akte_kelahiran) {
                Storage::disk('public')->delete($student->files->akte_kelahiran);
            }
            $student->delete();
            return response()->json(['success' => 'Data siswa berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 404);
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

        if ($item) {
            $item->status = $newStatus;
            $item->save();

        }
    }
    public function render()
    {
        $students = Student::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
            $query->orWhere('id', 'like', '%' . $this->search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(1);


        return view('livewire.backend.admin.ppdb.index', compact('students'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
