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
            'role' => 'admin',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ===============================
        // DATA DUMMY SISWA 50
        // ===============================
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha'];
        $ayahKerja = ['Petani', 'Guru', 'Wiraswasta', 'PNS', 'Karyawan'];
        $ibuKerja = ['Ibu Rumah Tangga', 'Guru', 'Wiraswasta', 'PNS'];
        $pendidikan = ['SD', 'SMP', 'SMA', 'D3', 'S1'];

        for ($i = 1; $i <= 50; $i++) {

            $userId = (string) Str::uuid();
            $studentId = 'STD' . str_pad($i, 4, '0', STR_PAD_LEFT);

            $nama = fake()->name();
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

            DB::table('students')->insert([
                'id' => $studentId,
                'academic_year_id' => 3,
                'user_id' => $userId,
                'name' => $nama,
                'gender' => $gender,
                'religion' => $agama[array_rand($agama)],
                'place_of_birth' => 'Bandung',
                'date_of_birth' => Carbon::now()->subYears(rand(6, 8))->subDays(rand(1, 365)),
                'citizenship' => 'WNI',
                'number_of_siblings' => rand(0, 4),
                'nik' => '3201' . rand(100000000000, 999999999999),
                'phone' => '08' . rand(1111111111, 9999999999),
                'email' => 'siswa' . $i . '@gmail.com',
                'address' => fake()->address(),

                // sekitar sekolah (Bandung)
                'latitude' => -6.9000 + (rand(-100, 100) / 10000),
                'longitude' => 107.6000 + (rand(-100, 100) / 10000),

                'status' => collect([
                    'pending',
                    'verified',
                    'accepted',
                    'rejected'
                ])->random(),

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('parents')->insert([
                'student_id' => $studentId,
                'father_name' => fake()->name('male'),
                'father_education' => $pendidikan[array_rand($pendidikan)],
                'father_occupation' => $ayahKerja[array_rand($ayahKerja)],
                'mother_name' => fake()->name('female'),
                'mother_education' => $pendidikan[array_rand($pendidikan)],
                'mother_occupation' => $ibuKerja[array_rand($ibuKerja)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}