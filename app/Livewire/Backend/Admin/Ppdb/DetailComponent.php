<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\Student;
use Livewire\Component;

class DetailComponent extends Component
{
    public $studentId;
    public $title = "Detail Pendaftar";


    public function render()
    {
        $student = Student::with(['parents', 'files'])->find($this->studentId);
        return view('livewire.backend.admin.ppdb.detail', compact('student'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
