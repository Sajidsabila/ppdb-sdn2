<?php
namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.app');
    }

    public function login()
    {
        // Validasi input
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.'
        ]);

        try {
            // Autentikasi pengguna
            if (Auth::attempt($credentials)) {
                // Regenerasi session untuk mencegah session fixation
                session()->regenerate();

                $user = Auth::user();

                // Periksa apakah email sudah diverifikasi
                if ($user->email_verified_at === null) {
                    Auth::logout();
                    return back()->with('error', 'Email belum diverifikasi.');
                }

                // Periksa role pengguna
                if ($user->role === 'user') {
                    return redirect()->route('home');
                }

                // Jika role tidak sesuai, logout pengguna
                Auth::logout();
                return back()->with('error', 'Anda tidak memiliki akses.');
            }

            // Jika kredensial salah
            return back()->with('error', 'Email atau password salah.');
        } catch (\Throwable $th) {
            // Penanganan error tak terduga
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $th->getMessage());
        }
    }

}