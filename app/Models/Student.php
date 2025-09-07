<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            if (empty($student->id)) {
                $student->id = self::generateIdPendaftaran();
            }
        });
    }

    public static function generateIdPendaftaran()
    {
        $year = date('Y');
        $lastStudent = self::latest('id')->first();

        if (!$lastStudent) {
            return '0000001-' . $year;
        }

        $lastNumber = (int) substr($lastStudent->id, 0, strpos($lastStudent->id, '-')); // Ambil nomor urut terakhir

        // Tambahkan nomor urut baru
        $newNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT); // Pastikan panjang tetap 7 digit

        return $newNumber . '-' . $year;


    }
    public function parents()
    {
        return $this->hasOne(Parents::class);
    }

    public function files()
    {
        return $this->hasOne(File::class);
    }

    public function year()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
    public function isFilesComplete()
    {
        $files = $this->files()->first();

        return !empty($files->pas_foto) && !empty($files->kartu_keluarga) && !empty($files->akte_kelahiran);
    }


}
