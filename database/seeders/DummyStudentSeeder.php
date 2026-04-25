<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyStudentSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('parents')->truncate();
        DB::table('students')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ===============================
        // ADMIN
        // ===============================
        DB::table('users')->insert([
            'id' => (string) Str::uuid(),
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => 'operator',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===============================
        // DATA MASTER
        // ===============================
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'];

        $ayahKerja = ['Petani', 'Nelayan', 'Buruh', 'Wiraswasta', 'PNS', 'Karyawan Swasta'];
        $ibuKerja = ['Ibu Rumah Tangga', 'Pedagang', 'Guru', 'Wiraswasta'];
        $pendidikan = ['SD', 'SMP', 'SMA', 'D3', 'S1'];

        $namaDepan = [
            'Ahmad','Muhammad','Ali','Rizky','Fajar','Dimas','Budi','Agus','Bayu','Rian',
            'Andi','Wahyu','Eko','Teguh','Arif','Rendra','Fikri','Yusuf','Hendra','Irfan'
        ];

        $namaBelakang = [
            'Saputra','Pratama','Wijaya','Santoso','Hidayat','Maulana','Utomo','Firmansyah','Prakoso','Ramadhan'
        ];

        $namaAyah = [
            'Sutrisno','Budi Santoso','Ahmad Fauzi','Joko Susilo','Haryanto',
            'Suparman','Agus Widodo','Eko Prasetyo','Mulyono','Slamet Riyadi'
        ];

        $namaIbu = [
            'Sulastri','Sri Wahyuni','Dewi Lestari','Siti Aminah','Rina Kartika',
            'Nur Aini','Wati','Endang Suryani','Sri Rahayu','Kartini'
        ];

        $alamatArea = [
            'Jl. Raya Sayung',
            'Jl. Pantura Demak',
            'Jl. Karangtengah',
            'Desa Sriwulan',
            'Desa Loireng',
            'Desa Kalisari',
            'Desa Batu',
            'Desa Tambakroto',
            'Desa Wonokerto',
            'Desa Tegalarum',
            'Desa Sidogemah',
            'Desa Jetaksari',
        ];

        // ===============================
        // BASE LOCATION (CONFIG DB KAMU)
        // ===============================
        $baseLat = -6.94354;
        $baseLng = 110.500185;

        for ($i = 1; $i <= 50; $i++) {

            $userId = (string) Str::uuid();
            $studentId = 'STD' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $nama = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
            $gender = rand(0, 1) ? 'Laki - laki' : 'Perempuan';

            DB::table('users')->insert([
                'id' => $userId,
                'name' => $nama,
                'email' => 'siswa' . $i . '@gmail.com',
                'role' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // umur 7–8 tahun
            $umur = rand(7, 8);
            $tanggalLahir = Carbon::now()->subYears($umur)->subDays(rand(1, 365));

            // ===============================
            // RANDOM LOCATION 2.5 KM
            // ===============================
            [$lat, $lng] = $this->generateRandomLocation($baseLat, $baseLng, 2.5);

            DB::table('students')->insert([
                'id' => $studentId,
                'academic_year_id' => 3,
                'user_id' => $userId,
                'name' => $nama,
                'gender' => $gender,
                'religion' => $agama[array_rand($agama)],
                'place_of_birth' => 'Demak',
                'date_of_birth' => $tanggalLahir,
                'citizenship' => 'WNI',
                'number_of_siblings' => rand(0, 4),

                'nik' => '3321' . rand(100000000000, 999999999999),
                'phone' => '08' . rand(1111111111, 9999999999),
                'email' => 'siswa' . $i . '@gmail.com',

                'address' => $alamatArea[array_rand($alamatArea)] . ', Demak, Jawa Tengah',

                'latitude' => $lat,
                'longitude' => $lng,

                'status' => collect(['pending','verified','accepted','rejected'])->random(),

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('parents')->insert([
                'student_id' => $studentId,
                'father_name' => $namaAyah[array_rand($namaAyah)],
                'father_education' => $pendidikan[array_rand($pendidikan)],
                'father_occupation' => $ayahKerja[array_rand($ayahKerja)],
                'mother_name' => $namaIbu[array_rand($namaIbu)],
                'mother_education' => $pendidikan[array_rand($pendidikan)],
                'mother_occupation' => $ibuKerja[array_rand($ibuKerja)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // ===============================
    // RANDOM COORDINATE WITH RADIUS
    // ===============================
   private function generateRandomLocation($lat, $lng, $radiusInKm = 2.5)
{
    $earthRadius = 6371;

    $distance = mt_rand(0, $radiusInKm * 1000); // meter
    $bearing = deg2rad(mt_rand(0, 360));

    $lat1 = deg2rad($lat);
    $lng1 = deg2rad($lng);

    $lat2 = asin(
        sin($lat1) * cos($distance / 1000 / $earthRadius) +
        cos($lat1) * sin($distance / 1000 / $earthRadius) * cos($bearing)
    );

    $lng2 = $lng1 + atan2(
        sin($bearing) * sin($distance / 1000 / $earthRadius) * cos($lat1),
        cos($distance / 1000 / $earthRadius) - sin($lat1) * sin($lat2)
    );

    return [rad2deg($lat2), rad2deg($lng2)];
}
}