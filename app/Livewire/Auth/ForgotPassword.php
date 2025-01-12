<?php

namespace App\Livewire\Auth;

use Password;
use App\Models\User;
use Livewire\Component;
use App\Mail\ResetPassword;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

class ForgotPassword extends Component
{
    public $email;
    public function render()
    {
        return view('livewire.auth.forgot-password')
            ->layout('layouts.app');
    }

    public function sendToken()
    {
        $this->validate([
            'email' => 'required|exists:users,email'
        ]);

        try {

            $user = User::where('email', $this->email)->first();
            $token = Password::createToken($user);
            $url = url("reset-password/{$token}?email={$this->email}");
            Mail::to($this->email)->send(new ResetPassword($url, $user));
            session()->flash('success', 'Berhasil mengirim email untuk reset password. Silakan periksa kotak masuk Anda.');
        } catch (\Throwable $th) {
            session()->flash('error', 'terjadi kesalahan' . $th->getMessage());
        }

    }
}
