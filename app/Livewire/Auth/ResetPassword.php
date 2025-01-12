<?php

namespace App\Livewire\Auth;

use Hash;
use Password;
use App\Models\User;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email, $password, $token, $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request('email');
    }
    public function render()
    {
        return view('livewire.auth.reset-password')
            ->layout('layouts.app');
    }

    public function resetPassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        try {
            $reset = Password::reset(
                $this->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                }
            );
            if ($reset === Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('success', 'Password berhasil diubah');
            }
            return back()->with('error', 'Password gagal diubah');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan' . $th->getMessage());
        }
    }
}
