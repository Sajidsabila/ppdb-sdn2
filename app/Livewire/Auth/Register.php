<?php

namespace App\Livewire\Auth;

use Carbon\Carbon;
use Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Redirect;

class Register extends Component
{

    public $name, $email, $password, $password_confirmation;
    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.app');
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
            $veruficationToken = Str::random(mt_rand(4, 5));
            $user = User::create([
                'id' => (string) Str::uuid(),
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'remember_token' => $veruficationToken
            ]);
            Mail::to($user->email)->send(new VerificationEmail($user));
            event(new Registered($user));
            return back()->with('success', 'Akun Berhasi Dibuat Silahkan Aktivasi Email');

        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan :' . $th->getMessage());
        }
    }

    public function verification($token)
    {
        try {
            $user = User::where('remember_token', $token)->first();
            if (!$user) {
                return back()->with('error', 'Token tidak valid');
            }

            if ($user->email_verified_at !== null) {
                return back()->with('error', 'email sudah diverifikasi');
            }

            $user->email_verified_at = Carbon::now();
            $user->remember_token = null;
            $user->save();
            return redirect()->route('login')->with('success', 'email berhasil diverifikasi silahkan login');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan' . $th->getMessage());
        }
    }
}
