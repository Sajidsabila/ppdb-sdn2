<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
