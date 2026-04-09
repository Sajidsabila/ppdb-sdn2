<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Configuration;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class StudentRankComponent extends Component
{
    use WithPagination;

    public $title = "Peringkat Siswa Berdasarkan Jarak dan Umur";
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $config = Configuration::first();
        $academic = AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return view('livewire.backend.admin.ppdb.student-rank-component', [
                'students' => collect(),
            ])->layout('layouts.admin', ['title' => $this->title]);
        }

        // 🔥 FILTER LEBIH KETAT
        $siswaList = Student::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', '')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->get();

        // 🔥 HITUNG JARAK & UMUR
        $ranking = $siswaList->map(function ($siswa) use ($config) {

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            );

            // ✅ FIX: pastikan KM
            $distance = $distance / 1000; // kalau function kamu meter

            $siswa->distance = round($distance, 2);

            // umur
            $siswa->calculated_age = $siswa->date_of_birth
                ? Carbon::parse($siswa->date_of_birth)->age
                : 0;

            return $siswa;
        })
            ->sort(function ($a, $b) {
                if ($a->distance == $b->distance) {
                    return $b->calculated_age <=> $a->calculated_age;
                }
                return $a->distance <=> $b->distance;
            })
            ->values();

        // kuota
        $quota = $academic->quota ?? 0;
        $cadanganLimit = $quota + 2;

        foreach ($ranking as $index => $siswa) {
            if ($index < $quota) {
                $siswa->status = 'Diterima';
            } elseif ($index < $cadanganLimit) {
                $siswa->status = 'Cadangan';
            } else {
                $siswa->status = 'Ditolak';
            }
        }

        // pagination
        $perPage = 10;
        $currentPage = request()->get('page', 1);

        $pagedData = new LengthAwarePaginator(
            $ranking->forPage($currentPage, $perPage),
            $ranking->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('livewire.backend.admin.ppdb.student-rank-component', [
            'students' => $pagedData,
        ])->layout('layouts.admin', ['title' => $this->title]);
    }
}