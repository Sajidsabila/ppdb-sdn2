<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        // Validasi input
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'email.email' => 'Tipe Data Harus Email'
        ]);

        try {
            // Autentikasi pengguna
            if (Auth::attempt($credentials)) {
                $this->session()->regenerate();
                $user = Auth::user();

                // Periksa apakah pengguna memiliki role "user"
                if ($user->role === 'user') {
                    return redirect()->route('user.dashboard');
                } else {
                    Auth::logout();
                    return back()->with('error', "Username dan Password Salah");
                }
            } else {
                return back()->with('error', "Email atau Password Salah");
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }
    }
}