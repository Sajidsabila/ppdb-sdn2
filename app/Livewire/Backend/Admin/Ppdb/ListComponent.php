<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Storage;

class ListComponent extends Component
{
    use WithPagination;

    public $title = "Data Siswa Terdaftar";
    public $id;

    public $search;

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

    public function render()
    {
        $students = Student::orderBy('id', 'desc')->paginate(10);
        return view('livewire.backend.admin.ppdb.index', compact('students'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
