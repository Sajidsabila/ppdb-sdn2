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

    protected $paginationTheme = 'bootstrap';
    public $search = '';


    public $title = "Peringkat Siswa Berdasarkan Jarak dan Umur";

    public function render()
    {
        $config = Configuration::first();
        $academic = AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return view('livewire.backend.admin.ppdb.student-rank-component', [
                'students' => new LengthAwarePaginator([], 0, 10)
            ])->layout('layouts.admin', ['title' => $this->title]);
        }

        // 🔥 tanggal acuan = akhir pendaftaran
        $tanggalAcuan = Carbon::parse($academic->end_registration);

        // 🔥 hanya siswa tahun ajaran aktif
        $siswaList = Student::where('academic_year_id', $academic->id)
            ->where('status', 'accepted')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $ranking = $siswaList->map(function ($siswa) use ($config, $tanggalAcuan) {

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            );

            // meter -> km
            $distance = $distance / 1000;

            // simpan raw distance
            $siswa->distance = round($distance, 3);

            // 🔥 format jarak detail
            $km = floor($distance);
            $meter = round(($distance - $km) * 1000);

            if ($km > 0) {
                $siswa->distance_detail = $km . ' Km ' . $meter . ' Meter';
            } else {
                $siswa->distance_detail = $meter . ' Meter';
            }

            // 🔥 umur detail
            if ($siswa->date_of_birth) {
                $lahir = Carbon::parse($siswa->date_of_birth);
                $umur = $lahir->diff($tanggalAcuan);

                // untuk ranking umur tertua
                $siswa->calculated_age = $lahir->diffInDays($tanggalAcuan);

                $siswa->age_detail =
                    $umur->y . ' Tahun ' .
                    $umur->m . ' Bulan ' .
                    $umur->d . ' Hari';
            } else {
                $siswa->calculated_age = 0;
                $siswa->age_detail = '-';
            }

            return $siswa;
        })
            ->sort(function ($a, $b) {
                if ($a->distance == $b->distance) {
                    return $b->calculated_age <=> $a->calculated_age;
                }

                return $a->distance <=> $b->distance;
            })
            // ->sort(function ($a, $b) {

            //     // 1. umur dulu (lebih tua = diffInDays lebih besar)
            //     if ($a->calculated_age != $b->calculated_age) {
            //         return $b->calculated_age <=> $a->calculated_age;
            //     }

            //     // 2. kalau umur sama → jarak
            //     return $a->distance <=> $b->distance;
            // })
            ->values();

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
            'academic' => $academic
        ])->layout('layouts.admin', ['title' => $this->title]);
    }
}