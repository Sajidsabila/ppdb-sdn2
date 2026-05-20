<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class NikValidasi implements ValidationRule
{
    protected $tanggalLahir;
    protected $jenisKelamin;

    public function __construct($tanggalLahir, $jenisKelamin)
    {
        $this->tanggalLahir = $tanggalLahir;
        $this->jenisKelamin = $jenisKelamin;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 16 digit angka
        if (!preg_match('/^[1-9][0-9]{15}$/', $value)) {
            $fail('NIK harus 16 digit angka dan tidak boleh diawali 0.');
            return;
        }

        // Semua angka sama
        if (preg_match('/^(.)\1{15}$/', $value)) {
            $fail('NIK tidak valid.');
            return;
        }

        // Ambil tanggal dari NIK
        $nikTanggal = (int) substr($value, 6, 2);
        $nikBulan = (int) substr($value, 8, 2);
        $nikTahun = (int) substr($value, 10, 2);

        // Parse tanggal lahir
        $tanggalLahir = Carbon::parse($this->tanggalLahir);

        $tgl = (int) $tanggalLahir->format('d');
        $bln = (int) $tanggalLahir->format('m');
        $thn = (int) $tanggalLahir->format('y');

        // Jika perempuan tambah 40
        if (strtolower($this->jenisKelamin) == 'perempuan') {
            $tgl += 40;
        }

        // Validasi cocok
        if (
            $nikTanggal !== $tgl ||
            $nikBulan !== $bln ||
            $nikTahun !== $thn
        ) {
            $fail('NIK tidak sesuai dengan tanggal lahir atau jenis kelamin.');
        }
    }
}