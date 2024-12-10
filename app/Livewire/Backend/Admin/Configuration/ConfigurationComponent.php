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
    public $logo, $email, $phone, $website, $name, $address;

    public function mount()
    {
        $configuration = Configuration::first();

        $this->logo = $configuration && $configuration->logo
            ? asset('storage/' . $configuration->logo)
            : null;
        $this->name = $configuration->name ?? '';
        $this->email = $configuration->email ?? '';
        $this->phone = $configuration->phone ?? '';
        $this->website = $configuration->website ?? '';
        $this->address = $configuration->address ?? ''; // Perbaikan typo "adsress" menjadi "address"
    }

    public function save()
    {
        $configuration = Configuration::first();
        $this->validate(
            [
                'name' => 'required|string|max:255',
                'logo' => $configuration ? 'nullable' : 'required|image|max:1120|mimes:jpg,png,jpeg,webp',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'website' => 'required|max:255',
                'address' => 'required|string|max:500', // Tambahkan validasi untuk address
            ],
            [
                'required' => ':attribute wajib diisi.',
                'max' => 'ukuran :attribute maksimal 1120 kilobyte.',
                'mimes' => ':attribute harus berupa file berformat: jpg, png, jpeg, atau webp.',
                'email' => 'Format:attribute tidak valid.',
                'url' => 'Format :attribute tidak valid.',
            ],
            [
                'name' => 'Nama',
                'logo' => 'Logo',
                'email' => 'Email',
                'phone' => 'Nomor telepon',
                'website' => 'Website',
                'address' => 'Alamat',
            ]
        );

        try {

            $filePath = $configuration ? $configuration->logo : null;

            // Hapus logo lama jika ada dan logo baru diunggah
            if (is_object($this->logo)) {
                if ($filePath) {
                    Storage::disk('public')->delete($filePath);
                }
                $filePath = $this->logo->store('configuration', 'public');
            }

            // Simpan atau perbarui data
            if ($configuration) {
                $configuration->update([
                    'name' => $this->name,
                    'logo' => $filePath,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'website' => $this->website,
                    'address' => $this->address,
                ]);
                session()->flash('success', 'Data berhasil diperbarui.');
            } else {
                Configuration::create([
                    'name' => $this->name,
                    'logo' => $filePath,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'website' => $this->website,
                    'address' => $this->address,
                ]);
                session()->flash('success', 'Data berhasil ditambahkan.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.configuration.index')
            ->layout('layouts.admin', ['title' => $this->title]);
    }
}
