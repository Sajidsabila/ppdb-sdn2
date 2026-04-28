<?php

namespace App\Livewire\Backend\Admin\Ppdb;

use App\Models\Student;
use Livewire\Component;
use App\Models\AcademicYear;
use Livewire\WithPagination;
use App\Models\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentAccepted extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title = "Data Siswa Terdaftar";
    public $selectedYear;
    public $search;

    public function render()
    {
        $years = AcademicYear::limit(10)->get();

        $config = Configuration::first();
        $academic = AcademicYear::where('id', $this->selectedYear)->first()
            ?? AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return view('livewire.backend.admin.ppdb.student-accepted', [
                'students' => collect(),
                'years' => $years
            ])->layout('layouts.admin', ['title' => $this->title]);
        }

        $tanggalAcuan = \Carbon\Carbon::parse($academic->end_registration);

        // 🔥 ambil semua siswa (tanpa status DB)
        $studentsRaw = Student::where('academic_year_id', $academic->id)
            ->where('status', 'accepted')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        // 🔥 hitung ranking (sama seperti rank component)
        $ranking = $studentsRaw->map(function ($siswa) use ($config, $tanggalAcuan) {

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            ) / 1000;

            $siswa->distance = round($distance, 3);

            $km = floor($distance);
            $meter = round(($distance - $km) * 1000);

            $siswa->distance_detail = $km > 0
                ? $km . ' Km ' . $meter . ' Meter'
                : $meter . ' Meter';

            if ($siswa->date_of_birth) {
                $lahir = \Carbon\Carbon::parse($siswa->date_of_birth);
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

        // 🔥 QUOTA
        $quota = $academic->quota ?? 0;

        // 🔥 AMBIL YANG DITERIMA DARI RANK
        $accepted = $ranking->take($quota);

        // 🔥 SEARCH
        if ($this->search) {
            $accepted = $accepted->filter(function ($item) {
                return stripos($item->name, $this->search) !== false
                    || stripos($item->id, $this->search) !== false;
            })->values();
        }
        $perPage = 10;
        $currentPage = request()->get('page', 1);

        $students = new LengthAwarePaginator(
            $accepted->forPage($currentPage, $perPage),
            $accepted->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('livewire.backend.admin.ppdb.student-accepted', compact('students', 'years'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        try {
            $student = Student::with('files')->findOrFail($id);

            if ($student->files) {
                foreach (['kartu_keluarga', 'pas_foto', 'akte_kelahiran'] as $file) {
                    if ($student->files->$file) {
                        \Storage::disk('public')->delete($student->files->$file);
                    }
                }
            }

            $student->delete();

            return response()->json(['success' => 'Data siswa berhasil dihapus'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 404);
        }
    }

    // =========================
    // PDF DETAIL
    // =========================
    public function generatePdf($id)
    {
        try {
            $configuration = Configuration::first();

            $student = Student::with('files', 'parents', 'year')
                ->findOrFail($id);

            $pdf = Pdf::loadView('livewire.pdf.buktipendactaran', [
                'student' => $student,
                'configuration' => $configuration
            ]);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'Bukti_Pendaftaran_' . $student->name . '.pdf');

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    // =========================
    // PRINT PDF ALL ACCEPTED
    // =========================
    public function print()
    {
        try {
            $configuration = Configuration::first();
            $year = AcademicYear::find($this->selectedYear);

            if (!$year) {
                return back()->with('error', 'Tahun tidak ditemukan');
            }

            $tanggalAcuan = \Carbon\Carbon::parse($year->end_registration);

            $studentsRaw = Student::where('academic_year_id', $year->id)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->get();

            $ranking = $studentsRaw->map(function ($siswa) use ($configuration, $tanggalAcuan) {

                $distance = calculate_distance(
                    $siswa->latitude,
                    $siswa->longitude,
                    $configuration->latitude,
                    $configuration->longitude
                ) / 1000;

                $siswa->distance = round($distance, 3);

                if ($siswa->date_of_birth) {
                    $lahir = \Carbon\Carbon::parse($siswa->date_of_birth);
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
                // ->sort(function ($a, $b) {

                //     // 1. umur dulu (lebih tua = diffInDays lebih besar)
                //     if ($a->calculated_age != $b->calculated_age) {
                //         return $b->calculated_age <=> $a->calculated_age;
                //     }

                //     // 2. kalau umur sama → jarak
                //     return $a->distance <=> $b->distance;
                // })

                ->sort(function ($a, $b) {

                    // 1. jarak dulu (lebih kecil = lebih prioritas)
                    if ($a->distance != $b->distance) {
                        return $a->distance <=> $b->distance;
                    }

                    // 2. kalau jarak sama → umur (lebih tua = lebih prioritas)
                    return $b->calculated_age <=> $a->calculated_age;
                })

                ->values();



            // QUOTA
            $quota = $year->quota ?? 0;

            $students = $ranking->take($quota);

            if ($students->isEmpty()) {
                return back()->with('error', 'Tidak ada data siswa diterima');
            }

            $pdf = Pdf::loadView('livewire.pdf.laporan-siswa-diterima', [
                'students' => $students,
                'configuration' => $configuration,
                'year' => $year
            ]);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'Laporan_Siswa_Diterima_' . $year->id . '.pdf');

        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}