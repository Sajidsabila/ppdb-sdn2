<?php

namespace App\Exports;

use App\Models\AcademicYear;
use App\Services\StudentRankingService;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentRankingExport implements FromCollection, WithHeadings
{
    protected $academic_year_id;
    protected $search;

    public function __construct($academic_year_id, $search)
    {
        $this->academic_year_id = $academic_year_id;
        $this->search = $search;
    }

    public function collection()
    {
        return StudentRankingService::calculate(
            $this->academic_year_id,
            $this->search
        )->map(function ($student) {

            return [
                'Nama Siswa' => $student->name,
                'Tanggal Lahir' => $student->date_of_birth,
                'Umur' => $student->age_detail,
                'Jarak Rumah' => $student->distance_detail,
                'Ranking' => $student->ranking,
                'Status' => $student->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Tanggal Lahir',
            'Umur',
            'Jarak Rumah',
            'Ranking',
            'Status',
        ];
    }
}