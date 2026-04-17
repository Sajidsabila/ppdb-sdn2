<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\Configuration;
use Carbon\Carbon;

class PengumumanComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title = 'Pengumuman Hasil Seleksi';

    public $academic_year_id;
    public $search = '';

    // 🔥 INI PENTING (load lebih banyak data)
    public $perPage = 10;

    public function mount($academic_year_id = null)
    {
        $this->academic_year_id = $academic_year_id;
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
        $config = Configuration::first();

        $academic = AcademicYear::find($this->academic_year_id)
            ?? AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return view('livewire.frontend.pengumuman-component', [
                'students' => collect([])
            ])->layout('layouts.app', ['title' => $this->title]);
        }

        $tanggalAcuan = Carbon::parse($academic->end_registration);

        // 1. ambil semua data (WAJIB karena ranking)
        $students = Student::where('academic_year_id', $academic->id)
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // 2. hitung ranking
        $ranking = $students->map(function ($siswa) use ($config, $tanggalAcuan) {

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            ) / 1000;

            $siswa->distance = $distance;

            $km = floor($distance);
            $meter = round(($distance - $km) * 1000);

            $siswa->distance_detail =
                $km > 0 ? "$km Km $meter Meter" : "$meter Meter";

            if ($siswa->date_of_birth) {
                $lahir = Carbon::parse($siswa->date_of_birth);
                $umur = $lahir->diff($tanggalAcuan);

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

                // 1. umur dulu (lebih tua = diffInDays lebih besar)
                if ($a->calculated_age != $b->calculated_age) {
                    return $b->calculated_age <=> $a->calculated_age;
                }

                // 2. kalau umur sama → jarak
                return $a->distance <=> $b->distance;
            })
            ->values();

        // 3. status ranking
        $quota = $academic->quota ?? 0;
        $cadanganLimit = $quota + 2;

        foreach ($ranking as $i => $siswa) {
            if ($i < $quota) {
                $siswa->status = 'Diterima';
            } elseif ($i < $cadanganLimit) {
                $siswa->status = 'Cadangan';
            } else {
                $siswa->status = 'Ditolak';
            }
        }

        // 4. 🔥 INI LOAD MORE SYSTEM (Bukan paginate)
        $studentsShow = $ranking->take($this->perPage);

        return view('livewire.frontend.pengumuman-component', [
            'students' => $studentsShow,
            'total' => $ranking->count(),
        ])->layout('layouts.app', [
                    'title' => $this->title
                ]);
    }
}