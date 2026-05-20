<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Exports\StudentRankingExport;
use App\Models\AcademicYear;
use App\Models\Configuration;
use App\Services\StudentRankingService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class StudentRankComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $academic_year_id = null;

    public $title = "Peringkat Siswa Berdasarkan Jarak dan Umur";

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingAcademicYearId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ranking = StudentRankingService::calculate(
            $this->academic_year_id,
            $this->search
        );

        $perPage = 10;

        // ambil page current dari livewire
        $currentPage = Paginator::resolveCurrentPage();

        $currentItems = $ranking
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->values();

        $students = new LengthAwarePaginator(
            $currentItems,
            $ranking->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
            ]
        );

        return view('livewire.backend.admin.ppdb.student-rank-component', [
            'students' => $students,
            'academicYears' => AcademicYear::latest()->get(),
            'academic' => AcademicYear::find($this->academic_year_id)
                ?? AcademicYear::latest()->first()
        ])->layout('layouts.admin', [
                    'title' => $this->title
                ]);
    }

    public function exportExcel()
    {
        return Excel::download(
            new StudentRankingExport(
                $this->academic_year_id,
                $this->search
            ),
            'ranking-siswa.xlsx'
        );
    }

    public function exportPdf()
    {
        $configuration = Configuration::first();
        $students = StudentRankingService::calculate(
            $this->academic_year_id,
            $this->search
        );

        $academic = AcademicYear::find($this->academic_year_id)
            ?? AcademicYear::latest()->first();

        $pdf = Pdf::loadView(
            'livewire.pdf.student-ranking',
            compact('students', 'academic', 'configuration')
        );

        return response()->streamDownload(
            fn() => print ($pdf->output()),
            'ranking-siswa.pdf'
        );
    }
}