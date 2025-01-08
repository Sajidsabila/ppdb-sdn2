<?php

namespace App\Livewire\Backend\Admin\Dashboard;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class DashboardAdminComponent extends Component
{
    public $title = "Dashboard";
    public $student;

    public function mount()
    {
        $students = Student::orderBy('created_at', 'desc')->limit(5)->get();
        $student = Student::select('academic_year_id', DB::raw('count(*) as total'))
            ->with('year') // Pastikan relasi 'year' didefinisikan di model Student
            ->groupBy('academic_year_id')
            ->limit(5)
            ->get();

        $data = [
            'dataset' => [],
            'label' => [],
        ];

        foreach ($student as $item) {
            $data['dataset'][] = $item->total; // Gunakan properti 'total' yang dihasilkan dari DB::raw
            $data['label'][] = $item->year->start_year . ' - ' . $item->year->end_year; // Format label
        }

        $this->student = json_encode($data);
    }

    public function render()
    {
        $data = [
            'all' => Student::count(),
            'pending' => Student::where('status', 'pending')->count(),
            'verified' => Student::where('status', 'verified')->count(),
            'accepted' => Student::where('status', 'accepted')->count(),
            'rejected' => Student::where('status', 'rejected')->count(),
        ];

        return view('livewire.backend.admin.dashboard.index', compact('data'))
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
