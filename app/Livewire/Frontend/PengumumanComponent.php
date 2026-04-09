<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Configuration;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class PengumumanComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $title = 'Pengumuman Hasil Seleksi';

    public function render()
    {
        $config = Configuration::first();
        $academic = AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return view('livewire.frontend.pengumuman-component', [
                'students' => new LengthAwarePaginator([], 0, 10)
            ])->layout('layouts.frontend', ['title' => $this->title]);
        }

        // 🔥 FILTER LEBIH AMAN
        $students = Student::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('latitude', '!=', '')
            ->where('longitude', '!=', '')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->get();

        // 🔥 HITUNG JARAK & UMUR
        $ranking = $students->map(function ($siswa) use ($config) {

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            );

            // ✅ FIX: jadikan KM
            $distance = $distance / 1000; // HAPUS kalau function kamu sudah KM

            $siswa->distance = round($distance, 2);

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

        // 🔥 STATUS
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

        // 🔥 PAGINATION
        $perPage = 10;
        $currentPage = request()->get('page', 1);

        $pagedData = new LengthAwarePaginator(
            $ranking->forPage($currentPage, $perPage),
            $ranking->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('livewire.frontend.pengumuman-component', [
            'students' => $pagedData,
        ])->layout('layouts.app', ['title' => $this->title]);
    }
}