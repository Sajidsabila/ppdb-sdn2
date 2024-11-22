<?php

namespace App\Livewire\Auth;

use Hash;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class Register extends Component
{

    public $name, $email, $password, $password_confirmation;
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function register()
    {
        $user = $this->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|unique:users,name',
            'password' => 'required|min:8|confirmed'
        ], [
            'required' => ":attribute tidak boleh kosong",
            'unique' => ':attribute yang anda masukkan sudah tersedia',
            'min' => ':attribute minimal karakter: min',
            'confirmed' => ':attribute tidak sama dengan konfirmasi password'
        ], [
            'email' => 'email',
            'name' => 'username',
            'password' => 'password'
        ]);

        try {
            $user = User::create([
                'id' => (string) Str::uuid(),
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'email_verified_at' => now()
            ]);
            return back()->with('success', 'Akun Berhasi Dibuat silahkan');

        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan :' . $th->getMessage());
        }
    }
}
