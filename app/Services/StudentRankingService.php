<?php

namespace App\Services;

use App\Models\AcademicYear;
use App\Models\Configuration;
use App\Models\Student;
use Carbon\Carbon;

class StudentRankingService
{
    public static function calculate($academicId = null, $search = null)
    {
        $config = Configuration::first();

        $academic = AcademicYear::find($academicId)
            ?? AcademicYear::latest()->first();

        if (!$config || !$academic) {
            return collect([]);
        }

        $tanggalAcuan = Carbon::parse($academic->end_registration);

        $students = Student::where('academic_year_id', $academic->id)
            ->where('status', 'accepted')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
                $q->orWhere('id', 'like', '%' . $search . '%');
            })
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $ranking = $students->map(function ($siswa) use ($config, $tanggalAcuan) {

            // ======================
            // HITUNG JARAK
            // ======================

            $distance = calculate_distance(
                $siswa->latitude,
                $siswa->longitude,
                $config->latitude,
                $config->longitude
            ) / 1000;

            $siswa->distance = round($distance, 3);

            $km = floor($distance);

            $meter = round(($distance - $km) * 1000);

            $siswa->distance_detail =
                $km > 0
                ? $km . ' Km ' . $meter . ' Meter'
                : $meter . ' Meter';

            // ======================
            // HITUNG UMUR
            // ======================

            if ($siswa->date_of_birth) {

                $lahir = Carbon::parse($siswa->date_of_birth);

                $umur = $lahir->diff($tanggalAcuan);

                $siswa->calculated_age =
                    $lahir->diffInDays($tanggalAcuan);

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

                // Prioritas jarak
                if ($a->distance != $b->distance) {
                    return $a->distance <=> $b->distance;
                }

                // Jika jarak sama → umur lebih tua
                return $b->calculated_age <=> $a->calculated_age;
            })

            ->values();

        $quota = $academic->quota ?? 0;

        $cadanganLimit = $quota + 2;

        foreach ($ranking as $i => $siswa) {

            $siswa->ranking = $i + 1;

            if ($i < $quota) {

                $siswa->status = 'Diterima';

            } elseif ($i < $cadanganLimit) {

                $siswa->status = 'Cadangan';

            } else {

                $siswa->status = 'Ditolak';
            }
        }

        return $ranking;
    }
}