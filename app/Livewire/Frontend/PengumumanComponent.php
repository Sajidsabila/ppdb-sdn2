<?php

namespace App\Livewire\Frontend;

use App\Models\AcademicYear;
use App\Models\Configuration;
use App\Models\Student;
use App\Services\StudentRankingService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PengumumanComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Pengumuman Hasil Seleksi';
    public $academicYears = [];

    public $academic_year_id;
    public $search = '';

    // 🔥 INI PENTING (load lebih banyak data)

    public $perPage = 10;

    public function updatedAcademicYearId()
    {
        $this->perPage = 10;
    }

    public function mount($academic_year_id = null)
    {
        $this->academicYears = AcademicYear::latest()->get();

        $this->academic_year_id =
            $academic_year_id
            ?? AcademicYear::latest()->value('id');
    }

    public function updatingSearch()
    {
        $this->perPage = 10; // reset saat search
    }

    // 🔥 tombol load more
    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $ranking = StudentRankingService::calculate(
            $this->academic_year_id,
            $this->search
        );

        $studentsShow = $ranking->take($this->perPage);

        return view('livewire.frontend.pengumuman-component', [
            'students' => $studentsShow,
            'total' => $ranking->count(),
            'academicYears' => $this->academicYears,
        ])->layout('layouts.app', [
                    'title' => $this->title
                ]);
    }
}