<?php

namespace App\Livewire\Frontend;

use App\Models\Student;
use Livewire\Component;
use App\Models\Configuration;
use Barryvdh\DomPDF\Facade\Pdf;

class DetailRegistration extends Component
{
    public function generatePdf($id)
    {
        try {
            $configuration = Configuration::first();
            $student = Student::with('files', 'parents', 'year')->findOrFail($id);
            $pdf = Pdf::loadView('livewire.pdf.buktipendactaran', [
                'student' => $student,
                'configuration' => $configuration
            ]);
            $fileName = 'Bukti_Pendaftaran_' . ($student->name ?? $student->id) . '.pdf';
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $fileName);
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
    public function render()
    {
        $student = Student::with('files')->where('user_id', auth()->user()->id)->first();
        return view('livewire.frontend.detail-registration', compact('student'))
            ->layout('layouts.app');
    }
}
