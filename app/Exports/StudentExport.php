<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $selectedYear;
    protected $selectedStatus;

    public function __construct($search, $selectedYear, $selectedStatus)
    {
        $this->search = $search;
        $this->selectedYear = $selectedYear;
        $this->selectedStatus = $selectedStatus;
    }

    public function collection()
    {
        return Student::query()

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

            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {

                return [
                    'id' => $item->id,
                    'name' => $item->name,

                    // status penerimaan
                    'status' => ucfirst($item->status),

                    // status berkas
                    'file_status' => $item->isFilesComplete()
                        ? 'Lengkap'
                        : 'Kurang Lengkap',

                    // format indonesia
                    'created_at' => Carbon::parse($item->created_at)
                        ->locale('id')
                        ->translatedFormat('d F Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID Pendaftaran',
            'Nama Siswa',
            'Status Penerimaan',
            'Status Berkas',
            'Tanggal Daftar',
        ];
    }
}