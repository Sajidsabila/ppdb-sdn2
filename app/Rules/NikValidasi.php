<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NikValidasi implements ValidationRule
{
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

        // Ambil bagian tanggal lahir
        $tgl = (int) substr($value, 6, 2);
        $bln = (int) substr($value, 8, 2);
        $thn = (int) substr($value, 10, 2);

        // Perempuan +40
        if ($tgl > 40) {
            $tgl -= 40;
        }

        if ($tgl < 1 || $tgl > 31) {
            $fail('Nik tidak valid.');
            return;
        }

        if ($bln < 1 || $bln > 12) {
            $fail('Nik tidak valid.');
            return;
        }
    }
}