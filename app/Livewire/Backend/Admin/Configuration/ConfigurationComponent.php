<?php

namespace App\Livewire\Backend\Admin\Configuration;

use Livewire\Component;
use App\Models\Configuration;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ConfigurationComponent extends Component
{
    use WithFileUploads;

    public $title = "Configuration";
    public $logo, $email, $phone, $website, $name, $address, $npsn, $latitude, $longitude;

    protected $listeners = ['setLocation'];

    public function mount()
    {
        $config = Configuration::first();

        if ($config) {
            $this->logo = $config->logo ? asset('storage/' . $config->logo) : null;
            $this->name = $config->name;
            $this->email = $config->email;
            $this->phone = $config->phone;
            $this->website = $config->website;
            $this->address = $config->address;
            $this->npsn = $config->npsn;
            $this->latitude = $config->latitude;
            $this->longitude = $config->longitude;
        }
    }

    public function setLocation($latitude = null, $longitude = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        logger("📍 Lokasi diterima dari frontend", [
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'website' => 'required|max:255',
            'address' => 'required|string|max:500',
            'npsn' => 'required|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ], [
            'required' => ':attribute wajib diisi.',
            'numeric' => ':attribute harus berupa angka.',
        ], [
            'name' => 'Nama Sekolah',
            'email' => 'Email',
            'phone' => 'Nomor Telepon',
            'website' => 'Website',
            'address' => 'Alamat',
            'npsn' => 'NPSN',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ]);

        $config = Configuration::first();

        try {
            $filePath = $config ? $config->logo : null;

            // Upload logo jika baru
            if (is_object($this->logo)) {
                if ($filePath) {
                    Storage::disk('public')->delete($filePath);
                }
                $filePath = $this->logo->store('configuration', 'public');
            }

            $data = [
                'name' => $this->name,
                'logo' => $filePath,
                'email' => $this->email,
                'phone' => $this->phone,
                'website' => $this->website,
                'address' => $this->address,
                'npsn' => $this->npsn,
                'latitude' => $this->latitude ?? null,
                'longitude' => $this->longitude ?? null,
            ];

            if ($config) {
                $config->update($data);
                session()->flash('success', 'Data berhasil diperbarui.');
            } else {
                Configuration::create($data);
                session()->flash('success', 'Data berhasil ditambahkan.');
            }
        } catch (\Throwable $th) {
            logger(' Gagal menyimpan konfigurasi:', ['error' => $th->getMessage()]);
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.configuration.index')
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
