<?php

namespace App\Services;

class StudentService
{
    protected $studentId;

    /**
     * Set Student ID
     */
    public function setStudentId($id)
    {
        $this->studentId = strval($id); // Pastikan ID disimpan sebagai string
    }

    /**
     * Get Student ID
     */
    public function getStudentId()
    {
        return $this->studentId;
    }
}
