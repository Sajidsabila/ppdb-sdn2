<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthAdmin extends Component
{
    public $email, $password;
    public function render(
    ) {
        return view('livewire.auth.auth-admin')
            ->layout('layouts.null');
    }

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'email.email' => 'Tipe Data Harus Email'
        ]);
        try {
            if (Auth::attempt($credentials)) {
                session()->regenerate();
                $user = Auth::user();

                if ($user->role === 'admin' || $user->role === 'operator') {
                    return redirect()->route('admin.home');
                }
                Auth::logout();
                return back()->with('error', "Username dan Password Salah");

            } else {
                return back()->with('error', "Email atau Password Salah");
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }

    }
}
